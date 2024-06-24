<?php 
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $statment = $obj->getConnect()->prepare("SELECT * FROM team_lists INNER JOIN sport_type ON sport_type.sport_id = team_lists.sport_type
                                             WHERE team_lists.team_id LIKE :id");
    $statment->execute(array(":id" => $_GET["id"]));
    $result = $statment->fetch(PDO::FETCH_ASSOC);
    if($result == false){
        header("location: index.php");
        exit;
    }
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
            <section class="col-lg-14">
                <a href="index.php" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ย้อนกลับ</a>

                <div class="card shadow p-3 p-md-4 mt-4">
                    <div class="form-group ">
                        <input type="text" class="form-control" value="กีฬา : <?php echo $result["sport_thai_name"]?>" readonly>
                    </div>
                    <div class="form-group ">
                        <?php if($result["team_manager_01"] != ""){ ?>
                                <input type="text" class="form-control" value="เจ้าหน้าที่คนที่ 1 : <?php echo $result["team_manager_01"]?>" readonly>
                        <?php } 
                              if($result["team_manager_02"] != ""){ ?>
                                <input type="text" class="form-control" value="เจ้าหน้าที่คนที่ 2 : <?php echo $result["team_manager_02"]?>" readonly>
                        <?php }
                              if($result["team_manager_03"] != ""){ ?>
                                <input type="text" class="form-control" value="เจ้าหน้าที่คนที่ 3 : <?php echo $result["team_manager_03"]?>" readonly>
                        <?php }
                              if($result["team_manager_04"] != ""){ ?>
                                <input type="text" class="form-control" value="เจ้าหน้าที่คนที่ 4 : <?php echo $result["team_manager_04"]?>" readonly>
                        <?php } ?>
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control" value="ชื่อ-สกุลผู้ประสานงาน : <?php echo $result["coordinator_name"]?>" readonly>
                        <input type="text" class="form-control" value="อีเมลติดต่อผู้ประสานงาน : <?php echo $result["coordinator_email"]?>" readonly>
                        <input type="text" class="form-control" value="เบอร์โทรศัพท์ติดต่อผู้ประสานงาน : <?php echo $result["coordinator_phonenumber"]?>" readonly>
                    </div>
                </div>
                
                <div class="card shadow p-3 p-md-4 mt-4">
                    <table class="table" id="list_team">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับผู้ร่วมแข่งขัน</th>
                                <th scope="col">ชื่อผู้เข้าแข่งขัน</th>
                                <th scope="col">รูปถ่ายผู้เข้าแข่งขัน</th>
                                <th scope="col">รูปสำเนาบัตร</th>
                                <th scope="col">รูปบัตรนักศึกษา</th>
                                <th scope="col">รูปผลเกรด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $obj = new ConnectDatabase();
                                    $statment = $obj->getConnect()->prepare("SELECT * FROM sub_image WHERE team LIKE :team");
                                    $statment->execute(array(":team" => $_GET["id"]));
                                    $i = 1;
                                    while($result = $statment->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <th> <?php echo $i?> </th>
                                            <td> <?php echo $result["contestant_name"]?> </td>
                                            <td> <a href="../../assets/data/cover/<?php echo $result["cover"]?>" target="_blank"><img alt="ไฟล์ที่ไม่ใช่ .jpg .png .gift และ .jpeg จะไม่แสดงรูป แต่มีไฟล์อยู่ในระบบแล้ว คลิกดูได้เลย" src="../../assets/data/cover/<?php echo $result["cover"]?>" width="150px" height="150px"></td> </a>
                                            <td> <a href="../../assets/data/card/<?php echo $result["card"]?>" target="_blank"><img alt="ไฟล์ที่ไม่ใช่ .jpg .png .gift และ .jpeg จะไม่แสดงรูป แต่มีไฟล์อยู่ในระบบแล้ว คลิกดูได้เลย" src="../../assets/data/card/<?php echo $result["card"]?>" width="105px" height="149px"> </td> </a>
                                            <td> <a href="../../assets/data/card_student/<?php echo $result["card_student"]?>" target="_blank"><img alt="ไฟล์ที่ไม่ใช่ .jpg .png .gift และ .jpeg จะไม่แสดงรูป แต่มีไฟล์อยู่ในระบบแล้ว คลิกดูได้เลย" src="../../assets/data/card_student/<?php echo $result["card_student"]?>" width="108px" height="68px"> </td> </a>
                                            <td> <a href="../../assets/data/grade/<?php echo $result["grade"]?>" target="_blank"><img alt="ไฟล์ที่ไม่ใช่ .jpg .png .gift และ .jpeg จะไม่แสดงรูป แต่มีไฟล์อยู่ในระบบแล้ว คลิกดูได้เลย" src="../../assets/data/grade/<?php echo $result["grade"]?>"  width="105px" height="149px"> </td> </a>
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
