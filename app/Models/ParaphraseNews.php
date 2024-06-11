<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParaphraseNews extends Model
{
    use HasFactory;

    protected $table = 'paraphrase_news';
    protected $fillable = [
        'url',
        'title',
        'image',
        'category',
        'content',
        'status',
        'reference',
    ];

}
