<?php

namespace App\Http\Controllers;

use App\models\Series;
use App\Http\Requests\SeriesRequest;
use Illuminate\Support\Str;


class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Series::orderBy('id' , 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.series');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesRequest $request)
    {
        $upload_path = public_path('series');
        $generated_new_name = Str::slug($request->title) . time() . '.' . $request->imageUrl->getClientOriginalExtension();
        $request->imageUrl->move($upload_path, $generated_new_name);
        // return response()->json(['success' => 'You have successfully uploaded "' . $file_name . '"']);
        $series = Series::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'imageUrl' => $generated_new_name,
            'description' => $request->description,

        ]);

        return $series;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        return view('admin.lessons' , compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
       return $series;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(SeriesRequest $request, Series $series)
    {
        if($request->hasFile('imageUrl')){
            $upload_path = public_path('series');
        $generated_new_name = Str::slug($request->title) . time() . '.' . $request->imageUrl->getClientOriginalExtension();
        $request->imageUrl->move($upload_path, $generated_new_name);
        }
        $series->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'imageUrl' => $generated_new_name ? $generated_new_name : Str::slug($request->title),
            'description' => $request->description,

        ]);

        return $series;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        return $series->delete();
    }
}
