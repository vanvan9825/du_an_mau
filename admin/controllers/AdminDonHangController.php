<?php

class AdminDonHangController
{
    public $modelDonHang;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhSachDonHang()
    {

        $listDonHang = $this->modelDonHang->getAllDonHang();

        require_once './views/donhang/listDonHang.php';
    }

    public function detailDonHang()
    {
        // Hàm này dùng để hiển thị form nhập
        // Lấy ra thông tin của sản phẩm cần sửa
        $don_hang_id = $_GET['id_don_hang'];
        // var_dump($don_hang_id);die;

        // Lấy ra thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        // var_dump($donHang);die;

        // Lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        // var_dump($sanPhamDonHang);die;

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        require_once './views/donhang/detailDonHang.php';
    }

    

    public function formEditDonHang()
    {
        // Hàm này dùng để hiển thị form nhập
        // Lấy ra thông tin của đơn hàng cần sửa
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        // var_dump($donHang);die;
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
       
            require_once './admin/views/donhang/editDonHang.php';
            
    }

    public function postEditDonHang()
    {
        // Hàm này dùng để xử lý thêm dữ liệu

        // Kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            // Lấy a dữ liệu cũ của sản phẩm
            $don_hang_id = $_POST['id_don_hang'] ?? '';
            // var_dump($don_hang_id);die;


            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            // var_dump($ten_nguoi_nhan);die;
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';

            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];

            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'Số điện thoại người nhận không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email người nhận không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ người nhận không được để trống';
            }
            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái đơn hàng';
            }
           

            $_SESSION['error'] = $errors;
            // var_dump($errors);die;

            // var_dump('abc');die;
            // Nếu ko có lỗi thì tiến hành sửa
            if (empty($errors)) {
                // Nếu ko có lỗi thì tiến hành thêm sản phẩm
                // var_dump('Oke');die;

                $this->modelDonHang->updateDonHang($don_hang_id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id);

                // var_dump($san_pham_id);die;

                header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                // Trả về form và lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }


}