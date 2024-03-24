<section>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h3 class="mb-5 font-weight-bold">CHI TIẾT SẢN PHẨM</h3>
        </div>

    </div>
    <article class="col-12">
        <!-- <div class="card"> -->
        <div class="container-fliud">
            <div class="wrapper row">
                <form action="index.php?action=giohang&act=giohang_action" method="post">
                    <!-- <input type="hidden" name="action" value="giohang&add_cart"/> -->

                    <div class="preview col-md-6">
                        <div class="tab-content">

                            <?php
                            //điều hướng qua view chi tiết, đồng thời cũng truyền id
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                //view đòi hỏi cần có thông tin của sản phẩm mà id=24?model
                                $hh = new hanghoa();
                                $sp = $hh->getHangHoaId($id); // array(idsanpham:24, tensp:áo...)
                                $tenhh = $sp['tensp'];
                                $mota = $sp['mota'];
                                $dongia = $sp['dongia'];
                            }
                            ?>
                            <?php
                            $hinh = $hh->getHangHoaHinh($id);
                            $set = $hinh->fetch(); //lấy ra thông tin của dòng đầu
                            ?>
                            <div class="tab-pane active" id=""><img
                                    src="Content\imagetourdien\<?php echo $set['hinh'] ?>" alt="" width="200px"
                                    height="350px">
                            </div>

                        </div>
                        
                        <ul class="preview-thumbnail nav nav-tabs">
                            <?php
                            while ($img = $hinh->fetch()):
                                ?>
                                <li class="active"><a href="#<?php echo $img['hinh']; ?>" data-toggle="tab">
                                        <img src="<?php echo 'Content/imagetourdien/' . $img['hinh']; ?>"
                                            alt="Học thiết kế web bán hàng Online"></a>
                                </li>
                                <?php
                            endwhile;
                            ?>
                        </ul>
                    
                      

                    </div>
                    <div class="details col-md-6">
                        <input type="hidden" name="mahh" value="<?php echo $id; ?>" />
                        <h3 class="product-title">
                            <?php echo $tenhh ?>
                        </h3>
                        <div class="rating">
                            <div class="stars"> <span class="fa fa-star checked"></span> <span
                                    class="fa fa-star checked"></span> <span class="fa fa-star checked"></span> <span
                                    class="fa fa-star"></span> <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p class="product-description">
                            <?php
                            echo $mota;
                            ?>
                        </p>
                        <h4 class="price">Giá bán:
                            <?php echo number_format($dongia); ?> đ
                        </h4>

                        <h5 class="colors">Màu:
                            <select name="mymausac" class="form-control" style="width:150px;">
                                <?php
                                $mau = $hh->getHangHoaMau($id);
                                while ($set = $mau->fetch()):
                                    ?>
                                    <option value="<?php echo $set['idmau'] ?>">
                                        <?php echo $set['tenmau'] ?>
                                    </option>
                                    <?php
                                endwhile;
                                ?>
                            </select><br>

                            <input type="hidden" name="size" id="size" value="0" />
                            Kích Thước:
                            <?php
                            $size = $hh->getHangHoaSize($id);
                            while ($set = $size->fetch()):
                                ?>
                                <!--thiết kế là button-->
                                <button type="button" name="" onclick="chonsize('<?php echo $set['tensize']; ?>')"
                                    class="btn btn-default-hong btn-circle" id="hong" value="<?php echo $set['idsize']; ?>">
                                    <?php echo $set['tensize']; ?>
                                </button>
                                <?php
                            endwhile;
                            ?>
                            </br></br>
                            Số Lượng:
                            <?php
                            $soluongtonkho = $hh->getSoLuongTonKho($id);
                            echo $soluongtonkho['soluongton'] . '<br>';
                            if ($soluongtonkho['soluongton'] > 0) {
                                echo '<input type="number" id="soluong" name="soluong" min="1" max="100" value="1" size="10" />';
                            } else {
                                echo 'Hết hàng rồi';
                            }
                            ?>



                        </h5>

                        <div class="action">

                            <?php
                            if ($soluongtonkho['soluongton'] > 0) {
                                echo '<button class="add-to-cart btn btn-default" type="submit" data-toggle="modal"
                                    data-target="#myModal">MUA NGAY
                                </button>';
                            } else {
                                echo '<button class="add-to-cart btn btn-default" type="submit" data-toggle="modal"
                                data-target="#myModal" disabled>MUA NGAY
                                </button>';
                            }
                            ?>


                            <a href="http://hocwebgiare.com/" target="_blank"> <button class="like btn btn-default"
                                    type="button"><span class="fa fa-heart"></span></button> </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- </div> -->
    </article>
</section>

<p class="float-left"><b>BÌnh luận </b></p>
<hr>
</div>
<form action="" method="post">
    <div class="row">

        <input type="hidden" name="txtmahh" value="" />
        <img src="Content/imagetourdien/people.png" width="10px" height="50px" ; />
        <textarea class="input-field" type="text" name="comment" rows="2" cols="70" id="comment"
            placeholder="Thêm bình luận">  </textarea>
        <input type="submit" class="btn btn-primary" id="submitButton" style="float: right;" value="Bình Luận" />

    </div>

</form>
<div class="row">
    <p class="float-left"><b>Các bình luận</b></p>
    <hr>
</div>
<div class="row">
    <br />
</div>

</div>
</section>
<script type="text/javascript">
    function chonsize(a) {
        console.log(a);
        document.getElementById("size").value = a;
    }

    function chonHinhAnh(src) {
        // Thay đổi src của hình ảnh chính với đường dẫn của hình ảnh được chọn
        document.querySelector('.tab-pane.active img').src = src;
    }
</script>