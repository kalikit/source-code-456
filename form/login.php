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
    <link rel="stylesheet" href="../assets/css/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <title>Đăng nhập</title>
</head>

<body>
    <?php
    include("../connectDB/ConnectDB.php");
    if (isset($_POST["btn_submit"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt tấn công sql injection
        $email = strip_tags($email);
        $email = addslashes($email); // sử dụng hàm addlashes để loại bỏ các kí tự dư thừa
        $password = strip_tags($password);
        $password = addslashes($password);

        $sql = "SELECT
        users.email, users.id as user_id, users.name as user_name,
        GROUP_CONCAT(permissions.name) as permission_name,
        user_has_roles.user_id,
        roles.name as role_name,
        roles.id as role_id
        FROM users
        LEFT JOIN user_has_roles ON users.id = user_has_roles.user_id
        LEFT JOIN roles ON roles.id = user_has_roles.role_id
        LEFT JOIN role_has_permissions ON role_has_permissions.role_id = roles.id
        LEFT JOIN permissions ON role_has_permissions.permission_id = permissions.id
        WHERE email ='$email' and password ='$password' GROUP BY roles.id";
        $query = mysqli_query($ketnoi, $sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows > 0 && $email == "admin@gmail.com" && $password == "admin123") {
            $permissions = '';
            while ($row = mysqli_fetch_array($query)) {
                $permissions .= $row['permission_name'];
                $_SESSION['auth_user']  = [
                    'id'    => $row['user_id'],
                    'name'  => $row['user_name'],
                    'email' => $row['email']
                ];
            }
            $_SESSION['auth_user']['permission_name']  = explode(',', $permissions);
            header("location: ../admin/Home.php");
        } 
        else if($num_rows > 0){
            $permissions = '';
            while ($row = mysqli_fetch_array($query)) {
                $permissions .= $row['permission_name'];
                $_SESSION['auth_user']  = [
                    'id'    => $row['user_id'],
                    'name'  => $row['user_name'],
                    'email' => $row['email']
                ];
            }
            $_SESSION['auth_user']['permission_name']  = explode(',', $permissions);
            header("location: ../employee/Home.php");
        }
        
        else { ?>
            <script>
                alert("Email hoặc mật khẩu không chính xác!");
            </script>
    <?php }
    }
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-8 col-lg-6 col-xl-5">

                <form action="" method="POST">
                    <div class="row justify-content-center form_main">
                        <div class="my-4 ">
                            <h5>Đăng nhập</h5>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-label" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn_login" name="btn_submit">Đăng nhập</button>
                        <br>
                        <div class="d-flex justify-content-between my-2"><a id="clickModal" data-toggle="modal" data-target="#myModal"><small>Quên mật khẩu?</small></a> &nbsp; / &nbsp;
                            <a href="./signin.php" class="" style="text-decoration: none;"><small>Tạo tài khoản</small></a>&nbsp; / &nbsp;
                            <a href="./ChangePass.php" class="" style="text-decoration: none;"><small>Thay đổi mật khẩu</small></a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between my-4">
                        <hr class="flex-fill m-0"> <span class="mx-3">
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
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Quên mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php include('./forgotPass.php'); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>

                </div>
            </div>
        </div>
    </div>

</body>

</html>