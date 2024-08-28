<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailToUser;
use Illuminate\Support\Facades\Auth;

// use App\Models\AdminUser;



class AdminController extends Controller
{


    public function index(){
        return view('admin.dashboard');
    }
    public function adminLogin()
    {
        return view('admin-login');
    }

    public function forgetPassword()
    {
        return view('forget-password');
    }

    public function checkOtp()
    {
        return view('otp');
    }

    public function resetPassword()
    {
        return view('reset-password');
    }

    
    public function authenticateAdmin(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email_address' => 'required|email',
            'password'    => 'required',
          ]);

        
           $adminUser = DB::table('admin_users')
                        ->select('*')
                        ->where('email_address', $request->email_address)
                        ->first();
            // dd($adminUser);
                
            if ($adminUser) 
            {
                // Check if the admin user is active
                if ($adminUser->is_active == 1) 
                {
                    // Verify the password
                    if (password_verify($request->password, $adminUser->password)) 
                    {
                        if($adminUser->admin_type=='S'){
                        // Set session variables
                        Session::put('admin_id', $adminUser->admin_id);
                        Session::put('admin_email', $adminUser->email_address);
                        Session::put('admin_name', $adminUser->admin_name);
                        Session::put('timezone', $request->timezone);
                        Session::put('admin_type', $adminUser->admin_type);
        
                        // Redirect to the UserController index action
                        return redirect()->action([AdminUserController::class, 'index']);
                    }
                    else{
                        // Set session variables
                        Session::put('admin_id', $adminUser->admin_id);
                        Session::put('admin_email', $adminUser->email_address);
                        Session::put('admin_name', $adminUser->admin_name);
                        Session::put('timezone', $request->timezone);
                        Session::put('admin_type', $adminUser->admin_type);
        
                        // Redirect to the UserController index action
                        return redirect()->action([AdminUserController::class, 'subadmin']);
                    }
                }
                    else {
                        // Return back with a password error message
                        return back()->with('message', 'Please enter the correct password.');
                    }
                }    
                else{
                    // Return back with an inactive account error message
                    return back()->with('message', 'This account is not active.');
                        
                }
            } 
            else {
                // Return back with an email error message
                return back()->with('message', 'Please enter the correct email.');
            }
            
    }

    public function forgetPasswordwithEmail(Request $request)
    {
        // dd($request->all());
        try{
            // $user = Admin_User::where('email_id',$request->email_id)->first();
            $user = DB::table('admin_users')
                ->where('email_address', $request->email_address)
                ->first();
            // dd($user);
            // if(count($user)>0)
            // if ($user) 
            if ($user && $user->is_active == 1) 

            {
               $email_address = trim($request->email_address);
               
             
                $otp = self::randomNumber();
                
                $save = self::saveEmailOtp($email_address, $otp);
                if($save){
                    $toUserName =$user->admin_name;
                    // dd($toUserName);
                    $mailSend =  self::SendMailToUserForForgotPasswordOtp($email_address, $toUserName, $otp);
                        if($mailSend){
                          session(['reset_email' => $request->email_address]);
                            // return redirect('/OTPpage')->with('email',$email);
                            return view('otp')->with('message','OTP sent to your Email')->with('email_address',$email_address);
                        }else{
                            return back()->with('message',"Some Error to send OTP ??");
                        }
                }
    
            }
            else
            {
              return back()->with('message',"Error Your Email wouldn't Exists");
            }
    
          }
          catch(\Exception $e){
    
            return back()->with('error',$e->getMessage());
    
          }
            
    }

    public static function saveEmailOtp($email_id, $otp) {
        $dateTime = gmdate('Y-m-d H:i:s');

        $sql = "REPLACE INTO verify_email(email_id, otp, created_datetime) VALUES ('$email_id', $otp, '$dateTime' )";
        $save = DB::statement($sql);
        return true;
    }

    public static function randomNumber()
    {
        return mt_rand(1000, 9999);
    }

    public static function SendMailToUserForForgotPasswordOtp($toEmailId, $toUserName, $otp) 
    {
  
          $app_name = "StoryTV";
          $supportEmail = "agicent.devices@gmail.com";
          $subject = 'OTP for mail verification';
  
  
        $bodyText = '
            <table valign="top" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" style="border-radius: 0 0 8px 8px;background: #fff;overflow: hidden;padding: 0 20px;">
                <tr>
                    <td style="padding: 0 20px;">
                        <p style="margin-top:5px;font-size:14px;">Hello,</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0 20px; padding-bottom: 30px;">
                        <p style="margin-top:5px;font-size:14px;">You have requested to verify your email address. Please use the below code to verify your request.</p>
                        <p style="font-size: 24px; margin-top:5px;"><b>' . $otp . '</b></p>
                        <p style="margin-top:5px;font-size:14px;">Enter this code to complete the signup process.</p>
                        <p style="margin-bottom: 30px; font-size:14px;"><i>' . $app_name . ' Team</i></p>
                    </td>
                </tr>
            </table>';
    
          $send = Mail::to($toEmailId)->send(new SendMailToUser($toUserName, $subject, $bodyText));
          
  
          return true;
    }

    public function verifyOtp(Request $request)
    {
        // dd("check");
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
        ]);
        // dd("check");

        if ($validator->fails()) {
            return redirect()->route('otp')->with('message', "Invalid OTP")->withInput();
        }

        // Retrieve email from session
        $email = session('reset_email');
        // dd($email);
       
        if (!$email) {
            return redirect()->route('otp')->with('message', "No email found in session");
        }

        // Retrieve the stored OTP from the database
        $storedOtp = DB::table('verify_email')
            ->where('email_id', $email)
            ->value('otp');

        if (!$storedOtp) {
            return redirect()->route('otp')->with('message', "No OTP found for the given email");
        }

        if ($request->otp == $storedOtp) {
            // Correct OTP, perform redirect
            // return redirect()->route('reset-password')->with('email', $email);
            // dd("ggg");
            return view('reset-password', ['email' => $email]);
        } else {
            
            // Incorrect OTP
            return redirect()->route('otp')->with('message', "Incorrect OTP");
        }
    }

    
   public function resetPswd(Request $request)
    {
       
      // Retrieve email from session
      $email = session('reset_email');
    //   dd($email);
    $hashedPassword = Hash::make($request->password);

      if (!$email) {
          // Handle the case where the email is not found in the session
          return redirect()->action([AdminUserController::class, 'showLoginPage']);
      }

      // Update the password in the database
      $user = DB::table('admin_users')
          ->where('email_address', $email)
          ->update([
            'password' => $hashedPassword,
                     ]);
          
       // Clear the email from the session after updating the password
       session()->forget('reset_email');

      if($user)
      {
      return redirect()->route('admin-login')->with('success','Your Password Reset Successfully You can Login Now !!');
      }
      else
      {
        // return redirect('/login')->with('message','Your Password Not Reset due to some error !!');
        return redirect()->route('admin-login')->with('message','Your Password Not Reset due to some error !!');
      }
     
  }

 


}

