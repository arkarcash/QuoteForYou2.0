<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BookCategory extends Model
{
    use HasFactory,SoftDeletes;


    public function books()
    {
        return $this->hasMany(Book::class,'book_category_id','id')
            ->with(['users' => function($u){
                return $u->where('user_id',Auth::guard('sanctum')->id())->wherePivot('expire_date','>=',today());
            }])
            ->take(20);
    }


}
