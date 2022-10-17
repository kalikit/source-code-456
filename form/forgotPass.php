<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <title>Đăng nhập</title>
</head>

<body>
    <form action="" method="POST">
        <div class="form-group">
            <label for="InputEmail">Nhập Email của bạn vào đây</label>
            <div class="form-inline">
                <input type="email" class="form-control mb-2" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <button type="submit" class="btn btn-primary mx-sm-3 mb-2" name="btn_forgotPass">Tiếp theo</button>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST["btn_forgotPass"])) {
        $email = $_POST['email'];
        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt tấn công sql injection
        $email = strip_tags($email);
        $email = addslashes($email); // sử dụng hàm addlashes để loại bỏ các kí tự dư thừa

        $sql2 = "select email from users where email ='$email'";
        $query2 = mysqli_query($ketnoi, $sql2);
        $num_rows2 = mysqli_num_rows($query2);
        if ($num_rows2 > 0) {
            $string = substr(time(), 0, 16);
            //$token = md5($string);

            $sql3 = "UPDATE users SET password = '$string' where email ='$email'";
            $query3 = mysqli_query($ketnoi, $sql3);
            //gui mail
            $encodeEmail = base64_encode($email);

            $to      = $email;
            $subject = "Reset password";
            $message = "<h4>mat khau moi la: </h4>" . $string;
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
                alert("Email không chính xác!");
            </script>
    <?php }
    }
    ?>
</body>

</html>