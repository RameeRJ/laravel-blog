<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'title',         // Add title here
        'post_text',     // Add post_text or any other required fields
        'user_id',       // If you are saving the user who creates the post
        'image',         // If there is an image field (even though it's null for some posts)
        'poststatus',    // If you have a post status field
    ];
}
