<?php

namespace App\Http\Controllers;

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
        if($rq->ajax()){
            $data = User::latest()->get();
            return response()->json(['status'=>'success','data'=>$data]);
        };
        $nhansu = User::paginate(9);
        return view('pages.personnel', compact('nhansu'));
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
    public function destroy(Request $rq)
    {
        $id = $rq->input('count_type');
        $nhansu =  User::find($id);
        $nhansu->delete();
        $nhansu2 =User::paginate(10);
        $body = User::UserBuild($nhansu2);
        return response()->json(['body'=>$body]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request()->validate([
            'personnel_code' => 'required|min:3|max:15|unique:users,personnel_code',
            'fullname' => 'required|max:255|min:2',
            'phone' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);
        $status = User::create($attributes);
        if ($status) {
            Alert::success('Thành Công !', 'Nhân sự đã được thêm mới !');
            return redirect()->route('personnel.index');
        } else {
            Alert::error('Thất Bại !', 'Vui lòng thử lại !');
        }
    }
}
