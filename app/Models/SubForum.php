<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubForum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function sticky_post() {
        return $this->hasOne(StickyPost::class);
    }
}
