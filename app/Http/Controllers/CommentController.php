<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Request;
use Redirect;

use App\Comment;

class CommentController extends Controller
{
    function __construct() {
        $this->middleware('authed', ['only' => ['store']]);
    }

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
        $validator = Validator::make(Request::all(), [
            'proposal_id' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('/proposal/' . Request::get('proposal_id'))
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment;
        $comment->user_id = Session::get('id');
        $comment->proposal_id = Request::get('proposal_id');
        $comment->content = Request::get('content');
        $comment->save();

        Session::flash('success', 'Комментарий добавлен.');

        return Redirect::to('/proposal/' . Request::get('proposal_id'));
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
}
