<?php
class loaisp
{
    //thuộc tính
    //phương thức lấy 8 sản phẩm mới nhất
    function getDanhMucSanPham()
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.idloai, a.tenloai  
                 from loai a";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là 8 sản phẩm mới nhất
    }

    function getTenLoaiSanPham($idloai)
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.tenloai  
                 from loai a
                 where a.idloai=$idloai";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getInstance($select);
        return $result; //đã lấy được dữ liệu là 8 sản phẩm mới nhất
    }
}
?>