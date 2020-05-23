<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Series;
class FrontEndController extends Controller
{
    public function showSeries(){
        $series = Series::orderBy('id' , 'desc')->paginate(5);
        return view('index' , compact('series'));
    }


    public function search(Request $request){
        $series = Series::search($request->search)->paginate(5);
        return view('index' , compact('series'));
    }
}
