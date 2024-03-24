<?php
//controller yêu cầu model thêm dữ liệu vào database
if (isset($_SESSION['cart'])) {
    if (isset($_SESSION['makh'])) {
        $makh = $_SESSION['makh'];
        //gọi mã số hóa đơn vừa chèn vào
        $hd = new hoadon();
        $sohd = $hd->insertHoaDon($makh); //9
        $_SESSION['masohd']=$sohd;
        $total = 0;
        // tiến hành thêm dữ liệu từ giỏ hàng vào bảng cthoadon

        foreach ($_SESSION['cart'] as $key => $item) {
            //controller yêu cầu model insert vào bảng cthoadon
            $hd->insertCTHoaDon($sohd, $item['mahh'], $item['soluong'], $item['mausac'], $item['size'], $item['thanhtien']);
            $total += $item['thanhtien'];
            //viết hàm cập nhật hàng tồn kho
            //VỀ LÀM
            $sltk=$hd->capNhatHangTonKho($item['mahh'],$item['mausac'],$item['size'],$item['soluong']);
            if ($sltk==true) {
                // Thông báo thành công
                echo "<script>alert('Cập nhập kho thành công!');</script>";
            } else {
                // Thông báo không đủ hàng
                echo "<script>alert('Không đủ hàng trong kho!');</script>";
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
            }
        }
        //khi insert xong cthoadon thì phải update tổng thành tiền vào ngược lại bảng hóa đơn
        $hd->updateTongTien($sohd, $makh, $total);
        unset($_SESSION['cart']);
    }
} 
include_once "./View/order.php";