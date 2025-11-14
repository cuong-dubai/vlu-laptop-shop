
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
/* Slug */
function slugConvert(slug, focus = false) {
	slug = slug.toLowerCase();
	slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
	slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
	slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
	slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
	slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
	slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
	slug = slug.replace(/đ/gi, 'd');
	slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
	slug = slug.replace(/ /gi, '-');
	slug = slug.replace(/\-\-\-\-\-/gi, '-');
	slug = slug.replace(/\-\-\-\-/gi, '-');
	slug = slug.replace(/\-\-\-/gi, '-');
	slug = slug.replace(/\-\-/gi, '-');
	if (!focus) {
		slug = '@' + slug + '@';
		slug = slug.replace(/\@\-|\-\@|\@/gi, '');
	}
	return slug;
}
function slugPreview(title, lang, focus = false) {
	var slug = slugConvert(title, focus);
	$('#slug' + lang).val(slug);
	$('#slugurlpreview' + lang + ' strong').html(slug);
	$('#seourlpreview' + lang + ' strong').html(slug);
}
function slugPreviewTitleSeo(title, lang) {
	if ($('#title' + lang).length) {
		var titleSeo = $('#title' + lang).val();
		if (!titleSeo) {
			if (title) $('#title-seo-preview' + lang).html(title);
			else $('#title-seo-preview' + lang).html('Title');
		}
	}
}
function slugPress() {
	var sluglang = 'vi,en';
	var inputArticle = $('.card-article input.for-seo');
	var id = $('.slug-id').val();
	var seourlstatic = true;
	// var seourlstatic = $(".slug-seo-preview").data("seourlstatic");
	inputArticle.each(function (index) {
		var name = $(this).attr('id');
   
		var lang = name.substr(name.length - 2);
		if (sluglang.indexOf(lang) >= 0) {
 
			if ($('#' + name).length) {
  
				$('body').on('keyup', '#' + name, function (e) {
          
					var keyCode = e.keyCode || e.which;
					var title = $('#' + name).val();
     
          
					if (keyCode != 13) {
            
            
						if ((!id || $('#slugchange').prop('checked')) && seourlstatic) {
							/* Slug preivew */
							slugPreview(title, lang);
						}
						/* Slug preivew title seo */
						slugPreviewTitleSeo(title, lang);
						/* slug Alert */
						slugAlert(2, lang);
					}
				});
			}
			if ($('#slug' + lang).length) {
        console.log(2);
				$('body').on('keyup', '#slug' + lang, function (e) {
					var keyCode = e.keyCode || e.which;
					var title = $('#slug' + lang).val();
					if (keyCode != 13) {
						/* Slug preivew */
						slugPreview(title, lang, true);
						/* slug Alert */
						slugAlert(2, lang);
					}
				});
			}
		}
	});
}
function slugChange(obj) {
	if (obj.is(':checked')) {
		/* Load slug theo tiêu đề mới */
		slugStatus(1);
		$('.slug-input').attr('readonly', true);
	} else {
		/* Load slug theo tiêu đề cũ */
		slugStatus(0);
		$('.slug-input').attr('readonly', false);
	}
}
function slugStatus(status) {
	var sluglang = 'vi,en';
	var inputArticle = $('.card-article input.for-seo');
	inputArticle.each(function (index) {
		var name = $(this).attr('id');
		var lang = name.substr(name.length - 2);
		if (sluglang.indexOf(lang) >= 0) {
			var title = '';
			if (status == 1) {
				if ($('#' + name).length) {
					title = $('#' + name).val();
					/* Slug preivew */
					slugPreview(title, lang);
					/* Slug preivew title seo */
					slugPreviewTitleSeo(title, lang);
				}
			} else if (status == 0) {
				if ($('#slug-default' + lang).length) {
					title = $('#slug-default' + lang).val();
					/* Slug preivew */
					slugPreview(title, lang);
					/* Slug preivew title seo */
					slugPreviewTitleSeo(title, lang);
				}
			}
		}
	});
}
function slugAlert(result, lang) {
	if (result == 1) {
		$('#alert-slug-danger' + lang).addClass('d-none');
		$('#alert-slug-success' + lang).removeClass('d-none');
	} else if (result == 0) {
		$('#alert-slug-danger' + lang).removeClass('d-none');
		$('#alert-slug-success' + lang).addClass('d-none');
	} else if (result == 2) {
		$('#alert-slug-danger' + lang).addClass('d-none');
		$('#alert-slug-success' + lang).addClass('d-none');
	}
}
function slugCheck() {
	var sluglang = 'vi,en';
	var slugInput = $('.slug-input');
	var id = $('.slug-id').val();
	var copy = $('.slug-copy').val();
	slugInput.each(function (index) {
		var slugId = $(this).attr('id');
		var slug = $(this).val();
		var lang = slugId.substr(slugId.length - 2);
		if (sluglang.indexOf(lang) >= 0) {
			if (slug) {
				$.ajax({
					url: 'api/slug.php',
					type: 'POST',
					dataType: 'html',
					async: false,
					data: {
						slug: slug,
						id: id,
						copy: copy
					},
					success: function (result) {
						slugAlert(result, lang);
					}
				});
			}
		}
	});
}
/* Reader image */
function readImage(inputFile, elementPhoto) {
  if (inputFile[0].files[0]) {
    if (inputFile[0].files[0].name.match(/.(jpg|jpeg|png|gif|bmp|webp)$/i)) {
      var size = parseInt(inputFile[0].files[0].size) / 1024;
      if (size <= 4096) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $(elementPhoto).attr('src', e.target.result);
        };
        reader.readAsDataURL(inputFile[0].files[0]);
      } else {
        notifyDialog('Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB');
        return false;
      }
    } else {
      $(elementPhoto).attr('src', '');
      notifyDialog('Định dạng hình ảnh không hợp lệ');
      return false;
    }
  } else {
    $(elementPhoto).attr('src', '');
    return false;
  }
}
/* Photo zone */
function photoZone(eDrag, iDrag, eLoad) {
  if ($(eDrag).length) {
    /* Drag over */
    $(eDrag).on('dragover', function () {
      $(this).addClass('drag-over');
      return false;
    });
    /* Drag leave */
    $(eDrag).on('dragleave', function () {
      $(this).removeClass('drag-over');
      return false;
    });
    /* Drop */
    $(eDrag).on('drop', function (e) {
      e.preventDefault();
      $(this).removeClass('drag-over');
      var lengthZone = e.originalEvent.dataTransfer.files.length;
      if (lengthZone == 1) {
        $(iDrag).prop('files', e.originalEvent.dataTransfer.files);
        readImage($(iDrag), eLoad);
      } else if (lengthZone > 1) {
        notifyDialog('Bạn chỉ được chọn 1 hình ảnh để upload');
        return false;
      } else {
        notifyDialog('Dữ liệu không hợp lệ');
        return false;
      }
    });
    /* File zone */
    $(iDrag).change(function () {
      readImage($(this), eLoad);
    });
  }
}
/* PhotoZone */
if ($('#photo-zone').length) {
  photoZone('#photo-zone', '#file-zone', '#photoUpload-preview img');
}
/* Delete item */
function deleteItem(url) {
  document.location = url;
}
/* Confirm */
function confirmDialog(action, text, value, title = 'Thông báo', icon = 'fas fa-exclamation-triangle', type = 'blue') {
  $.confirm({
    title: title,
    icon: icon, // font awesome
    type: type, // red, green, orange, blue, purple, dark
    content: text, // html, text
    backgroundDismiss: true,
    animationSpeed: 600,
    animation: 'zoom',
    closeAnimation: 'scale',
    typeAnimated: true,
    animateFromElement: false,
    autoClose: 'cancel|3000',
    escapeKey: 'cancel',
    buttons: {
      success: {
        text: '<i class="fas fa-check align-middle mr-2"></i>Đồng ý',
        btnClass: 'btn-blue btn-sm bg-gradient-primary',
        action: function () {
          if (action == 'delete-item') deleteItem(value);
        }
      },
      cancel: {
        text: '<i class="fas fa-times align-middle mr-2"></i>Hủy',
        btnClass: 'btn-red btn-sm bg-gradient-danger'
      }
    }
  });
}
/* Delete item */
if ($('#delete-item').length) {
  $('body').on('click', '#delete-item', function () {
    var url = $(this).data('url');
    confirmDialog('delete-item', 'Bạn có chắc muốn xóa mục này ?', url);
  });
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

  slugPress();
  if ($('#slugchange').length) {
    $('body').on('click', '#slugchange', function () {
      console.log('dsd');
      
      slugChange($(this));
    });
  }
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
