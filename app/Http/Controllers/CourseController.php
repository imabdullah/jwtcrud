<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use JWTAuth;


class CourseController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }


    public function index()
    {
        return Course::where('user_id',$this->user->id)->orderBy('created_at','DESC')->get();
    }


    public function store(Request $request)
    {
        $course = new Course();
        $course->user_id = $this->user->id;
        $course->link = $request->get("link");
        $course->name = $request->get("name");
        $course->image = $request->get("image");
        $course->save();

        return response()->json([
            'success' => true,
            'message' => 'Course added successfully'
        ], Response::HTTP_CREATED);
    }

}
