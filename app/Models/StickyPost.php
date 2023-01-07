<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubForum;
use App\Models\Post;

class StickyPost extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'post_id',
    ];

    public function subForum() {
        return $this->belongsTo(SubForum::class);
    }

    public function post() {
        return $this->hasOne(Post::class);
    }
}
