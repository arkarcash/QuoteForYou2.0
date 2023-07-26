<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\BookResource;
use App\Http\Resources\NoteResource;
use App\Http\Resources\VoiceCategoryResource;
use App\Http\Resources\VoiceResource;
use App\Models\Ads;
use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use App\Models\Voice;
use App\Models\VoiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    use ResponseHelper;
    public function poems(Request $request)
    {
        $poems = Note::when(isset($request->tag_id),function ($q) use ($request){
            return $q->whereHas('tags',function ($t) use ($request){
                return $t->where('tag_id',$request->tag_id);
            });
            })->when(Auth::guard('sanctum')->check(),function ($q) use ($request){
                return $q->withCount(['users' => function($u){
                    return $u->where('user_id',Auth::guard('sanctum')->id());
                }]);
            })->where('is_poem',1)->with('author','tags')
            ->when(isset($request->trending),function ($q) use ($request){
                return $q->orderBy('view','desc');
            })->orderBy('id','desc')->paginate(10);

           $meta = [
                'total' => $poems->total(),
                'current_page' => $poems->currentPage(),
                'last_page' => $poems->lastPage(),
                'has_more_page' => $poems->hasMorePages()
            ];

        return $this->success(NoteResource::collection($poems),$meta);

    }

    public function quote(Request $request)
    {
        $quote = Note::when(isset($request->tag_id),function ($q) use ($request){
                    return $q->whereHas('tags',function ($t) use ($request){
                        return $t->where('tag_id',$request->tag_id);
                    });
                })->when(Auth::guard('sanctum')->check(),function ($q) use ($request){
                   return $q->withCount(['users' => function($u){
                      return $u->where('user_id',Auth::guard('sanctum')->id());
                   }]);
                })->where('is_poem',0)
                ->when(isset($request->trending),function ($q) use ($request){
                    return $q->orderBy('view','desc');
                })->orderBy('id','desc')->paginate(10);

        $meta = [
            'total' => $quote->total(),
            'current_page' => $quote->currentPage(),
            'last_page' => $quote->lastPage(),
            'has_more_page' => $quote->hasMorePages()
        ];
        return $this->success(NoteResource::collection($quote),$meta);
    }

    public function voices(Request $request)
    {
        $voices = Voice::with('voiceCategory')
                        ->when(isset($request->category_id),function ($q) use ($request){
                            return $q->where('voice_category_id',$request->category_id);
                        })
                        ->when(isset($request->trending),function ($q) use ($request){
                            return $q->orderBy('view','desc');
                        })->orderBy('id','desc')->paginate(10);

        $meta = [
            'total' => $voices->total(),
            'current_page' => $voices->currentPage(),
            'last_page' => $voices->lastPage(),
            'has_more_page' => $voices->hasMorePages()
        ];
        return $this->success(VoiceResource::collection($voices),$meta);
    }

    public function voiceCategories()
    {
        $categories = VoiceCategory::get();
        return $this->success(VoiceCategoryResource::collection($categories));
    }



    public function toggleSaveNote($note_id)
    {
        if (!Note::where('id',$note_id)->exists()){
            return $this->fail('giving id is not valid');
        }

        $user = User::where('id',Auth::guard('sanctum')->id())->first();

        $check = $user->whereHas('notes',function ($q) use ($note_id){
            return $q->where('note_id',$note_id);
        })->exists();

        if($check){
            $user->notes()->detach($note_id);
            return $this->success('removed!');

        }else{
            $user->notes()->attach($note_id);
            return $this->success('saved!');
        }

    }


    public function savedNotes(Request $request)
    {
        $quote = Note::
                when(isset($request->is_poem),function ($q) use ($request){
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
        return $this->success(NoteResource::collection($quote),$meta);
    }

    public function increaseNote($noteId)
    {
        $note = Note::where('id',$noteId)->first();
        $note->increment('view',1);

        return $this->success($note);
    }

    public function increaseVoice($noteId)
    {
        $note = Voice::where('id',$noteId)->first();
        $note->increment('view',1);

        return $this->success($note);
    }

    public function ads()
    {
        $ads = Ads::select('id','type','banner','inter','reward')->get();
        return $this->success($ads);
    }
}
