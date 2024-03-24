<style>
    .card-body .view.overlay .img-fluid {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        /* Bo tròn viền của hình ảnh */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Hiệu ứng bóng đổ cho hình ảnh */
    }

    .card-body .view.overlay .img-fluid:hover {
        opacity: 0.8;
        /* Độ mờ khi rê chuột vào hình ảnh */
        transition: opacity 0.3s ease-in-out;
        /* Hiệu ứng chuyển đổi mờ */
    }
</style>
<!--Section: Examples-->
<section id="examples" class="text-center">

    <!-- Heading -->
    <div class="row">
        <div class="col-lg-8 text-right">
            <h3 class="mb-5 font-weight-bold mt-5" style="color: red;text-align: start">SẢN PHẨM MỚI NHẤT</h3>
        </div>
        <div class="col-lg-4 text-right mt-4">
            <a href="index.php?action=sanpham">
                <span style="color: gray;">Xem chi tiết</span>
        </div>
        </a>


    </div>
    <!--Grid row-->
    <div class="row">
        <?php
        //view yêu cầu controller có dữ liệu, có rồi, nằm trong model
        $hh = new hanghoa();
        $result = $hh->getHangHoaNew(); // $result là bảng chứa 8 sản phẩm
        while ($set = $result->fetch()): //$set=arry(mahh:24, tenhh: Giày cao gót - vàng, hinh:21.jpg; dongia:500000, mausac: Màu trắng)
            ?>
            <!--Grid column-->
            <div class="col-lg-3 col-md-4 mb-3 text-left">
                <div class="card" style=" border-radius: 10px;">
                    <div class="card-body p-0">
                        <div class="view overlay z-depth-1-half">
                            <img src="./Content/imagetourdien/<?php echo $set['hinh']; ?>" class="img-fluid" alt="">
                            <div class="mask rgba-white-slight"></div>
                        </div>
                    </div>
                    <div class="card-footer text-muted" style="font-size:15px">
                        <h5 class="my-4 font-weight-bold" style="color: red; font-size:15px">
                            <?php echo number_format($set['dongia']); ?><sup><u>đ</u></sup></br>
                        </h5>
                        <a href="index.php?action=sanpham&act=sanphamchitiet&id=<?php echo $set['idsanpham']; ?>">
                            <span>
                                <?php echo $set['tensp'] . " - " . $set['tenmau']; ?>
                            </span></br></a>
                        <button class="btn btn-danger" id="may4" value="lap 4">New</button>
                        <h5>Số lượt xem:
                            <?php echo $set['soluotxem']; ?>
                        </h5>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
        ?>
    </div>

    <!--Grid row-->

</section>
<!-- end sản phẩm mới nhất -->
<!-- sản phẩm khuyến mãi -->
<section id="examples" class="text-center">

    <!-- Heading -->
    <div class="row">
        <div class="col-lg-8 text-right">
            <h3 class="mb-5 font-weight-bold mt-5" style="color: red;text-align: start">SẢN PHẨM KHUYẾN MÃI</h3>
        </div>
        <div class="col-lg-4 text-right mt-4">
            <a href="index.php?action=sanpham&act=sanphamkhuyenmai">
                <span style="color: gray;">Xem chi tiết</span>
        </div>
        </a>

    </div>
    <!--Grid row-->
    <div class="row">

        <?php
        //view yêu cầu controller có dữ liệu, có rồi, nằm trong model
        $kq = $hh->getHangHoaSale(); // $result là bảng chứa 4 sản phẩm
        while ($set = $kq->fetch()) { //$set=arry(mahh:24, tenhh: Giày cao gót - vàng, hinh:21.jpg; dongia:500000, mausac: Màu trắng)
            ?>
            <!--Grid column-->
            <div class="col-lg-3 col-md-4 mb-3 text-left">
                <div class="card" style=" border-radius: 10px;">
                    <div class="card-body p-0">
                        <div class="view overlay z-depth-1-half">
                            <img src="./Content/imagetourdien/<?php echo $set['hinh']; ?>" class="img-fluid" alt="">
                            <div class="mask rgba-white-slight"></div>
                        </div>
                    </div>
                    <div class="card-footer text-muted" style="font-size:15px">
                        <h5 class="my-4 font-weight-bold">
                            <font color="red">
                                <?php echo number_format($set['giamgia']); ?><sup><u>đ</u></sup>
                            </font>
                            <strike>
                                <?php echo number_format($set['dongia']); ?>
                            </strike><sup><u>đ</u></sup>
                        </h5>

                        <a href="index.php?action=sanpham&act=sanphamchitiet&id=<?php echo $set['idsanpham']; ?>">
                            <span>
                                <?php echo $set['tensp'] . " - " . $set['tenmau']; ?>
                            </span></br></a>
                        <button class="btn btn-danger" id="may4" value="lap 4">New</button>
                        <h5>Số lượt xem:
                            <?php echo $set['soluotxem']; ?>
                        </h5>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <!--Grid row-->

</section>
<!-- end sản phẩm khuyến mãi -->