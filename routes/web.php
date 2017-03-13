<?php

use App\Like;

Route::get('/', function () {
    $posts = App\Post::get();
    return view('welcome')->with('posts', $posts);
});

Route::get('post/{id}', function($id){
    $post = App\Post::find($id);
    return view('app.postview')->with('post', $post);
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/logged', 'AppController@index');
    Route::get('/logout','AppController@UserLogout');
    Route::get('nickname', 'AppController@ShowNicknameView');
    Route::post('nickname', 'AppController@PostNickname');
    Route::get('post', function(){
        return view('app.posts');
    });
    Route::post('post', function(){
        $data = [
            'body' => Request::get('body'),
            'user_id' => Auth::user()->id
        ];
        App\Post::create($data);
    });


    Route::post('comment', function(){
        $data = [
            'body' => Request::get('body'),
            'user_id' => Auth::user()->id,
            'post_id' => Request::get('post_id')
        ];
        App\Comment::create($data);
        return redirect('post/'.Request::get('post_id'));

    });




    Route::get('/like/{id}/{category}',function($id, $cat){

        $user_id = Auth::id();
        $like = App\Like::where('user_id', $user_id)->where('el_id', $id)->where('category', $cat)->first();
        if($like){
                $like->delete();
                return response()->json(['liked' => false]);
        }else{
            $new_like = new Like();
            $new_like->user_id = $user_id;
            $new_like->el_id = $id;
            $new_like->category = $cat;
            $new_like->save();
            return response()->json(['liked' => true]);
        }
    });

    Route::get('test', function(){
        $user = App\User::first();
        echo($user->like[0]->Element('22')->get());
    });
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('auth/facebook', 'AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'AuthController@handleProviderCallback');
    Route::get('/login', 'AuthController@LoginView');
});

Auth::routes();


