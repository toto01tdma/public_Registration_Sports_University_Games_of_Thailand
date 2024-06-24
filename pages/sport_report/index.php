<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>รายชื่อทีม</title>
  <link rel="shortcut icon" type="image/x-icon" href="">
  <!-- stylesheet -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit" >
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <style>
        .table, tr, th, td{
            border:1px solid black;
        }
  </style>
</head>
<body>
    <div class="container">
        <div class="justify-content-center row">
            <section class="col-lg-12">
                <a href="../sport_register/index.php" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ไปหน้าฟอร์มลงทะเบียน</a>
                <br>
                <br>
                <form action="./" method="get">
                    <div class="col-md-8 px-1 px-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" name="condition_search_by_team_name" maxlength="60" id="" value="" placeholder="-- กรอกชื่อทีมเพื่อค้นหา --" require>
                            <div class="input-group-prepend">
                                <button type="submit" class="input-group-text px-5" style="border-radius:0px 5px 5px 0px; background-color:#28a745; color:white;">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="./" class="btn btn-dark mt-3"><< ดูทีมทั้งหมด >></a>
                <?php
                        require_once("../../service/connect.php");
                        $condition_search_by_sport_type = (isset($_GET['condition_search_by_sport_type'])) ? $_GET['condition_search_by_sport_type'] : "";
                        $obj = new ConnectDatabase();
                        $statment = $obj->getConnect()->prepare("SELECT * FROM sport_type");
                        $statment->execute();
                        while($result = $statment->fetch(PDO::FETCH_ASSOC)){ 
                            $color_btn = ($condition_search_by_sport_type == $result["sport_id"]) ? "btn btn-dark" : "btn btn-secondary" ;?>
                            <a href="./?condition_search_by_sport_type=<?php echo $result["sport_id"]?>" class="<?php echo $color_btn?> mt-3"><?php echo $result["sport_thai_name"]?></a>
                <?php   } ?>
                <div class="card shadow p-3 p-md-4 mt-4">
                <table class="table" id="list_team">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อทีม</th>
                            <th scope="col">ประเภทกีฬา</th>
                            <th scope="col">จำนวนผู้เข้าแข่งขัน</th>
                            <th scope="col">รูปแบบการแข่งขัน (สำหรับกีฬาประเภทสแต็ค)</th>
                            <th scope="col">ดูรายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                if(isset($_GET["condition_search_by_team_name"])){
                                    $statment = $obj->getConnect()->prepare("SELECT * FROM team_lists INNER JOIN sport_type ON sport_type.sport_id = team_lists.sport_type
                                                                            WHERE team_name LIKE :team");
                                    $statment->execute(array(":team" => ("%".$_GET["condition_search_by_team_name"]."%")));
                                }else{
                                    $statment = $obj->getConnect()->prepare("SELECT * FROM team_lists INNER JOIN sport_type ON sport_type.sport_id = team_lists.sport_type
                                                                            WHERE sport_type LIKE :type");
                                    $statment->execute(array(":type" => ("%".$condition_search_by_sport_type."%"))); 
                                }
                                $i = 1;
                                while($result = $statment->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <th> <?php echo $i?> </th>
                                        <td> <?php echo $result["team_name"]?> </td>
                                        <td> <?php echo $result["sport_thai_name"]?> </td>
                                        <td> <?php echo $result["number_people"]?> </td>
                                        <td> <?php echo $result["sport_type_detail"]?> </td>
                                        <td>
                                            <a href="detail.php?id=<?php echo $result["team_id"]?>">
                                                <button type="button" class="btn btn-outline-success">
                                                    ดูรายละเอียด
                                                </button>
                                            </a>
                                        </td> 
                                    </tr>
                        <?php       $i++;
                                }
                        ?>
                    </tbody>
                </table>
                </div>
            </section>
        </div>
    </div>

<!-- scripts -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/adminlte.min.js"></script>

<?php   if(isset($_SESSION["alert"])){ ?>
            <script>
                alert("<?php echo $_SESSION["alert"]?>");
            </script>
<?php       unset($_SESSION["alert"]);
        } ?>

</body>
</html>
