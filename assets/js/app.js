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
    var handleRequest = function(productId, qty, callback){
        $.ajax({
            url: 'ajax/add_to_cart.php',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: productId,
                qty: qty || 1
            }
        })
        .done(function(response){
            if (response && response.success) {
                callback(true, response);
            } else {
                callback(false, response ? response.message : null);
            }
        })
        .fail(function(){
            callback(false, 'Không thể thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.');
        });
    };

    $(document).on('click', '.btn-add-to-cart', function(e){
        e.preventDefault();

        var $btn = $(this);
        var productId = parseInt($btn.data('product-id'), 10) || 0;

        if (!productId) {
            return;
        }

        $btn.prop('disabled', true).addClass('is-loading');

        handleRequest(productId, 1, function(success, result){
            if (success) {
                window.location.href = 'gio-hang';
            } else {
                alert(result || 'Không thể thêm sản phẩm vào giỏ hàng.');
            }

            $btn.prop('disabled', false).removeClass('is-loading');
        });
    });

    $(document).on('click', '.addcart', function(e){
        e.preventDefault();

        var $btn = $(this);
        var productId = parseInt($btn.data('id'), 10) || 0;
        var action = $btn.data('action');

        if (!productId) {
            return;
        }

        $btn.prop('disabled', true).addClass('is-loading');

        handleRequest(productId, 1, function(success, result){
            $btn.prop('disabled', false).removeClass('is-loading');

            if (!success) {
                alert(result || 'Không thể thêm sản phẩm vào giỏ hàng.');
                return;
            }

            if (action === 'buynow') {
                window.location.href = 'gio-hang';
            } else {
                alert('Sản phẩm đã được thêm vào giỏ hàng.');
            }
        });
    });
}

$(document).ready(function () {
    VLU.Slick();
    VLU.HandleAddToCart();
});