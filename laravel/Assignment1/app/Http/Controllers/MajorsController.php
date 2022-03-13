<?php

namespace App\Http\Controllers;

use App\Majors;
use Illuminate\Http\Request;
use Response;

class MajorsController extends Controller
{
    public function index()
    {
        $majors = Majors::orderBy("name")->get();
        return Response::json(
            [
                'status'=>200,
                'message'=>'Get majors',
                'data'=>$majors
            ]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function show(Majors $majors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function edit(Majors $majors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Majors $majors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Majors $majors)
    {
        //
    }
}