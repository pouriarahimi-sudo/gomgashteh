<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        // Test database connection
        try {
            DB::connection()->getPdo();

            $announcements = Announcement::where('status',1)->get();
            $categories = Category::all();
            return view('user.index',compact('announcements','categories'));

        } catch (\Exception $e) {
            echo 'خطای اتصال به سرور';
//            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
