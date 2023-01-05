<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Process;
use App\Models\SubForum;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image_name',
        'image_path',
    ];

    public function subForum() {
        return $this->belongsTo(SubForum::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reply() {
        return $this->hasMany(Reply::class);
    }
}
