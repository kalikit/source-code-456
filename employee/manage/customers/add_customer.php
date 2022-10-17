<?php
include '../../../connectDB/ConnectDB.php';
?>
<form method="post">
    <div class="row">
        <div class="col-md-6">
            <h3 style="text-align: center;"> Thêm mới khách hàng </h3>
            <div class="form-group">
                <label for="id">Mã khách hàng:</label>
                <input type="text" class="form-control" name="id" required>
            </div>
            <div class="form-group">
                <label for="name">Họ tên:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="addr">Địa chỉ:</label>
                <input type="text" class="form-control" name="addr" required>
            </div>
            <div class="form-group">
                <label for="number">Số điện thoại:</label>
                <input type="text" class="form-control" name="number" required>
            </div>
            <div class="form-group">
                <label for="authID">Mã định danh:</label>
                <input type="text" class="form-control" name="authID" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="price">Giá tiền:</label>
                <input type="text" class="form-control" name="price" required>VNĐ
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" name="description" cols="30" rows="5" required></textarea>
            </div>
            <div class="form-group" style="display: flex;">
                <label for="amount">Số lượng khảo sát:</label>&emsp;&emsp;
                <input type="number" class="form-control" name="amount" required min="1" max="100" style="width: 100px; text-align: center;"></input>
            </div>
            <div class="form-group" style="display: flex;">
                <label for="numberofsentences">Số câu khảo sát:</label>&emsp;&emsp;
                <input type="number" class="form-control" name="numberofsentences" required min="1" max="100" style="width: 100px; text-align: center;"></input>
          </div>
            
        </div>

        <div class="col-md-12">
            <input type="submit" name="submit" class="btn btn-primary" value="Thêm mới">
            <a class="btn btn-light" href="./customers.php"> Hủy </a>
        </div>
    </div>

</form>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $addr = $_POST['addr'];
    $number = $_POST['number'];
    $authID = $_POST['authID'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];
    $numberofsentences = $_POST['numberofsentences'];

    $sql = "INSERT INTO customers(id, ho_ten, dia_chi, so_dt, ma_dinh_danh, email, mo_ta, gia_tien, so_luong_ks, so_cau_ks) VALUES ('$id','$name','$addr','$number','$authID','$email','$description','$price','$amount','$numberofsentences')";
    $insert = mysqli_query($ketnoi, $sql);
    if ($insert == true) {
        header('Location: ./customers.php');
        echo '<script>alert("Thêm thành công")</script>';

        exit;
    } else {
        echo '<script>alert("Lỗi!")</script>';
        exit;
    }
}
?>