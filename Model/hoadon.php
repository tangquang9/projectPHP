<?php
class hoadon
{
    function insertHoaDon($makh)
    {
        $db = new connect();
        $date = new DateTime('now');
        $ngay = $date->format('Y-m-d'); // vì trong database là y-m-d nên phải định dạng lại
        $query = "insert into hoadon(idhoadon,idkh,ngaylap,tongtien) values(Null,$makh,'$ngay',0)";
        $db->exec($query);
        // đã chèn xong vào bảng hóa đơn, nó sinh ra mã số hóa đơn
        $select = "select a.idhoadon from hoadon a order by a.idhoadon desc limit 1";
        $masohd = $db->getInstance($select);
        return $masohd[0]; // trả về mảng $masohd=array(9);
    }
    //phương thức insert vào bảng cthoadon
    function insertCTHoaDon($masohd, $mahh, $soluongmua, $mausac, $size, $thanhtien)
    {
        $db = new connect();
        $query = "insert into cthoadon(masohd,mahh,soluongmua,mausac,size,thanhtien,tinhtrang)
            values ($masohd,$mahh,$soluongmua,'$mausac', '$size', $thanhtien, 0)";
        $db->exec($query);
    }
    //phương thức cập nhập tổng tiền
    function updateTongTien($masohd, $makh, $tongtien)
    {
        $db = new connect();
        $query = "update hoadon set tongtien=$tongtien WHERE idhoadon=$masohd and idkh=$makh";
        $db->exec($query);
    }
    //phương thức lấy thông tin khách hàng mua hàng dựa vào mã số hd
    function selectThongTinKH($masohd)
    {
        $db = new connect();
        $select = "select a.idhoadon, b.tenkh, b.diachi, b.sodienthoai, a.ngaylap, a.tongtien
        from hoadon a, khachhang b 
        WHERE a.idkh=b.makh and a.idhoadon=$masohd";
        $result = $db->getInstance($select);
        return $result;
    }
    //phương thức lấy thông tin hàng trên hóa đơn, tức là trên hóa đơn có bao nhiêu món hàng
    function selectThongTinHoaDon($masohd)
    {
        $db = new connect();
        $select = "select DISTINCT a.tensp, c.mausac, c.size, b.dongia, c.soluongmua 
        from sanpham a, ctsanpham b, cthoadon c
        WHERE a.idsanpham=b.idsanpham and a.idsanpham=c.mahh and c.masohd=$masohd";
        $result = $db->getList($select);
        return $result;
    }

    function capNhatHangTonKho($mahh, $tenmau, $tensize, $soluongmua) {
        $db = new connect();
    
        // Lấy idmau dựa trên tên màu
        $selectMau = "SELECT idmau FROM mau WHERE tenmau = '$tenmau'";
        $resultMau = $db->getInstance($selectMau);
        $idmau = $resultMau['idmau'];
    
        // Lấy idsize dựa trên tên kích thước
        $selectSize = "SELECT idsize FROM size WHERE tensize = '$tensize'";
        $resultSize = $db->getInstance($selectSize);
        $idsize = $resultSize['idsize'];
    
        // Lấy thông tin hàng tồn kho từ cơ sở dữ liệu dựa trên mahh, idmau, idsize
        $select = "SELECT soluongton FROM ctsanpham WHERE idsanpham = $mahh AND idmau = $idmau AND idsize = $idsize";
        $result = $db->getInstance($select);
        $hanghoa = $result['soluongton'];
    
        if ($hanghoa >= $soluongmua) {
            // Cập nhật hàng tồn kho
            $soluongton_moi = $hanghoa - $soluongmua;
    
            // Lưu thông tin cập nhật vào cơ sở dữ liệu dựa trên mahh, idmau, idsize
            $update = "UPDATE ctsanpham SET soluongton = $soluongton_moi WHERE idsanpham = $mahh AND idmau = $idmau AND idsize = $idsize";
            $db->exec($update);
    
            // Thực hiện các bước tiếp theo của quá trình mua hàng
            // ...
    
            return true;
        } else {
            // Hết hàng
            return false;
        }
    }
}

?>