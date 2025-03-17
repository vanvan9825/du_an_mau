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
          <h1>Quản lý tài khoản quản trị viên</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Ảnh dại diện</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Trạng Thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listKhachHang as $key => $KhachHang) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $KhachHang['ho_ten'] ?></td>
                      <td>
                        <img src="<?= BASE_URL . $KhachHang['anh_dai_dien'] ?> " 
                        width="100px" alt=""
                        onerror="this.onerror=null; this.src=' https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'">
                      </td>
                      <td><?= $KhachHang['email'] ?></td>
                      <td><?= $KhachHang['so_dien_thoai'] ?></td>
                      <td><?= $KhachHang['trang_thai'] == 1 ? 'Active' : 'Inactve' ?></td>
                      <td>
                        <div class="btn-group">
                        <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $KhachHang['id'] ?>">
                          <button class="btn btn-primary"><i class="far fa-eye"> </i></button>
                        </a>
                        </div>



                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $KhachHang['id'] ?>">
                          <button class="btn btn-warning"><i class="fas fa-wrench"></i></button>
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '?act=reset-password&id_quan_tri=' . $KhachHang['id'] ?>" 
                          onclick="return confirm('Bạn có muốn reset pasword của tài khoản này không ?')">
                          <button class="btn btn-danger"><i class="fas fa-undo"></i></button>
                        </a>
                        
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                  <th>STT</th>
                    <th>Họ tên</th>
                    <th>Ảnh dại diện</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Trạng Thái</th>
                    <th>Thao tác</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer  -->
<?php include './views/layout/footer.php'; ?>
<!-- End footer  -->

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>

</html>