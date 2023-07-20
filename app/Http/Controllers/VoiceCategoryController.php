<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoiceCategoryRequest;
use App\Http\Requests\UpdateVoiceCategoryRequest;
use App\Models\VoiceCategory;

class VoiceCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreVoiceCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoiceCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoiceCategory  $voiceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(VoiceCategory $voiceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoiceCategory  $voiceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(VoiceCategory $voiceCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoiceCategoryRequest  $request
     * @param  \App\Models\VoiceCategory  $voiceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoiceCategoryRequest $request, VoiceCategory $voiceCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoiceCategory  $voiceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoiceCategory $voiceCategory)
    {
        //
    }
}
