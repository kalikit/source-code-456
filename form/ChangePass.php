<?php
session_start();
ob_start();
?>
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
  <link rel="stylesheet" href="../assets/css/changepass.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <title>Thay đổi mật khẩu</title>
</head>

<body>
  <?php
  include("../connectDB/ConnectDB.php");
  if (isset($_POST["btn_changePass"])) {
    $newPass = $_POST['newPass'];
    $renewPass = $_POST['renewPass'];
    $oldPass = $_POST['oldPass'];
    if ($renewPass != $newPass) {
  ?>
      <script>
        alert("Mật khẩu không khớp với mật khẩu vừa nhập!")
      </script>
      <?php
    } else {
      $sql = "UPDATE users SET password='$newPass' where password = '$oldPass' ";
      $query = mysqli_query($ketnoi, $sql);
      
      ?>
        <script>
          alert("Thay đổi mật khẩu thành công!")
          window.location = "./login.php"
        </script>
  <?php 
      }
    }
  

  ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10 col-md-8 col-lg-6 col-xl-5">

        <form action="" method="POST">
          <div class="row justify-content-center form_main">
            <div class="my-4 ">
              <h5>Thay đổi mật khẩu</h5>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Nhập mật khẩu cũ</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Old Password" name="oldPass" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Nhập mật khẩu mới</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password" name="newPass" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Xác nhận lại mật khẩu</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Renew Password" name="renewPass" required>
            </div>
            <button type="submit" class="btn btn-primary btn_change" name="btn_changePass">Thay đổi</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>