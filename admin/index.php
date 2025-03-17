<?php

session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ



// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';
// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';


// Route
$act = $_GET['act'] ?? '/';
// if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin') {
//   checkLoginAdmin();
// }


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    // Route báo cáo thống kê - trang chủ
    '/' => (new AdminBaoCaoThongkeController())->home(),




    // route danh mục
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),

    // Route sản phẩm
    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => (new AdminSanPhamController())->formAddSanPham(),
    'them-san-pham' => (new AdminSanPhamController())->postAddSanPham(),
    'form-sua-san-pham' => (new AdminSanPhamController())->formEditSanPham(),
    'sua-san-pham' => (new AdminSanPhamController())->postEditSanPham(),
    'sua-album-anh-san-pham' => (new AdminSanPhamController())->postEditSanPham(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->detailSanPham(),

    // route bình luận
    'update-trang-thai-binh-luan' => (new AdminSanPhamController())->updateTrangThaiBinhLuan(),


    // Route quản lý đơn hàng
    'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    'form-sua-don-hang' => (new AdminDonHangController())->formEditDonHang(),
    'sua-don-hang' => (new AdminDonHangController())->postEditDonHang(),
    'chi-tiet-don-hang' => (new AdminDonHangController())->detailDonHang(),

      // Route quản lý tài khoản 
            // quản lý tài khoản quản trị 
            'list-tai-khoan-quan-tri' => (new AdminTaiKhoanController)->danhSachQuanTri(),
            'form-them-quan-tri' => (new AdminTaiKhoanController)->formAddQuanTri(),
            'them-quan-tri' => (new AdminTaiKhoanController)->postAddQuanTri(),
            'form-sua-quan-tri' => (new AdminTaiKhoanController)->formEditQuanTri(),
            'sua-quan-tri' => (new AdminTaiKhoanController)->postEditQuanTri(),
            
            
            
            
            // route reset password tai khoan
            'reset-password' => (new AdminTaiKhoanController)->resetPassword(),
           
              // quản lý tài khoản khach hang 
            'list-tai-khoan-khach-hang' => (new AdminTaiKhoanController)->danhSachKhachHang(),
            'form-sua-khach-hang' => (new AdminTaiKhoanController)->formEditKhachHang(),
            'sua-khach-hang' => (new AdminTaiKhoanController)->postEditKhachHang(),
            'chi-tiet-khach-hang' => (new AdminTaiKhoanController())->detailKhachHang(),

            // route quản lí tài khoản cá nhân (quản trị)

            'form-sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController)->formEditCaNhanQuanTri(),
            'sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController)->postEditCaNhanQuanTri(),
            
            'sua-mat-khau-ca-nhan-quan-tri' => (new AdminTaiKhoanController)->postEditMatKhauCaNhan(),



            // route auth 

            // 'login-admin' =>(new AdminTaiKhoanController())->formLogin(),
            // 'check-login-admin' =>(new AdminTaiKhoanController())->login(),
            // 'logout-admin' =>(new AdminTaiKhoanController())->logout(),
            


};
