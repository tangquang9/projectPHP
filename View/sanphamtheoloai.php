<!-- quảng cáo -->
<?php
include "quangcao.php";
?>
<!-- end quảng cáo -->


<!-- end số lượt xem san phẩm -->
<!-- sản phẩm-->
<!-- cùng 1 view để gọi nhiều dữ liệu khác nhau-->
<?php
$idloai = 1;
if (isset($_GET['action'])) {
    if (isset($_GET['loai'])) {
        $idloai = $_GET['loai'];
    }
}
?>
<!--Section: Examples-->
<section id="examples" class="text-center">

    <!-- Heading -->
    <div class="row">
        <div class="col-lg-8 text-right">
            <?php
            
            $loaisp= new loaisp();
            $ten=$loaisp->getTenLoaiSanPham($idloai);


            echo '<h3 class="mb-5 font-weight-bold mt-5" style="color: red;text-align: start">TẤT CẢ SẢN PHẨM '            .  $ten['tenloai']            .         '</h3>';

            ?>
        </div>

    </div>
    <!--Grid row-->
    <div class="row">
        <?php
        $hh = new hanghoa();
        $result = $hh->getHHtheoLoai($idloai); //thấy được 14 sản phẩm
        
        //lấy 14 sản phẩm đổ lên View
        while ($set = $result->fetch()) {

            ?>
            <!--Grid column-->
            <div class="col-lg-3 col-md-4 mb-3 text-left">

                <div class="view overlay z-depth-1-half">
                    <img src="./Content/imagetourdien/<?php echo $set['hinh']; ?>" class="img-fluid" alt="">
                    <div class="mask rgba-white-slight"></div>
                </div>
                <?php
            
                   echo '<h5 class="my-4 font-weight-bold" style="color: red; font-size:15px">
                        ' . number_format($set['dongia']) . '<sup><u>đ</u></sup></br>
                    </h5>';
          
                ?>

                </h5>
                <a href="">
                    <span>
                        <?php echo $set['tensp'] . " - " . $set['tenmau']; ?>
                    </span></br>
                </a>
                <button class="btn btn-danger" id="may4" value="lap 4">New</button>
                <h5>Số lượt xem:
                    <?php echo $set['soluotxem']; ?>
                </h5>

            </div>
            <?php
        }
        ?>
    </div>

    <!--Grid row-->

</section>


<!-- end sản phẩm mới nhất -->


<div class="col-md-6 div col-md-offset-3">
    <ul class="pagination">

        <li><a href=""></a></li>

    </ul>
</div>