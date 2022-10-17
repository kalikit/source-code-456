<?php
session_start();
ob_start();
include('../../../connectDB/ConnectDB.php');
include("../../nav_employee.php");
//----------phan trang survey ---------
                        $sql = "select count(id) as total from surveys";
                        $result = mysqli_query($ketnoi, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $total_records = $row['total'];
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit = 3;
                        $total_page = ceil($total_records / $limit);
                        if ($current_page > $total_page) {
                            $current_page = $total_page;
                        } else if ($current_page < 1) {
                            $current_page = 1;
                        }

                        $start = ($current_page - 1) * $limit;

//----------phan trang form survey ---------
                        $sql2 = "select count(id) as total from form_survey";
                        $result2 = mysqli_query($ketnoi, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $total_records2 = $row2['total'];
                        $current_page2 = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit2 = 3;
                        $total_page2 = ceil($total_records2 / $limit2);
                        if ($current_page2 > $total_page2) {
                            $current_page2 = $total_page2;
                        } else if ($current_page2 < 1) {
                            $current_page2 = 1;
                        }

                        $start2 = ($current_page2 - 1) * $limit2;
                        
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

                        <h3 style="text-align: center; margin-top: 30px;"> Danh sách người tham gia khảo sát </h3>
                        <div class="" style="margin: 15px 0 25px;">
                            <button type="button" class="btn btn-primary" id="clickModal" data-toggle="modal" data-target="#myModal" style="margin-left: 50px;"> Thêm người khảo sát</button>
                        </div>
                        <div class="">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên đăng nhập</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số ĐT</th>
                                        <th scope="col">Thông tin khác</th>
                                        <th scope="col">Chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM surveys LIMIT $start, $limit";
                                    $result = mysqli_query($ketnoi, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $row['user']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['number']; ?></td>
                                            <td><?php echo $row['infor']; ?></td>
                                            <td>
                                                <a href="./edit_survey.php?id= <?= $row['id']; ?>"><i class="fa fa-edit" style="font-size: 17px;"></i></a>&ensp;
                                                <a onclick="return window.confirm('Bạn muốn xóa không');" href="./delete_survey.php?id= <?= $row['id']; ?>"><i class="fa fa-trash" style="font-size: 17px"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <nav aria-label="Page navigation example" style="margin: 15px 20px 10px 0;">
                            <ul class="pagination justify-content-end">

                                <li class="page-item"><?php
                                    if ($current_page > 1 && $total_page > 1) {
                                        echo '<a class="page-link" aria-label="Previous" href="survey.php?page=' . ($current_page - 1) . '">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a> ';
                                    } else {
                                        echo '<a class="page-link" aria-label="Previous" href="survey.php?page=' . ($current_page - 1) . '">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a> ';
                                    }
                                    ?>
                                </li>

                                <li class="page-item" style="display: flex;">
                                    <?php for ($i = 1; $i <= $total_page; $i++) {
										if ($i == $current_page) {
											echo '<a class="page-link" href="survey.php" style="background-color: #6666CC; color: white;">' . $i . '</a> ';
										} else {
											echo '<a class="page-link" href="survey.php?page=' . $i . '" >' . $i . '</a> ';
										}
									}
                                    ?>
                                </li>

                                <li class="page-item">
                                    <?php if ($current_page < $total_page && $total_page > 1) {
										echo '<a class="page-link" aria-label="Next" href="survey.php?page=' . ($current_page + 1) . '">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a> ';
									}
									?>
                                </li>

                            </ul>
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--danh sach ket qua khao sat------>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-10 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">

                        <h3 style="text-align: center; margin-top: 30px;"> Kết quả khảo sát </h3>
                        <div class="">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Câu 1</th>
                                        <th scope="col">Câu 2</th>
                                        <th scope="col">Câu 3</th>
                                        
                                        <th scope="col">Câu 4</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM form_survey LIMIT $start2, $limit2";
                                    $result = mysqli_query($ketnoi, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['question1']; ?></td>
                                            <td><?php echo $row['question2']; ?></td>
                                            <td><?php echo $row['question3']; ?></td>
                                            <td><?php echo $row['question4']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <nav aria-label="Page navigation example" style="margin: 15px 20px 10px 0;">
                            <ul class="pagination justify-content-end">

                                <li class="page-item"><?php
                                    if ($current_page2 > 1 && $total_page2 > 1) {
                                        echo '<a class="page-link" aria-label="Previous" href="survey.php?page=' . ($current_page2 - 1) . '">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a> ';
                                    } else {
                                        echo '<a class="page-link" aria-label="Previous" href="survey.php?page=' . ($current_page2 - 1) . '">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a> ';
                                    }
                                    ?>
                                </li>

                                <li class="page-item" style="display: flex;">
                                    <?php for ($i = 1; $i <= $total_page2; $i++) {
										if ($i == $current_page2) {
											echo '<a class="page-link" href="survey.php" style="background-color: #6666CC; color: white;">' . $i . '</a> ';
										} else {
											echo '<a class="page-link" href="survey.php?page=' . $i . '" >' . $i . '</a> ';
										}
									}
                                    ?>
                                </li>

                                <li class="page-item">
                                    <?php if ($current_page2 < $total_page2 && $total_page2 > 1) {
										echo '<a class="page-link" aria-label="Next" href="survey.php?page=' . ($current_page2 + 1) . '">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a> ';
									}
									?>
                                </li>

                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php include('./add_survey.php'); ?>

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