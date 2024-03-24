<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    body {
        background-image: linear-gradient(to right top, #D91B23, #124FEB);
    }

    .search {
        display: inline-block;
        position: relative;
        height: 35px;
        width: 35px;
        box-sizing: border-box;
        margin: 0px 8px 7px 0px;
        padding: 7px 9px 0px 9px;
        border: 3px solid;
        border-radius: 25px;
        transition: all 200ms ease;
        cursor: text;
        background: white;

        &:after {
            content: "";
            position: absolute;
            width: 3px;
            height: 20px;
            right: -5px;
            top: 21px;
            background: white;
            border-radius: 3px;
            transform: rotate(-45deg);
            transition: all 200ms ease;
        }

        &.active,
        &:hover {
            width: 200px;
            margin-right: 0px;

            &:after {
                height: 0px;
            }
        }

        input {
            width: 100%;
            border: none;
            box-sizing: border-box;
            font-family: Helvetica;
            font-size: 15px;
            color: black;
            background: transparent;
            outline-width: 0px;
        }
    }
</style>
<header class="row no-gutters">
    <!-- nav san pham -->
    <section class="col-12" style="height:80px;">
        <div class="col-12">
            <div class="row">

                <!-- test -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
                    <div class="container" style="font-size: 15px;">
                        <a class="navbar-brand pt-2" style="font-size: 25px;" href="#"><i
                                class="fa-brands fa-waze me-1"></i>ShopQ</a>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ">
                                <!-- <form class="form-inline my-2 my-lg-0  pt-3">
                                    <input class="form-control mr-sm-2 " type="search" placeholder=""
                                        aria-label="Search">
                                </form> -->
                                <li class="nav-item">
                                    <a class="nav-link pt-4" href="http://localhost:8080/PHP2/ShopQ/index.php?">Trang
                                        Chủ</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Sản Phẩm
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                        $loai = new loaisp();
                                        $kq = $loai->getDanhMucSanPham();
                                        while ($set = $kq->fetch()):
                                            ?>
                                            <li><a class="dropdown-item"
                                                    href="index.php?action=sanpham&loai=<?php echo $set['idloai']; ?>">
                                                    <?php echo $set['tenloai']; ?>
                                                </a></li>
                                            <?php
                                        endwhile ?>
                                    </ul>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pt-4" href="#">Giới Thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pt-4" href="#">Liên Hệ</a>
                                </li>
                                <li class="nav-item pt-2">
                                    <div class="cntr">
                                        <div class="cntr-innr">

                                            <form class="form-inline" action="index.php?action=sanpham&act=timkiem"
                                                method="post">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">


                                                        <label class="search" for="inpt_search">
                                                            <input id="inpt_search" type="text" name="txtsearch" />
                                                        </label>
                                                    </div>

                                            </form>


                                            <script>
                                                $("#inpt_search").on('focus', function () {
                                                    $(this).parent('label').addClass('active');
                                                });

                                                $("#inpt_search").on('blur', function () {
                                                    if ($(this).val().length == 0)
                                                        $(this).parent('label').removeClass('active');
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if (isset($_SESSION['makh'])) {
                                    ?>
                                    <li class="nav-item">
                                        <a href="index.php?action=dangnhap&act=dangxuat" class="nav-link">Đăng Xuất</a>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li class="nav-item">
                                        <a href="index.php?action=dangky" class="nav-link">Đăng Ký</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="index.php?action=dangnhap" class="nav-link">Đăng Nhập</a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <div class="d-flex align-items-center">
                                    <a href="index.php?action=giohang" class="nav-link me-2"><img
                                            src="Content/imagetourdien/cartx2.png" width="30px" height="30px"
                                            alt=""></a>
                                    <p style="color: red; margin-top: 15px; margin-left: 0px; margin-right: 5px;">(0)
                                    </p>
                                </div>
                                <?php
                                if (isset($_SESSION['makh'])) {
                                    echo ' <li>
                                        <p style="color: red; margin-top: 15px; margin-left: 0px;">' . $_SESSION['tenkh'] . '</p>
                                         </li>';
                                } else {
                                    echo '<li>
                                        <p style="color: red; margin-top: 15px; margin-left: 0px;">Xin chào!</p>
                                        </li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- end test -->
            </div>
        </div>
    </section>
    <!-- dang ky -->
    <!-- <section class="col-12">

        <div class="col-12">
            <div class="row">
                <nav class="navbar navbar-expand-lg n navbar-light bg-light" style="margin-bottom: 0px; "> -->

    <!-- Right
     <ul class="navbar-nav ml-auto" style="font-size: 15px;">
                        <li>
                            <form class="form-inline" action="" method="post">
                                <div class="input-group">
                                    <div class="input-group-prepend"> -->
    <!-- <a href="Trangchu.php?trang=tk"> -->
    <!-- <input class="input-group-text" style="height: 50px; font-size: 15px;"
                                            type="submit" id="btsearch" value="Tìm Kiếm" /> -->
    <!-- </a> -->
    <!-- <span class="input-group-text">@</span> -->
    <!-- <input type="text" name="txtsearch" style="height: 50px; font-size: 15px;"
                                            class="form-control" placeholder="Tìm Kiếm" />
                                    </div> -->

    <!-- </form> 
                        </li> 
                        <li class="nav-item">
                            <a href="" class="nav-link">Đăng Ký</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Đặng Nhập</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Đặng Xuất</a>
                        </li>
                        <li>
                            <a href="" class="nav-link"><img src="Content/imagetourdien/cartx2.png" width="30px"
                                    height="30px" alt=""></a>

                        </li>
                        <li>
                            <p style="color: red; margin-top: 20px; margin-left: 0px;">(0)</p>

                        </li>
                        <li>

                            <p style="color: red; margin-top: 20px; margin-left: 0px;"></p>

                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </section> -->



</header>
<!-- dang ky -->

<!-- hinh dộng -->
<div class="row">

    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div id="carousel-example-1z" class="carousel slide carousel-fade carousel-fade" data-ride="carousel">
                    <!--Indicators-->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                        <li data-target="#carousel-example-1z" data-slide-to="2"></li>

                    </ol>
                    <!--/.Indicators-->
                    <!--Slides-->
                    <div class="carousel-inner z-depth-1-half" role="listbox">
                        <!--First slide-->
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="Content/imagetourdien/slide1.jpg" style="height: 700px;"
                                alt=" First slide">
                        </div>
                        <!--/First slide-->
                        <!--Second slide-->
                        <div class="carousel-item">
                            <img class="d-block w-100" src="Content/imagetourdien/slide2.jpg" style="height: 700px;"
                                alt="Second slide">
                        </div>
                        <!--/Second slide-->
                        <!--Third slide-->
                        <div class="carousel-item">
                            <img class="d-block w-100" src="Content/imagetourdien/slide3.jpg" alt="Third slide"
                                style="height: 700px;">
                        </div>

                        <!--/Third slide-->
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <!--/.Controls-->
                </div>
            </div>
        </div>

    </div>
</div>