<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Validator;
use Request;

use App\Proposal;
use App\Keyword;

class ProposalController extends Controller {

    public function index() {

        $proposals = Proposal::query();

        if (Request::get('user')) {
            $proposals->where('user_id', Request::get('user'));
        }

        switch (Request::get('status')) {
            case "all":
                $proposals->withTrashed();
                break;
            case "treated":
                break;
            case "done":
                $proposals->onlyTrashed();
        }

        if (Request::get('category')) {
            $proposals->where('keyword_category', Request::get('category'));
        }

        if (Request::get('month')) {
            $proposals->where('created_at', "LIKE", Request::get('month') . "-%");
        }

        $result = $proposals->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('proposal.index')
            ->with('proposals', $result);
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

        $keywords = Keyword::all();

        return view('proposal.create')
            ->with('keywords', $keywords);
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
            Session::flash('danger', 'Пройдите аутентификацию для создания заявки.');
            return redirect('/user/login');
        }

        $validator = Validator::make($request->all(), [
            'keyword' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('proposal/create')
                ->withErrors($validator)
                ->withInput();
        }

        $proposal = new Proposal;
        $proposal->user_id = Session::get('id');
        $proposal->keyword_id = $request->keyword;
        $proposal->keyword_category = Keyword::find($request->keyword)->category;
        $proposal->content = $request->content;
        $proposal->save();

        Session::flash('success', 'Заявка добавлена.');

        return redirect("proposal");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Session::has('access')) {
            Session::flash('status', 'Необходимо пройти аутентификацию.');
            return redirect('/user/login');
        }
        $proposal = Proposal::withTrashed()->find($id);
        return view('proposal.show')->with('proposal', $proposal);
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
        $proposal = Proposal::find($id);
        $proposal->deleted_by = Session::get('id');
        $proposal->save();
        $proposal->delete();

        return redirect("/proposal/$id");
    }
}
