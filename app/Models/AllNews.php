<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllNews extends Model
{
    use HasFactory;

    protected $table = 'all_news';
    protected $fillable = [
        'url',
        'title',
        'status',
        'category',
    ];

}
