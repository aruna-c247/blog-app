<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Blog;
use App\Models\User;

class Analytics extends Controller
{
  public function index()
  {
    $totalBlogs = Blog::count();
    
    return view('content.dashboard.dashboards-analytics', compact('totalBlogs'));
  }

  /**
   * show profile page 
   */
  public function userProfile()
  {
    $userId = Auth::id(); 
    $userData = User::findOrFail($userId);
    return view('content.profile.profile-page', compact('userData'));
  }

}
