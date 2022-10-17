<?php 
session_start();
ob_start();
include '../../../connectDB/ConnectDB.php';
include '../../nav.php';
// Lấy tất cả quyền đổ ra checkbox
$sql_pms   = "SELECT * FROM permissions";
$query_pms  = mysqli_query($ketnoi, $sql_pms);
$num_rows_pms  = mysqli_num_rows($query_pms);
$permissions = array();
if ($num_rows_pms > 0) {
    while ($row_pms = mysqli_fetch_array($query_pms)) {
        $permissions[] = [
            'id' => $row_pms['id'],
            'name' => $row_pms['name'],
        ];
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_role = mysqli_query($ketnoi, "SELECT * FROM roles LEFT JOIN role_has_permissions ON roles.id = role_has_permissions.role_id WHERE roles.id = '$id'");
    $role_data = array();
    while ($data = mysqli_fetch_array($query_role)) {
        $role_data['name'] = $data['name'];
        $role_data['description'] = $data['description'];
        $role_data['permission'][] = $data['permission_id'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

                        <h2 style="text-align: center; margin-top: 20px;"> Chỉnh sửa vai trò </h2>
                        <form method="post">
                            <div class="col-md-12" style="margin-top:30px;">
                                <div class="col-md-6" style="max-width:500px;border:1px solid #eee;padding:20px;">
                                    <div class="form-group">
                                        <label for="name">Tên:</label>
                                        <input type="text" value="<?= $role_data['name']; ?>" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả:</label>
                                        <textarea class="form-control" name="description" cols="30" rows="10"><?= $role_data['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading"> Chọn quyền </div>
                                            <div class="panel-body">
                                                <?php foreach ($permissions as $group) { ?>
                                                    <div class="form-group">
                                                        <label>
                                                            <input name="permissions[]" <?php if (in_array($group['id'], $role_data['permission'])) echo "checked"; ?> type="checkbox" value="<?= $group['id'] ?>">
                                                            <?= $group['name'] ?>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin: 30px 0 20px 30px;">
                                <input type="submit" name="submit" class="btn btn-primary" value="Cập nhật">
                                <a class="btn btn-light" href="roles.php"> Hủy </a>
                            </div>
                        </form>

                    </div>
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
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_role = mysqli_query($ketnoi, "SELECT * FROM roles LEFT JOIN role_has_permissions ON roles.id = role_has_permissions.role_id WHERE roles.id = '$id'");
    $role_data = array();
    while ($data = mysqli_fetch_array($query_role)) {
        $role_data['name'] = $data['name'];
        $role_data['description'] = $data['description'];
        $role_data['permission'][] = $data['permission_id'];
    }
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $in_permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

    $name        = trim($name);
    $description = trim($description);

    // Kiểm tra Vai trò đã có hay chưa?
    if (mysqli_num_rows(mysqli_query($ketnoi, "SELECT name FROM roles WHERE name = '$name' AND id <> '$id'")) > 0) {
        header('Location: ' . $_SERVER['HTTP_REFERER']); // return            exit;
    }

    $role_id = false;
    $date = date("Y-m-d H:i:s");
    $sql    = "UPDATE roles SET name = '{$name}', description = '{$description}', updated_at = '{$date}' WHERE id = '$id'";
    $update = mysqli_query($ketnoi, $sql);
    if (isset($_POST['submit'])) {
        if ($update) {
            $role_id = $id;
            if (count($in_permissions) > 0) {
                $remove = mysqli_query($ketnoi, "DELETE FROM role_has_permissions WHERE role_id = '$role_id'");
                foreach ($in_permissions as $pms_id) {
                    $update_rl_has_pms = mysqli_query($ketnoi, "INSERT INTO role_has_permissions(permission_id,role_id) VALUE ('{$pms_id}','{$role_id}')");
                }
                header('Location: roles.php');
                echo '<script>alert("Sửa thành công")</script>';
            }
        }
    } else {
        echo '<script>alert("không đúng")</script>';
        exit;
    }
}
?>