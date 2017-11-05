<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|string|min:5|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        User::create([
            'login' => $request['login'],
            'password' => bcrypt($request['password']),
        ]);

        Log::info(Auth::user()->login.' создал администратора ('.$request['login'].')');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'login' => 'required|string|min:5|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user->update([
            'login' => $request['login'],
            'password' => bcrypt($request['password']),
        ]);

        Log::info(Auth::user()->login.' отредактировал администратора ('.$user->id.')');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Log::info(Auth::user()->login.' удалил администратора ('.$user->id.')');
        $user->delete();
        return redirect()->route('users.index');
    }
}
