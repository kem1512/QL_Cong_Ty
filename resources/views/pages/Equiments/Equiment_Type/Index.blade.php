@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Loại thiết bị'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <form id="form-equiment-type">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Thêm loại thiết bị</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu thông tin</button>
                            </div>
                        </div>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tên loại</label>
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Trạng thái</label>
                                        <div class="form-check form-switch mt-1">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                checked="" name="status">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 mb-5">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Danh sách loại thiết bị</p>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Loại thiết bị
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ngày tạo
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ngày cập nhật
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Trạng thái
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            colspan="2">
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="list-equiment-type">
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-5 d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" aria-label="Previous" id="btnBack">
                                            <i class="fa fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:;">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" aria-label="Next" id="btnNext">
                                            <i class="fa fa-angle-right"></i>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('javascript')
    <script>
        var totalPage = 5;
        var Page = 1;

        $(document).ready(function() {
            GetAll(totalPage, Page);
            Next();
        });

        function GetAll(total_page, page) {
            $.ajax({
                type: "get",
                url: "getequimenttype/" + total_page + "/" + page,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    tbody = '';
                    $.each(response.data, function(index, equimenttype) {
                        tbody += '<tr>';
                        tbody += '<td class="align-middle text-center">' + (index + 1) + '</td>';
                        tbody += '<td class="align-middle text-center">' + equimenttype.name + '</td>';

                        tbody += '<td class="align-middle text-center">' + equimenttype.created_at +
                            '</td>';
                        tbody += '<td class="align-middle text-center">' + equimenttype.updated_at +
                            '</td>';
                        tbody +=
                            '<td class="align-middle text-center"> <span class="' +
                            (equimenttype.status == 1 ?
                                'badge bg-gradient-success' :
                                'badge bg-gradient-warning'
                            ) + '">' + (equimenttype.status == 1 ? 'Hoạt động' : 'Không hoạt động') +
                            '</span></td>';
                        tbody +=
                            '<td class="align-middle text-center"><button class="btn btn-primary btn-sm ms-auto">Sửa</button></td>';
                        tbody +=
                            '<td class="align-middle text-center"><button class="btn btn-primary btn-sm ms-auto">Xóa</button></td>';
                        tbody += '</tr>';
                    });
                    $('#list-equiment-type').html(tbody);
                }
            });
        }

        function Previous() {
            $(document).on('click', '#btnBack', function() {
                Page -= 1;
                GetAll(totalPage, Page);
            });
        }

        function Next() {
            $(document).on('click', '#btnNext', function() {
                Page += 1;
                GetAll(totalPage, Page);
            });
        }
    </script>
@endsection
