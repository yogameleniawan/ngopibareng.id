<?php

namespace App\Http\Controllers;

use App\Jobs\PdfExportJob;
use App\Models\Level;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Faker\Factory as Faker;

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
            $data = User::latest();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if (Auth::user()->role == 'user') {
                        $btn = '<td class="dropdown"><div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div><ul class="dropdown-menu" role="menu"><a class="dropdown-item edit-table" onclick="viewUserPage(`' . $data->id . '`,`' . $data->email . '`,`' . $data->name . '`,`' . $data->biodata . '`,`' . $data->role . '`)" data-toggle="modal" data-target="#demoModal"><li> <i class="ik ik-edit" style="color: white;font-size:16px;padding-right:5px"></i><span style="font-size:14px">View</span></li></a></ul></td>';
                        return $btn;
                    } else {
                        $btn = '<td class="dropdown"><div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div><ul class="dropdown-menu" role="menu"><a class="dropdown-item edit-table" onclick="editUserPage(`' . $data->id . '`,`' . $data->email . '`,`' . $data->name . '`,`' . $data->biodata . '`,`' . $data->role . '`)" data-toggle="modal" data-target="#demoModal"><li> <i class="ik ik-edit" style="color: white;font-size:16px;padding-right:5px"></i><span style="font-size:14px">Edit</span></li></a><a class="dropdown-item delete" onclick="deleteUserPage(`' . $data->id . '`,`' . $data->email . '`,`' . $data->name . '`,`' . $data->biodata . '`,`' . $data->role . '`)" data-toggle="modal"
                        data-target="#demoModal" data-id=' . $data->id . '><li><i class="ik ik-trash-2" style="color: white;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Delete</span></li></a></ul></td>';
                        return $btn;
                    }
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
        $table = new User();
        $table->name = $request->name;
        $table->email = $request->email;
        if ($request->password == null) {
            $table->password = $table->password;
        } else {
            $table->password = Hash::make($request->password);
        }
        $table->role = $request->role;
        $table->biodata = $request->biodata;
        if ($table->save()) {
            return response()->json(['message' => 'User added'], 200);
        } else {
            return response()->json(['message' => 'User failed to add'], 500);
        }
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
        //
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
        $table = User::find($request->id);
        $table->name = $request->name;
        $table->email = $request->email;
        if ($request->password == null) {
            $table->password = $table->password;
        } else {
            $table->password = Hash::make($request->password);
        }
        $table->role = $request->role;
        $table->biodata = $request->biodata;
        if ($table->save()) {
            return response()->json(['message' => 'User updated'], 200);
        } else {
            return response()->json(['message' => 'User failed to update'], 500);
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
            return response()->json(['data' => $table, 'message' => 'User deleted'], 200);
        } else {
            return response()->json(['message' => 'User failed to delete'], 500);
        }
    }

    public function exportPDF()
    {
        User::chunk(1000, function ($users) {
            PdfExportJob::dispatch($users);
        });

        return response()->json(['message' => 'Export Complete'], 200);
    }
}
