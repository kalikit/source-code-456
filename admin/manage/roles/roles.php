<?php
session_start();
ob_start();
include '../../../connectDB/ConnectDB.php';
include("../../nav.php");
?>
<?php
$sql    = "SELECT * FROM roles WHERE deleted_at IS NULL";
$query  = mysqli_query($ketnoi, $sql);
$num_rows  = mysqli_num_rows($query);

$roles = array();
if ($num_rows > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $roles[] = [
            'id'    => $row['id'],
            'name'  => $row['name'],
            'description' => $row['description']
        ];
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hệ Thống Quản Trị </title>
    <link rel="stylesheet" href="../../../assets/css/roles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/login.css" />
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

                        <h2> Quản lý vai trò </h2>
                        <a id="clickModal" data-toggle="modal" data-target="#myModal" class="btn btn-primary col-4" style="color: white; font-size:17px;"> Thêm mới vai trò </a>
                        <div class="">
                        <table class="table table-bordered" style="margin-top: 60px;border:1px solid #eee">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th style="width:300px">CHỌN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $item) { ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['description']; ?></td>
                                        <td style="width:200px;text-align:center">
                                            <a href="edit-role.php?id=<?= $item['id']; ?>" class="btn btn-primary btn-sm"> Sửa vai trò </a>
                                            <a onclick="return confirm('Bạn có chắc xóa không ?')" href="delete-role.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm"> Xóa vai trò </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Thêm mới vai trò </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php include("./add-role.php"); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>

                </div>
            </div>
        </div>
    </div>

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