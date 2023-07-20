<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders = Order::with('OrderProducts','township')->withCount('OrderProducts')->where('user_id',Auth::id())->orderBy('id','DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => OrderResource::collection($orders),
            'meta' => [
                'total_product' => $orders->total(),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'has_more_page' => $orders->hasMorePages()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'township_id' => ['required','exists:townships,id'],
            'address' => 'required',
        ]);

        if($request->user_id != Auth::id()){
            return response()->json(['status' => 'error' , 'data' => 'Invalid User ID']);
        }

        $carts = Cart::where('user_id',Auth::id())->get();
        if(count($carts) == 0){
            return response()->json(['status' => 'error' , 'data' => 'no cart found on db']);
        }

        $township = Township::where('id',$request->township_id)->first();

        if($township->COD == '0'){
            $request->validate([
                'slip' => 'image|required',
                'payment_id' => 'required',
            ]);
        }

        $orderId = uniqid();

        DB::beginTransaction();
        try {

            $order = new Order();
            $order->order_id = 'BABY-ORDER-'.$orderId;
            $order->user_id = Auth::id();
            $order->township_id = $request->township_id;
            $order->address = $request->address;
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->note = $request->note ?? null;

            if($request->hasFile('slip')){
                $request->validate([
                    'payment_id' => 'required',
                ]);
                $file = $request->file('slip');
                $newName = uniqid().$file->getClientOriginalName();
                $path = 'public/order_payment/';
                if(Storage::exists($path)){
                    Storage::makeDirectory($path);
                }
                Storage::putFileAs($path,$file,$newName);
                $order->payment_slip = $newName;
                $order->payment_id = $request->payment_id;
            }
            $order->save();

            $addToOrders = $carts->mapToGroups(function ($p) use($orderId,$order){
                $product = Product::where('id',$p['product_id'])->first();

                if((int)$p['quantity'] > $product->stock){
                    DB::rollBack();
                    throw new \Exception("$product->name stock is only available $product->stock");
                }else{

                    $product->decrement('stock',(int)$p['quantity']);

//                    if($product->discount_percentage != 0 && $product->discount_price != 0){
//                        $total = $product->discount_price * $p['quantity'];
//                    }else{
//                        $total = $product->price * $p['quantity'];
//                    }

                    $orderProduct = new OrderProduct();
                    $orderProduct->order_id = $order->id ;
                    $orderProduct->quantity = $p['quantity'];
                    $orderProduct->product_price = $product->price;
//                    $orderProduct->discount_price = $product->discount_price;
//                    $orderProduct->discount_percentage = $product->discount_percentage;
                    $orderProduct->product_id = $product->id;
                    $orderProduct->sub_price = $product->price * $p['quantity'];
                    $orderProduct->save();

                    return [ 'total' => $orderProduct->sub_price ];
                }

            })->all();


            $total = array_sum($addToOrders['total']->toArray()) ;
            $carts->each->delete();

            DB::commit();
            return response()->json(['status' => 'success' , 'data' => 'successfully ordered' , 'DeliveryFees' => $township->fees, 'total' => $total , 'order_id' => $orderId ]);

        }catch (\Exception $err){
            DB::rollBack();
            return response()->json(['status' => 'error' , 'data' => $err->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $order = Order::with('OrderProducts')->withCount('OrderProducts')->where('order_id',$id)->get();
        return response()->json(['status' => 'success' , 'data' => OrderDetailResource::collection($order)]);

    }

    public function confirm($id)
    {
        $order = Order::where('id',$id)->first();
        $order->status = '1';
        $order->update();
        return redirect()->back();
    }

    public function delivery($id)
    {
        $order = Order::where('id',$id)->first();
        $order->status = '2';
        $order->update();
        return redirect()->back();
    }

    public function complete($id)
    {
        $order = Order::where('id',$id)->first();
        $order->status = '3';
        $order->update();
        return redirect()->back();
    }

    public function cancel($id)
    {
        $order = Order::where('id',$id)->first();
        $order->status = '4';
        $order->update();
        return redirect()->back()->with(['message' => 'Canceled']);
    }


}
