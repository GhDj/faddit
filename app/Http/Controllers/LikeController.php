<?php

namespace App\Http\Controllers;

use App\CommentLike;
use App\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postLike($id){
        $pl = new PostLike();
        $pl->user_id = Auth::user()->id;
        $pl->post_id = $id;
        $pl->save();
        return 'success';
    }

    public function commentLike($id){
        $cl = new CommentLike();
        $cl->id_user = Auth::user()->id;
        $cl->comment_id = $id;
        $cl->save();
        return 'success';
    }

    public function removePostLike($id) {
        $pl = PostLike::where([['user_id','=',Auth::user()->id],['post_id','=',$id]])->get();
        PostLike::destroy($pl->id);
        return 'deleted';
    }

    public function removeCommentLike() {
        dd(Input::all());
        if (Request::ajax())
        {
            dd(Input::all());
            $pl = CommentLike::where([['user_id','=',Auth::user()->id],['comment_id','=',Input::get('id')]])->get();
            CommentLike::destroy($pl->id);
            return 'deleted';
        }

    }
}
