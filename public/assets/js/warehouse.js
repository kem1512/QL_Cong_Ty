import Pagination from './Paginate.js';

var paginate = new Pagination();
var orderby = 'asc';
var keyword = "";
var title = "Thêm mới kho";

$(document).ready(function () {
    Get();
    Redirect();
    Next();
    Previous();
    Delete();
    Update();
    View();
    $('#title').text(title);
});

function Get() {
    $.ajax({
        type: "get",
        url: "/warehouse/get/" + paginate.perPage + "/" + orderby + "/" + keyword + "?page=" + paginate.currentPage,
        dataType: "json",
        success: function (response) {
            let html = '';
            $.each(response.warehouses.data, function (index, value) {
                html += '<div class="col-sm-3 card px-0 m-5 border">';
                html += '<div class="card-header"><h5 class="text-primary">Kho : ' + value.name + '</h5></div>';
                html += '<div class="card-body">';
                html += '<img class="img-fluid border border-primary" style="width: 200px;height: 200px;" src="' + value.image + '"/>';
                html += '</div>';
                html += '<div class="card-footer">';
                html += '<div class="justify-content-center">';
                html += '<button class="btn bg-gradient-primary btn-sm mx-2" id="btnSua" name="' + value.id + '"><i class="fa-solid fa-pen"></i></button>';
                html += '<button class="btn bg-gradient-primary btn-sm mx-2" id="btnXem" name="' + value.id + '"><i class="fa-solid fa-eye"></i></button>';
                html += '<button class="btn bg-gradient-danger btn-sm mx-2" id="btnXoa" name="' + value.id + '"><i class="fa-solid fa-trash-can"></i></button>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
            });
            $('#table-warehouse').html(html);
            paginate.lastPage = response.warehouses.last_page;
            paginate.ViewPageLink(paginate.lastPage, paginate.currentPage, 'pageLink');
        }
    });
}

function Next() {
    $(document).on('click', '#btnNext', function () {
        paginate.Next(Get);
    });
}

function Previous() {
    $(document).on('click', '#btnPrevious', function () {
        paginate.Previous(Get);
    });
}

function Redirect() {
    $(document).on('click', '#btnRedirect', function (e) {
        let index = e.target.innerHTML;
        paginate.Redirect(index, Get);
    });
}

function Delete() {

    $(document).on('click', '#btnXoa', function (e) {
        let id = e.target.name;
        Swal.fire({
            title: 'Bạn có chắc muốn xóa?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/warehouse/delete/" + id,
                    dataType: "json",
                    success: function () {
                        Swal.fire(
                            'Good job',
                            'Xóa thành công',
                            'success'
                        );
                        Get();
                    }
                });
            }
        })

    });
}

function Update() {
    $(document).on('click', '#btnSua', function () {
        alert();
    });
}

function View() {
    $(document).on('click', '#btnXem', function () {
        alert();
    });
}