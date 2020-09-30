<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class comment extends Model
{
    use HasFactory;


    public static function store(Request $request)
    {
        // Validate the request...
        // dd($request);
        $comment = new comment;


        $comment->content = $request->content;

        $comment->save();
    }
}