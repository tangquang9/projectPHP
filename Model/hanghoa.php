<?php
class hanghoa
{
    //thuộc tính
    //phương thức lấy 8 sản phẩm mới nhất
    function getHangHoaNew()
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.idsanpham,a.tensp,a.soluotxem,b.hinh,b.dongia,c.tenmau 
            from sanpham a,ctsanpham b, mau c 
            WHERE a.idsanpham=b.idsanpham AND b.idmau=c.idmau ORDER by a.idsanpham DESC limit 8";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là 8 sản phẩm mới nhất
    }
    function getHangHoaSale()
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.idsanpham,a.tensp,a.soluotxem,b.hinh,b.dongia,c.tenmau, b.giamgia 
        from sanpham a,ctsanpham b, mau c 
        WHERE a.idsanpham=b.idsanpham AND b.idmau=c.idmau and giamgia!=0 ORDER by a.idsanpham ASC limit 4";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là 8 sản phẩm mới nhất
    }
    function getHangHoaAll()
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.idsanpham,a.tensp,a.soluotxem,b.hinh,b.dongia,c.tenmau 
        from sanpham a,ctsanpham b, mau c 
        WHERE a.idsanpham=b.idsanpham AND b.idmau=c.idmau AND giamgia=0 ORDER by a.idsanpham DESC ";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là  sản phẩm mới nhất
    }
    function getHangHoaAllSale()
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.idsanpham,a.tensp,a.soluotxem,b.hinh,b.dongia,c.tenmau, b.giamgia 
        from sanpham a,ctsanpham b, mau c 
        WHERE a.idsanpham=b.idsanpham AND b.idmau=c.idmau and giamgia!=0 ORDER by a.idsanpham DESC ";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là  sản phẩm mới nhất
    }
    //phương thức đếm số lượng trên trang 14 sản phẩm
    function getCountHangHoaAll()
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select count(a.idsanpham) 
        from sanpham a,ctsanpham b, mau c 
        WHERE a.idsanpham=b.idsanpham AND b.idmau=c.idmau and giamgia=0 ORDER by a.idsanpham DESC ";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getInstance($select);
        return $result; //array(count:14);//số 14
        
        
    }
    //phương thức phân trang cho 14 sản phẩm
    function getHangHoaAllPage($start,$limit)
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.idsanpham,a.tensp,a.soluotxem,b.hinh,b.dongia,c.tenmau 
        from sanpham a,ctsanpham b, mau c 
        WHERE a.idsanpham=b.idsanpham AND b.idmau=c.idmau AND giamgia=0 ORDER by a.idsanpham DESC limit ".$start.",".$limit;
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là  sản phẩm mới nhất
    }
    //phương thức lấy thông tin của một sản phẩm
    function getHangHoaId($id){
        $db=new connect();
        $select="select DISTINCT a.idsanpham,a.tensp,a.mota,b.dongia
        from sanpham a,ctsanpham b
        WHERE a.idsanpham=b.idsanpham AND a.idsanpham=$id";
        $result=$db->getInstance($select);
        return $result; // trả về đúng 1 row dạng array(idsanpham:24, tensp: áo....)
    }
    //phương thức lấy thông tin màu của 1 sản phẩm
    function getHangHoaMau($id){
        $db=new connect();
        $select="select DISTINCT b.idmau,b.tenmau 
        from ctsanpham a, mau b
        WHERE a.idmau=b.idmau AND a.idsanpham=$id";
        $result=$db->getList($select);
        return $result; // trả về đúng 1 row dạng array(idsanpham:24, tensp: áo....)
    }
    //phương thức lấy thông tin size của 1 sản phẩm
    function getHangHoaSize($id){
        $db=new connect();
        $select="select DISTINCT b.idsize,b.tensize
        from ctsanpham a, size b
        WHERE a.idsize=b.idsize AND a.idsanpham=$id";
        $result=$db->getList($select);
        return $result; // trả về đúng 1 row dạng array(idsanpham:24, tensp: áo....)
    }
    //phương thức lấy hình của 1 id
    function getHangHoaHinh($id){
        $db=new connect();
        $select="select DISTINCT a.hinh
        from ctsanpham a
        WHERE a.idsanpham=$id";
        $result=$db->getList($select);
        return $result; // trả về đúng 1 row dạng array(idsanpham:24, tensp: áo....)
    }
    //lấy hình dựa vào id,mau,size
    function getHangHoaHinhMauSize($id,$mau,$size){
        $db=new connect();
        $select="select DISTINCT a.hinh from ctsanpham a, mau b, size c 
        where a.idmau=b.idmau and a.idsize=c.idsize and a.idsanpham=$id and b.idmau=$mau and c.tensize='$size'";
        $result=$db->getInstance($select);
        return $result; // trả về đúng 1 row dạng array(idsanpham:24, tensp: áo....)
    }
    //phương thức lấy tên màu thông qua id
    function getHangHoaIdMau($idmau){
        $db=new connect();
        $select="select a.tenmau from mau a where a.idmau=$idmau";
        $result=$db->getInstance($select);
        return $result; // trả về đúng 1 row dạng array(idsanpham:24, tensp: áo....)
    }
    function getHHtheoLoai($idloai)
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "select a.idsanpham,a.tensp,a.soluotxem,b.hinh,b.dongia,c.tenmau, b.giamgia , d.idloai
        from sanpham a,ctsanpham b, mau c, loai d
        WHERE a.idsanpham=b.idsanpham AND b.idmau=c.idmau AND a.idloaisp=d.idloai AND d.idloai=$idloai ORDER by a.idsanpham DESC ";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là  sản phẩm mới nhất
    }
    function getSoLuongTonKho($id)
    {
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó tức là viết lệnh select
        $select = "SELECT soluongton FROM ctsanpham WHERE idsanpham = $id";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getInstance($select);
        return $result; //đã lấy được dữ liệu là  sản phẩm mới nhất
    }
    //phương thức tìm kiếm sản phẩm
    function timkiemSP($timkiem){
        //b1: kết nối được với database 
        $db = new connect();
        //b2:cần lấy cái gì thì truy vấn cái đó 
        $select = "SELECT a.idsanpham, a.tensp, a.soluotxem, b.hinh, b.dongia, c.tenmau FROM sanpham a, ctsanpham b, mau c WHERE a.idsanpham = b.idsanpham and b.idmau = c.idmau and b.giamgia=0 and tensp like '%$timkiem%' ORDER BY a.idsanpham DESC";
        //b3: ai thực thi câu lệnh select? query nằm trong getlist, mà getlist thuộc về lớp connect
        $result = $db->getList($select);
        return $result; //đã lấy được dữ liệu là  sản phẩm mới nhất
    }
}
?>