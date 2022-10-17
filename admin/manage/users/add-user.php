<?php
include '../../../connectDB/ConnectDB.php';
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name       = trim($_POST['name']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    //$password   = md5($password); // Mã hóa md5 mật khẩu
    $sql = "INSERT INTO users(name, email, password, ngaytao) VALUE ('{$name}','{$email}','{$password}','{$created_at}')";
    $insert = mysqli_query($ketnoi, $sql); // Lưu Thông tin đăng ký vào bảng users                  
    if ($insert) // nếu lưu thành công
    {
        header('Location: ' . '?page=../../../form/login.php'); // return redirect về login
        exit;
    } else // nếu thất bại
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']); // return back
        exit;
    }
}

?>

<div class="panel" style="box-shadow: none;">
    <h3 style="text-align: center;"> Thêm mới thành viên </h3>
    <form class="form_add_user" method="post" action="?page=dang-ky">
        <div class="form-group">
            <input type="text" id="login" class="form-control" name="name" placeholder="Tên tài khoản" required>
        </div>
        <div class="form-group">
            <input type="email" id="login" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" id="password" class="form-control" name="password" placeholder="Mật khẩu" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" value="Thêm thành viên">
        </div>
    </form>
</div>
<style>
    .form_add_user {
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid grey;
        border-radius: 5px;
        padding: 20px;
        margin-top: 50px;
    }
    .btn-primary{
        margin-top: 15px;
    }
</style>