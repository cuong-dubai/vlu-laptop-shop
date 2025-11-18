<div class="wrap-content">
    <div class="wrap-user mt-4">
        <div class="title-user">
            <span>Đăng ký</span>
        </div>
        <form class="form-user validation-user" novalidate method="post" action="account/dang-ky"
            enctype="multipart/form-data">
            <?= $flash->getMessages("frontend") ?>
            <label>Họ tên</label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control text-sm" id="fullname" name="fullname"
                    placeholder="Nhập họ và tên" value="<?= $flash->get('fullname') ?>" required>
                <div class="invalid-feedback">Vui lòng nhập họ tên</div>
            </div>
            <label>Tài khoản</label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control text-sm" id="username" name="username"
                    placeholder="Nhập tài khoản" value="<?= $flash->get('username') ?>" required>
                <div class="invalid-feedback">Vui lòng nhập tài khoản</div>
            </div>
            <label>Mật khẩu</label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control text-sm" id="password" name="password"
                    placeholder="Nhập mật khẩu" required>
                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
            </div>
            <label>Nhập lại mật khẩu</label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control text-sm" id="repassword" name="repassword"
                    placeholder="Nhập lại mật khẩu" required>
                <div class="invalid-feedback">Vui lòng nhập lại mật khẩu</div>
            </div>
            <label>Giới tính</label>
            <div class="input-group input-user">
                <?php $flashGender = $flash->get('gender'); ?>
                <div class="radio-user custom-control custom-radio">
                    <input type="radio" id="nam" name="gender" class="custom-control-input" value="1"
                        <?= ($flashGender == 1) ? 'checked' : '' ?> required>
                    <label class="custom-control-label" for="nam">Nam</label>
                </div>
                <div class="radio-user custom-control custom-radio">
                    <input type="radio" id="nu" name="gender" class="custom-control-input" value="2"
                        <?= ($flashGender == 2) ? 'checked' : '' ?> required>
                    <label class="custom-control-label" for="nu">Nữ</label>
                </div>
            </div>
            
            <label>Email</label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                </div>
                <input type="email" class="form-control text-sm" id="email" name="email" placeholder="Nhập địa chỉ email"
                    value="<?= $flash->get('email') ?>" required>
                <div class="invalid-feedback">Vui lòng nhập địa chỉ email</div>
            </div>
            <label>Điện thoại</label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-phone-square"></i></div>
                </div>
                <input type="number" class="form-control text-sm" id="phone" name="phone"
                    placeholder="Nhập số điện thoại" value="<?= $flash->get('phone') ?>" required>
                <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
            </div>
            <div class="button-user">
                <input type="submit" class="btn btn-primary btn-block" name="registration-user" value="Đăng ký"
                    disabled>
            </div>
        </form>
    </div>
</div>