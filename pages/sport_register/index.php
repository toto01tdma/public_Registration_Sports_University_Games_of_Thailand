<?php
    require_once("../../assets/center.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> <?php echo $text_header?> </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/<?php echo $logo_01?>">
  <!-- stylesheet -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit"> -->
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="../../assets/css/style1.css">
  <style>
        *{font-family: tahoma;}
  </style>
</head>
<body>
<header class="bg"></header>
    <section class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <section class="col-lg-6">
                    <div class="card shadow p-3 p-md-4 mt-4">
                        <div class="text-center">
                            <img src="../../assets/images/<?php echo $logo_01?>" width="100px" height="140px" class="rounded" alt="...">
                        </div>
                        <h3 class="text-center text-primary font-weight-bold"> <?php echo $text_header?> </h3>
                        <div class="card-body">
                            <a href="../sport_report/" class="btn btn-dark mt-3">ดูรายชื่อทีมที่ลงทะเบียน</a>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12 px-1 px-md-5">
                                        <?php
                                            require_once("../../service/connect.php");
                                                $obj = new ConnectDatabase();
                                                $statment = $obj->getConnect()->prepare("SELECT * FROM sport_type"); // ใส่โค้ด Sql ลงไป
                                                $statment->execute(); ?>
                                        <?php   while($row = $statment->fetch(PDO::FETCH_ASSOC)){ ?>
                                                    <div class="text-center card">
                                                        <a href="step2.php?sport_type=<?php echo $row["sport_id"] ?>">
                                                            <img src="../../assets/sport_type_image/<?php echo $row["sport_type_image"] ?>" alt="" width="50%" height="50%">
                                                        </a>
                                                    </div>
                                        <?php   } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

<!-- script -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    function openButton(){
        document.getElementById("btn_submit").removeAttribute("disabled");
    }
</script>

<?php   if(isset($_SESSION["alert"])){ ?>
            <script>
                alert("<?php echo $_SESSION["alert"]?>");
            </script>
<?php       unset($_SESSION["alert"]);
        } ?>
</body>
</html>
