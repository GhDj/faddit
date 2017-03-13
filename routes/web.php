<?php


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
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('auth/facebook', 'AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'AuthController@handleProviderCallback');
    Route::get('/login', 'AuthController@LoginView');
});

Auth::routes();
