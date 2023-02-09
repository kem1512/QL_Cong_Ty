<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        //active new user
        if (Auth::user()->status == 0) {
            $user = User::find(Auth::user()->id);
            $user->status = 1;
            $user->save();
        }

    
        //get user
        if ($rq->ajax()) {
            $data = User::paginate(8);
            $body = User::UserBuild($data);
            return response()->json(['body' => $body]);
        };
        $phongbans = Department::getDepartments();
        $postions = Position::all();

        
        //join chỉ lấy phần chung | leftjoin lấy cả chung và riêng
        $nhansu = User::leftjoin('departments', 'users.department_id', 'departments.id')->select('users.*', 'departments.name')->paginate(8);
        return view('pages.personnel.personnel', compact('phongbans', 'postions', 'nhansu'));
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
        //get user by id , response to form update
        $id = $rq->id;
        $personneldetail = User::find($id);
        return response()->json(['status' => 'success', 'data' => $personneldetail]);
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

        dd($request);
        $path='files/';
        $file=$request->file('img_url');
        $file_name=time().'_'.$file->getClientOriginalName();
        $upload=$file->storeAs($path,$file_name);


        $user = User::find($request->id);
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
        $nhansu2 = User::leftjoin('departments', 'users.department_id', 'departments.id')
        ->select('users.*', 'departments.name')->paginate(8);
        $body = User::UserBuild($nhansu2);
        return response()->json(['status' => 'succes','body' => $body]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $rq)
    {
        //delete user by id
        $id = $rq->input('count_type');
        $nhansu =  User::find($id);
        $nhansu->delete();
        $nhansu2 = User::leftjoin('departments', 'users.department_id', 'departments.id')
        ->select('users.*', 'departments.name')->paginate(8);
        $body = User::UserBuild($nhansu2);
        return response()->json(['body' => $body]);
    }


    public function search(Request $request)
    {   //search by personnel_code , fullname and email
        $search = $request->search;
        $result = User::where('personnel_code', 'like', "%$search%")
            ->orWhere('fullname', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->leftjoin('departments', 'users.department_id', 'departments.id')->select('users.*', 'departments.name')->paginate(8);
        $body = User::UserBuild($result);
        return response()->json(['body' => $body]);
    }

    public function fillter(Request $request)
    { // còn 2 bug |1 là chưa hiển thị phòng ban |2 là khi chọn mặc định không hiển thị lại
        if ($request->department_filter == "") {
            
            $searchst = $request->status_filter;

            $resultst = User::where('status', '=', "$searchst")->paginate(8);
            
            $body = User::UserBuild($resultst);
            return response()->json(['body' => $body]);
        } else if ($request->status_filter == "") {

            $searchdp = $request->department_filter;
            $resultdp = User::where('department_id', '=', "$searchdp")->paginate(8);
            $body = User::UserBuild($resultdp);
            return response()->json(['body' => $body]);
        }else if ($request->status_filter == ""|$request->department_filter == "") {

            $nhansu2 = User::paginate(8);
            $body = User::UserBuild($nhansu2);
            return response()->json(['body' => $body]);
        }else{
            $searchst1 = $request->status_filter;
            $searchdp1 = $request->department_filter;
            $resultall = User::where('department_id', '=', "$searchdp1")->where('status', '=', "$searchst1")->paginate(8);
            $body = User::UserBuild($resultall);
            return response()->json(['body' => $body]);
        }
    }


    /**
     * Store a newly created resourcestatus in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator =Validator::make($request->all(),[
        //     'fullname' => 'required|max:255|min:2',
        //     'phone' => 'required',
        //     'email' => 'required|email|max:255|unique:users,email',
        //     'password' => 'required|min:5|max:255',
        //     'address'=>'required'
        // ],[
        //     'email.unique'=>'Email đã tồn tại !',
        //     'email.max'=>'Email quá dài !',
        //     'email.email'=>'Email không đúng định dạng !',
        //     'email.required'=>'Vui lòng nhập email !',
        //     'address.required'=>'Vui lòng nhập địa chỉ !',
        //     'phone.required'=>'Vui lòng nhập số điện thoại !',
        //     'fullname.required'=>'Vui lòng nhập họ tên !',
        //     'fullname.min'=>'Vui lòng nhập trên 2 ký tự !',
        //     'fullname.max'=>'Ký tự quá dài !',
        //     'password.min' => 'Mật khẩu phải lớn hơn 5 ký tự !',
        //     'password.required'=>'Vui lòng nhập mật khẩu !',
        // ]);

        // if(!$validator->passes()){
        //     return response()->json(['code'=>0,'error'=>$validator->errors()->toArray() ]);
        // }

      
        $user= new User();
        $max = User::orderBy('id','DESC')->first();
        $user->personnel_code='SCN'.$max->id+1;
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->address = $request->address;

        $user->save();

        $nhansu2 = User::leftjoin('departments', 'users.department_id', 'departments.id')
        ->select('users.*', 'departments.name')->paginate(8);
        $body = User::UserBuild($nhansu2);
        return response()->json(['status' => 'succes','body' => $body]);
    }
}
