<?php
session_start();
ob_start();
include '../connectDB/ConnectDB.php';
include "nav_employee.php";
$auth_id = $_SESSION['auth_user']['id'];
$sql = "SELECT
		GROUP_CONCAT(permissions.name) as permission_name,
		user_has_roles.user_id,
		roles.name as role_name,
		roles.id as role_id
		FROM user_has_roles 
		LEFT JOIN roles ON roles.id = user_has_roles.role_id
    LEFT JOIN role_has_permissions ON role_has_permissions.role_id = roles.id
    LEFT JOIN permissions ON role_has_permissions.permission_id = permissions.id
		WHERE user_has_roles.user_id = '$auth_id'
		GROUP BY roles.id";
    $query  = mysqli_query($ketnoi, $sql);
    $num_rows  = mysqli_num_rows($query);

    $data = array();
    if ($num_rows > 0) {
      while ($row = mysqli_fetch_array($query)) {
        $data[] = [
          'role_name' => $row['role_name'],
          'permissions' => explode(',', $row['permission_name']),
        ];
      }
    }
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Hệ Thống Quản Trị</title>
  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../assets/css/home.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
</head>

<body>

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-10 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">

            <h1 style="font-size: 25px; margin: 20px 0 0 20px">Xin chào <?= $_SESSION['auth_user']['name'] ?>!</h1>
            <div class="panel" style="box-shadow: none; margin: 20px">
              
              <div class="box__role_permission col-md-12" style="padding-top:30px;">
                <?php if (count($data) > 0) { ?>
                  <h3> Bạn có thể thực hiện: </h3>
                  <?php // $value = $data['role_name'];
                  foreach ($data as $item) { ?>
                    <div class="col-md-12">
                      <div class="panel panel-info">
                        <h4 class="panel-heading">Vai trò: </h4>
                        <div class="panel-body">
                          <ul>
                              <li style="font-size: 18px;"><?php echo $item['role_name']; ?></li>
                          </ul>
                        </div>

                        <h4 class="panel-heading">Quyền: </h4>
                        <div class="panel-body">
                          <?php foreach ($item['permissions'] as $item_pms) { ?>
                            <div class="col-md-3">
                              <ul>
                                <li style="font-size: 18px;"><?php echo $item_pms; ?></li>
                              </ul>
                            </div>
                          <?php } ?>
                        </div>
                        
                      </div>
                    </div>
                  <?php } ?>
                <?php  } else { ?>
                  <p> Chưa có vai trò nào trong hệ thống!</p>
                <?php } ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- build:js assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../assets/vendor/js/menu.js"></script>
  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/dashboards-analytics.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>