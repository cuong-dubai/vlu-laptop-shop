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
});