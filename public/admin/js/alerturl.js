
function getIdDetails_admin() {
    var urlParams;
    (window.onpopstate = function() {
        var match,
            pl = /\+/g, // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function(s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);

        urlParams = {};
        while ((match = search.exec(query)))
            urlParams[decode(match[1])] = decode(match[2]);
    })();
    return urlParams;
}

// alert save brand success
if (getIdDetails_admin().message == "save_brand_success") {
    swal({
        title: "Success!",
        text: "Thêm thương hiệu thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert save cate success
if (getIdDetails_admin().message == "save_cate_success") {
    swal({
        title: "Success!",
        text: "Thêm danh mục thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert save product success
if (getIdDetails_admin().message == "save_product_success") {
    swal({
        title: "Success!",
        text: "Thêm sản phẩm thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert save user success
if (getIdDetails_admin().message == "save_user_success") {
    swal({
        title: "Success!",
        text: "Thêm khách hàng thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}


// alert update user success
if (getIdDetails_admin().message == "update_cate_success") {
    swal({
        title: "Success!",
        text: "Cập nhật danh mục thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert update brand success
if (getIdDetails_admin().message == "update_brand_success") {
    swal({
        title: "Success!",
        text: "Cập nhật thương hiệu thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert update product success
if (getIdDetails_admin().message == "update_product_success") {
    swal({
        title: "Success!",
        text: "Cập nhật sản phẩm thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert update category success
if (getIdDetails_admin().message == "update_user_success") {
    swal({
        title: "Success!",
        text: "Cập nhật thông tin khách hàng thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert delete user success
if (getIdDetails_admin().message == "delete_user_success") {
    swal({
        title: "Success!",
        text: "Xóa khách hàng thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert delete brand success
if (getIdDetails_admin().message == "delete_brand_success") {
    swal({
        title: "Success!",
        text: "Xóa thương hiệu thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert delete category success
if (getIdDetails_admin().message == "delete_cate_success") {
    swal({
        title: "Success!",
        text: "Xóa danh mục thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
// alert delete product success
if (getIdDetails_admin().message == "delete_product_success") {
    swal({
        title: "Success!",
        text: "Xóa sản phẩm thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}


$(document).ready(function () {
    $('.update_receipt_success').click(function () {
        swal({
            title: "SUCCESS",
            text: "Cập nhật trạng thái hóa đơn thành công",
            icon: "success",
            buttons: false,
            dangerMode: true,
        })
    });
});



$(document).ready(function () {
    $('.delete_receipt_success').click(function () {
        swal({
            title: "SUCCESS",
            text: "Xóa hóa đơn thành công",
            icon: "success",
            buttons: false,
            dangerMode: true,
        })
    });
});


$(document).ready(function () {
    $('.update_warranty_success').click(function () {
        swal({
            title: "SUCCESS",
            text: "Cập nhật trạng thái bảo hành thành công",
            icon: "success",
            buttons: false,
            dangerMode: true,
        })
    });
});

$(document).ready(function () {
    $('.delete_warranty_success').click(function () {
        swal({
            title: "SUCCESS",
            text: "Xóa phiếu bảo hành thành công",
            icon: "success",
            buttons: false,
            dangerMode: true,
        })
    });
});



if (getIdDetails_admin().message == "add_warranty_success") {
    swal({
        title: "SUCCESS",
        text: "Tạo phiếu bảo hành thành công",
        icon: "success",
        buttons: false,
        dangerMode: true,
    })
}
