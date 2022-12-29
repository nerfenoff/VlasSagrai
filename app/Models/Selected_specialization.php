<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected_specialization extends Model
{
    public $timestamps = false;
    protected $table = 'selected_specializations';
    protected $fillable = [
        'post_data_id',
        'specialization_id',
    ];
}
