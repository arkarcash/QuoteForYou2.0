<?php

namespace App\Nova;

use App\Nova\Filters\OrderStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Order>
     */
    public static $model = \App\Models\Order::class;

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
            BelongsTo::make('user'),
            BelongsTo::make('township'),

            Text::make('Total',function ($va){
                return sprintf(
                    '<span style="%s">'. number_format(collect($va["OrderProducts"])->sum("sub_price")) .'</span>',
                    'color:#0f0; font-weight:bold',
                );
            })->asHtml()->sortable(true),

            Text::make('delivery_to','name')->hideFromIndex(),
            Text::make('delivery_phone','phone')->hideFromIndex(),
            Text::make('address')->hideFromIndex(),
            Text::make('note')->hideFromIndex(),

            Text::make('Status',function ($va){
                // return $va['isBan'] == '1' ? 'Ban' : 'Normal';
                if($va['status'] == '0'){
                    return sprintf(
                        '<a style="%s"  href="/nova/resources/order/confirm/'.$this->id.'">Confirm</a>
                                <a style="%s"  href="/nova/resources/order/cancel/'.$this->id.'">Cancel</a>',
                        'color:#fff700; font-weight:bold;margin-right:10px;border: 1px solid;border-radius: 8px;padding: 5px 16px;','color:#ff0000; font-weight:bold;border: 1px solid;border-radius: 8px;padding: 5px 16px;'
                    );
                }else if($va['status'] == '1'){
                    return sprintf(
                        '<a style="%s"  href="/nova/resources/order/delivery/'.$this->id.'">Delivery</a>',
                        'color:#ff8100ee; font-weight:bold;border: 1px solid;border-radius: 8px;padding: 5px 16px;',
                    );
                }else if($va['status'] == '2'){
                    return sprintf(
                        '<a style="%s" href="/nova/resources/order/complete/'.$this->id.'">Complete</a>',
                        'color:#00ff00; font-weight:bold;border: 1px solid;border-radius: 8px;padding: 5px 16px;',
                    );
                }else if($va['status'] == '3'){
                    return sprintf(
                        '<a style="%s">Done</a>',
                        'color:#00ff00; font-weight:bold',
                    );
                }else{
                    return sprintf(
                        '<a style="%s">Canceled</a>',
                        'color:#ff0000; font-weight:bold',
                    );
                }

            })->asHtml(),
            HasMany::make('OrderProducts'),
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
        return [
            new OrderStatus()
        ];
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

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

   public static function authorizedToCreate(Request $request)
   {
       return false;
   }

   public function authorizedToUpdate(Request $request)
   {
       return false;
   }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
}
