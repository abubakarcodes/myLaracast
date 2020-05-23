<?php

namespace App\models;
use App\models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Series extends Model
{
    use Searchable;
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

   protected $fillable = [
       'title',
       'imageUrl',
       'description',
       'slug',
   ];

   public function getOrderedLessons(){
       return $this->lessons()->orderBy('episode_number' , 'asc')->get();
   }
}
