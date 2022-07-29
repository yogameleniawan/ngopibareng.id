<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $btn = '<td class="dropdown"><div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div><ul class="dropdown-menu" role="menu"><a class="dropdown-item edit-table" onclick="editUserPage(`' . $data->id . '`,`' . $data->email . '`,`' . $data->name . '`,`' . $data->biodata . '`,`' . $data->role . '`)" data-toggle="modal" data-target="#demoModal"><li> <i class="ik ik-edit" style="color: white;font-size:16px;padding-right:5px"></i><span style="font-size:14px">Edit</span></li></a><a class="dropdown-item delete" onclick="deleteUserPage(`' . $data->id . '`,`' . $data->email . '`,`' . $data->name . '`,`' . $data->biodata . '`,`' . $data->role . '`)" data-toggle="modal"
                    data-target="#demoModal" data-id=' . $data->id . '><li><i class="ik ik-trash-2" style="color: white;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Delete</span></li></a></ul></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $data = User::find($id);
        return view('admin.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = User::find($id);
        $table->email = $request->email;
        $table->password = $request->password;
        if ($table->save()) {
            return redirect()->route('materi.index')
                ->with('success', 'Users created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $table = User::find($request->id);

        if ($table->delete()) {
            return response()->json(['data' => $table], 200);
        }
    }
}
