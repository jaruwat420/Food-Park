<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    // index function
    public function index(Request $request){

        return view ('staff.dashboard.index');
    }


}
