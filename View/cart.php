<div class="table-responsive">
  <?php
  //khi nào hiển thị, khi giỏ hàng tồn tại và có hàng
  if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    ?>
    <form action="index.php?action=giohang&act=update_cart" method="post">
      <table class="table table-bordered">
        <thead>
          <tr>
            <td colspan="5">
              <h2 style="color: red;">THÔNG TIN GIỎ HÀNG</h2>
            </td>
          </tr>
          <tr class="table-success">
            <th>Số TT</th>
            <th>Thông Tin Sản Phẩm</th>
            <th>Tùy Chọn Của Bạn</th>
            <th colspan="2">Giá</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $j=0;
          foreach ($_SESSION['cart'] as $key => $item) {
            $j++;
            ?>
            <tr>
              <td><?php echo $j; ?></td>
              <td>
                <img width="50px" height="50px" src="Content/imagetourdien/<?php echo $item['hinh']; ?>">
                <?php echo $item['tenhh']; ?>
              </td>
              <td>
                Màu:
                <?php echo $item['mausac']; ?> Size:
                <?php echo $item['size']; ?>
              </td>
              <td>
                Đơn Giá:
                <?php echo number_format($item['dongia']); ?>- Số Lượng: <input type="text" name="newqty[]"
                  value="<?php echo $item['soluong']; ?>" /><br />
                <p style="float: right;"> Thành Tiền
                  <?php echo number_format($item['thanhtien']); ?> <sup><u>đ</u></sup>
                </p>
              </td>
              <td>
                <a href="index.php?action=giohang&act=delete_cart&id=<?php echo $key; ?>"><button type="button" class="btn btn-danger">Xóa</button></a>
                
              </td>
            </tr>
            <?php
          }
          ?>

          <tr>
            
            <td colspan="3">
              <b>Tổng Tiền</b>:
              <b> 
               <?php
                $gh=new giohang();
                echo $gh->getSubTotal();
               ?>   
              <sup><u>đ</u></sup></b>
            </td>
            
            <td style="float: right;">
            <button type="submit" class="btn btn-secondary">Sửa</button>  
             
            </td>
            <td><a href="index.php?action=thanhtoan"><button type="button" class="btn btn-primary">Thanh Toán</button></a></td>
          </tr>
        </tbody>
      </table>
    </form>
    <?php
  } else {
    echo '<script> alert("Bạn chưa có hàng"); </script>';
    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
  }
  ?>
</div>
</div>