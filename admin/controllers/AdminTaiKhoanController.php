<?php 
class AdminTaiKhoanController {
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;



    public function __construct()

    {
        $this->modelTaiKhoan =new AdminTaiKhoan();
        $this->modelDonHang =new AdminDonHang();
        $this->modelSanPham =new AdminSanPham();
    }

    public function danhSachQuanTri(){
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        // var_dump($listQuanTri );die;

        require_once './views/taikhoan/quantri/listQuanTri.php';




    }


    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();
    }
    public function postAddQuanTri()
    {
        // Hàm này dùng để xử lý thêm dữ liệu

        // Kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $ho_ten = $_POST['ho_ten'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';

            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            // if (empty($gioi_tinh)) {
            //     $errors['gioi_tinh'] = 'Giới tính người dùng không được để trống';
            // }
            
            $_SESSION['error'] = $errors;
            // var_dump($_SESSION['error']); die;

            // Nếu ko có lỗi thì tiến hành thêm tài khoản
            if (empty($errors)) {
                // Nếu ko có lỗi thì tiến hành thêm tài khoản
                // var_dump('Oke');
                // Đặt mat_khau mặc định -123@123abc
                $mat_khau = password_hash('123456789', PASSWORD_BCRYPT);
                // var_dump($mat_khau);die;

                // Khai báo chức vụ
                $chuc_vu_id = 1;

                $this->modelTaiKhoan->insertTaiKhoan(
                    $ho_ten,
                    $ngay_sinh,
                    $email,
                    $so_dien_thoai,
                    $dia_chi,
                    $mat_khau,
                    $chuc_vu_id
                );
                // var_dump($abc);die;

                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // Trả về form và lỗi
                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-them-quan-tri');
                exit();
            }
        }
    }

    public function formEditQuanTri()  {
        $quan_tri_id = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($quan_tri_id);

        // var_dump($quanTri); die;
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
        
    }

    public function postEditQuanTri()
    {
        // Hàm này dùng để xử lý thêm dữ liệu

        // Kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            // Lấy a dữ liệu cũ của sản phẩm
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';
            // Truy vấn
           

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email= $_POST['email'] ?? '';
            $so_dien_thoai= $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
           
           

       

            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dung không được để trống';
            }

            if (empty($email)) {
                $errors['email'] = 'email không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'trang thai không được để trống';
            }

            
           

            $_SESSION['error'] = $errors;
            // var_dump($errors);die;

            // Nếu ko có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {
                // Nếu ko có lỗi thì tiến hành thêm sản phẩm
                // var_dump('Oke');die;

                $this->modelTaiKhoan->updateTaiKhoan($quan_tri_id,$ho_ten,$email,$so_dien_thoai,$trang_thai);

                // var_dump($abc);die;

                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // Trả về form và lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&quan_tri_id=' . $quan_tri_id);
                exit();
            }
        }
    }



    public function resetPassword() {

        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);

       $mat_khau = password_hash('123@123abc', PASSWORD_BCRYPT );

        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id,$mat_khau);

        if($status && $tai_khoan['chuc_vu_id'] == 1){
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        }elseif($status && $tai_khoan['chuc_vu_id'] == 2){
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        }
        else{
            var_dump('lỗi khi reset tài khoản'); die;
        }
        
    }

    public function danhSachKhachHang(){
        // $tai_khoan = $_GET['id_khach_hang'];
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);
        // var_dump($listQuanTri );die;

        require_once './views/taikhoan/khachhang/listKhachHang.php';




    }

    public function formEditKhachHang()  {
        $khach_hang_id = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($khach_hang_id);

        // var_dump($khachHang); die;
        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
        
    }

   


public function postEditKhachHang()
{
    // Hàm này dùng để xử lý thêm dữ liệu

    // Kiểm tra xem dữ liệu có phải đc submit lên không
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy ra dữ liệu
        // Lấy a dữ liệu cũ của sản phẩm
        $khach_hang_id = $_POST['id_khach_hang'] ?? '';
        // Truy vấn
       

        $ho_ten = $_POST['ho_ten'] ?? '';
        $gioi_tinh = $_POST['gioi_tinh'] ?? '';
        $ngay_sinh = $_POST['ngay_sinh'] ?? '';
        $dia_chi = $_POST['dia_chi'] ?? '';
        $email= $_POST['email'] ?? '';
        $so_dien_thoai= $_POST['so_dien_thoai'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? '';
       
       

   

        // Tạo 1 mảng trống để chứa dữ liệu
        $errors = [];

        if (empty($ho_ten)) {
            $errors['ho_ten'] = 'Tên người dung không được để trống';
        }
        if (empty($ngay_sinh)) {
            $errors['ngay_sinh'] = 'ngay sinh không được để trống';
        }
        if (empty($gioi_tinh)) {
            $errors['gioi_tinh'] = 'gioi tinh không được để trống';
        }

        if (empty($email)) {
            $errors['email'] = 'email không được để trống';
        }
        if (empty($trang_thai)) {
            $errors['trang_thai'] = 'trang thai không được để trống';
        }

        
       

        $_SESSION['error'] = $errors;
        // var_dump($errors);die;

        // Nếu ko có lỗi thì tiến hành thêm sản phẩm
        if (empty($errors)) {
            // Nếu ko có lỗi thì tiến hành thêm sản phẩm
            // var_dump('Oke');die;

            $this->modelTaiKhoan->updateKhachHang($khach_hang_id,$ho_ten,$email,$so_dien_thoai, $ngay_sinh,$gioi_tinh, $dia_chi,$trang_thai);

            // var_dump($abc);die;

            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        } else {
            // Trả về form và lỗi
            // Đặt chỉ thị xóa session sau khi hiển thị form
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL_ADMIN . '?act=form-sua-khach-hang&khach_hang_id=' . $khach_hang_id);
            exit();
        }
    }
}

public function detailKhachHang(){

    $id_khach_hang = $_GET['id_khach_hang'];
    $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

    $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);
    $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);

    require_once './views/taikhoan/khachhang/detailKhachHang.php';

    
}


public function formLogin(){
    require_once './views/auth/formLogin.php';

    deleteSessionError();

}

public function login() {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // lấy mail và pass gửi từ form 

        $email = $_POST['email'];
        $password = $_POST['password'];

        // var_dump($email);die;


        // xử lý kiểm tra thông tin đăng nhập 

        $user = $this->modelTaiKhoan->checkLogin($email, $password);

        if($user == $email ){ // trường hợp đăng nhập thành công
            // lưu thông tin vào session 
            $_SESSION['user_admin'] = $user;
            header("Location:" . BASE_URL_ADMIN);
            exit;

        }else{
            // lỗi thì lưu lỗi vào session
            $_SESSION['error'] = $user;
            // var_dump($_SESSION['error']); die;

            $_SESSION['flash'] = true ;

            header("Location:" . BASE_URL_ADMIN . '?act=login-admin');

            exit;

        }


    }
    
}

public function logout(){
    if(isset($_SESSION['user_admin'])){
        unset($_SESSION['user_admin']);
        header("Location:" . BASE_URL_ADMIN . '?act=login-admin');
    }
}

public function formEditCaNhanQuanTri()
    {
        $email = $_SESSION['user_admin'];
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
        // var_dump($thongTin);die;

        require_once './views/taikhoan/canhan/formEditCaNhan.php';

        deleteSessionError();
    }
public function postEditCaNhanQuanTri(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
           $ca_nhan_id = $_POST['id_ca_nhan'];

            $email = $_POST['email'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            
            // Lấy thông tin user từ session
            // $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_admin']);
            // var_dump($user);die;

           

            $errors = [];

            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }

            $_SESSION['error'] = $errors;
            // var_dump($errors);die;

            if (!$errors) {
                // Nếu ko có lỗi thì tiến hành thêm sản phẩm
                // var_dump('Oke');die;

                 $add =$this->modelTaiKhoan->updateCaNhan($ca_nhan_id,$ho_ten,$email,$so_dien_thoai,$dia_chi);

                if ($add) {
                    $_SESSION['success'] = "Đã đổi thông tin thành công";
                    $_SESSION['flash'] = true;
                    header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                    // exit();
                }
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                exit();
            }
        }
    }

     
    public function postEditMatKhauCaNhan()
    {
        // var_dump($_POST);die;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];

            // Lấy thông tin user từ session
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_admin']);
            // var_dump($user);die;

            $checkPass = password_verify($old_pass, $user['mat_khau']);

            $errors = [];

            if (!$checkPass) {
                $errors['old_pass'] = 'Mật khẩu người dùng không đúng';
            }
            if ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không đúng';
            }
            if (empty($old_pass)) {
                $errors['old_pass'] = 'Vui lòng điền trường dữ liệu này';
            }
            if (empty($new_pass)) {
                $errors['new_pass'] = 'Vui lòng điền trường dữ liệu này';
            }
            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = 'Vui lòng điền trường dữ liệu này';
            }

            $_SESSION['error'] = $errors;
            // var_dump($errors);die;

            if (!$errors) {
                // var_dump('Oke');die;

                // Thực hiện đổi mật khẩu
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);

                $satus = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
                // var_dump(satus);die;

                if ($satus) {
                    $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                    $_SESSION['flash'] = true;
                    header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                    // exit();
                }
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                exit();
            }
        }
    }

}



?>