<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryBookResource;
use App\Http\Resources\NoteResource;
use App\Http\Resources\NotesResource;
use App\Http\Resources\TrafficResource;
use App\Models\Blog;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Month;
use App\Models\MonthAnalysis;
use App\Models\Tag;
use App\Models\User;
use App\Nova\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    use ResponseHelper;
    public function books(Request $request)
    {
        $books = Book::with('bookCategory')
            ->withCount('users')
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
            })->orderBy('id','desc')->paginate(12);

        $meta = [
            'total' => $books->total(),
            'current_page' => $books->currentPage(),
            'last_page' => $books->lastPage(),
            'has_more_page' => $books->hasMorePages()
        ];
        return $this->success(BookResource::collection($books),$meta);
    }

    public function CategoryBooks(Request $request)
    {

        $books = BookCategory::with('books')
            ->orderBy('id','desc')->paginate(10);

        return $this->success(CategoryBookResource::collection($books),self::getMeta($books));

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
        $books = Book::whereHas('users',function($u){
                return $u->where('user_id',Auth::guard('sanctum')->id());
            })
            ->with(['users' => function($u){
                return $u->where('user_id',Auth::guard('sanctum')->id())->wherePivot('expire_date','>=',today());
            }])
            ->paginate(10);

        return $this->success(BookResource::collection($books),self::getMeta($books));
    }

    public function blogs()
    {
        $blogs = Blog::latest()->paginate(10);
        $meta = $this->getMeta($blogs);
        return $this->success(BlogResource::collection($blogs),$meta);
    }

    public function analysis()
    {
        $analysis = Month::select('name')->where('is_show',1)->first();

        $traffic = MonthAnalysis::select('id','month_id','traffic','name')->whereHas('month',function ($q){
            return $q->where('is_show',1);
        })->get();

        return response()->json([
            'points' => $traffic->pluck('traffic'),
            'months' => $analysis
        ]);
    }

    public function tags()
    {
        $tags = Tag::select('id','name')->paginate(16);
        return $this->success(AuthorResource::collection($tags),self::getMeta($tags));

    }

    public function bookAuthor()
    {
        $authors = BookAuthor::select('id','name')->paginate(16);
        return $this->success(AuthorResource::collection($authors),self::getMeta($authors));
    }


    public function noteAuthor()
    {
        $authors = \App\Models\Author::select('id','name')->paginate(16);
        return $this->success(NotesResource::collection($authors),self::getMeta($authors));
    }
    /**
     * @param $blogs
     * @return array
     */
    protected function getMeta($data): array
    {
        $meta = [
            'total' => $data->total(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'has_more_page' => $data->hasMorePages()
        ];
        return $meta;
    }
}
