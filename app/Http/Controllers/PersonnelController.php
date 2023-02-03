<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class PersonnelController extends Controller
{
    public function show(){
        $userdetail= User::find(5);
        $nhansu = User::paginate(9);
        return view('pages.personnel', compact('nhansu'),compact('userdetail'));
    }
    public function showdataedit($id){
        $userdetail= User::find(4);
        return view('pages.personnel', compact('userdetail'));
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
        return redirect()-> route('home');
    }

    public function store()
    {
        $attributes = request()->validate([
            'personnel_code' => 'required|min:3|max:15|unique:users,personnel_code',
            'fullname' => 'required|max:255|min:2',
            'phone'=>'required',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);
        $status = User::create($attributes);
        if($status){
            Alert::success('Thành Công !', 'Nhân sự đã được thêm mới !');
            return redirect()-> route('personnel');
        }else{
            Alert::error('Thất Bại !', 'Vui lòng thử lại !');
        }
    }
}
