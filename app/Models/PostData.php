<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostData extends Model
{
    public $timestamps = false;
    protected $table = 'posts_data';
    protected $fillable = [
        'post_data_id',

        'image',
        'phone',
        'address',
        'coords',
        'education_level',
        'city',
        'educational_institution',
        'form_of_education',
        'the_presence_of_a_barrier_free_environment',
    ];

    public function post() {
        return $this->hasOne(Post::class, 'post_data_id');
    }
}
