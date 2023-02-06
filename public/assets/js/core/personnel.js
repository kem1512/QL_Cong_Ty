// Ajax csrf_token
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function getAllPersonnel() {}

// DELETE Personnel
function onDelete(id) {
    //sweetalert
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
    });

    swalWithBootstrapButtons
        .fire({
            title: "Bạn muốn xóa ?",
            text: "Sau khi xóa không thể khôi phục !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Xóa",
            cancelButtonText: "Không",
            reverseButtons: true,
        })

        .then((result) => {
            if (result.isConfirmed) {
                //logic
                $.ajax({
                    url: "/personnel",
                    method: "DELETE",
                    data: {
                        count_type: id,
                    },
                    success: function (result) {
                        $("#body_query").html(result.body);
                    },
                });

                swalWithBootstrapButtons.fire(
                    "Thành Công !",
                    "Nhân sự của bạn đã bị xóa.",
                    "success"
                );
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    "Đã Hủy !",
                    "Tác vụ xóa đã được hủy.",
                    "error"
                );
            }
        });
}

// INSERT Personnel
$("#btn_insert_personnel").on("click", function (e) {
    e.preventDefault();
    var personnel_code = $("#personnel_code").val();
    var fullname = $("#fullname").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var password = $("#password").val();
    if (
        (personnel_code == "") |
        (fullname == "") |
        (phone == "") |
        (email == "") |
        (password == "")
    ) {
        onAlertError("Vui lòng không để trống !");
    } else {
        $.ajax({
            url: "/personnel/add",
            method: "POST",
            data: {
                personnel_code: personnel_code,
                fullname: fullname,
                phone: phone,
                email: email,
                password: password,
            },
            success: function (result) {
                onAlertSuccess("Nhân sự mới của bạn đã thêm thành công !");
                $("#body_query").html(result.body);
                ClearFromA();
            },
            error: function (params) {
                onAlertError("Vui lòng kiểm tra và thử lại !");
            },
        });
    }
});

//GET Personnel where id
function getdetail(id) {
    $.ajax({
        url: "/personnel/edit",
        method: "GET",
        data: {
            id: id,
        },
        success: function (result) {
            var nhansu = result.data;
            $("#id").val(nhansu.id);
            $("#personnel_codeu").val(nhansu.personnel_code);
            $("#fullnameu").val(nhansu.fullname);
            $("#phoneu").val(nhansu.phone);
            $("#emailu").val(nhansu.email);
            $("#passwordu").val(nhansu.password);
            $("#department_idu").val(nhansu.department_id);
            $("#date_of_birthu").val(nhansu.date_of_birth);
            $("#position_idu").val(nhansu.position_id);
            $("#recruitment_dateu").val(nhansu.recruitment_date);
            $("#statusu").val(nhansu.status);
            $("#addressu").val(nhansu.address);
        },
        error: function (params) {
            onAlertError("Vui lòng kiểm tra và thử lại !");
        },
    });
}

//UPDATE Personnel 
$("#btn_update_personnel").on("click", function (e) {
    e.preventDefault();
    var personnel_code = $("#personnel_codeu").val();
    var fullname = $("#fullnameu").val();
    var phone = $("#phoneu").val();
    var email = $("#emailu").val();
    var department_id = $("#department_idu").val(); 
    var date_of_birth = $("#date_of_birthu").val();
    var position_id = $("#position_idu").val();
    var recruitment_date = $("#recruitment_dateu").val();
    var status = $("#statusu").val();
    var address = $("#addressu").val();
    var id = $("#id").val();
    if (
        (fullname == "") |
        (phone == "") |
        (email == "") |
        (department_id == "") |
        (date_of_birth == "") |
        (position_id == "") |
        (recruitment_date == "") |
        (status == "") |
        (address == "")|
        (id=="")
    ) {
        onAlertError("Vui lòng không để trống !");
    }else {
        $.ajax({
            url: "/personnel/update",
            method: "POST",
            data : {
                id:id,
                personnel_code: personnel_code,
                fullname: fullname,
                phone: phone,
                email: email,
                department_id: department_id,
                date_of_birth: date_of_birth,
                position_id: position_id,
                recruitment_date: recruitment_date,
                status: status,
                address: address,
            },
            success: function (result) {
                onAlertSuccess("Thông tin của bạn đã được sửa đổi !");
                $("#body_query").html(result.body);
                ClearFromU();
            },
            error: function (params) {
                onAlertError("Vui lòng kiểm tra và thử lại !");
            },
        });
    }
    
});

function onAlertSuccess(text) {
    Swal.fire("Thành Công !", text, "success");
}
function ClearFromA(){
    $("#personnel_code").val('');
    $("#fullname").val('');
    $("#phone").val('');
    $("#email").val('');
    $("#password").val('');
}
function onAlertError(text) {
    Swal.fire("Thất Bại !", text, "error");
}
