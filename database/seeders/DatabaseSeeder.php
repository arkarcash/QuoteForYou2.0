<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Township;
use App\Models\VoiceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'points' => 1,
             'email' => 'customer@gmail.com',
         ]);

         DB::table('admins')->insert([
             'name' => 'ivan',
             'email' => 'ivan@gmail.com',
             'email_verified_at' => now(),
             'password' => Hash::make('password')
         ]);

         $categories = ['လက်အိတ်','ဉီးထုတ်','ဖိနပ်','နို့ဗူး','အကျီ','ဘောင်းဘီ','အနွေးထည့်','နို့မှုန့်','ပေါင်ဒါမှန့်'];

         foreach ($categories as $cat){
             $catgory = new VoiceCategory();
             $catgory->name = $cat;
             $catgory->save();
         }


        $this->call([
            TagSeeder::class,
            NoteSeeder::class,
            AuthorSeeder::class,
            UserSeeder::class,
        ]);


//         Product::factory(10)->create()->each(function ($p){
//             for ($i=0;$i<random_int(2,5);$i++){
//                 $poto = new ProductPhoto();
//                 $poto->product_id = $p->id;
//                 $poto->photo = 'default.png';
//                 $poto->save();
//             }
//
//         });


//        $payments = [
//            [
//                "id" => 12,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/GixEPJKtw3MMJ961Bh3wI1aafOf4oQeOp7bKYb86.jpg",
//                "payment_type" => "A BANKING",
//                "name" => "U YAN NAING PHYO",
//                "number" => "04651681256",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:39:45.000000Z",
//                "updated_at" => "2023-05-29T06:39:45.000000Z"
//            ],
//            [
//                "id" => 11,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/tCLGiw7VtzUgjbpW7z3SlLoo8glZbYDBuXlp0a62.png",
//                "payment_type" => "MAB BANKING",
//                "name" => "U YAN NAING PHYO",
//                "number" => "23186512351285",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:39:06.000000Z",
//                "updated_at" => "2023-05-29T06:39:06.000000Z"
//            ],
//            [
//                "id" => 10,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/JAe9ZGtAtngXUSaYWGfL0Z479bTf3pF92IWfoqV5.jpg",
//                "payment_type" => "UAB BANKING",
//                "name" => "U YAN NAING PHYO",
//                "number" => "21544784582",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:38:21.000000Z",
//                "updated_at" => "2023-05-29T06:38:21.000000Z"
//            ],
//            [
//                "id" => 9,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/DZ7lehz3qSadW5f564ZFmsjL83EJ2BudVFQHaMwc.jpg",
//                "payment_type" => "UAB PAY",
//                "name" => "YAN NAING PHYO",
//                "number" => "09799606909",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:37:48.000000Z",
//                "updated_at" => "2023-05-29T06:37:48.000000Z"
//            ],
//            [
//                "id" => 8,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/0UBq4xU2IxNyR8Sqo4coDyLHvw1kfPW1PjW7jmOZ.png",
//                "payment_type" => "CB BANKING",
//                "name" => "U YAN NAING PHYO",
//                "number" => "2521531455",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:37:25.000000Z",
//                "updated_at" => "2023-05-29T06:37:25.000000Z"
//            ],
//            [
//                "id" => 7,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/1OptFrBWLf7wqeynPSRqO0EnjFGsGavnLuXZAvOI.jpg",
//                "payment_type" => "CB PAY",
//                "name" => "YAN NAING PHYO",
//                "number" => "09799606909",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:37:06.000000Z",
//                "updated_at" => "2023-05-29T06:37:06.000000Z"
//            ],
//            [
//                "id" => 6,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/3NLF6OY8bZLu30Vwg2r6a8oqZH724LGLZiPETRXk.jpg",
//                "payment_type" => "AYA BANKING",
//                "name" => "U YAN NAING PHYO",
//                "number" => "1252454585",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:36:35.000000Z",
//                "updated_at" => "2023-05-29T06:36:35.000000Z"
//            ],
//            [
//                "id" => 5,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/ugoDqToUnMt4Bx9yEYl5XOuzceX3gX6CFzWwHhZj.jpg",
//                "payment_type" => "AYA PAY",
//                "name" => "YAN NAING PHYO",
//                "number" => "09799606909",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:36:03.000000Z",
//                "updated_at" => "2023-05-29T06:36:03.000000Z"
//            ],
//            [
//                "id" => 4,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/TSXkUjywdb10zMGok84pbukiqS7YTdjFEvHwidyJ.jpg",
//                "payment_type" => "YOMA BANKING",
//                "name" => "U YAN NAING PHYO",
//                "number" => "02021515454",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:35:28.000000Z",
//                "updated_at" => "2023-05-29T06:35:28.000000Z"
//            ],
//            [
//                "id" => 3,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/QwOe28NtW9MJ8cj8KuDilgbvZUQHTCTfKmyko50D.png",
//                "payment_type" => "WAVE PAY",
//                "name" => "YAN NAING PHYO",
//                "number" => "09799606909",
//                "status" => "1",
//                "created_at" => "2023-05-29T06:34:49.000000Z",
//                "updated_at" => "2023-05-29T06:34:49.000000Z"
//            ],
//            [
//                "id" => 2,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/sN5qWwhys6vsv5uvcccSqwFHcnfVKSF2uxEZN2sk.png",
//                "payment_type" => "K PAY",
//                "name" => "YAN NAING PHYO",
//                "number" => "09799606909",
//                "status" => "1",
//                "created_at" => "2023-04-24T04:13:57.000000Z",
//                "updated_at" => "2023-05-29T06:33:25.000000Z"
//            ],
//            [
//                "id" => 1,
//                "payment_logo" => "https://binary.apponlineshop.com/image/payments/dYW8VWbDqNIWyFaH7mf8zFKHDTZYpQCeMViXIdvT.png",
//                "payment_type" => "KBZ BANKING",
//                "name" => "U YAN NAING PHYO",
//                "number" => "09123457777",
//                "status" => "1",
//                "created_at" => "2022-10-20T10:58:46.000000Z",
//                "updated_at" => "2023-05-29T06:34:04.000000Z"
//            ]
//        ];

//        foreach ($payments as $P)
//        {
//            $payment = new Payment();
//            $payment->name = $P['name'];
//            $payment->photo = $P['payment_logo'];
//            $payment->number= $P['number'];
//            $payment->save();
//        }

//        \App\Models\User::factory(29)->create()->each(function ($u){
//
//            for ($i=0; $i< rand(1,9); $i++){
//                $unique = uniqid();
//
//                $order = new Order();
//                $order->order_id = $unique;
//                $order->user_id = $u->id;
//                $order->name = $u->name;
//                $order->phone = '09887765443';
//                $order->address = 'Taunggyi,Ayetahryar 13 quatar';
//                $order->township_id = Township::all()->random()->id;
//                $order->created_at = now()->subDays(rand(1,30));
//                $order->updated_at = now()->subDays(rand(1,30));
//                $order->save();
//
//
//                for ($i=0; $i< rand(1,3); $i++){
//                    $product = Product::all()->random();
//                    $quantity = random_int(1,4);
//
//                    $orderProduct = new OrderProduct();
//                    $orderProduct->order_id = $order->id ;
//                    $orderProduct->quantity = $quantity;
//                    $orderProduct->product_price = $product->price;
//                    $orderProduct->product_id = $product->id;
//                    $orderProduct->sub_price = $product->price * $quantity;
//                    $orderProduct->save();
//                }
//            }
//
//        });
    }
}
