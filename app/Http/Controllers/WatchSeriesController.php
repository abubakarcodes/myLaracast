<?php

namespace App\Http\Controllers;

use App\models\Series;
use App\models\Lesson;
use Illuminate\Http\Request;

class WatchSeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('watchLessons');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Series $series)
    {
       return view('watchSeries', compact('series'));
    }


    public function watchLessons(Series $series ,  $id){
        $lesson = Lesson::findOrFail($id);
        return view('watchLessons', compact(['series' , 'lesson']));
    }



}
