<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\TrafficResource;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Category;
use App\Models\Month;
use App\Models\MonthAnalysis;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    use ResponseHelper;
    public function books(Request $request)
    {
        $books = Book::with('bookCategory')->withCount('users')
            ->when(isset($request->category_id),function ($q) use ($request){
                return $q->where('book_category_id',$request->category_id);
            })
            ->when(isset($request->author_id),function ($q) use ($request){
                return $q->where('book_author_id',$request->author_id);
            })
            ->when(isset($request->keyword),function ($q) use ($request){
                return $q->where('title','LIKE',"%$request->keyword%");
            })
           ->with(['users' => function($u){
               return $u->where('user_id',Auth::guard('sanctum')->id())->wherePivot('expire_date','>=',today());
           }])
            ->when(isset($request->trending),function ($q) use ($request){
                return $q->orderBy('users_count','desc');
            })
            ->when(isset($request->is_premium),function ($q) use ($request){
                return $q->where('is_premium',$request->is_premium);
            })->orderBy('id','desc')->paginate(10);

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

            $date = Carbon::make($book->pivot->expire_date);
            $primaryDate = $book->pivot->created_at;
            $user->books()->detach($book_id);


            if ($date->gte(today())){
                $user->books()->attach( $book_id , ['expire_date' => $date->addWeek(),'created_at' => $primaryDate , 'updated_at' => now()]);
            }else{
                $user->books()->attach( $book_id , ['expire_date' => now()->addWeek(),'created_at' => now() , 'updated_at' => now()]);
            }


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

    public function blogs()
    {
        $blogs = Blog::latest()->paginate(10);
        $meta = [
            'total' => $blogs->total(),
            'current_page' => $blogs->currentPage(),
            'last_page' => $blogs->lastPage(),
            'has_more_page' => $blogs->hasMorePages()
        ];
        return $this->success(BlogResource::collection($blogs),$meta);
    }

    public function analysis()
    {
        $analysis = Month::select('name')->where('is_show',1)->first();

        $traffic = MonthAnalysis::select('id','month_id','traffic','name')->whereHas('month',function ($q){
            return $q->where('is_show',1);
        })->get();

        return response()->json([
            'points' => TrafficResource::collection($traffic),
            'months' => $analysis
        ]);
    }

    public function tags()
    {
        $tags = Tag::select('id','name')->get();

        return $this->success($tags);

    }
}
