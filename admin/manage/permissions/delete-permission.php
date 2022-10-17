<?php
    include '../../../connectDB/ConnectDB.php';
    if (isset($_GET['id'])) 
        {
            $id = $_GET['id'];
            $sql = "DELETE FROM permissions WHERE id = '$id'";
            $query  = mysqli_query($ketnoi, $sql);
            if ($query) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            else {
                header('Location: ' . $_SERVER['HTTP_REFERER']); // return back
                exit;
            }
        }
?>