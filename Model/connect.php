<?php
    class connect{
        //thuộc tính
        var $db=null;
        //hàm tạo, hàm tạo được gọi khi chúng ta tạo 1 đối tượng
        function __construct(){
            //vì mỗi lần tạo đối tượng từ connect thì sẽ kết nối với dữ liệu
            $dsn='mysql:host=localhost;dbname=shopq';
            $user='root';
            $pass=''; //nếu xài xamp,wamp thì $pass=''; 
            //muốn kết nối thì dùng class PDO hoặc mysqli
            try {
                $this->db = new PDO($dsn,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
                // echo "Kết nối thành công";
            } catch (\Throwable $th) {
                //throw $th;
                echo "Kết nối ko thành công";
                echo $th;
            }
        }
        //câu lệnh select ai thực thi? phương thức query, phương thức này thuộc về class PDO
        //phương thức trả về nhiều dòng dữ liệu
        function getList($select){
            $result=$this->db->query($select);
            return $result;// trả về nhiều dòng tức là 1 bảng
        }
        //phương thúc trả về 1 dòng dữ liệu
        function getInstance($select){
            $results=$this->db->query($select);//1 dòng
            //do trả về 1 dòng, nên fetch() để lấy dòng dữ liệu đó
            $result=$results->fetch();//$result là array(thuộc tính1: giá trị1, thuộc tính2: giá trị2...)
            return $result; // trả về 1 array chứa 1 dòng
        }
        //nếu câu lệnh là insert,update, delete thì dùng exec
        function exec($query){
            $result=$this->db->exec($query);
            return $result;
        }
        //prepare thực thi tất cả
        function excep($query){
            $statement=$this->db->prepare($query);
            return $statement;
        }
    }
?>