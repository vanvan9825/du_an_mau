<?php

class AdminTaiKhoan {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan($chuc_vu_id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans
            WHERE chuc_vu_id = :chuc_vu_id
           
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute(
               [':chuc_vu_id'=>$chuc_vu_id]
            );

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function insertTaiKhoan(
        $ho_ten,
        $ngay_sinh,
        $email,
        $so_dien_thoai,
        $dia_chi,
        $mat_khau,
        $chuc_vu_id
    ) {
        try {
            $sql = 'INSERT INTO tai_khoans (ho_ten, ngay_sinh, email, so_dien_thoai, dia_chi, mat_khau, chuc_vu_id)
                    VALUES (:ho_ten, :ngay_sinh, :email, :so_dien_thoai, :dia_chi, :mat_khau, :chuc_vu_id)';

            $stmt = $this->conn->prepare($sql);

            // var_dump($stmt);die;

            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':ngay_sinh' => $ngay_sinh,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi,
                ':mat_khau' => $mat_khau,
                ':chuc_vu_id' => $chuc_vu_id
            ]);

            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getDetailTaiKhoan($id){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function updateTaiKhoan($id,$ho_ten,$email,$so_dien_thoai,$trang_thai)
    {
        try {
            // var_dump($ho_ten); die();
            $sql = 'UPDATE tai_khoans SET
            ho_ten = :ho_ten,
            email = :email,
            so_dien_thoai = :so_dien_thoai,
            trang_thai = :trang_thai
            
           
           
            WHERE id = :id';
            // var_dump($sql);die;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':trang_thai' => $trang_thai
                
                
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }  

    public function updateCaNhan($id,$ho_ten,$email,$so_dien_thoai,$dia_chi){
        try {
            // var_dump($ho_ten); die();
            $sql = 'UPDATE tai_khoans SET
            ho_ten = :ho_ten,
            email = :email,
            so_dien_thoai = :so_dien_thoai,
            dia_chi = :dia_chi
    
            
           
           
            WHERE id = :id';
            // var_dump($sql);die;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi
                
                
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }

    }

   
    public function  resetPassword($id, $mat_khau)
    {
        try {
            // var_dump($mat_khau); die();
            $sql = 'UPDATE tai_khoans SET
            mat_khau = :mat_khau
            WHERE id = :id';
            // var_dump($sql);die;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
                ':mat_khau' => $mat_khau
            ]);

            
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function updateKhachHang($id,$ho_ten,$email,$so_dien_thoai, $ngay_sinh,$gioi_tinh, $dia_chi,$trang_thai)
    {
        try {
            // var_dump($ho_ten); die();
            $sql = 'UPDATE tai_khoans SET
            ho_ten = :ho_ten,
            email = :email,
            so_dien_thoai = :so_dien_thoai,
            ngay_sinh = :ngay_sinh,
            gioi_tinh = :gioi_tinh,
            dia_chi = :dia_chi,         
            trang_thai = :trang_thai
            
           
           
            WHERE id = :id';
            // var_dump($sql);die;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':ngay_sinh' => $ngay_sinh,
                ':gioi_tinh' => $gioi_tinh,
                ':dia_chi' => $dia_chi,
                ':trang_thai' => $trang_thai
                
                
            ]);

            
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function checkLogin($email, $mat_khau){
        try {
            // var_dump($email);die;
            $sql = "SELECT * FROM tai_khoans WHERE email = :email ";
            $stmt = $this->conn->prepare($sql);
            // var_dump($sql);die;

            $stmt->execute([':email'=>$email]);
            $user = $stmt->fetch();

            if($user && password_verify($mat_khau, $user['mat_khau'] )){
                if( $user['chuc_vu_id'] == 1 ){
                    
                    if($user['trang_thai'] == 1){
                        return $user['email'];

                    }else{
                        return 'Tài khoản bị cấm';
                    }
                }else{
                    return 'Tài khoản không có quyền đăng nhập';
                }

            }else{
                return 'Lỗi khi đăng nhập sai thông tin mật khẩu tài khoản';

            }

        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }





    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


   


   


    
}


?>