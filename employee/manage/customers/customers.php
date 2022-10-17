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

                        <h2 style="text-align: center; margin-top: 30px;"> Danh sách khách hàng </h2>
                        <div class="" style="margin: 15px 0 25px;">
                            <button type="button" class="btn btn-primary" id="clickModal" data-toggle="modal" data-target="#myModal" style="margin-left: 50px;"> Thêm khách hàng</button>
                        </div>
                        <div class="">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã KH</th>
                                        <th scope="col">Họ tên</th>
                                        <!--<th scope="col">Địa chỉ</th>
                                        <th scope="col">Số ĐT</th>-->
                                        <th scope="col">Mã ĐD</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Giá tiền</th>
                                        <th scope="col">Số lượng KS</th>
                                        <th scope="col">Số câu KS</th>
                                        <th scope="col">Chọn</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM customers";
                                    $result = mysqli_query($ketnoi, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['id']; ?></th>
                                            <td><?php echo $row['ho_ten']; ?></td>
                                            <td><?php echo $row['ma_dinh_danh']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['mo_ta']; ?></td>
                                            <td><?php echo $row['gia_tien']; ?></td>
                                            <td><?php echo $row['so_luong_ks']; ?></td>
                                            <td><?php echo $row['so_cau_ks']; ?></td>
                                            <td>
                                                <a href="./edit_customer.php?id= <?= $row['id']; ?>"><i class="fa fa-edit" style="font-size: 17px;"></i></a>
                                                <a onclick="return window.confirm('Bạn muốn xóa không');" href="./delete_customer.php?id= <?= $row['id']; ?>"><i class="fa fa-trash" style="font-size: 17px"></i></a>
                                                <!--<button type="button" class="btn btn-sm btn-primary" id="clickModal" data-toggle="modal" data-target="#myModal2" style="margin-left: 50px;"> Khảo sát</button>-->
                                            </td>
                                            <td>
                                                <?php if ($row['trang_thai'] == 1) : ?>
                                                    <a class="btn btn-sm btn-danger" href="./status.php?id=<?= $row['id'] ?>&status=0">Hủy kích hoạt</a>
                                                <?php else : ?>
                                                    <a class="btn btn-sm btn-success" href="./status.php?id=<?= $row['id'] ?>&status=1">Kích hoạt</a>
                                                <?php endif ?>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php include('./add_customer.php'); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">Thêm mới quyền</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="panel" style="margin: 10px 50px;">
                        <form method="post">
                            <div class="form-group">
                                <label for="name"> Tên quyền: </label>
                                <input type="text" name="name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description"> Mô tả: </label>
                                <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="add-permission" value="1">
                                <input type="submit" class="btn btn-primary" value="Thêm mới" name="submit">
                            </div>
                        </form>
                    </div>

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