<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('note_id','tag_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
