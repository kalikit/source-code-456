<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="”viewport”" content="”width"="device-width," initial-scale="1.0″" />
  <link rel="stylesheet" href="../assets/css/signin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <title>Đăng ký</title>
</head>

<body>

  <div class="container contain">
    <div class="row justify-content-center">
      <div class="col-11 col-md-9 col-lg-7 col-xl-7">

        <form action="" method="POST" name="myForm" onsubmit="return matchPass()">
          <div class="row justify-content-center form_main">
            <div class="my-4 ">
              <h5>Đăng ký tài khoản</h5>
            </div>
            <div class="col-10">
              <label for="validationCustom01">Tên đăng nhập * </label>
              <input type="text" class="form-control" id="validationCustom01" required name="user">

              <label for="validationCustom01">Mật khẩu *</label>
              <input type="password" class="form-control" id="validationCustom01" required name="pass">

              <label for="validationCustom01">Nhập lại mật khẩu *</label>
              <input type="password" class="form-control" id="validationCustom01" required name="repass">

              <script>
                function matchPass() {
                  var pass = document.myForm.pass.value;
                  var repass = document.myForm.repass.value;
                  if (pass == repass) {
                    return true;
                  } else {
                    alert("Mật khẩu nhập lại không đúng với mật khẩu đã nhập!");
                    return false;
                  }
                }
              </script>
              <label for="validationCustom01">Email *</label>
              <input type="email" class="form-control" id="validationCustom01" required name="email">

              <label for="validationCustom01">Số điện thoại</label>
              <input type="text" class="form-control" id="validationCustom01" name="number">

              <label for="validationCustom01">Địa chỉ</label>
              <input type="text" class="form-control" id="validationCustom01" name="addr">
            </div>
            <button type="submit" class="btn btn-primary btn_login" name="dangky">Đăng ký</button>
          </div>

          <div class="d-flex align-items-center justify-content-between my-4">
            <hr class="flex-fill m-0">
            <span class="mx-3">
              Đăng nhập bằng
            </span>
            <hr class="flex-fill m-0">
          </div>

          <div class="row login_btn_by">
            <a href="#" class="btn btn-primary btn_by" role="button" aria-pressed="true"><i class="fab fa-google"></i>&nbsp;Google</a>
            <a href="#" class="btn btn-primary btn_by" role="button" aria-pressed="true"><i class="fab fa-facebook"></i>&nbsp;Facebook</a>
            <a href="#" class="btn btn-primary btn_by" role="button" aria-pressed="true"><i class="fa fa-comment"></i>&nbsp;Zalo</a>

          </div>
        </form>
        <?php
        include("../connectDB/ConnectDB.php");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_POST['dangky'])) {
            $user = mysqli_escape_string($ketnoi, $_POST["user"]);
            $pass = mysqli_escape_string($ketnoi, $_POST["pass"]);
            $email = mysqli_escape_string($ketnoi, $_POST["email"]);
            $number = mysqli_escape_string($ketnoi, $_POST["number"]);
            $addr = mysqli_escape_string($ketnoi, $_POST["addr"]);
            
              $sql = "insert into users(name,password,email,number,addr) values('$user','$pass','$email','$number','$addr')";
              $signin = mysqli_query($ketnoi, $sql); 
              if($signin){
              ?>
                <script>
                  alert("Đăng ký thành công!");
                </script>
                <?php header('location: ./login.php');
              }
            }
          }
        
        ?>
      </div>
    </div>
  </div>
</body>

</html>