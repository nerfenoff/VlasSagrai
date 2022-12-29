<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected_special_need extends Model
{
    public $timestamps = false;
    protected $table = 'selected_special_needs';
    protected $fillable = [
        'post_data_id',
        'special_needs_id',
    ];
}
