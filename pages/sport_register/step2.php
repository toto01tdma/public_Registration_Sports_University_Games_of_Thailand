<?php
    require_once("../../assets/center.php");
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $statment = $obj->getConnect()->prepare("SELECT * FROM sport_type WHERE sport_id = :sport_id "); // ใส่โค้ด Sql ลงไป
    $statment->execute(array(":sport_id" => $_GET['sport_type']));
    $result = $statment->fetch(PDO::FETCH_ASSOC);

    if($result === false){
        header("location: index.php");
        exit;
    }
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
                        <a href="index.php" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ย้อนกลับ</a>
                        <!-- HTML Form Login --> 
                        <form enctype="multipart/form-data" method="post" onsubmit="return checkBeforeSubmit()" action="step3.php">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12 px-1 px-md-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="sport_type_name" id="sport_type_name" value="ประเภทกีฬา : <?php echo $result["sport_thai_name"]?>" readonly>
                                            <input type="hidden" class="form-control" name="sport_type_id" id="sport_type_id" value="<?php echo $result["sport_id"]?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="team_name">ชื่อทีม (ในนามมหาวิทยาลัย)</label>
                                            <input type="text" class="form-control" name="team_name" id="team_name" onkeyup="checkCharTeamName(); checkBeforeSubmit2();" maxlength="100" placeholder="เช่น มหาวิทยาลัยราชภัฎอุดรธานี" required>
                                            <p id="alertErrorTeamName" style="color:red;"></p>
                                            <p id="alertErrorTeamNameinType" style="color:red; text-align:center;"></p>
                                            <input type="hidden" value="" id="AllowForNotErrorOfTeamName">
                                        </div>
                                        <div class="form-group">
                                            <label for="number_people">จำนวนนักกีฬา </label>
                                            <label for="number_people" style="font-size:90%;">(ส่งรายชื่อนักกีฬาได้ไม่ต่ำกว่า <?php echo $result["min_number_people"]?> คน และไม่เกิน <?php echo $result["max_number_people"]?> คน)</label>
                                            <div class="form-group col-sm-12">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="number_people" id="number_people" min="<?php echo $result["min_number_people"]?>" max="<?php echo $result["max_number_people"]?>" value="<?php echo $result["max_number_people"]?>" required>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text px-2">คน</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p id="alertErrorNumberPeople" style="color:red;"></p>
                                        </div>
                                        <label for="team_managers">ข้อมูลเจ้าหน้าที่ทีม</label>
                                        <label for="team_managers" style="font-size:90%;">(ต้องมีอย่างน้อย 1 คน และไม่เกิน 4 คน)</label>
                                        <?php   $max_team_manager = 4;
                                                for($i = 1; $i < ($max_team_manager+1); $i++){ 
                                                    $disabled = ($i > 1) ? "disabled" : "";
                                                    $display = ($i == 1) ? "display:block;" : "display:none;";
                                                    $required_textBox = ($i == 1) ? "required" : "";
                                                    $text_more_of_textBox = ($i > 1) ? "(หากไม่มีไม่ต้องกรอกก็ได้)" : "(ต้องกรอก)"; ?>
                                                    <div class="form-group" id="form_group_option_at_<?php echo $i?>">
                                                        <input type="text" style="<?php echo $display?>" class="form-control" name="team_manager_name<?php echo $i?>" id="team_manager_name<?php echo $i?>" onkeyup="checkCharTeamManagerName(<?php echo $i?>)" maxlength="50" placeholder="ชื่อ-สกุล เจ้าหน้าที่คนที่ <?php echo $i?> <?php echo $text_more_of_textBox?>" <?php echo $required_textBox?> <?php echo $disabled?> >
                                                        <select class="form-control" style="<?php echo $display?>" name="team_manager_role<?php echo $i?>" id="team_manager_role<?php echo $i?>" onchange="showInputBoxForOther(<?php echo $i?>)" required <?php echo $disabled?> >
                                                            <option value disabled selected>-- หน้าที่ --</option>
                                                            <option value="ผู้จัดการทีม">ผู้จัดการทีม</option>
                                                            <option value="ผู้ฝึกสอน">ผู้ฝึกสอน</option>
                                                            <option value="ผู้ช่วยผู้ฝึกสอน">ผู้ช่วยผู้ฝึกสอน</option>
                                                            <option value="นักกายภาพบำบัด">นักกายภาพบำบัด</option>
                                                            <option value="นักกีฬาสำรอง">นักกีฬาสำรอง</option>
                                                            <option value="other">อื่นๆ</option>
                                                        </select>
                                                        <input type="text" class="form-control" name="team_manager_role_other<?php echo $i?>" id="team_manager_role_other<?php echo $i?>" style="display:none;" onkeyup="" maxlength="30" placeholder="โปรดระบุหน้าที่" required disabled>
                                                        <p id="alertErrorManagerTeamName<?php echo $i?>" style="color:red;"></p>
                                                        <?php if($i != $max_team_manager){ ?>
                                                                <div class="btn btn-success mt-3 btn-block" id="btn_showFormGroupOption<?php echo $i?>" style="<?php echo $display?>" onclick="showOptionNextTeamManager(<?php echo ($i+1)?>)">เพิ่มฟอร์มกรอกข้อมูลเจ้าหน้าที่ คนที่ <?php echo ($i+1)?></div>
                                                        <?php } ?>
                                                    </div>
                                        <?php   } ?>
                                        <div id="formForStack" class="card pl-3 pr-3 pt-3">
                                            <h5><b>ข้อมูล ผู้ประสานงาน</b></h5>
                                            <div class="form-group">
                                                <label for="coordinator_name">ชื่อ-สกุล ผู้ประสานงาน</label>
                                                <input type="text" class="form-control" name="coordinator_name" id="coordinator_name" onkeyup="checkCharCoordinatorName();" maxlength="60" placeholder="ชื่อ-สกุล ผู้ประสานงาน" required>
                                                <p id="alertErrorCoordinatorName" style="color:red;"></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">อีเมลติดต่อ ผู้ประสานงาน</label>
                                                <input type="email" class="form-control" name="coordinator_email" id="coordinator_email" onkeyup="" maxlength="240" placeholder="อีเมลติดต่อ" required>
                                                <p id="alertErrorCoordinatorEmail" style="color:red;"></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">เบอร์โทรศัพท์ติดต่อ ผู้ประสานงาน</label>
                                                <input type="phone" class="form-control" name="coordinator_phonenumber" id="coordinator_phonenumber" onkeyup="checkCharCoordinatorPhoneNumber();" maxlength="10" placeholder="เบอร์โทรศัพท์ติดต่อ" required>
                                                <p id="alertErrorCoordinatorPhoneNumber" style="color:red;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="background-color:inherit;">
                                <button type="submit" class="btn btn-primary btn-block mx-auto w-50" name="submit" id="btn_submit">ไปขั้นตอนต่อไป &#10095;&#10095;&#10095;</button>
                            </div>
                        </form>
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
    function showInputBoxForOther(ind){
        let val = document.getElementById("team_manager_role"+ind).value;
        if(val == "other"){
            document.getElementById("team_manager_role_other"+ind).setAttribute("style", "display:block;");
            document.getElementById("team_manager_role_other"+ind).removeAttribute("disabled");
        }else{
            document.getElementById("team_manager_role_other"+ind).setAttribute("style", "display:none;");
            document.getElementById("team_manager_role_other"+ind).setAttribute("disabled", "");
        }
    }

    function showOptionNextTeamManager(ind){
        document.getElementById("team_manager_role"+ind).setAttribute("style", "display:block;");
        document.getElementById("team_manager_name"+ind).setAttribute("style", "display:block;");
        document.getElementById("team_manager_name"+ind).removeAttribute("disabled");
        if(ind != <?php echo $max_team_manager?>){
            document.getElementById("btn_showFormGroupOption"+ind).setAttribute("style", "display:block;");
            document.getElementById("btn_showFormGroupOption"+(ind-1)).setAttribute("style", "display:none;");
        }
        if(ind == <?php echo $max_team_manager?>) { document.getElementById("btn_showFormGroupOption"+(ind-1)).setAttribute("style", "display:none;"); }
    }

    function checkCharTeamName(){
        let notError = true;
        let name = document.getElementById("team_name").value;
        if(name != ""){
            if(isNaN(name)){
                document.getElementById("alertErrorTeamName").innerHTML = "";    
            }else{
                document.getElementById("alertErrorTeamName").innerHTML = "** ชื่อทีมห้ามเป็นตัวเลขทั้งหมด **";
                notError = false;
            }
        }else{
            document.getElementById("alertErrorTeamName").innerHTML = "";
            notError = false; 
        }
        return notError;
    }

    function checkCharTeamManagerName(ind){
        let notError = true;
        let name = document.getElementById("team_manager_name"+ind).value;
        if(ind > 1){
            if(name != ""){ document.getElementById("team_manager_role"+ind).removeAttribute("disabled"); }
            else{ document.getElementById("team_manager_role"+ind).setAttribute("disabled", ""); } 
        }
        if(name != ""){
            if(isNaN(name)){
                document.getElementById("alertErrorManagerTeamName"+ind).innerHTML = "";    
            }else{
                document.getElementById("alertErrorManagerTeamName"+ind).innerHTML = "** ชื่อห้ามเป็นตัวเลขทั้งหมด **";
                notError = false;
            }
        }else{
            document.getElementById("alertErrorManagerTeamName"+ind).innerHTML = "";
        }
        return notError;
    }

    function checkCharCoordinatorName(){
        let notError = true;
        let name = document.getElementById("coordinator_name").value; 
        if(name != ""){
            if(isNaN(name)){
                document.getElementById("alertErrorCoordinatorName").innerHTML = "";    
            }else{
                document.getElementById("alertErrorCoordinatorName").innerHTML = "** ชื่อห้ามเป็นตัวเลขทั้งหมด **";
                notError = false;
            }
        }else{
            document.getElementById("alertErrorCoordinatorName").innerHTML = "";
        }
        return notError;
    }

    function checkBeforeSubmit2(){
        let CheckNotError = true;

        let v_team = document.getElementById("team_name").value;
        let v_type_id = document.getElementById("sport_type_id").value;
        let v_type_name = document.getElementById("sport_type_name").value;

        $.ajax({
            type: "POST",
            url: "../../service/checkform/CheckForDuplicatesOfData.php", // end point api คือส่ง api ไปยังปลายทางที่ระบุไว้
            data: { team : v_team,
                    type : v_type_id}
        }).done(function(resp) {
            document.getElementById("alertErrorTeamNameinType").innerHTML = ""; 
            document.getElementById("AllowForNotErrorOfTeamName").value = "true";
        }).fail(function(resp) {
            document.getElementById("alertErrorTeamNameinType").innerHTML = '** ทีม '+v_team+' ได้ลงทะเบียน'+v_type_name+' แล้ว กรุณาเลือกประเภทกีฬาอื่นๆ **';
            document.getElementById("AllowForNotErrorOfTeamName").value = "false";
        })

        CheckNotError = (document.getElementById("AllowForNotErrorOfTeamName").value == "true" && checkCharTeamName()) ? true : false;
        return CheckNotError;
    }

    function checkBeforeSubmit(){
        let notError = true;
        let notErrorTeamName = checkBeforeSubmit2(); // เช็คว่าชื่อทีมนี้ลงประเภทกีฬานี้หรือยัง
        let notErrorPhoneNumber = checkCharCoordinatorPhoneNumber(); // เช็คว่าเบอรโทรศัพท์ผ้ประสานงานถูกต้องหรือไม่
        let notErrorTeamManagerName = true;
        for(let i = 0; i < <?php echo $max_team_manager?>; i++){ // เช็คว่าชื่อเจ้าหน้าที่ดูแลทีมเป็นตัวเลขหรือไม่
            if(checkCharTeamManagerName(i+1) === false){
                notErrorTeamManagerName = false;
            }
        }
        let notErrorCoordinatorName = checkCharCoordinatorName(); // เช็คว่าชื่อผู้ประสานงานเป็นตัวเลขหรือไม่

        if((notErrorTeamName && notErrorTeamManagerName && notErrorCoordinatorName && notErrorPhoneNumber) === false){
            notError = false;
            Swal.fire({ 
                text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ', 
                icon: 'error', 
                confirmButtonText: 'ตกลง', 
            })
        }
        return notError;
    }

    function checkCharCoordinatorPhoneNumber(){
        let notError = true;
        let phone = document.getElementById("coordinator_phonenumber").value;

        if(isNaN(phone) && phone != ""){
            document.getElementById("alertErrorCoordinatorPhoneNumber").innerHTML = "** ห้ามกรอกเป็นตัวอักษรอื่นนอกจากตัวเลขเท่านั้น **";
            notError = false;           
        }else if(phone.length < 10){
            document.getElementById("alertErrorCoordinatorPhoneNumber").innerHTML = "** กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก **";
            notError = false;
        }else{
            document.getElementById("alertErrorCoordinatorPhoneNumber").innerHTML = "";
        }
        return notError;
    }
    checkCharCoordinatorPhoneNumber();

    function checkMaxAndMinPeople(){
        let people = document.getElementById("number_people").value;

        people = parseInt(people);
        if(people < <?php echo $result["min_number_people"]?>){
            document.getElementById("number_people").value = "<?php echo $result["min_number_people"]?>";
        }
        if(people > <?php echo $result["max_number_people"]?>){
            document.getElementById("number_people").value = <?php echo $result["max_number_people"]?>;
        }
    }

    $(function() {
        $("#number_people").change(function() {
            checkMaxAndMinPeople();
        });

        $("#number_people").keyup(function() {
            checkMaxAndMinPeople();
        });
    })

</script>
</body>
</html>
