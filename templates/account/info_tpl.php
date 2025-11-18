<div class="wrap-content">
    <div class="container frefix__user__info__container mt-5">
        <div class="row">
            <!-- Menu bên trái -->
            <div class="col-md-3">
                <div class="list-group frefix__user__info__list-group">
                    <a href="#info" class="list-group-item list-group-item-action active" data-toggle="tab">Thông tin
                        chung</a>
                    <a href="#changePassword" class="list-group-item list-group-item-action" data-toggle="tab">Đổi mật
                        khẩu</a>
                    <a href="#orders" class="list-group-item list-group-item-action" data-toggle="tab">Đơn hàng</a>
                    <a href="#orderHistory" class="list-group-item list-group-item-action" data-toggle="tab">Lịch sử mua hàng</a>

                </div>
            </div>

            <!-- Nội dung bên phải -->
            <div class="col-md-9">
                <div class="tab-content frefix__user__info__tab-content">
                    <!-- Thông tin tài khoản -->
                    <div class="tab-pane fade show active" id="info">
                        <h3>Thông tin cá nhân</h3>
                        <form class="frefix__user__info__form-user validation-user" novalidate method="post"
                            action="account/thong-tin" enctype="multipart/form-data">
                            <?= $flash->getMessages("frontend") ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tài khoản</label>
                                    <div class="input-group frefix__user__info__input-user">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control text-sm" id="username" name="username"
                                            placeholder="Nhập tài khoản" value="<?= $rowDetail['username'] ?>" readonly
                                            required>
                                    </div>
                                    <label>Họ tên</label>
                                    <div class="input-group frefix__user__info__input-user">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control text-sm" id="fullname" name="fullname"
                                            placeholder="Nhập họ và tên"
                                            value="<?= (!empty($flash->has('fullname'))) ? $flash->get('fullname') : $rowDetail['fullname'] ?>"
                                            required>
                                        <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                                    </div>
                                    <label>Email</label>
                                    <div class="input-group frefix__user__info__input-user">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                        </div>
                                        <input type="email" class="form-control text-sm" id="email" name="email"
                                            placeholder="Nhập email"
                                            value="<?= (!empty($flash->has('email'))) ? $flash->get('email') : $rowDetail['email'] ?>"
                                            required>
                                        <div class="invalid-feedback">Vui lòng nhập email</div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label>Ngày sinh</label>
                                    <div class="input-group frefix__user__info__input-user">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                        </div>
                                        <input type="text" class="form-control text-sm" id="birthday" name="birthday"
                                            placeholder="Nhập ngày sinh"
                                            value="<?= (!empty($flash->has('birthday'))) ? $flash->get('birthday') : date("d/m/Y", $rowDetail['birthday']) ?>"
                                            required autocomplete="off">
                                        <div class="invalid-feedback">Vui lòng nhập ngày sinh</div>
                                    </div>

                                    <label>Điện thoại</label>
                                    <div class="input-group frefix__user__info__input-user">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-phone-square"></i></div>
                                        </div>
                                        <input type="number" class="form-control text-sm" id="phone" name="phone"
                                            placeholder="Nhập số điện thoại"
                                            value="<?= (!empty($flash->has('phone'))) ? $flash->get('phone') : $rowDetail['phone'] ?>"
                                            required>
                                        <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                                    </div>
                                    <label>Giới tính</label>
                                    <div class="input-group frefix__user__info__input-user">
                                        <?php $flashGender = $flash->get('gender'); ?>
                                        <div class="radio-user custom-control custom-radio">
                                            <input type="radio" id="nam" name="gender" class="custom-control-input"
                                                <?= (!empty($flashGender) && $flashGender == 1) ? 'checked' : (($rowDetail['gender'] == 1) ? 'checked' : '') ?> value="1" required>
                                            <label class="custom-control-label" for="nam">Nam</label>
                                        </div>
                                        <div class="radio-user custom-control custom-radio">
                                            <input type="radio" id="nu" name="gender" class="custom-control-input"
                                                <?= (!empty($flashGender) && $flashGender == 2) ? 'checked' : (($rowDetail['gender'] == 2) ? 'checked' : '') ?> value="2" required>
                                            <label class="custom-control-label" for="nu">Nữ</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label>Địa chỉ</label>
                                    <div class="input-group frefix__user__info__input-user">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-map"></i></div>
                                        </div>
                                        <input type="text" class="form-control text-sm" id="address" name="address"
                                            placeholder="Nhập địa chỉ"
                                            value="<?= (!empty($flash->has('address'))) ? $flash->get('address') : $rowDetail['address'] ?>"
                                            required>
                                        <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                                    </div>
                                </div>
                            </div>





                            <div class="frefix__user__info__button-user">
                                <input type="submit" class="btn btn-primary btn-block" name="info-user" value="Cập nhật"
                                    disabled>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="changePassword">
                        <h3>Đổi mật khẩu</h3>
                        <form class="frefix__user__info__form-user validation-user" novalidate method="post"
                            action="account/thong-tin" enctype="multipart/form-data">
                            <label>Mật khẩu cũ</label>
                            <div class="input-group frefix__user__info__input-user">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control text-sm" id="old-password"
                                    name="old-password" placeholder="Nhập mật khẩu cũ">
                            </div>
                            <label>Mật khẩu mới</label>
                            <div class="input-group frefix__user__info__input-user">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control text-sm" id="new-password"
                                    name="new-password" placeholder="Nhập mật khẩu mới">
                            </div>
                            <label>Nhập lại mật khẩu mới</label>
                            <div class="input-group frefix__user__info__input-user">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control text-sm" id="new-password-confirm"
                                    name="new-password-confirm" placeholder="Nhập lại mật khẩu mới">
                            </div>
                            <div class="frefix__user__info__button-user">
                                <input type="submit" class="btn btn-primary btn-block" name="info-user" value="Cập nhật"
                                    disabled>
                            </div>
                        </form>
                    </div>
                    <!-- Đơn hàng -->
                    <div class="tab-pane fade" id="orders">
                        <section class="content mb-3">
                            <div class="container-fluid">
                                <h5 class="pt-3 pb-2">
                                    Đơn hàng
                                    <span class="badge badge-warning">Tính năng đang phát triển</span>
                                </h5>

                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="fa fa-cogs mr-2"></i>
                                    <span>Chức năng Đơn hàng đang trong quá trình hoàn thiện. Vui lòng quay lại
                                        sau!</span>
                                </div>


                            </div>
                        </section>
                    </div>
                    <!-- Lịch sử mua hàng -->
                    <div class="tab-pane fade" id="orderHistory">
                        <section class="content mb-3">
                            <div class="container-fluid">
                                <h5 class="pt-3 pb-2">
                                    Lịch sử mua hàng
                                    <span class="badge badge-warning">Tính năng đang phát triển</span>
                                </h5>

                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="fa fa-cogs mr-2"></i>
                                    <span>Chức năng Lịch sử mua hàng đang trong quá trình hoàn thiện. Vui lòng quay lại
                                        sau!</span>
                                </div>


                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>