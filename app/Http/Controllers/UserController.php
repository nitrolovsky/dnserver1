<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Request;
use View;
use Redirect;

use App\User;
use App\Company;
use App\Department;
use App\Duty;

class UserController extends Controller
{

    function __construct() {

        $this->middleware('authed', ['only' => ['index', 'show', 'edit', 'update', 'logout']]);
        $this->middleware('noAuthed', ['only' => ['create', 'store', 'viewLogin', 'login']]);

    }

    public function index() {

        $users = User::query();

        if (Request::get('keyword')) {
            $users->where('fio', 'LIKE', '%' . Request::get('keyword') . '%')
                ->orWhere('cabinet', 'LIKE', '%' . Request::get('keyword') . '%')
                ->orWhere('phone', 'LIKE', '%' . Request::get('keyword') . '%')
                ->orWhere('email', 'LIKE', '%' . Request::get('keyword') . '%');
        }

        $usersResult = $users->paginate(15);

        return View::make('user.index')
            ->with('users', $usersResult);

    }

    public function create() {

        $companies = Company::all();
        $departments = Department::all();
        $duties = Duty::all();

        return View::make('user.create')
            ->with('companies', $companies)
            ->with('departments', $departments)
            ->with('duties', $duties);

    }

    public function store(Request $request) {

        $validator = Validator::make(Request::all(), [
            'login' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'confirmPassword' => 'required|max:255',
            'name' => 'required|max:255',
            'company' => 'required|numeric',
            'department' => 'required|numeric',
            'duty' => 'required|numeric',
            'cabinet' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return Redirect::to('user/create')
                ->withErrors($validator)
                ->withInput();
        }

        $password = Request::get('password');
        $confirmPassword = Request::get('confirmPassword');

        if ($password != $confirmPassword) {
            $validator->errors()
                ->add('confirmPassword', "Подтверждение пароля не совпадает с паролем.");
            return Redirect::to('user/create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;
        $user->login = Request::get('login');
        $user->password = md5(Request::get('password'));
        $user->name = Request::get('name');
        $user->company = Request::get('company');
        $user->department = Request::get('department');
        $user->duty = Request::get('duty');
        $user->cabinet = Request::get('cabinet');
        $user->phone = Request::get('phone');
        $user->email = Request::get('email');
        $user->mobile = Request::get('mobile');
        $user->access = 1;
        $user->save();

        Session::flash('info', 'Вы успешно зарегистрированы.');

        Session::put('id', $user->id);
        Session::put('access', $user->access);
        Session::put('login', $user->login);
        Session::put('name', $user->name);
        Session::put('authed', 1);

        return Redirect::to("/user/$user->id");

    }

    public function show($id) {

        $userId = $id;
        $user = User::find($userId);

        return View::make('user.show')
            ->with('user', $user);

    }

    public function edit($id) {

        if (Session::get('id') != $id) {
            if (Session::get('access') < 14000) {
                Session::flash('info', 'Недостаточно прав доступа.');
                return Redirect::to('/tiding');
            }
        }

        $userId = $id;
        $user = User::find($userId);

        $companies = Company::all();
        $departments = Department::all();
        $duties = Duty::all();

        return View::make('user.edit')
            ->with('user', $user)
            ->with('companies', $companies)
            ->with('departments', $departments)
            ->with('duties', $duties);

    }

    public function update(Request $request, $id) {

        if (Session::get('id') != $id) {
            if (Session::get('access') < 14000) {
                Session::flash('info', 'Недостаточно прав доступа.');
                return Redirect::to('/tiding');
            }
        }

        $user = User::find($id);
        $user->name = Request::get('name');
        $user->cabinet = Request::get('cabinet');
        $user->phone = Request::get('phone');
        $user->email = Request::get('email');
        $user->mobile = Request::get('mobile');
        $user->company = Request::get('company');
        $user->department = Request::get('department');
        $user->duty = Request::get('duty');
        $user->save();

        Session::flash('info', 'Данные пользователя успешно обновлены.');

        return Redirect::to("/user/show/$id");

    }

    public function destroy($id) {
        //
    }

    public function viewLogin(Request $request) {

        return View::make('user.login');

    }

    public function login(Request $request) {

        $validator = Validator::make(Request::all(), [
            'login' => 'required|max:255',
            'password' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return Redirect::to('/user/login')
                ->withErrors($validator)
                ->withInput();
        }

        $login = Request::get('login');
        $user = User::where('login', $login)
            ->get()
            ->first();

        if (empty($user)) {
            $validator->errors()
                ->add('login', "Пользователя с логином: '$login'  не существует.");
            return Redirect::to('/user/login')
                ->withErrors($validator)
                ->withInput();
        }

        $password = md5(Request::get('password'));
        $user = User::where('login', $login)
            ->where('password', $password)
            ->get()
            ->first();

        if (empty($user)) {
            $validator->errors()
                ->add('password', "Неверный пароль.");
            return Redirect::to('/user/login')
                ->withErrors($validator)
                ->withInput();
        }

        Session::put('id', $user->id);
        Session::put('access', $user->access);
        Session::put('login', $user->login);
        Session::put('fio', $user->fio);
        Session::put('authed', 1);

        return Redirect::to("/user/$user->id");

    }

    public function logout() {

        Session::flush();
        return Redirect::to('/');

    }

    public function birthdays() {

        $month = date('m');
        $users = User::where('birth_month', $month)
            ->orderBy('birth_day', 'asc')
            ->get();

        return View::make('user.birthdays')
            ->with('users', $users);

    }

    public function proposals() {

        $user = User::find(Session::get('id'));

        return View::make('user.proposals')
            ->with('user', $user);

    }

}
