<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function bookCategory()
    {
        return $this->belongsTo(BookCategory::class)->withTrashed();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('expire_date');
    }
}
