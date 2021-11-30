<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {

        $users_all = User::all();

        return view('admin.home', compact('users_all'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.home');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
    }

    public function show($id)
    {
        //
        $userunique = User::whereId($id)->get();
        return view('admin.home', compact('$userunique'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $userUpdate = User::find($id);
        //dd($userUpdate);
        $userUpdate->name = $request->input('name');
        $userUpdate->email = $request->input('email');
        $userUpdate->save();
        return redirect()->back()
            ->with('success', "User edité avec succès");
    }

    public function destroy($id)
    {
        $userdelete = User::find($id);
        $userdelete->delete();

        return redirect()->back()
            ->with('success', "User supprimé avec succès");
    }
}
