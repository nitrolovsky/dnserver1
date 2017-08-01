<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Validator;
use View;

use App\Http\Requests;
use App\Post;

class PostController extends Controller
{
    function __construct() {
        $this->middleware('authorAdmin', ['only' => ['create', 'store', 'show', 'edit', 'update']]);
    }
    public function index() {
        $posts = Post::where('enabled', 1)
            ->orderBy('id', 'desc')
            ->paginate(5);
        return View::make('post.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::has('access')) {
            Session::flash('danger', 'Пройдите аутентификацию для создания новости.');
            return redirect('/user/login');
        }
        if (Session::get('access') < 1) {
            Session::flash('danger', 'Недостаточно прав для создания новости.');
            return Redirect::to('/');
        }

        $categorys = DB::table('newscat')->get();

        return view('post.create')
            ->with('categorys', $categorys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Session::has('access')) {
            Session::flash('danger', 'Пройдите аутентификацию для создания новости.');
            return redirect('/user/login');
        }
        if (Session::get('access') < 1) {
            Session::flash('danger', 'Недостаточно прав для создания новости.');
            return redirect('/');
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|max:255',
            'text' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('post/create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post;
        $post->category_id = $request->category;
        $post->user_id = Session::get('id');
        $post->full_text = $request->text;
        if ($request->enabled) {
            $post->enabled = "False";
        } else {
            $post->enabled = "True";
        }
        $post->date = date('Y-m-d H:i:s');
        $post->save();

        Session::flash('success', 'Новость добавлена.');

        return redirect("/post");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Session::has('access')) {
            Session::flash('danger', 'Пройдите аутентификацию для создания новости.');
            return redirect('/user/login');
        }
        if (Session::get('access') < 1) {
            Session::flash('danger', 'Недостаточно прав для создания новости.');
            return redirect('/');
        }

        $post = Post::find($id);
        $categorys = DB::table('newscat')->get();

        return view('post.edit')
            ->with('post', $post)
            ->with('categorys', $categorys);
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
        if (!Session::has('access')) {
            Session::flash('danger', 'Пройдите аутентификацию для создания новости.');
            return redirect('/user/login');
        }
        if (Session::get('access') < 1) {
            Session::flash('danger', 'Недостаточно прав для создания новости.');
            return redirect('/');
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|max:255',
            'text' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('post/create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::find($id);
        $post->category_id = $request->category;
        $post->full_text = $request->text;
        if ($request->enabled) {
            $post->enabled = "False";
        } else {
            $post->enabled = "True";
        }
        $post->save();

        Session::flash('success', 'Новость обновлена.');

        return redirect('/post');
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
