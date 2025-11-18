function validateForm(ele = "") {
    if (ele) {
        $("." + ele)
            .find("input[type=submit]")
            .removeAttr("disabled");
        var forms = document.getElementsByClassName(ele);
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener(
                "submit",
                function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        });
    }
}
validateForm('validation-user');
VLU.Slick = function(){
    $('.slideshow').slick({
    infinite: true,
    slidesToShow: 1,
    vertical: false,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    dots: false,
    });
}

$(document).ready(function () {
    VLU.Slick();


    // Xử lý thêm vào giỏ hàng bằng AJAX
    $(document).on('click', '.btn-add-cart', function (e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        if (!productId) return;

        $.ajax({
            url: 'ajax/add_to_cart.php',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: productId,
                qty: 1
            },
            success: function (res) {
                if (res && res.success && res.cart) {
                    var totalQty = res.cart.total_qty || 0;
                    $('#cart-count').text(totalQty);
                } else if (res && res.message) {
                    alert(res.message);
                } else {
                    alert('Không thể thêm vào giỏ hàng, vui lòng thử lại.');
                }
            },
            error: function () {
                alert('Không thể kết nối tới máy chủ.');
            }
        });
    });

main
});