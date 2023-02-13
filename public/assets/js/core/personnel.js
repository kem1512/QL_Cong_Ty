var fillterst;
var fillterdp;
var num;
var dbclick = [
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
];
// Ajax csrf_token
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

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
                        if (result.status == "error") {
                            onAlertError(result.message);
                        } else {
                            onAlertSuccess("Xoá Thành Công !");
                            $("#body_query").html(result.body);
                        }
                    },
                });
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

//Phân Trang
$(document).ready(function () {
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href");
        console.log(page);
        getMoresUser(page);
    });
});

// INSERT Personnel
$("#btn_insert_personnel").on("click", function (e) {
    e.preventDefault();
    var address = $("#address").val();
    var fullname = $("#fullname").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var password = $("#password").val();
    if (
        (address == "") |
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
                address: address,
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
            error: function (error) {
                onAlertError(error.responseJSON.message);
            },
        });
    }
});

$(".read-checkbox-level").on("change", function () {
    var level;
    var id = id;
    var id = $(this).attr("level");
    var st = $(this).is(":checked");
    if (st == true) {
        level = 1;
    } else {
        level = 0;
    }
    $.ajax({
        url: "/personnel/level",
        method: "GET",
        data: {
            id: id,
            level: level,
        },
        success: function (result) {
            onAlertSuccess(result.message);
        },
        error: function (error) {
            onAlertError(error.responseJSON.message);
        },
    });
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
            if (nhansu.img_url == null) {
                nhansu.img_url = "avatar2.png";
            }
            $("#img_url").attr("src", "./img/" + nhansu.img_url);
            $("#id_user").val(nhansu.id);
            $("#about").val(nhansu.about);
            $("#gender").val(nhansu.gender);
            $("#title").val(nhansu.title);
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
            $("#addressup").val(nhansu.address);
        },
        error: function (error) {
            onAlertError("Vui lòng kiểm tra và thử lại !");
        },
    });
}
//GET Personnel where id views
function getdetailview(id) {
    $.ajax({
        url: "/personnel/edit",
        method: "GET",
        data: {
            id: id,
        },
        success: function (result) {
            var nhansu = result.data;
            if (nhansu.img_url == null) {
                nhansu.img_url = "avatar2.png";
            }
            $("#img_url").attr("src", "./img/" + nhansu.img_url);
            $("#id_user").val(nhansu.id).prop("disabled", true);
            $("#about").val(nhansu.about).prop("disabled", true);
            $("#gender").val(nhansu.gender).prop("disabled", true);
            $("#title").val(nhansu.title).prop("disabled", true);
            $("#personnel_codeu")
                .val(nhansu.personnel_code)
                .prop("disabled", true);
            $("#fullnameu").val(nhansu.fullname).prop("disabled", true);
            $("#phoneu").val(nhansu.phone).prop("disabled", true);
            $("#emailu").val(nhansu.email).prop("disabled", true);
            $("#passwordu").val(nhansu.password).prop("disabled", true);
            $("#department_idu")
                .val(nhansu.department_id)
                .prop("disabled", true);
            $("#date_of_birthu")
                .val(nhansu.date_of_birth)
                .prop("disabled", true);
            $("#position_idu").val(nhansu.position_id).prop("disabled", true);
            $("#recruitment_dateu")
                .val(nhansu.recruitment_date)
                .prop("disabled", true);
            $("#statusu").val(nhansu.status).prop("disabled", true);
            $("#addressup").val(nhansu.address).prop("disabled", true);
        },
        error: function (error) {
            onAlertError("Vui lòng kiểm tra và thử lại !");
        },
    });
}

//UPDATE
$(document).ready(function () {
    $("#form_update").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        // console.log(formData);
        $.ajax({
            type: "POST",
            url: "/personnel",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status == "error") {
                    console.log(response.message);
                    onAlertError(response.message);
                } else {
                    onAlertSuccess("Thông tin của bạn đã được sửa đổi !");
                    $("#body_query").html(response.body);
                }
            },
            error: function (error) {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});

// UPDATE_profile;
$(document).ready(function () {
    $("#form_profile").on("submit", function (e) {
        e.preventDefault();
        // let formData = new FormData(this);
        var fullname = $("#fullname_profile").val();
        var phone = $("#phone_profile").val();
        var email = $("#email_profile").val();
        var date_of_birth = $("#date_of_birth_profile").val();
        var gender = $("#gender_profile").val();
        var address = $("#address_profile").val();
        var position_id = $("#position_id_profile").val();
        var department_id = $("#department_id_profile").val();
        var about = $("#about_profile").val();
        var data = {
            fullname: fullname,
            phone: phone,
            email: email,
            date_of_birth: date_of_birth,
            gender: gender,
            address: address,
            position_id: position_id,
            department_id: department_id,
            about: about,
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/personnel/profile",
            data: {
                fullname: fullname,
                phone: phone,
                email: email,
                date_of_birth: date_of_birth,
                gender: gender,
                address: address,
                position_id: position_id,
                department_id: department_id,
                about: about,
            },
            success: (response) => {
                if (response.status == "error") {
                    console.log(response.message);
                    onAlertError(response.message);
                } else {
                    onAlertSuccess("Thông tin của bạn đã được sửa đổi !");
                    $("#body_query").html(response.body);
                    setfaild();
                }
            },
            error: function (error) {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});
//Search
$(document).ready(function () {
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "/personnel/search",
            method: "GET",
            data: {
                search: search,
            },
            success: function (result) {
                $("#body_query").html(result.body);
            },
        });
    });
});

//Fillter status
$(document).ready(function () {
    $("#status_select").on("change", function () {
        fillterst = $(this).val();
        if (isNaN(fillterst)) {
            fillterst = "";
        }
        console.log("Status" + fillterst);
        console.log("Phòng ban" + fillterdp);
        $.ajax({
            url: "/personnel/fillter",
            method: "GET",
            data: {
                status_filter: fillterst,
                department_filter: fillterdp,
            },
            success: function (result) {
                $("#body_query").html(result.body);
            },
        });
    });
});

//Fillter department
$(document).ready(function () {
    $("#department_select").on("change", function () {
        fillterdp = $(this).val();
        if (isNaN(fillterdp)) {
            fillterdp = "";
        }
        console.log("Status" + fillterst);
        console.log("Phòng ban" + fillterdp);
        $.ajax({
            url: "/personnel/fillter",
            method: "GET",
            data: {
                status_filter: fillterst,
                department_filter: fillterdp,
            },
            success: function (result) {
                $("#body_query").html(result.body);
            },
        });
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#img_url").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
//AVTIVE form
$(document).on("dblclick", ".dbcl_ctl", function () {
    var id_clicked = "#" + $(this).attr("id");
    if (id_clicked == "#fullname_profile") {
        num = 0;
    } else if (id_clicked == "#email_profile") {
        num = 1;
    } else if (id_clicked == "#phone_profile") {
        num = 2;
    } else if (id_clicked == "#date_of_birth_profile") {
        num = 3;
    } else if (id_clicked == "#gender_profile") {
        num = 4;
    } else if (id_clicked == "#position_id_profile") {
        num = 5;
    } else if (id_clicked == "#address_profile") {
        num = 6;
    } else if (id_clicked == "#recruitment_date") {
        num = 7;
    } else if (id_clicked == "#about_profile") {
        num = 8;
    } else if (id_clicked == "#department_id_profile") {
        num = 9;
    }
    // alert(dbclick[num]);
    if (dbclick[num] == true) {
        $(id_clicked).prop("disabled", true);
        dbclick[num] = false;
        console.log("ĐÃ Ẩn");
        console.log(dbclick[num]);
    } else {
        $(id_clicked).prop("disabled", false);
        dbclick[num] = true;
        console.log("ĐÃ Hiện");
        console.log(dbclick[num]);
    }
});
function setfaild() {
    $("#fullname_profile").prop("disabled", true);
    $("#phone_profile").prop("disabled", true);
    $("#email_profile").prop("disabled", true);
    $("#date_of_birth_profile").prop("disabled", true);
    $("#gender_profile").prop("disabled", true);
    $("#address_profile").prop("disabled", true);
    $("#position_id_profile").prop("disabled", true);
    $("#department_id_profile").prop("disabled", true);
    $("#about_profile").prop("disabled", true);
    dbclick = [
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
    ];
}
function getMoresUser(page) {
    $.ajax({
        type: "GET",
        url: page,
        success: function (result) {
            $("#body_query").html(result.body);
        },
    });
}
function onAlertSuccess(text) {
    Swal.fire("Thành Công !", text, "success");
}
function ClearFromA() {
    $("#personnel_code").val("");
    $("#fullname").val("");
    $("#phone").val("");
    $("#email").val("");
    $("#password").val("");
}
function onAlertError(text) {
    Swal.fire("Thất Bại !", text, "error");
}
