<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdsRequest;
use App\Http\Requests\UpdateAdsRequest;
use App\Models\Ads;
use App\Models\Fcmtokenkey;
use Illuminate\Support\Facades\Http;

class AdsController extends Controller
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
     * @param  \App\Http\Requests\StoreAdsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdsRequest  $request
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdsRequest $request, Ads $ads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ads)
    {
        //
    }

    public static function sendPushNotification($title,$message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = config('app.firebase.server_key');
        $fcm_user_key = Fcmtokenkey::get();

        foreach ($fcm_user_key as $key){
            $notifications = [
                'title' => $title,
                'body' => $message ,
                'badge' => 1,
            ];



            $response =  Http::withHeaders([
                'Authorization' => "key={$serverKey}",
                'Content-Type' => "application/json"
            ])->post($url, [
                'to' => $key->token,
                'notification' => $notifications,
            ]);


            if($response->json()['failure'] == 1){
                $key->delete();
            }
            logger($response->json()['failure']);
        }

        return true;
    }
}
