<?php

namespace App\Http\Controllers;

use View;
use Redirect;
use Validator;
use Session;
use Request;

use App\ComputerEquipmentCategory;
use App\ComputerEquipment;

class ComputerEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $computer_equipments = ComputerEquipment::query();

        switch (Request::get('status')) {
            case "all":
                break;
            case "treated":
                $computer_equipments->where('status', 0);
                break;
            case "done":
                $computer_equipments->where('status', 1);
                break;
            case "rejected":
                $computer_equipments->where('status', 2)
                    ->andWhere('status', 3);
                break;
        }

        if (Request::get('month')) {
            $computer_equipments->where('created_at', "LIKE", Request::get('month') . "-%-");
        }

        $result = $computer_equipments->orderBy('created_at', 'DESC')
            ->paginate(5);

        $computer_equipments = new ComputerEquipment;

        return View::make('computer-equipment.index')
            ->with('computer_equipments', $result);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = ComputerEquipmentCategory::all();

        return View::make('computer-equipment.create')
            ->with('categories', $categories);

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
            'category_id' => 'required',
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::action('ComputerEquipmentController@create')
                ->withErrors($validator)
                ->withInput();
        }

        $computer_equipment = new ComputerEquipment;
        $computer_equipment->user_id = Session::get('id');
        $computer_equipment->category_id = Request::get('category_id');
        $computer_equipment->text = Request::get('text');
        $computer_equipment->status = 0;
        $computer_equipment->save();

        Session::flash('success', 'Заявка добавлена.');

        return Redirect::action('UserController@proposals');

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
