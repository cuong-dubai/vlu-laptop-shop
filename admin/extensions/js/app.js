
/* Validation form */
function validateForm(ele) {
	window.addEventListener(
		'load',
		function () {
			var forms = document.getElementsByClassName(ele);
			var validation = Array.prototype.filter.call(forms, function (form) {
				form.addEventListener(
					'submit',
					function (event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					},
					false
				);
			});
			$('.' + ele)
				.find('input[type=submit],button[type=submit]')
				.removeAttr('disabled');
		},
		false
	);
}
/* Validation form chung */
validateForm('validation-form');
function isExist(ele) {
	return ele.length;
}
function login() {

  var username = $("#username").val();
  var password = $("#password").val();

  if (
    $(".alert-login").hasClass("alert-danger") ||
    $(".alert-login").hasClass("alert-success")
  ) {
    $(".alert-login").removeClass("alert-danger alert-success");
    $(".alert-login").addClass("d-none");
    $(".alert-login").html("");
  }

  if ($(".show-password").hasClass("active")) {
    $(".show-password").removeClass("active");
    $("#password").attr("type", "password");
    $(".show-password").find("span").toggleClass("fas fa-eye fas fa-eye-slash");
  }

  $(".show-password").addClass("disabled");
  $(".btn-login .sk-chase").removeClass("d-none");
  $(".btn-login span").addClass("d-none");
  $(".btn-login").attr("disabled", true);
  $("#username").attr("disabled", true);
  $("#password").attr("disabled", true);

  $.ajax({
    type: "POST",
    dataType: "json",
    url: "ajax/login.php",
    async: false,
    data: { username: username, password: password },
    success: function (result) {
      if (result.success) {
        window.location = "index.php";
      } else if (result.error) {
        $(".alert-login").removeClass("d-none");
        $(".show-password").removeClass("disabled");
        $(".btn-login .sk-chase").addClass("d-none");
        $(".btn-login span").removeClass("d-none");
        $(".btn-login").attr("disabled", false);
        $("#username").attr("disabled", false);
        $("#password").attr("disabled", false);
        $(".alert-login").removeClass("alert-success");
        $(".alert-login").addClass("alert-danger");
        $(".alert-login").html(result.error);
      }
    },
  });
}
function filterCategory(url) {
  if ($('.filter-category').length > 0 && url != '') {
    var id = '';
    var value = 0;
    $('.filter-category').each(function () {
      id = $(this).attr('id');
      if (id) {
        value = parseInt($('#' + id).val());
        if (value) {
          url += '&' + id + '=' + value;
        }
      }
    });
  }
  return url;
}
function notifyDialog(content = '', title = 'Thông báo', icon = 'fas fa-exclamation-triangle', type = 'blue') {
  $.alert({
    title: title,
    icon: icon, // font awesome
    type: type, // red, green, orange, blue, purple, dark
    content: content, // html, text
    backgroundDismiss: true,
    animationSpeed: 600,
    animation: 'zoom',
    closeAnimation: 'scale',
    typeAnimated: true,
    animateFromElement: false,
    autoClose: 'accept|3000',
    escapeKey: 'accept',
    buttons: {
      accept: {
        text: '<i class="fas fa-check align-middle mr-2"></i>Đồng ý',
        btnClass: 'btn-blue btn-sm bg-gradient-primary'
      }
    }
  });
}
if ($('.format-price').length) {
  $('.format-price').priceFormat({
    limit: 13,
    prefix: '',
    centsLimit: 0
  });
}
function roundNumber(rnum, rlength) {
	return Math.round(rnum * Math.pow(10, rlength)) / Math.pow(10, rlength);
}
if ($('.regular_price').length && $('.sale_price').length) {
  $('.regular_price, .sale_price').keyup(function () {
    var regular_price = $('.regular_price').val();
    var sale_price = $('.sale_price').length ? $('.sale_price').val() : 0;
    var discount = 0;
    if (regular_price == '' || regular_price == '0' || sale_price == '' || sale_price == '0') {
      discount = 0;
    } else {
      regular_price = regular_price.replace(/,/g, '');
      sale_price = sale_price ? sale_price.replace(/,/g, '') : 0;
      regular_price = parseInt(regular_price);
      sale_price = parseInt(sale_price);
      if (sale_price < regular_price) {
        discount = 100 - (sale_price * 100) / regular_price;
        discount = roundNumber(discount, 0);
      } else {
        $('.regular_price, .sale_price').val(0);
        if ($('.discount').length) {
          discount = 0;
          $('.sale_price').val(0);
        }
      }
    }
    if ($('.discount').length) {
      $('.discount').val(discount);
    }
  });
}
/* Search */
function doEnter(evt, obj, url) {
  if (url == '') {
    notifyDialog('Đường dẫn không hợp lệ');
    return false;
  }
  if (evt.keyCode == 13 || evt.which == 13) {
    onSearch(obj, url);
  }
}
function onSearch(obj, url) {
  if (url == '') {
    notifyDialog('Đường dẫn không hợp lệ');
    return false;
  } else {
    var keyword = $('#' + obj).val();
    url = filterCategory(url);
    if (keyword) {
      url += '&keyword=' + encodeURI(keyword);
    }
    window.location = filterCategory(url);
  }
}




$(document).ready(function () {

  /* Chặn submit form nhưng vẫn gọi login() */
  $(".formAuthentication").on("submit", function (e) {
    e.preventDefault();
    login();
  });

  if (LOGIN_PAGE) {
    /* Nhấn Enter */
    $("#username, #password").keypress(function (event) {
      if (event.keyCode == 13 || event.which == 13) {
        event.preventDefault(); // Không reload trang
        login();
      }
    });

    /* Click nút login */
    $(".auth-form-btn").click(function (event) {
      event.preventDefault(); // Không reload trang
      login();
    });

    /* Show/Hide password */
    $(".show-password").click(function () {
      if ($("#password").val()) {
        if ($(this).hasClass("active")) {
          $(this).removeClass("active");
          $("#password").attr("type", "password");
        } else {
          $(this).addClass("active");
          $("#password").attr("type", "text");
        }
        $(this).find("span").toggleClass("fas fa-eye fas fa-eye-slash");
      }
    });
  }
});
