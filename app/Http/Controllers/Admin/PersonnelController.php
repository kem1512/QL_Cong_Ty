<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class PersonnelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq)
    {
        if ($rq->ajax()) {
            $data = User::latest()->get();
            return response()->json(['status' => 'success','data' => $data]);
        };
        $postions = Position::paginate(99);
        $nhansu = User::paginate(5);
        // dd($nhansu);
        return view('pages.personnel.personnel', compact('nhansu'),compact('postions'));
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
    public function edit(Request $rq)
    {
        $id = $rq->id;
        $personneldetail=User::find($id);
        return response()->json(['status'=>'success','data'=>$personneldetail]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request -> id);
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->department_id = $request->department_id;
        $user->date_of_birth = $request->date_of_birth;
        $user->position_id = $request->position_id;
        $user->recruitment_date = $request->recruitment_date;
        $user->status = $request->status;
        $user->address = $request->address;
        $user->save();
        $postions = Position::paginate(99);
        $nhansu = User::paginate(9);

        $nhansu2 = User::paginate(10);
        $body = User::UserBuild($nhansu2);
        return response()->json(['body' => $body]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $rq)
    {
        $id = $rq->input('count_type');
        $nhansu =  User::find($id);
        $nhansu->delete();
        $nhansu2 = User::paginate(10);
        $body = User::UserBuild($nhansu2);
        return response()->json(['body' => $body]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatetion = $request->validate([
            'personnel_code' => 'required|min:3|max:15|unique:users,personnel_code',
            'fullname' => 'required|max:255|min:2',
            'phone' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);
        User::create($validatetion);
        $nhansu2 = User::paginate(10);
        $body = User::UserBuild($nhansu2);
        return response()->json(['status'=>'succes','body' => $body]);
    }
}
