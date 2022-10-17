<?php
include '../../../connectDB/ConnectDB.php';
$sql_pms   = "SELECT * FROM permissions";
$query_pms  = mysqli_query($ketnoi, $sql_pms);
$num_rows_pms  = mysqli_num_rows($query_pms);
$permissions = array();
if ($num_rows_pms > 0) {
    while ($row_pms = mysqli_fetch_array($query_pms)) {
        $permission_groups = $row_pms['permission_group'];
        $permissions[]  = [
            'id' => $row_pms['id'],
            'name' => $row_pms['name'],
        ];
    }
}
?>
<form method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <h3 style="text-align: center;"> Chọn quyền cho vai trò </h3>
            <div class="col-md-12">
                <div class="panel panel-info">
                    <h5 class="panel-heading" style="margin-bottom: 20px;"> Chọn quyền: </h5>
                    <div class="panel-body" style="margin-left: 20px;">
                        <?php foreach ($permissions as $group) { ?>
                            <div class="form-group">
                                <label>
                                    <input name="permissions[]" type="checkbox" value="<?= $group['id'] ?>">
                                    <?php echo $group['name']; ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <input type="submit" name="submit" class="btn btn-primary" value="Thêm mới">
            <a class="btn btn-light" href="./roles.php"> Hủy </a>
        </div>
    </div>

</form>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $in_permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

    $created_at = date("Y-m-d H:i:s");
    $role_id = false;
    $sql = "INSERT INTO roles(name,description,created_at) VALUE ('{$name}','{$description}','{$created_at}')";
    $insert = mysqli_query($ketnoi, $sql);
    if ($insert == true) {
        $role_id = mysqli_insert_id($ketnoi);
        if (count($in_permissions) > 0 && $role_id != false) {
            foreach ($in_permissions as $pms_id) {
                mysqli_query($ketnoi, "INSERT INTO role_has_permissions (permission_id,role_id) VALUE('{$pms_id}','{$role_id}')");
            }
        }
        header('Location: roles.php');
        echo '<script>alert("Thêm thành công")</script>';
        exit;
    } else {
        echo '<script>alert("Lỗi!")</script>';
        exit;
    }
}
?>