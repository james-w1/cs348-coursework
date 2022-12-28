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
        'body'
    ];

    public function subForum() {
        return $this->belongsTo(SubForum::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function reply() {
        return $this->hasMany(Reply::class);
    }
}
