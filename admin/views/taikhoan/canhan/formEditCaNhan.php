<!-- header  -->
<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý tài khoản khách hàng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="<?= BASE_URL_ADMIN .  $user['anh_dai_dien']; ?>" class="avatar img-circle" alt="avatar" width="100px"
                            onerror="this.onerror=null; this.src='https://static.vecteezy.com/system/resources/previews/019/879/186/large_2x/user-icon-on-transparent-background-free-png.png'">
                            
                        <h6 class="mt-2">Họ tên: <?= $user['ho_ten'] ?></h6>
                        <h6 class="mt-2">Chức vụ: <?= $user['chuc_vu_id'] ?></h6>
                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri&ca_nhan_id=' . $user['id'] ?>" method="POST">
                    <input type="hidden" name="ca_nhan_id" value="<?= $user['id']?>">
                        <hr>
                        <h3>Thông tin cá nhân</h3>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Họ tên:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" value="<?= $user['ho_ten'] ?>" name="ho_ten">
                                <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="email" value="<?= $user['email'] ?>" name="email">
                                <?php if (isset($_SESSION['error']['email'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Số điện thoại:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="number" value="<?= $user['so_dien_thoai'] ?>" name="so_dien_thoai" >
                                <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Địa chỉ:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" value="<?= $user['dia_chi'] ?>" name="dia_chi">
                                <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h3>Đổi mật khẩu</h3>
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-info alert-dismissable">
                            <a class="panel-close close" data-dismiss="alert">×</a>
                            <i class="fa fa-coffee"></i>
                            <?= $_SESSION['success']; ?></p>
                        </div>
                    <?php } ?>
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="password" name="old_pass" value="">
                                <?php if (isset($_SESSION['error']['old_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['old_pass'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="password" name="new_pass" value="">
                                <?php if (isset($_SESSION['error']['new_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['new_pass'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="password" name="confirm_pass" value="">
                                <?php if (isset($_SESSION['error']['confirm_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['confirm_pass'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer  -->
<?php include './views/layout/footer.php'; ?>
<!-- End footer  -->

</body>

</html>