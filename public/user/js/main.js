(function ($) {
    "use strict";

    // Dropdown on mouse hover
    // $(document).ready(function () {
    //     function toggleNavbarMethod() {
    //         if ($(window).width() > 992) {
    //             $('.navbar .dropdown').on('mouseover', function () {
    //                 $('.dropdown-toggle', this).trigger('click');
    //             }).on('mouseout', function () {
    //                 $('.dropdown-toggle', this).trigger('click').blur();
    //             });
    //         } else {
    //             $('.navbar .dropdown').off('mouseover').off('mouseout');
    //         }
    //     }
    //     toggleNavbarMethod();
    //     $(window).resize(toggleNavbarMethod);
    // });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });

    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

})(jQuery);


//validate login user to view cart
function cart_login() {
    Swal.fire({
        icon: 'error',
        title: 'Oops',
        text: 'Bạn cần đăng nhập để có thể xem giỏ hàng!',
        footer: '<a href="/user_login">Đăng nhập</a>'
    })
}

function add_cart(id) {
    var cart_product_id = $('.cart_product_id_' + id).val()
    var cart_product_name = $('.cart_product_name_' + id).val();
    var cart_product_image = $('.cart_product_image_' + id).val();
    var cart_product_price = $('.cart_product_price_' + id).val();
    var cart_product_qty = $('.cart_product_qty_' + id).val();
    var cart_product_weight = $('.cart_product_weight_' + id).val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: "/add_cart",
        type: 'POST',
        data: {
            id: id,
            cart_product_id: cart_product_id,
            cart_product_name: cart_product_name,
            cart_product_image: cart_product_image,
            cart_product_price: cart_product_price,
            cart_product_qty: cart_product_qty,
            cart_product_weight: cart_product_weight,
            _token: _token
        },
        success: function (data) {
            $('#count_cart').html(data);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Thêm sản phẩm vào giỏ hàng thành công',
                footer: '<a href="/show_cart">Xem giỏ hàng</a>'
            })
        }
    });
}

// list location
$(document).ready(function () {
    $('.choose').on('change', function () {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
        if (action == "city") {
            result = 'district';
        } else if (action == "district") {
            result = 'ward';
        } else {
            result = 'service';
        }
        $.ajax({
            url: '/select_delivery_cart',
            method: 'POST',
            data: {
                action,
                ma_id,
                _token
            },
            success: function (data) {
                $('#' + result).html(data);
            }
        })
    })
})

// calculate fee ship
$(document).ready(function () {
    $('.calculate_delivery').click(function () {
        var matp = $('.city').val();
        var maqh = $('.district').val();
        var xaid = $('.ward').find(':selected').data('ward');
        var total = $('.total').val();
        var service = $('.service').val();
        var _token = $('input[name="_token"]').val();
        if (matp == '' || maqh == '' || xaid == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: 'Vui lòng chọn địa chỉ giao hàng!',
            })
        } else {
            $.ajax({
                url: '/calculate_delivery',
                method: 'POST',
                data: {
                    matp: matp,
                    maqh: maqh,
                    xaid: xaid,
                    total_order: total,
                    service: service,
                    _token: _token
                },
                success: function () {
                    swal({
                        title: "SUCCESS",
                        text: "Tính phí vận chuyển thành công, vui lòng kiểm tra lại giỏ hàng và thanh toán",
                        icon: "success",
                        buttons: false,
                        dangerMode: true,
                    })
                    location.reload();
                }
            });
        }
    });
});

// notification base on url
function getIdDetails() {
    var urlParams;
    (window.onpopstate = function () {
        var match,
            pl = /\+/g, // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);

        urlParams = {};
        while ((match = search.exec(query)))
            urlParams[decode(match[1])] = decode(match[2]);
    })();
    return urlParams;
}

// update cart
$(document).ready(function () {
    $('.success_update_allcart').click(function () {
        swal({
            title: "SUCCESS",
            text: "Cập nhật tất cả sản phẩm trong giỏ hàng thành công",
            icon: "success",
            buttons: false,
            dangerMode: true,
        })
    });
});

// delete all cart success
$(document).ready(function () {
    $('.success_delete_allcart').click(function () {
        $.ajax({
            type: 'GET',
            url: '/delete_all_cart',
            success: function () {
                swal({
                    title: "SUCCESS",
                    text: "Xóa tất cả sản phẩm trong giỏ hàng thành công",
                    icon: "success",
                    buttons: false,
                    dangerMode: true,
                })
                location.reload();
            }
        });
    });
    displaySearch()
    let brand = [];
    $('.checkboxbrand').change(function () {
        var action = '';
        var type = 'brand';
        if (this.checked) {
            action = 'checked';
            brand.push($(this).val());
        } else {
            action = 'unchecked';
            brand.splice(brand.indexOf($(this).val()), 1);
        }
        var _token = $('input[name="_token"]').val();
        if (brand.length > 0) {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {brand, _token, action, type},
                success: function (data) {
                    if (data.length > 0) {
                        $('#filter-product').html(data);
                    } else {
                        $('#filter-product').html('Không có sản phẩm nào');
                    }
                }
            })
        } else {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {_token},
                success: function (data) {
                    if (data.length > 0) {
                        $('#filter-product').html(data);
                    } else {
                        $('#filter-product').html('Không có sản phẩm nào');
                    }
                }
            })
        }
    })
    let category = [];
    $('.checkboxcategory').change(function () {
        var action = '';
        var type = 'category';
        if (this.checked) {
            action = 'checked';
            category.push($(this).val());
        } else {
            action = 'unchecked';
            category.splice(category.indexOf($(this).val()), 1);
        }
        var _token = $('input[name="_token"]').val();
        if (category.length > 0) {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {category, _token, action, type},
                success: function (data) {
                    if (data.length > 0) {
                        $('#filter-product').html(data);
                    } else {
                        $('#filter-product').html('Không có sản phẩm nào');
                    }
                }
            })
        } else {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {_token},
                success: function (data) {
                    $('#filter-product').html(data);
                }
            })
        }
    })
    let price = [];
    $('.checkboxprice').change(function () {
        var min = $(this).val();
        var max = $(this).data('max');
        var action = '';
        if (this.checked) {
            action = 'checked';
            price.push(min);
            price.push(max);
        } else {
            action = 'unchecked';
            price.splice(price.indexOf(min), 1);
            price.splice(price.indexOf(max), 1);
        }
        var type = 'price';
        var _token = $('input[name="_token"]').val();
        if (price.length > 0) {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {price, _token, action, type},
                success: function (data) {
                    $('#filter-product').html(data);
                }
            })
        } else {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {_token},
                success: function (data) {
                    $('#filter-product').html(data);
                }
            })
        }
    })

});
//search products
$(document).ready(() => {
    $("#search").on('keyup',
        function () {
            let $value = $(this).val();
            let action = 'keyup';
            let type = 'search';
            if ($value.length > 0) {
                $.ajax({
                    type: "get",
                    url: "/search",
                    data: {'search': $value, action, type},
                    success: function (data) {
                        if (data.length > 0) {
                            $('#search-product').html(data);
                        } else {
                            $('#search-product').html('Không tìm thấy sản phẩm');
                        }
                    }
                });
            }
        }
    );
});
//search receipt
$(document).ready(() => {
    displaySearchReceipt()
    $("#search-receipt").on('keyup',
        function () {
            let $value = $(this).val();
            if ($value.length > 0) {
                $.ajax({
                    type: "get",
                    url: "/search-receipt",
                    data: {'search': $value},
                    success: function (data) {
                        if (data.length > 0) {
                            $('#search-receipt-result').html(data);
                        } else {
                            $('#search-receipt-result').html('Không tìm thấy hóa đơn');
                        }
                    }
                });
            }
        }
    );
});
// display result search
function displaySearch() {
    let search = document.querySelector(".form-control.search");
    let display = document.querySelector(".display-search");
    let checkboxbrand = document.getElementsByClassName("checkboxbrand");
    let checkboxcate = document.getElementsByClassName("checkboxcategory");
    let checkboxprice = document.getElementsByClassName("checkboxprice");
    search.addEventListener('keyup', (e) => {
        display.setAttribute('id', 'search-product');
        const value = e.target.value;
        if (value.length <= 0) {
            display.setAttribute('id', '');
        }
    })
    for (let i = 0; i < checkboxbrand.length; i++) {
        checkboxbrand[i].addEventListener('change', () => {
            display.setAttribute('id', 'filter-product');
        })
    }
    for (let i = 0; i < checkboxcate.length; i++) {
        checkboxcate[i].addEventListener('change', () => {
            display.setAttribute('id', 'filter-product');
        })
    }
    for (let i = 0; i < checkboxprice.length; i++) {
        checkboxprice[i].addEventListener('change', () => {
            display.setAttribute('id', 'filter-product');
        })
    }
}
function displaySearchReceipt() {
    let search_receipt = document.querySelector("#search-receipt");
    let display_receipt = document.querySelector(".display-search-receipt");
    search_receipt.addEventListener('keyup', (e) => {
        display_receipt.setAttribute('id', 'search-receipt-result');
        const value = e.target.value;
        if (value.length <= 0) {
            display_receipt.setAttribute('id', '');
        }
    })
}
// validate checkout
$(document).ready(function () {
    $('.check_payment').click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Oops',
            text: 'Vui lòng chọn địa điểm giao hàng!',
        })
    });
});

// validate checkout
$(document).ready(function () {
    $('.paymentsuccess').click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: 'Đặt hàng thành công!',
        })
    });
});






