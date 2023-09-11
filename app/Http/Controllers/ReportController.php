<?php

namespace App\Http\Controllers;

use App\Http\Helper\ResponseHelper;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    use ResponseHelper;
    public function report(Request $request)
    {

        $request->validate([
           'photo' => 'required|image',
           'description' => 'required|string',
        ]);

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $path  = 'public/report/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            $newName = uniqid().$file->getClientOriginalName();

            Storage::putFileAs($path,$file,$newName);

            $productImage = new Report();
            $productImage->description = $request->description;
            $productImage->photo = 'report/'.$newName;
            $productImage->save();

        }

        return $this->success('Successfully Reported');


    }

    public function banners()
    {
        $banners = Banner::select('photo')->get();

        return $this->success(BannerResource::collection($banners));
    }
}
