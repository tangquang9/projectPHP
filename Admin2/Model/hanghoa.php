<?php
class hanghoa{
    function getHangHoa()
    {
        $db=new connect();
        $select="select * from sanpham";
        $result=$db->getList($select);
        return $result;
    }
    function insertHangHoa($tenhh,$maloai,$dacbiet,$slx,$ngaylap,$mota)
    {
        $db=new connect();
        $query="insert into sanpham(idsanpham,tensp,idloaisp,dacbiet,soluotxem,ngaylap,mota) values (Null,'$tenhh',$maloai,$dacbiet,$slx,'$ngaylap','$mota')";
        $result=$db->exec($query);
        return $result;
    }
    // phương thức lấy thông tin 1 món hàng
    function getHangHoaID($id)
    {
        $db=new connect();
        $select="select * from sanpham where idsanpham=$id";
        $result=$db->getInstance($select);
        return $result;
    }
    // phương thức update
    function updateHangHoa($mahh,$tenhh,$maloai,$dacbiet,$slx,$ngaylap,$mota)
    {
        $db=new connect();
        $query="update sanpham 
        set tensp='$tenhh',idloaisp=$maloai,dacbiet=$dacbiet,soluotxem=$slx,ngaylap='$ngaylap',mota='$mota' 
        where idsanpham=$mahh";
        $result=$db->exec($query);
        return $result;
    }
    function getMau()
    {
        $db=new connect();
        $select="select * from mau";
        $result=$db->getList($select);
        return $result;
    }
    function getSize()
    {
        $db=new connect();
        $select="select * from size";
        $result=$db->getList($select);
        return $result;
    }
    function getThongKe()
    {
        $db=new connect();
        $select="select b.tensp,sum(a.soluongmua) as soluong from cthoadon a, sanpham b WHERE a.mahh=b.idsanpham group by b.tensp";
        $result=$db->getList($select);
        return $result;
    }

}
?>