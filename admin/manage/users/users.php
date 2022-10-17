<?php
session_start();
ob_start();
include '../../../connectDB/ConnectDB.php';
include("../../nav.php");
$sql   =   "SELECT
            GROUP_CONCAT(roles.name) as name,
            GROUP_CONCAT(roles.id) as role_id,users.id AS user_id, email,users.NAME AS user_name 
            FROM users
            LEFT JOIN user_has_roles ON users.id = user_has_roles.user_id
            LEFT JOIN roles ON roles.id = user_has_roles.role_id 
            GROUP BY users.id";
            $query  = mysqli_query($ketnoi, $sql);
            $num_rows  = mysqli_num_rows($query); // đếm số bản ghi
            $list_user = array(); // tạo mảng chứa dữ liệu trả về
            if ($num_rows > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $list_user[] = [
                        'id'    => $row['user_id'],
                        'name'  => $row['user_name'],
                        'email' => $row['email'],
                        'role_id' => $row['role_id'],
                        'role_name' => ($row['name']) ? $row['name'] : 'Chưa có vai trò!'
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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

                        <div class="panel" style="box-shadow: none;">
                            <h2 style="text-align: center; margin-top: 20px;"> Quản lý thành viên </h2>
                            <button type="button" class="btn btn-primary" id="clickModal" data-toggle="modal" data-target="#myModal" style="margin-left: 50px;"> Thêm thành viên</button>
                            <table class="table table-bordered" style="margin-top: 60px;border:1px solid #eee;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Vai trò</th>
                                        <th style="width:230px">Chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_user as $item) {
                                        $_SESSION['user']['name'] = $item['name'];
                                    ?>

                                        <tr class="item__user" data-name="<?= $item['name']; ?>">
                                            <td><?= $item['id']; ?></td>
                                            <td><?= $item['name']; ?></td>
                                            <td><?= $item['email']; ?></td>
                                            <td><?= $item['role_name']; ?></td>
                                            <td style="text-align:center">
                                                <form action="user-role.php" method="post">
                                                    <input type="hidden" name="role_group" value="<?= $item['role_id']; ?>">
                                                    <input type="hidden" name="user_name" value="<?= $item['name'] . '+' . $item['id'];; ?>">
                                                    <button class="btn btn-sm btn-light" style="background-color:lightblue; font-size: 14px;"> Chọn vai trò</button>
                                                    <a onclick="return confirm('Bạn có chắc xóa không ?')" href="delete-user.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm"> Xóa </a>
                                                </form>
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

    <!-- Modal thêm thành viên-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php include("./add-user.php"); ?>

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