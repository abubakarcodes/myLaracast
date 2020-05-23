<?php

namespace App\Http\Controllers;

use App\models\Lesson;
use Illuminate\Http\Request;
use App\models\Series;
use Illuminate\Support\Facades\Validator;

class LessonsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Series $series , Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'episode_number' => 'required',
            'video_id' => 'required',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors() , 422);
        }
       return $series->lessons()->create([
           'title' => $request->title,
           'description' => $request->description,
           'episode_number' => $request->episode_number,
           'video_id' => $request->video_id,
       ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Series $series ,Lesson $lesson)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'episode_number' => 'required',
            'video_id' => 'required',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors() , 422);
        }
         $lesson->update($request->all());
         return $lesson->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series , Lesson $lesson)
    {
        return $lesson->delete();

    }
}
