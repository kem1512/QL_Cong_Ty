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
                    url: "/personnel/delete",
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
$("#btn_insert_personnel").on("click", function () {
    var data = $("#insert_personnel").serialize();
    var url = "";
    // if () {
    //     Swal.fire(
    //         'Thất Bại !',
    //         'Vui lòng không để trống !',
    //         'error'
    //     )
    // } else {
    //     $.ajax({
    //         url:
    //  })
});

function getdetail(id) {
    $.ajax({
        url: "/personnel/edit",
        method: "GET",
        data: {
            count_type: id,
        },
    });
}

function onAlertSuccess() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        title: "Signed in successfully",
    });
}

function onAlertError() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "error",
        title: "Signed in successfully",
    });
}
