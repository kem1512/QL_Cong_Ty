var perPage = 5;
var currentPage = 1;
var lastPage = 0;
var createCheck = true;
var id_equimenttype = 0;
var Active;
var keyword = "";

$(document).ready(function () {

    $('#btnHuy').css('display', 'none');

    GetAll(perPage, currentPage, keyword);

    Submit();

    $('#btnHuy').on('click', function () {
        $('#btnHuy').css('display', 'none');
        createCheck = true;
        $('input[name = "name"]').val("");
    })
});

function GetAll(per_page, current_page, key_word) {
    $.ajax({
        type: "get",
        url: "getequimenttype/" + per_page + "/" + key_word + "?page=" + current_page,
        dataType: "json",
        success: function (response) {
            tbody = '';
            $.each(response.data, function (index, equimenttype) {
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
                    '<td class="align-middle text-center"><button class="btn btn-primary btn-sm ms-auto" onclick="GetEquiment(' + equimenttype.id + ')">Sửa</button></td>';
                tbody +=
                    '<td class="align-middle text-center"><button class="btn btn-primary btn-sm ms-auto" onclick="Delete(' + equimenttype.id + ')">Xóa</button></td>';
                tbody += '</tr>';
            });
            $('#list-equiment-type').html(tbody);
            lastPage = response.last_page;
            ViewPageLink(response.last_page, response.current_page);
        }
    });
}

function Previous() {
    currentPage--;
    GetAll(perPage, currentPage, keyword);
    if (currentPage < 1) {
        currentPage = lastPage;
        GetAll(perPage, currentPage, keyword);
    }
}

function Next() {
    currentPage++;
    GetAll(perPage, currentPage, keyword);
    if (currentPage > lastPage) {
        currentPage = 1;
        GetAll(perPage, currentPage, keyword);
    }
}

function ViewPageLink(lastPage, active) {
    html = "";
    for (let index = 1; index <= lastPage; index++) {
        html += " <li class='page-item " + (index == active ? "active" : "") + "'><a class='page-link' onclick='RedirectPage(" + index + ")'>" + (index) +
            "</a></li>"
    }
    $('#pageLink').html(html);
}

function RedirectPage(index) {
    currentPage = index;
    GetAll(perPage, currentPage, keyword);
}

function Submit() {
    $(document).on('submit', '#form-equiment-type', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        if (createCheck) {
            $.ajax({
                type: "post",
                url: "postequimenttype",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    $('input[name = "name"]').val("");
                    Swal.fire(
                        'Good job!',
                        'Thêm mới thành công',
                        'success'
                    );
                    GetAll(perPage, currentPage, keyword);
                },
                error: function (err) {
                    $('#error-name').text(err.responseJSON.message);
                }
            });
        } else {
            $.ajax({
                type: "post",
                url: "updateequimenttype/" + id_equimenttype,
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    $('input[name = "name"]').val("");
                    Swal.fire(
                        'Good job!',
                        'Sửa thành công',
                        'success'
                    );
                    GetAll(perPage, currentPage, keyword);
                    createCheck = true;
                    $('#btnHuy').css('display', 'none');
                },
                error: function (err) {
                    $('#error-name').text(err.responseJSON.message);
                }
            });
        }
    });
}

function Delete(id) {
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
                url: "deleteequimenttype/" + id,
                dataType: "json",
                success: function (response) {
                    Swal.fire(
                        'Good job!',
                        'You clicked the button!',
                        'success'
                    );
                    GetAll(perPage, currentPage, keyword);
                }
            });
        }
    })
}

function GetEquiment(id) {
    $.ajax({
        type: "get",
        url: "getbyidequiment/" + id,
        dataType: "json",
        success: function (response) {
            $('input[name = "name"]').val(response[0].name);
            response[0].status == 1 ? $('#flexSwitchCheckDefault').attr('checked', true) : $('#flexSwitchCheckDefault').attr('checked', false);
            id = response[0].id;
            id_equimenttype = id;
            createCheck = false;
            $('#btnHuy').css('display', 'block');
        }
    });

}

function Search() {
    keyword = $('#txtTimKiem').val();
    GetAll(perPage, currentPage, keyword);
}

function ChangeStatus() {
    keyword = $('#status-list').val();
    GetAll(perPage, currentPage, keyword);
}


