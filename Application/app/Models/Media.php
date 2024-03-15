<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
    protected $fillable = [
        'pictures',
        'videos',
        'link',
        'title',
        'description',
        'sections',
        'slug',
        'status',
        'sort',
        'createdBy',
        'updatedBy',
    ];
}
