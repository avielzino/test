<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\comment;
use App\Models\sub_comment;
use Illuminate\Support\Facades\Session;

date_default_timezone_set ('israel') ;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    $data['comments'] = comment::all()->toArray();

    $data['sub_comments'] = sub_comment::all()->toArray();
if(!(session()->has('alert'))){
    session::put('alert','wellcome to my blog');
}
    return view('welcome', $data);
});


Route::post('newpost', function (Request $request) {
    session::put('alert','new post posted');

    comment::store($request);
    return redirect('/');
});

Route::post('newsubpost', function (Request $request) {
    session::put('alert','new comment posted');

    sub_comment::store($request);
    return redirect('/');
});

Route::post('del', function (Request $request) {
    comment::where('comment_id', $request['delete'])->delete();
    sub_comment::where('for_comment', $request['delete'])->delete();
    session::put('alert','post and all comment delited');

    return redirect('/');
});