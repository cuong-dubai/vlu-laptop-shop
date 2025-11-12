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