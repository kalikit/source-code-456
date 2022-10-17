
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../assets/css/form_survey.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <title>Form khảo sát</title>
</head>

<body>
    <?php
    include("../../../connectDB/ConnectDB.php");
    if (isset($_POST["btn_submit"])) {
            $name = $_POST['name'];
            if(isset($_POST['question1'])){
                $question1 = $_POST['question1'];
            }  else {
                $question1 = false;
            }
            if(isset($_POST['question2'])){
                $question2 = $_POST['question2'];
            }  else {
                $question2 = false;
            }
            if(isset($_POST['question3'])){
                $question3 = $_POST['question3'];
            }  else {
                $question3 = false;
            }
            if(isset($_POST['question4'])){
                $question4 = $_POST['question4'];
            }  else {
                $question4 = false;
            }
            $sql = "INSERT INTO form_survey(name, question1, question2, question3, question4) VALUE ('$name', '$question1','$question2','$question3', '$question4')";
            $insert = mysqli_query($ketnoi, $sql);
            if ($insert == true) {
                echo '<script>alert("Khảo sát thành công")</script>';
                ?>
                <script src="../../../assets/js/hideForm.js"></script>
                <?php
            } else { ?>
                <script>
                    alert("Lỗi!");
                </script>
               <?php exit;
            } 
        }
        ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-8 col-lg-6 col-xl-7">
                <div class="my-4">
                    <h5>Mẫu khảo sát</h5>
                </div>
                <form action="" method="POST">
                    <div class="row form_main">
                        <div class="form-group">
                            <label for="name">Họ tên:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Câu 1: Quý khách hàng lựa chọn các báo cáo theo tần suất?:</label><br>
                            <div class="row">
                                <div class="col-sm-3 col-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question1" id="gridRadios1" value="Tuần" >
                                    <label class="form-check-label" for="gridRadios1">
                                        Tuần
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question1" id="gridRadios2" value="Quý">
                                    <label class="form-check-label" for="gridRadios2">
                                        Quý
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question1" id="gridRadios3" value="Tháng">
                                    <label class="form-check-label" for="gridRadios3">
                                        Tháng
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question1" id="gridRadios4" value="Năm">
                                    <label class="form-check-label" for="gridRadios4">
                                        Năm
                                    </label>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="form-group form-check">
                            <label for="">Câu 2: Quý khách hàng sử dụng các thông tin trong báo cáo cho mục đích gì?:</label><br>
                            <input type="radio" id="" name="question2" value="Xây dựng kế hoạch kinh doanh hàng quý/hàng năm">
                            <label for="option1"> Xây dựng kế hoạch kinh doanh hàng quý/hàng năm</label><br>
                            <input type="radio" id="" name="question2" value="Xây dựng dự án đầu tư">
                            <label for="option2"> Xây dựng dự án đầu tư</label><br>
                            <input type="radio" id="" name="question2" value=" Viết báo cáo tư vấn/ báo cáo phân tích">
                            <label for="option3"> Viết báo cáo tư vấn/ báo cáo phân tích</label><br>
                            <input type="radio" id="" name="question2" value="Tham khảo cho đề tài/luận văn/luận án/bài báo">
                            <label for="option4"> Tham khảo cho đề tài/luận văn/luận án/bài báo</label><br>
                        </div>
                        <div class="form-group form-check">
                            <label for="">Câu 3: Theo Quý khách hàng, các báo cáo cần bổ sung, điều chỉnh như thế nào?:</label><br>
                            <input type="radio" id="" name="question3" value="Phân tích chuyên sâu hơn">
                            <label for="option1"> Phân tích chuyên sâu hơn</label><br>
                            <input type="radio" id="" name="question3" value="Giảm phân tích, tăng số liệu">
                            <label for="option2"> Giảm phân tích, tăng số liệu</label><br>
                            <input type="radio" id="" name="question3" value="Cung cấp thông tin doanh nghiệp">
                            <label for="option3"> Cung cấp thông tin doanh nghiệp</label><br>
                            <input type="radio" id="" name="question3" value="Số liệu cần cập nhật hơn">
                            <label for="option4"> Số liệu cần cập nhật hơn</label><br>
                            <input type="radio" id="" name="question3" value="Báo cáo cần súc tích hơn">
                            <label for="option5"> Báo cáo cần súc tích hơn</label><br>
                        </div>
                        <div class="form-group">
                            <label for="">Câu 4: Quý khách hàng lựa chọn các báo cáo theo tần suất?:</label><br>
                            <div class="row">
                                <div class="col-sm-3 col-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question4" id="gridRadios1" value="Có" >
                                    <label class="form-check-label" for="gridRadios1">
                                        Có
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question4" id="gridRadios2" value="Không">
                                    <label class="form-check-label" for="gridRadios2">
                                        Không
                                    </label>
                                    </div>
                                </div>
                             </div>
                        </div>

                        <button type="submit" onclick="click()" class="btn btn-primary btn_login" name="btn_submit">Nộp biểu mẫu</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

        <h2 class="alert">Cảm ơn bạn đã tham gia khảo sát</h2>
    
</body>

</html>