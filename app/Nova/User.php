<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
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

            Image::make('photo')
                ->path('kok')
                ->storeAs(function (Request $request) {
                    return Str::replace(' ','_',$request->photo->getClientOriginalName());
                })
                ->preview(function ($value, $disk) {
                    return $value
                        ? '/Ranks/'.$value
                        : null;
                })
                ->prunable()->hideWhenCreating()->hideWhenUpdating(),


            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),


            Text::make('email')
                ->sortable()
                ->rules('required', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Text::make('Points',function ($va){
                return sprintf(
                    '<span style="%s">'.$va['points'] ." ",
                    'color:#fab01b; font-weight:bold;font-size:18',
                );
            })->asHtml(),

            Text::make('Photo','photo')
                ->sortable()
                ->rules('required', 'max:255')->showOnUpdating(),

            HasOne::make('certificate')->showOnDetail()->hideWhenCreating()->hideWhenUpdating(),

            Number::make('Point','points')->hideFromDetail()->hideFromIndex(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            BelongsToMany::make('books')
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
