<?php

namespace App\Http\Controllers;

use App\Models\Ska;
use Illuminate\Http\Request;

class SkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Ska  $ska
     * @return \Illuminate\Http\Response
     */
    public function show(Ska $ska)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ska  $ska
     * @return \Illuminate\Http\Response
     */
    public function edit(Ska $ska)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ska  $ska
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ska $ska)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ska  $ska
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ska $ska)
    {
        $ska->delete();
        return back();
    }
}
