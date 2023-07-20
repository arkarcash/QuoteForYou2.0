<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function voiceCategory()
    {
        return $this->belongsTo(VoiceCategory::class)->withTrashed();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
