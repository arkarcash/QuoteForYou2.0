<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\Translation\t;

class CartController extends Controller
{
    use ResponseHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $carts = Cart::with('Product')->where('user_id',Auth::id())->get();
        $price = 0;
        $totaLPrice = $carts->map(function ($value) use ($price){
            return $price += $value->product->price * $value->quantity;
        });

        return response()->json([
                'status' => true,
                'data' => CartResource::collection($carts),
                'totalPrice' => array_sum($totaLPrice->toArray()),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            foreach ($request->carts as $cart){

                if(Product::where('id',$cart['product_id'])->exists()){
                    $product = Product::where('id',$cart['product_id'])->first();

                    $quantity = (int)$cart['quantity'];

                    logger('Product Stock is '.$product->stock .':'. 'User Quantity'.$quantity);
                    if($product->stock < $quantity){
                        DB::rollBack();
                        throw new \Exception("$product->name stock is only available $product->stock");
                    }
                    $cart = new Cart();
                    $cart->product_id = $product->id;
                    $cart->user_id = Auth::id();
                    $cart->quantity = $quantity;
                    $cart->save();

                }else{
                    DB::rollBack();
                    throw new \Exception('product id '. $cart['product_id'].'  not exists');
                }

            }

//            return Cart::where('user_id',Auth::id())->get();

            DB::commit();
            return $this->success('successfully added');

        }catch (\Exception $err){
            DB::rollBack();
            return $this->fail($err->getMessage(),422);
        }
    }


    public function singleStore(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|min:1',
        ]);

        if ($validate->fails()){
            if (isset($validate->fails()['product_id']['Exists'])){
                return $this->fail('Product ID Not Exists On Database');
            }

            if (isset($validate->fails()['quantity'])){
                return $this->fail('Quantity Required');
            }

            return $this->fail($validate->getMessageBag());
        }

        DB::beginTransaction();

        try {

            $product = Product::where('id',$request->product_id)->first();
            $quantity = (int)$request->quantity;

            if($product->stock < $quantity){
                DB::rollBack();
                throw new \Exception("$product->name stock is only available $product->stock");
            }

            $check = Cart::where('user_id',Auth::id())->where('product_id',$product->id);
            if($check->exists()){
                $check->first()->increment('quantity',1);
            }else{
                $cart = new Cart();
                $cart->product_id = $product->id;
                $cart->user_id = Auth::id();
                $cart->quantity = $quantity;
                $cart->save();
            }

            DB::commit();
            return $this->success();

        }catch (\Throwable $err){

            DB::rollBack();
            return $this->fail($err->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('id',$id)->first();
        if(!$cart){
            return $this->fail('Cart ID NOT FOUND!');
        }

        $validate = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$cart->Product->stock],
        ]);

        if($validate->fails()){
            if (isset($validate->fails()['quantity']['Max'])){
                return $this->fail('Product Quantity NOT ENOUGH');
            }
            return $this->fail($validate->getMessageBag());
        }

        $cart->quantity = $request->quantity;
        $cart->update();
        return $this->success('Successfully Updated');
    }


    public function deleteCart($cart_id)
    {

        $cart = Cart::where('user_id',Auth::id())->where('id',$cart_id)->first();

        if($cart){
            $cart->delete();
            return $this->success( 'successfully deleted');
        }

        return $this->fail(' CART ID NOT FOUND');

    }
}
