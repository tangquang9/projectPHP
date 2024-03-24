<?php
class giohang
{
    //phương thức add hàng
    function addHangHoa($mahh, $mausac, $size, $soluong)
    {
        //còn thiếu hinh, ten, gia, thanhtien
        $sanpham = new hanghoa();
        $sp = $sanpham->getHangHoaId($mahh); // trả về 1 dòng, được fetch rồi nên nó array
        $tenhh = $sp['tensp'];
        $dongia = $sp['dongia'];
        $total = $soluong * $dongia;
        //lấy ra tên màu
        $mau = $sanpham->getHangHoaIdMau($mausac);
        $tenmau = $mau['tenmau'];
        // lấy hình
        $hinh = $sanpham->getHangHoaHinhMauSize($mahh, $mausac, $size);
        $img = $hinh['hinh'];
        $flag = false;
        // vì giỏ hàng chứa là object, mà object thì có thuộc tính
        //trước khi thêm vào giỏ hàng cần kiểm tra xem món đó đã tồn tại trong giỏ hàng chưa
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['mahh'] == $mahh && $item['mausac'] == $tenmau && $item['size'] == $size) {
                $flag = true;
                $soluong += $item['soluong'];
                $this->updateHH($key, $soluong); //giohang::updateHH(...)
            }
        }
        if ($flag == false) {
            //tạo đối tượng
            $item = array(
                'mahh' => $mahh, //24
                'tenhh' => $tenhh,
                'hinh' => $img,
                'mausac' => $tenmau,
                'size' => $size,
                'soluong' => $soluong,
                'dongia' => $dongia,
                'thanhtien' => $total
            );
            //đem đối tượng add vào trong giỏ hàng a[]
            $_SESSION['cart'][] = $item;
        }
        /*
            a[1]=$_SESSION['cart'][1]['dongia']
            $_SESSION['cart']=array(
                {mahh:22,tenhh:tensp,hinh:hinh22.jpg,dongia:500k,mausac:Trắng,size:35,soluong:1,thanhtien:500},
                {mahh:24,tenhh:tensp,hinh:hinh24.jpg,dongia:500k,mausac:Trắng,size:35,soluong:1,thanhtien:500},
                {mahh:24,tenhh:tensp,hinh:hinh24a.jpg,dongia:500k,mausac:Trắng,size:36,soluong:1,thanhtien:500},
            )
        */
    }
    //phương thức update hàng hóa 
    function updateHH($index,$soluong){
        if($soluong <=0){
            unset($_SESSION['cart'][$index]);
        }
        else{
            //update là phép gán
            $_SESSION['cart'][$index]['soluong']=$soluong;
            $tiennew = $_SESSION['cart'][$index]['soluong']*$_SESSION['cart'][$index]['dongia'];
            $_SESSION['cart'][$index]['thanhtien']=$tiennew;
        }
    }
    //phương thức tính thành tiền
    function getSubTotal(){
        $subtotal=0;
        foreach($_SESSION['cart'] as $item){
            $subtotal+=$item['thanhtien'];
        }
        $subtotal=number_format($subtotal,2);
        return $subtotal;
    }
}
?>