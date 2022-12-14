<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Jobs\ExcelExportJob;
use App\Jobs\PdfExportJob;
use App\Models\Level;
use App\Models\User;
use App\Models\UserExport;
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
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

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
        $user_export = new UserExport();
        $user_export->user_id = Auth::user()->id;
        $user_export->type = 'pdf';
        $user_export->save();

        User::chunk(1000, function ($users, $i) {
            PdfExportJob::dispatch($users, $i);

            $result_export = UserExport::where('user_id', Auth::user()->id)->first();
            $result_export->split = $i;
            $result_export->save();
        });

        return response()->json(['message' => 'Export Complete'], 200);
    }

    public function checkPDF()
    {
        $export = UserExport::where('user_id', Auth::user()->id)->first();
        if (Storage::disk('local')->exists("pdf/split/export$export->split.pdf")) {
            $merger = PDFMerger::init();
            for ($i = 1; $i <= $export->split; $i++) {
                $merger->addPDF(storage_path("app/pdf/split/export$i.pdf"), 'all');
            }
            $merger->merge();
            $merger->save(public_path('pdf/result/export.pdf'));

            $result_export = UserExport::where('user_id', Auth::user()->id)->first();
            $result_export->path = 'pdf/result/export.pdf';
            $result_export->save();

            return response()->json(['exist' => true, 'path' => $export->path], 200);
        } else {
            return response()->json(['exist' => false], 200);
        }
    }

    public function deleteExportPDF()
    {
        $export = UserExport::where('user_id', Auth::user()->id)->first();
        for ($i = 1; $i <= $export->split; $i++) {
            unlink(storage_path("app/pdf/split/export$i.pdf"));
        }
        $export->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }

    public function exportExcel()
    {
        User::chunk(1000, function ($users, $i) {
            ExcelExportJob::dispatch($users, $i);
        });

        return response()->json(['code' => 'start'], 200);
    }

    public function checkExcel()
    {
        $file = Storage::disk('local')->exists('public/users.xlsx');

        if ($file) {
            return response()->json(['code' => 'exists'], 200);
        } else {
            return response()->json(['code' => 'empty'], 200);
        }
    }

    public function download()
    {
        return response()->download(storage_path('app/public/users.xlsx'));
    }
}
