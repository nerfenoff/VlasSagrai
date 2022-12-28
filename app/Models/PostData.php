<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostData extends Model
{
    public $timestamps = false;
    protected $table = 'posts_data';

    public function post() {
        return $this->hasOne(Post::class, 'post_data_id');
    }
}
