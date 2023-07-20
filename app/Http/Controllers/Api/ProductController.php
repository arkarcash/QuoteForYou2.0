<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseHelper;
    public function index(Request $request)
    {
        $products = Product::with('photos')->when(isset($request->keyword),function ($q) use ($request){
                        return $q->where('name','LIKE',"%$request->keyword%");
                    })->when(isset($request->category_id),function ($q) use ($request){
                        return $q->where('category_id',"$request->category_id");
                    })->when(isset($request->from_age),function ($q) use ($request){
                        return $q->where('from_age',$request->from_age)->where('to_age',$request->to_age);
                    })->latest('id')->paginate(10);
        $meta = [
            'total_product' => $products->total(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'has_more_page' => $products->hasMorePages()
        ];
        return $this->success(ProductResource::collection($products),$meta);
    }

    public function show($id)
    {

    }
}
