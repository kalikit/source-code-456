<?php
session_start();
ob_start();
include ('../../../connectDB/ConnectDB.php');
include("../../nav_employee.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Trị</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="icon" type="image/x-icon" href="../../../assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../../assets/css/demo.css" />
    <link rel="stylesheet" href="../../../assets/css/home.css" />
    <link rel="stylesheet" href="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <script src="../../../assets/vendor/js/helpers.js"></script>
    <script src="../../../assets/js/config.js"></script>
</head>

<body>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-10 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">

                    <?php
                        $sql = "SELECT * FROM customers WHERE id = '$_GET[id]'";
                        $result = mysqli_query($ketnoi, $sql);
                        $row = mysqli_fetch_array($result)
                    ?>
                        
                        <h3 style="text-align: center;margin-top: 25px;"> Sửa thông tin khách hàng </h3>
                        <form method="post">
                            <div class="col-md-7" style="margin-top:30px;">
                                <div class="form-group">
                                    <label for="id">Mã khách hàng:</label>
                                    <input type="text" class="form-control" name="id" required value="<?= $row['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Họ tên:</label>
                                    <input type="text" class="form-control" name="name" required value="<?= $row['ho_ten']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="addr">Địa chỉ:</label>
                                    <input type="text" class="form-control" name="addr" required value="<?= $row['dia_chi']; ?>">
                                </div>
                                <div class="form-group">
                                     <label for="number">Số điện thoại:</label>
                                    <input type="text" class="form-control" name="number" required value="<?= $row['so_dt']; ?>">
                                </div>
                                <div class="form-group">
                                   <label for="authID">Mã định danh:</label>
                                    <input type="text" class="form-control" name="authID" required value="<?= $row['ma_dinh_danh']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" required value="<?= $row['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả:</label>
                                    <textarea class="form-control" name="description" cols="30" rows="5" required><?= $row['mo_ta']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá tiền:</label>
                                    <input type="text" class="form-control" name="price" required value="<?= $row['gia_tien']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Số lượng khảo sát:</label>
                                    <input type="text" class="form-control" name="amount" required value="<?= $row['so_luong_ks']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="numberofsentences">Số câu khảo sát:</label>
                                    <input type="text" class="form-control" name="numberofsentences" required value="<?= $row['so_cau_ks']; ?>">
                                </div>
                            </div>

                                <div class="col-md-12" style="margin: 30px 0 20px 30px;">
                                    <input type="submit" name="update" class="btn btn-primary" value="Sửa">
                                    <a class="btn btn-light" href="./customers.php"> Hủy </a>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
if(isset($_POST['update']))
{
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
    
    $sql = "UPDATE customers SET id='$id', ho_ten='$name', dia_chi='$addr', so_dt='$number', ma_dinh_danh='$authID', email='$email', mo_ta='$description', gia_tien='$price', so_luong_ks='$amount', so_cau_ks='$numberofsentences' where id = $id";
    $update = mysqli_query($ketnoi, $sql);
    if ($update == true) { ?>
        <script>
            alert("Sửa thành công");
        window.location = "./customers.php";
        </script>
        <?php
        exit;
    } else { ?>
        <script>alert("Lỗi!")</script>
        <?php
        exit;
    }
}
?>
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../../assets/vendor/js/menu.js"></script>
    <script src="../../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../../../assets/js/main.js"></script>
    <script src="../../../assets/js/dashboards-analytics.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>