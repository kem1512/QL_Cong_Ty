function onDelete(id) {
    // window.employee_id = id;
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
                $.ajax({
                    url: "/personnel/delete",
                    method: "GET",

                    data: {
                        count_type: id,
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
function getdetail(id){
    $.ajax({
        url: "/personnel/edit",
        method: "GET",

        data: {
            count_type: id,
        },
    });
}

function onAlertSuccess() {
    Swal.fire({
        position: "top-end",
        width: 400,
        icon: "success",
        title: "Thành Công !",
        showConfirmButton: false,
        timer: 1000,
    });
}

function onAlertError() {
    Swal.fire({
        position: "top-end",
        width: 400,
        icon: "error",
        title: "Thất Bại !",
        showConfirmButton: false,
        timer: 1000,
    });
}
