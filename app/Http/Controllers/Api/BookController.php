<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    use ResponseHelper;
    public function books(Request $request)
    {
        $books = Book::with('bookCategory')
            ->when(isset($request->category_id),function ($q) use ($request){
                return $q->where('book_category_id',$request->category_id);
            })
           ->with(['users' => function($u){
               return $u->where('user_id',Auth::guard('sanctum')->id())->wherePivot('expire_date','>=',today());
           }])
            ->when(isset($request->is_premium),function ($q) use ($request){
                return $q->where('is_premium',$request->is_premium);
            })->paginate(10);
//return $books;
        $meta = [
            'total' => $books->total(),
            'current_page' => $books->currentPage(),
            'last_page' => $books->lastPage(),
            'has_more_page' => $books->hasMorePages()
        ];
        return $this->success(BookResource::collection($books),$meta);
    }



    public function toggleSaveBook($book_id)
    {
        if (!Book::where('id',$book_id)->exists()){
            return $this->fail('giving id is invalid');
        }

        $user = User::where('id',Auth::guard('sanctum')->id())->first();

        $check = $user->whereHas('books',function ($q) use ($book_id){
            return $q->where('book_id',$book_id);
        })->exists();

        if($check){
            $book =  $user->books()->where('book_id',$book_id)->withPivot('expire_date','created_at')->first();

            $date = Carbon::make($book->pivot->expire_date)->addWeek();
            $primaryDate = $book->pivot->created_at;
            $user->books()->detach($book_id);
            $user->books()->attach( $book_id , ['expire_date' => $date,'created_at' => $primaryDate , 'updated_at' => now()]);

            return $this->success('Add One Week!');

        }else{
            $user->books()->attach( $book_id , ['expire_date' => now()->addWeek(),'created_at' => now() , 'updated_at' => now()]);
            return $this->success('saved!');
        }

    }


    public function savedBooks(Request $request)
    {
        $quote = Book::when(isset($request->is_poem),function ($q) use ($request){
                return $q->where('is_poem',$request->is_poem);
            })
            ->whereHas('users',function($u){
                return $u->where('user_id',Auth::guard('sanctum')->id());
            })
            ->with(['users' => function($u){
                return $u->where('user_id',Auth::guard('sanctum')->id())->wherePivot('expire_date','>=',today());
            }])
            ->paginate(10);
        $meta = [
            'total' => $quote->total(),
            'current_page' => $quote->currentPage(),
            'last_page' => $quote->lastPage(),
            'has_more_page' => $quote->hasMorePages()
        ];
        return $this->success(BookResource::collection($quote),$meta);
    }
}
