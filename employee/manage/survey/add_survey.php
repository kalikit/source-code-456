<?php
include '../../../connectDB/ConnectDB.php';
?>
<form method="post">
    <div class="row">
        <div class="col-md-12">
            <h3 style="text-align: center;"> Thêm người khảo sát </h3>
            <div class="form-group">
                <label for="user">Tên đăng nhập:</label>
                <input type="text" class="form-control" name="user" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="number">Số điện thoại:</label>
                <input type="text" class="form-control" name="number" required>
            </div>
            <div class="form-group">
                <label for="infor">Thông tin khác:</label>
                <textarea class="form-control" name="infor" cols="30" rows="5" required></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <input type="submit" name="submit" class="btn btn-primary" value="Thêm mới">
            <a class="btn btn-light" href="./survey.php"> Hủy </a>
        </div>
    </div>

</form>
<!-- submit form--------------------->
<?php
if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $infor = $_POST['infor'];

    $sql = "INSERT INTO surveys(user, email, number, infor) VALUES ('$user','$email','$number','$infor')";
    $insert = mysqli_query($ketnoi, $sql);
    if ($insert == true) {
        echo '<script>alert("Thêm thành công")</script>';

        //gui mail
        $encodeEmail = base64_encode($email);

        $to      = $email;
        $subject = "Link khảo sát";
        $message = "<p><a href='http://localhost:3000/employee/manage/survey/form_survey.php'>Click vào đây để tham gia khảo sát</a></p>";
        $header  =  "From:nhocquan142@gmail.com \r\n";
        $header .=  "Cc:other@exmaple.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $success = mail($to, $subject, $message, $header);

        if ($success == true) { ?>
            <script>
                alert("Đã gửi mail thành công!");
            </script>
        <?php } else { ?>
            <script>
                alert("Không gửi được email!");
            </script>
        <?php }
    } else { ?>
        <script>
            alert("Lỗi!");
        </script>
       <?php exit;
    } 
    header('Location: ./survey.php');
    
}
?>