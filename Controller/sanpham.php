<?php
//controller gọi View hiển thị trang sản phẩm
// include_once "./View/sanpham.php";
$act = "sanpham";
//controller điều phối đến những view khác thông qua 1 biến
//biến đó tên là act

if (isset($_GET["loai"])) {
    include_once "./View/sanphamtheoloai.php";
} else {
    if (isset($_GET["act"])) {
        $act = $_GET["act"]; //sanphamkhuyenmai
    }
    switch ($act) {
        case 'sanpham':
            include_once "./View/sanpham.php";
            break;
        case 'sanphamkhuyenmai':
            include_once "./View/sanpham.php";
            break;
        case 'sanphamchitiet';
            include_once "./View/sanphamchitiet.php";
            break;
        case 'timkiem':
            //nhận giá trị người dùng gõ tìm kiếm vào và tìm kiếm trên trang sản phẩm
            include_once "./View/sanpham.php";
            break;
    }
}



?>