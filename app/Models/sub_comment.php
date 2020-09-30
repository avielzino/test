<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class sub_comment extends Model
{
    use HasFactory;


    public static function store(Request $request)
    {
        // Validate the request...
        // dd($request);
        $sub_comment = new sub_comment;
        $sub_comment->for_comment = $request->for_comment;

        $sub_comment->content = $request->content;

        $sub_comment->save();
    }
}