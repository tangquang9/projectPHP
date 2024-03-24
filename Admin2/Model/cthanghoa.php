<?php
    class cthanghoa{
        function insertCTHangHoa($mahh,$mamau,$masize,$dongia,$slt,$hinh,$giamgia)
        {
            $db=new connect();
            $query="insert into ctsanpham(idsanpham,idmau,idsize,dongia,soluongton,hinh,giamgia) values ($mahh,$mamau,$masize,$dongia,$slt,'$hinh',$giamgia)";
            $result=$db->exec($query);
            return $result;
        }
    }
?>