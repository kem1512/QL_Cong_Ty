
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Nhân Sự'])

    <style>
        #adddropdown {
            top: -100%;
        }

        #btn-edit,
        #btn-del {
            cursor: pointer;
        }

        #adddropdown {
            top: -10%;
            -webkit-animation-name: rightanimationend;
            -webkit-animation-duration: 0.4s;
            animation-name: rightanimation;
            animation-duration: 0.4s;
        }

        #offcanvasNavbar {
            width: 40%;
        }

        .btn-close {
            color: #524f4c !important;
        }

        .swal2-cancel {
            margin-right: 10% !important;
        }

        #btn-submit-add {
            text-align: center;
        }

        #offcanvasNavbarupdate {
            width: 70%;
        }

        @media only screen and (max-width: 1100px) {
            #offcanvasNavbarupdate {
                width: 100%;
            }

            #offcanvasNavbar {
                width: 100%;
            }
        }

        #imgupdate {
            color: bisque;
            border: 1px solid #b3aea7;
            width: 200px;
            height: 300px;
            margin-left: 20%;
        }
    </style>

    <!-- ADD dropdow  -->
    <div id="adddropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="offcanvas-body">
                    <h1 id="add-title" style="text-align: center">Thêm Nhân Sự</h1>
                    <form class="mt-8" method="POST" id="insert_personnel">
                        @csrf
                        <div class="mb-3 row ml-7">
                            <label for="mansadd" class="col-sm-4 col-form-label">Mã Nhân Sự</label>
                            <div class="col-sm-6">
                                <input type="text" name="personnel_code" id="personnel_code" class="form-control"
                                    id="mansadd" placeholder="(vd : SCN0001)" />
                                @error('personnel_code')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="fullname" class="col-sm-4 col-form-label">Tên Nhân Sự</label>
                            <div class="col-sm-6">
                                <input type="text" name="fullname" id="fullname" class="form-control" id="fullname"
                                    placeholder="(vd : Nguyễn Văn A)" />
                                @error('fullname')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="phoneadd" class="col-sm-4 col-form-label">Số Điện Thoại</label>
                            <div class="col-sm-6">
                                <input type="text" name="phone" id="phone" class="form-control" id="phoneadd"
                                    placeholder="(vd : 0123456789)" />
                                @error('phone')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row ml-7">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" id="email" class="form-control" id="staticEmail"
                                    placeholder="email@example.com" />
                                @error('email')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" id="password" class="form-control"
                                    id="inputPassword" />
                                @error('password')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div id="btn-submit-add">
                            <button type="submit" id="btn_insert_personnel" class="btn btn-primary mt-7">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update page -->
    <div id="updatedropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarupdate"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h1 id="add-title" style="text-align: center">Sửa Nhân Sự</h1>
                    <form class="mt-5 col col-12" action="">
                        @csrf
                        <div class="row wraper">
                            <div class="row">
                                <div class="col-4 justify-content-center" style="text-align: center">
                                    <div id="imgupdate">
                                        <img src="https://i.pravatar.cc/150?img=62" width="200px" height="300px"
                                            alt="ảnh Nhân sự" />
                                    </div>
                                    <a class="btn mr-5">Chọn</a>
                                </div>

                                <div class="col-4">
                                    <div class="form-update">
                                        <label for="mans" class="col-sm-4 col-form-label">Mã Nhân Sự :</label>
                                        <input type="text" readonly value="{{ $userdetail->personnel_code ?? '' }}"
                                            class="form-control" id="mans" value="SCN0001" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="name" class="col-sm-4 col-form-label">Họ Tên :</label>
                                        <input type="text" name="fullname" value="{{ $userdetail->fullname ?? '' }}"
                                            class="form-control" id="name" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="Email" class="col-sm-4 col-form-label">Email :</label>
                                        <input type="email" name="email" value="{{ $userdetail->email ?? '' }}"
                                            class="form-control" id="Email" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="phone" class="col-sm-4 col-form-label">Số Điện Thoại:</label>
                                        <input type="text" name="phone" value="{{ $userdetail->phone ?? '' }}"
                                            class="form-control" id="phone" required />
                                    </div>

                                </div>
                                <div class="col-4">
                                    <label for="phongban" class="col-sm-4 col-form-label">Phòng Ban :</label>
                                    <select class="form-control" name="department_id" id="phongban">
                                        {{-- {{$sinhvien->GioiTinh == "Nam" ? 'selected':''}} --}}
                                        <option value="1">Công Nghệ</option>
                                        <option value="2">Kế Toán</option>
                                        <option value="3">Nhân Sự</option>
                                    </select>
                                    <label for="chucvu" class="col-sm-4 col-form-label">Chức Vụ :</label>
                                    <select class="form-control" name="position_id" id="chucvu">
                                        <option value="1">Giám Đốc</option>
                                        <option value="2">Quản Lý</option>
                                        <option value="3">Trưởng Phòng</option>
                                    </select>
                                    <label for="trangthai" class="col-sm-4 col-form-label">Trạng Thái :</label>
                                    <select class="form-control" name="status" id="trangthai">
                                        <option value="1">Đang Hoạt Động</option>
                                        <option value="2">Nghỉ Phép</option>
                                        <option value="3">Chưa Kích Hoạt</option>
                                    </select>
                                    <div class="form-update">
                                        <label for="password" class="col-sm-4 col-form-label">Mật Khẩu :</label>
                                        <input type="password" readonly value="{{ $userdetail->passwor ?? '********' }}"
                                            class="form-control" id="password" />
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-update">
                                    <label for="dateofbirth" class="col-sm-4 col-form-label">Ngày Sinh:</label>
                                    <input type="date" name="date_of_birth"
                                        value="{{ $userdetail->date_of_birth ?? '' }}" class="form-control"
                                        id="dateofbirth" />
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-update">
                                    <label for="recrui" class="col-sm-4 col-form-label">Ngày Tuyển Dụng:</label>
                                    <input type="date" name="recruitment_date"
                                        value="{{ $userdetail->recruitment_date ?? '' }}" class="form-control"
                                        id="recrui" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="exampleFormControlTextarea1" class="col-sm-4 col-form-label">Địa Chỉ
                                    :</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $userdetail->address ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="btn-group-update mt-5 align-items-center justify-content-center">
                            <button class="btn btn-primary" type="submit">Cập Nhật</button>
                            <a data-bs-dismiss="offcanvas" aria-label="Close" class="btn btn-danger">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class=" d-flex justify-content-between">
                            <h6>Quản Lý Nhân Sự</h6>
                            <a id="form-add" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasNavbar">Thêm</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2" id="body_query">
                        {!! \App\Models\User::UserBuild($nhansu) !!}
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
