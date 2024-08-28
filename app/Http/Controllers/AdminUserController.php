<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
// use Session;

class AdminUserController extends Controller
{
    //

    public function index() 
    {
        $admins = AdminUser::getAllAdmins();
        // Pass the admins to the view
        return view('admin.dashboard', ['admins' => $admins]);
    }

    public function subadmin(){
       
        $admins = AdminUser::getSubAdmins();
        return view('admin.superAdminDashboard', ['admins' => $admins]);
    }
        
        
    

    
    
}
