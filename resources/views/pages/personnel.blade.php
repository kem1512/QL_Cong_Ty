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
        width: 50%;
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
<!-- Full screen modal -->
<div>
    <div id="adddropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="offcanvas-body">
                    <h1 id="add-title" style="text-align: center">Thêm Nhân Sự</h1>
                    <form class="mt-8" action="">
                        <div class="mb-3 row ml-7">
                            <label for="mansadd" class="col-sm-4 col-form-label">Mã Nhân Sự</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mansadd"
                                    placeholder="(vd : SCN0001)" />
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="nameadd" class="col-sm-4 col-form-label">Tên Nhân Sự</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nameadd"
                                    placeholder="(vd : Nguyễn Văn A)" />
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="phoneadd" class="col-sm-4 col-form-label">Số Điện Thoại</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="phoneadd"
                                    placeholder="(vd : 0123456789)" />
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="staticEmail"
                                    placeholder="email@example.com" />
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="inputPassword" />
                            </div>
                        </div>
                        <div id="btn-submit-add">
                            <a type="submit" onclick="onAlertSuccess()" class="btn btn-primary mt-7">Thêm</a>
                            <a type="submit" onclick="onAlertError()" class="btn btn-primary mt-7">Thất Bại</a>
                        </div>
                    </form>
                </div>
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
                    <div class="row wraper">
                        <div class="row">
                            <div class="col-6 justify-content-center" style="text-align: center">
                                <div id="imgupdate">
                                    <img src="" width="200px" height="300px" alt="ảnh Nhân sự" />
                                </div>
                                <a class="btn mr-5">Chọn</a>
                            </div>

                            <div class="col-6">
                                <div class="form-update">
                                    <label for="mans" class="col-sm-4 col-form-label">Mã Nhân Sự :</label>
                                    <input type="text" readonly class="form-control" id="mans"
                                        value="SCN0001" />
                                </div>
                                <div class="form-update">
                                    <label for="name" class="col-sm-4 col-form-label">Họ Tên :</label>
                                    <input type="text" class="form-control" id="name" />
                                </div>
                                <div class="form-update">
                                    <label for="Email" class="col-sm-4 col-form-label">Email :</label>
                                    <input type="email" class="form-control" id="Email" />
                                </div>
                                <label for="chucvu" class="col-sm-4 col-form-label">Chức Vụ :</label>
                                <select class="form-control" id="chucvu">
                                    <option value="">Giám Đốc</option>
                                    <option value="">Quản Lý</option>
                                    <option value="">Trưởng Phòng</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="phongban" class="col-sm-4 col-form-label">Phòng Ban :</label>
                            <select class="form-control" id="phongban">
                                <option value="">Công Nghệ</option>
                                <option value="">Kế Toán</option>
                                <option value="">Nhân Sự</option>
                            </select>
                            <div class="form-update">
                                <label for="phone" class="col-sm-4 col-form-label">Số Điện Thoại:</label>
                                <input type="text" class="form-control" id="phone" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="trangthai" class="col-sm-4 col-form-label">Trạng Thái :</label>
                            <select class="form-control" id="trangthai">
                                <option value="">Đang Hoạt Động</option>
                                <option value="">Nghỉ Phép</option>
                                <option value="">Chưa Kích Hoạt</option>
                            </select>
                            <div class="form-update">
                                <label for="password" class="col-sm-4 col-form-label">Mật Khẩu :</label>
                                <input type="password" class="form-control" id="password" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" class="col-sm-4 col-form-label">Địa Chỉ
                                :</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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

@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
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
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã
                                            Nhân
                                            Sự</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ
                                            Tên
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Chức Vụ</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phòng Ban</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Trạng Thái</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="">
                                            <p class="text-sm font-weight-bold mb-0">SCN001</p>
                                        </td>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <img src="./img/team-1.jpg" class="avatar me-3" alt="image">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Name</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Trưởng Phòng</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">Phòng Công Nghệ</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Hoạt Động</span>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a id="btn-del" onclick="onDelete()">
                                                    <p class="text-sm font-weight-bold mb-0 ">Delete</p>
                                                </a>

                                                {{-- Edit --}}
                                                <a id="btn-edit" data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasNavbarupdate">
                                                    <p class="text-sm font-weight-bold mb-0 ps-2">Edit</p>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">SCN002</p>
                                        </td>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <img src="./img/team-1.jpg" class="avatar me-3" alt="image">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Name</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Trưởng Phòng</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">Phòng Công Nghệ</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">Không Hoạt Động</span>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a id="btn-del" data-bs-toggle="modal" onclick="onDelete()"
                                                    data-bs-target="#exampleModal">
                                                    <p class="text-sm font-weight-bold mb-0 ">Delete</p>
                                                </a>

                                                {{-- Edit --}}
                                                <a id="btn-edit" data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasNavbarupdate">
                                                    <p class="text-sm font-weight-bold mb-0 ps-2">Edit</p>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
