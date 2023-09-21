<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;

class Certificate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Certificate>
     */
    public static $model = \App\Models\Certificate::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Image::make('Contributor','contributor')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),
            Image::make('Rising Star','rising_star')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),

            Image::make('Guru','guru')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),

            Image::make('Mentor','mentor')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),


            Image::make('Mystery','mystery')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),
            Image::make('Creator','creator')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),

            Image::make('Specialist','specialist')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),
            Image::make('Collaborator','collaborator')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),
            Image::make('Authority','authority')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),
            Image::make('Legend','legend')
                ->preview(function ($value, $disk) {
                    return $value
                        ? asset('/storage/certificates/'.$value)
                        : null;
                }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
