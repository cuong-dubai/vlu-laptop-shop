<?php
// get today's date
$today = new DateTime();
// get the season dates
$spring = new DateTime('January 1');
$summer = new DateTime('April 1');
$fall = new DateTime('July 1');
$winter = new DateTime('October 1');
// spcial dates
$start_tet = new DateTime('January 1');
$end_tet = new DateTime('January 30');

$valentine = new DateTime('February 14');

$result = 'bg.png';
?>
<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">

    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5"
      style="background:url(./extensions/images/bg-login.jpg) no-repeat;background-attachment:fixed;background-position:center;background-size:cover;">
      <div class="w-100 d-flex justify-content-center">
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-5">
          <a href="index.html" class="app-brand-link gap-2">
            <div class="login-view-website text-sm"><a href="../" target="_blank" title="Xem website"><i
                  class="fas fa-reply mr-2"></i>Xem website</a></div>
            <div class="skd-logo">
              <a href="#">
                <img src="extensions/images/logo_head.png" alt="">
              </a>
            </div>
          </a>
        </div>


        <!-- /Logo -->
        <h4 class="mb-2">Welcome to VLU LAPTOP SHOP</h4>
        <p class="mb-4 text-center">Vui lòng đăng nhập để vào trang quản trị website</p>

        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework"
          enctype="multipart/form-data" novalidate="novalidate">
          <div class="mb-3 fv-plugins-icon-container">
            <label for="email" class="form-label">Username</label>
            <input type="text" class="form-control text-sm" name="username" id="username" placeholder="Tài khoản *"
              autocomplete="off" autofocus="">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            </div>
          </div>
          <div class="mb-3 form-password-toggle fv-plugins-icon-container">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge has-validation">
              <input type="password" class="form-control text-sm" name="password" id="password" placeholder="Mật khẩu *"
                autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text show-password">
                  <span class="fas fa-eye"></span>
                </div>
              </div>
            </div>
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            </div>
          </div>
          <button class="btn btn-primary d-grid btn-login w-100 auth-form-btn">
            Đăng nhập
          </button>
          <div class="alert my-alert alert-login d-none text-center text-sm p-2 mb-0 mt-2" role="alert"></div>
        </form>
      </div>
    </div>
    <!-- /Login -->
  </div>
</div>