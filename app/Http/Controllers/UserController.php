<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\AdminHelper;
use Illuminate\Support\Facades\Session;
use App\Models\Event; 


class UserController extends Controller
{
    public function index()
    {
        $users = User::getAllVerifiedUsers(); 
        $divToShow = 0;
        $formCount = 0;
        // dd($users);
        if(Session::has('admin_id')){
            return view('users.user')
                ->with('users',$users)
                ->with('divToShow',$divToShow)
                ->with('formCount',$formCount);
        }
        else{
            return redirect()->action([AdminController::class, 'adminLogin'])->with('message', 'Please Log in first.');
        }
        
    }

    public function block($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        User::blockUser($id); // Assuming this method blocks the user in User model

        return redirect()->route('users.index')->with('success', 'User blocked successfully.');
    }

    public function details($id)
    {
        $user = User::getUserDetails($id);
        // dd($user);



        // // Render Blade views to HTML
        // $userDetailsHtml = view('users.user_details', compact('user'))->render();
        // // $viewUserDetailsHtml = view('partials.view_user_details', compact('user'))->render();

        return view('partials.user_details')->with('user', $user);

        // // Return JSON response with rendered HTML
        // return response()->json([
        //     'user_details' => $userDetailsHtml,
        //     // 'view_user_details' => $viewUserDetailsHtml
        // ]);
    }

    public function userStats()
    {
        $users = User::getUserStatistics(); // Assuming this method retrieves user statistics
        return view('users.user_stats', compact('users'));
    }

    public function getFollowers($user_id)
    {
        $followers = User::getFollowers($user_id); // Assuming this method retrieves followers
        return response()->json($followers);
    }

    public function getFollowing($user_id)
    {
        $following = User::getFollowing($user_id);
        return response()->json($following);
    }

    public function show($id)
    {
        $user = User::getUserDetails($id);
        $followers = User::getFollowersWithNames($id);
        //dd($followers);
        return view('partials.view_user')
            ->with('user', $user)
            ->with('followers', $followers);
    }


    public function userSearch(Request $request){
        // dd("hello");
        // dd($request->all());
        $inputValue = $request->all();
        $searchIn = $request->search_in;
        // dd($request->all());


        for ($i = 0; $i < count($searchIn); $i++) {
          if ($searchIn[$i] == 'block_flag' || $searchIn[$i] == 'created_datetime' || $searchIn[$i]=='sign_via') {
            $searchType[$i] = 'exact_match';
          } else {
            $searchType[$i] = $request->search_type[$i];
          }
        }

        $suggestionText = $request->suggestion_text;

        $isVerified = $request->block_flag;
        

        $formCount = $request->formCount;
        $divToShow = $request->divToShow;
        $limitFlag = $request->limit_flag;
        $dateFilters = $request->datefilter;
        $startDate = array();
        $endDate = array();

        foreach ($dateFilters as $dateFilter) {
          if ($dateFilter != "") {
              $splitDateFilter = explode(' ~ ', $dateFilter);
              $startDateFilter = $splitDateFilter[0] . " 00:00:00";

            // echo '<pre>';
            // print_r($startDateFilter);
              //$startDateFilterFormat = date("Y/m/d H:i:s", strtotime($startDateFilter));
              $startDateFilterFormat = date("m/d/Y H:i:s", strtotime($startDateFilter));


              $endDateFilter = $splitDateFilter[1] . " 23:59:59";

              //$endDateFilterFormat = date("Y/m/d H:i:s", strtotime($endDateFilter));
              $endDateFilterFormat = date("m/d/Y H:i:s", strtotime($endDateFilter));

              //$timezone = 'America/Los_Angeles';
              $timezone = Session::get('timezone');

              $start_date = AdminHelper::ConvertLocalTimezoneToGMT($startDateFilterFormat, $timezone);
              $end_date = AdminHelper::ConvertLocalTimezoneToGMT($endDateFilterFormat, $timezone);
          } else {
              $start_date = '';
              $end_date = '';
          } 

          $startDate[] = $start_date;
          $endDate[] = $end_date;

        } 
        

        $users = User::getUserSearchData($searchIn, $searchType, $suggestionText, $isVerified, $startDate, $endDate, $limitFlag);
        // dd($users);

        
        return view('users.user')
            ->with('users',$users)
            ->with('divToShow' ,$divToShow)
            ->with('inputValue',$inputValue)
            ->with('searchType',$searchType)
            ->with('searchIn',$searchIn)
            ->with('formCount' ,$formCount);

        
    }

    public function blogPost(Request $request)
    {
        return view('Blogs.blog_card');
    }

    public function checkPage()
    {
        // return view('blog');
        return view('Blogs.new_page');
    }

    public function event() {
        return view('Event.event_html');
        // return view('Blogs.new_page');
    }


    public function Page()
{
    $events = Event::paginate(6); // Paginate with 6 items per page
    return view('events.index', compact('events'));
}



}
