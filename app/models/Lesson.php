<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected  $fillable =  [
        'title',
        'description',
        'video_id',
        'series_id',
        'episode_number',
    ];


    public function series(){
        return $this->belongsTo(Series::class);
    }


    public function nextLesson(){
        return $this->series->lessons()->orderBy('episode_number' , 'asc')
                    ->where('episode_number', '>' , $this->episode_number)
                     ->first();
    }

    public function previousLesson(){
        return $this->series->lessons()
                ->orderBy('episode_number' , 'desc')
                ->where('episode_number', '<' , $this->episode_number)
                ->first();
    }


}
