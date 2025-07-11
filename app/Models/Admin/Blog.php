<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Blog extends Model
{
    use HasFactory;   
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'status',
        'author_id'
    ];
}
