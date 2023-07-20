<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoiceRequest;
use App\Http\Requests\UpdateVoiceRequest;
use App\Models\Voice;

class VoiceController extends Controller
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
     * @param  \App\Http\Requests\StoreVoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function show(Voice $voice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function edit(Voice $voice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoiceRequest  $request
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoiceRequest $request, Voice $voice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voice $voice)
    {
        //
    }
}
