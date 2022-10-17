<?php 
							$hostname = "localhost";
							$user = "root";
							$pass = "";
							$database = "csdlweb";
							// tao ket noi
							$ketnoi = new mysqli($hostname, $user, $pass, $database);
                            if($ketnoi -> connect_error){
                                exit('Kết nối không thành công!'.$ketnoi -> connect_error);
                            }
							//mysqli_query($ketnoi,$database);
							
                            
?>