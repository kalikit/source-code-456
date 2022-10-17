<?php
include ('../../../connectDB/ConnectDB.php');
include("../../nav.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Trị </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
                        $sql = "SELECT * FROM permissions WHERE id = '$_GET[id]'";
                        $result = mysqli_query($ketnoi, $sql);
                        $row = mysqli_fetch_array($result)
                    ?>
                        
                        <h3 style="text-align: center;margin-top: 25px;"> Sửa quyền </h3>
                        <form method="post">
                            <div class="col-md-7" style="margin-top:30px;">
                                <div class="form-group">
                                    <label for="id"> ID: </label>
                                    <input type="text" name="id" required class="form-control" value="<?= $row['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name"> Tên quyền: </label>
                                    <input type="text" name="name" required class="form-control" value="<?= $row['name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description"> Mô tả: </label>
                                    <textarea name="description" cols="30" rows="10" class="form-control"><?= $row['description']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12" style="margin: 30px 0 20px 30px;">
                                <input type="submit" name="update" class="btn btn-primary" value="Sửa">
                                <a class="btn btn-light" href="permissions.php"> Hủy </a>
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
    $description = $_POST['description'];
    
    $sql = "UPDATE permissions SET id='$id', name='$name', description='$description' where id = $id";
    $update = mysqli_query($ketnoi, $sql);
    if ($update == true) { ?>
        <script>
            alert("Sửa thành công");
            window.location = "permissions.php";
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