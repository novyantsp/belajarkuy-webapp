<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $courses = Course::all();
        $course_details = CourseDetail::all();

        return view('dashboard', compact('courses', 'course_details'));
    }
}
