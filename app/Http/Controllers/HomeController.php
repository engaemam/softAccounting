<?php

namespace App\Http\Controllers;
use App\Model\Member;
use App\Model\Project;
use App\Model\Setting;
use App\Model\Pages;

use Illuminate\Http\Request;
//use Illuminate\Http\Request;
class HomeController extends Controller
{

    public function index()
    {
        return redirect('admin');
    }


}