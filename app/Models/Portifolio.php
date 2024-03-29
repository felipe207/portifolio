<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portifolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','sub_title',
        'big_image','small_image',
        'description',
        'client','category'
    ];
}
