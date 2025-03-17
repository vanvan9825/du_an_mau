<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

// Dường dẫn vào đến phần client
define('BASE_URL'       , 'http://localhost/xuong_thu_cung/');

// Đường dẫn vào phần admin
define('BASE_URL_ADMIN'  , 'http://localhost/xuong_thu_cung/admin/'); 


define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'xuong_thu_cung');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
