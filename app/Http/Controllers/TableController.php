<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\Table;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_email = Auth::user()->email;
        $user_id = Auth::id();
        $tables = Table::with('user_creator')->where('users_id', $user_id)->get();
        $tables_guest = Table::with('user_creator')->where('guests', $user_email)->get();

        return view("trello.home", compact('tables', 'tables_guest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trello.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTable = [
            'table_name' => $request->input('table_name'),
            'guests' => $request->input('guests'),
            'users_id' => Auth::id(),
        ];

        $request->validate([
            'table_name' => 'required',
        ]);

        Table::create($newTable);

        return redirect()->back()
            ->with('success', "Tableau crée avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Table::whereId($id)->with('columns.tickets.comments')->get();

        return view('trello.showTable', compact('table'));
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
        $newname = $request->table_name;
        $table = Table::find($id);
        $table->table_name = $newname;
        $table->save();

        return redirect()->back()
            ->with('success', "Tableau modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect()->route('tables.index');
    }
}
