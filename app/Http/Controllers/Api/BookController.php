<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    use ResponseHelper;
    public function books(Request $request)
    {
        $voices = Book::with('voiceCategory')
            ->when(isset($request->category_id),function ($q) use ($request){
                return $q->where('voice_category_id',$request->category_id);
            })
            ->when(Auth::guard('sanctum')->check(),function ($q) use ($request){
                return $q->withCount(['users' => function($u){
                    return $u->where('user_id',Auth::guard('sanctum')->id());
                }]);
            })
            ->when(isset($request->is_premium),function ($q) use ($request){
                return $q->where('is_premium',$request->is_premium);
            })->paginate(10);
//return $voices;
        $meta = [
            'total' => $voices->total(),
            'current_page' => $voices->currentPage(),
            'last_page' => $voices->lastPage(),
            'has_more_page' => $voices->hasMorePages()
        ];
        return $this->success(BookResource::collection($voices),$meta);
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
            $user->books()->detach($book_id);
            return $this->success('removed!');

        }else{
            $user->books()->attach($book_id);
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
            ->withCount(['users' => function($u){
                return $u->where('user_id',Auth::guard('sanctum')->id());
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
