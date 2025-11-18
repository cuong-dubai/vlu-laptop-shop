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

VLU.HandleAddToCart = function(){
    $(document).on('click', '.btn-add-to-cart', function(e){
        e.preventDefault();

        var $btn = $(this);
        var productId = parseInt($btn.data('product-id'), 10) || 0;

        if (!productId) {
            return;
        }

        $btn.prop('disabled', true).addClass('is-loading');

        $.ajax({
            url: 'ajax/add_to_cart.php',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: productId,
                qty: 1
            }
        })
        .done(function(response){
            if (response && response.success) {
                window.location.href = 'gio-hang';
            } else {
                alert(response && response.message ? response.message : 'Không thể thêm sản phẩm vào giỏ hàng.');
            }
        })
        .fail(function(){
            alert('Không thể thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.');
        })
        .always(function(){
            $btn.prop('disabled', false).removeClass('is-loading');
        });
    });
}

$(document).ready(function () {
    VLU.Slick();
    VLU.HandleAddToCart();
});