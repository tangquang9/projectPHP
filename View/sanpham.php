<!-- quảng cáo -->
<?php
include "quangcao.php";
?>
<!-- end quảng cáo -->
<?php
//phân trang
$hh = new hanghoa();
//b1: xác định trang mình đang phân trang có bao nhiêu sản phẩm
//cách 1: dùng count
// $count=$hh->getCountHangHoaAll(); // 14
//cách 2:
$count = $hh->getHangHoaAll()->rowCount(); //14
//b2: giới hạn 1 trang bao nhiêu sản phẩm, tự cho tùy vào thiết kế
$limit = 8;
//b3: tính ra số trang dựa trên tổng sản phẩm và limit
$trang = new page();
//lấy ra có bao nhiêu trang
$page = $trang->findPage($count, $limit); //2
//lấy ra start
$start = $trang->findStart($limit); //0  
?>

<!-- end số lượt xem san phẩm -->
<!-- sản phẩm-->
<!-- cùng 1 view để gọi nhiều dữ liệu khác nhau-->
<?php
$ac = 1;
if (isset($_GET['action'])) {
    if (isset($_GET['act']) && $_GET['act'] == 'sanphamkhuyenmai') {
        $ac = 2;
    } 
    elseif(isset($_GET['act']) && $_GET['act'] == 'timkiem'){
        $ac = 3;
    }
    else {
        $ac = 1;
    }
    

}
?>
<!--Section: Examples-->
<section id="examples" class="text-center">

    <!-- Heading -->
    <div class="row">
        <div class="col-lg-8 text-right">
            <?php
            if ($ac == 1) {
                echo '<h3 class="mb-5 font-weight-bold mt-5" style="color: red;text-align: start">TẤT CẢ SẢN PHẨM</h3>';
            }
            if ($ac == 2) {
                echo '<h3 class="mb-5 font-weight-bold mt-5" style="color: red;text-align: start">TẤT CẢ SẢN PHẨM SALE</h3>';
            }
            if ($ac == 3) {
                echo '<h3 class="mb-5 font-weight-bold mt-5" style="color: red;text-align: start">SẢN PHẨM TÌM KIẾM LÀ</h3>';
            }
            ?>
        </div>

    </div>
    <!--Grid row-->
    <div class="row">
        <?php
        $hh = new hanghoa();
        if ($ac == 1) {
            // $result = $hh->getHangHoaAll(); //thấy được 14 sản phẩm
            $result = $hh->getHangHoaAllPage($start, $limit); //phân trang
        }
        if ($ac == 2) {
            $result = $hh->getHangHoaAllSale(); //thấy được 8 sản phẩm
        }
        if($ac = 3){
            if(isset($_POST['txtsearch'])){
                $tk=$_POST['txtsearch'];
                // đem giá trị này đi tìm kiếm
                $result=$hh->timkiemSP($tk);
            }
        }
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
                if ($ac == 1) {
                    '<h5 class="my-4 font-weight-bold" style="color: red; font-size:15px">
                        ' . number_format($set['dongia']) . '<sup><u>đ</u></sup></br>
                    </h5>';
                }
                ?>

                </h5>
                <a href="index.php?action=sanpham&act=sanphamchitiet&id=<?php echo $set['idsanpham']; ?>">
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
<!-- phân trang -->

<div class="col-md-6 div col-md-offset-3">
    <!--phân trang-->
    <ul class="pagination">
        <?php
        //nút lùi, khi nào lùi, khi trang hiện nó lớn hơn 1 và tổng số trang >1
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($current_page > 1 && $page > 1) {
            echo '<li><a href="index.php?action=sanpham&page=' . ($current_page - 1) . '">Prev</a></li>';
        }
        for ($i = 1; $i <= $page; $i++) {
            ?>
            <li><a href="index.php?action=sanpham&page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a></li>
            <?php
        }
        //nút next, next cho tới khi nhỏ hơn tổng số trang và tổng trang lớn hơn 1
        if ($current_page < $page && $page > 1) {
            echo '<li><a href="index.php?action=sanpham&page=' . ($current_page + 1) . '">Next</a></li>';
        }
        ?>

    </ul>
</div>