<?php
    if(!($_SERVER['REQUEST_METHOD'] === "POST")){   header("location: index.php"); exit;}
    require_once("../../assets/center.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ลงทะเบียนกีฬาสาธิต กีฬามหาลัยแห่งประเทศไทยครั้งที่ 48</title>
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
    <form action="../../service/save/" enctype="multipart/form-data" method="post" onsubmit="return checkBeforeSubmit()">
        <section class="d-flex align-items-center min-vh-100">
            <div class="container">
                <div class="row justify-content-center">
                    <section class="col-lg-6">
                        <div class="card shadow p-3 p-md-4 mt-4">
                        <div class="text-center">
                            <img src="../../assets/images/<?php echo $logo_01?>" width="100px" height="140px" class="rounded" alt="...">
                        </div>
                        <h3 class="text-center text-primary font-weight-bold">ลงทะเบียนกีฬาสาธิต กีฬามหาลัยแห่งประเทศไทยครั้งที่ 48</h3>
                        <div class="card-body">
                            <a href="step2.php" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ย้อนกลับ</a>
                            <!-- HTML Form -->
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12 px-1 px-md-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="team_name" name="team_name" value="<?php echo $_POST["team_name"]?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="sport_type_name" id="sport_type_name" value="<?php echo $_POST["sport_type_name"]?>" readonly>
                                                <input type="hidden" class="form-control" name="sport_type_id" id="sport_type_id" value="<?php echo $_POST["sport_type_id"]?>" readonly>
                                            </div>

                                            <div onclick="document.getElementById('groupDataForShowAndHide').classList.toggle('d-none')" class="btn btn-dark mt-1 mb-2">แสดง/ซ่อนข้อมูล</div>

                                            <div id="groupDataForShowAndHide" class="d-none card pl-3 pr-3 pt-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="number_people" value="มีผู้เข้าแข่งขัน : <?php echo $_POST["number_people"]?> คน" readonly>
                                                    <input type="hidden" class="form-control" name="number_people" value="<?php echo $_POST["number_people"]?>" readonly>
                                                </div>
                                                <?php   $ind = 1;
                                                        for($i = 1; $i < (4+1); $i++){
                                                            if(isset($_POST["team_manager_name".$i])){
                                                                if($_POST["team_manager_name".$i] != ""){ ?>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="team_manager_name<?php echo $ind?>" value="เจ้าหน้าที่คนที่ <?php echo $ind." ".$_POST['team_manager_name'.$i]?>" readonly>
                                                                        <input type="hidden" class="form-control" name="team_manager_name<?php echo $ind?>" value="<?php echo $_POST['team_manager_name'.$i]?>" readonly>
                                                                        <?php if(isset($_POST["team_manager_role_other".$i])){ ?>
                                                                            <input type="text" class="form-control" id="team_manager_role<?php echo $ind?>" value="หน้าที่ : <?php echo $_POST["team_manager_role_other".$i]?>" readonly>
                                                                            <input type="hidden" class="form-control" name="team_manager_role<?php echo $ind?>" value="<?php echo $_POST["team_manager_role_other".$i]?>" readonly>
                                                                        <?php }else{ ?>
                                                                            <input type="text" class="form-control" id="team_manager_role<?php echo $ind?>" value="หน้าที่ : <?php echo $_POST['team_manager_role'.$i]?>" readonly>
                                                                            <input type="hidden" class="form-control" name="team_manager_role<?php echo $ind?>" value="<?php echo $_POST['team_manager_role'.$i]?>" readonly>
                                                                        <?php } ?>
                                                                    </div>
                                                <?php           $ind += 1;
                                                                }
                                                            }
                                                        } ?>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="coordinator_name" value="ผู้ประสานงาน : <?php echo $_POST["coordinator_name"]?>" readonly>
                                                    <input type="hidden" class="form-control" name="coordinator_name" value="<?php echo $_POST["coordinator_name"]?>" readonly>

                                                    <input type="text" class="form-control" id="coordinator_email" value="อีเมลติดต่อผู้สานงาน : <?php echo $_POST["coordinator_email"]?>" readonly>
                                                    <input type="hidden" class="form-control" name="coordinator_email" value="<?php echo $_POST["coordinator_email"]?>" readonly>
                                                    
                                                    <input type="text" class="form-control" id="coordinator_phonenumber" value="เบอร์โทรติดต่อผู้สานงาน : <?php echo $_POST["coordinator_phonenumber"]?>" readonly>
                                                    <input type="hidden" class="form-control" name="coordinator_phonenumber" value="<?php echo $_POST["coordinator_phonenumber"]?>" readonly>
                                                </div>
                                            </div>
                                            <?php   if($_POST["sport_type_id"] == "4"){ ?>
                                                        <div id="formForStack" class="card pl-3 pr-3 pt-3">
                                                            <h5>รูปแบบการแข่งขัน สแต็ค</h5>
                                                            <label for="type_stack">(สามารถเลือกได้มากกว่า 1 ประเภท)</label>
                                                            <p id="alertErrorSub_stack" style="color:red;"></p>
                                                            <?php
                                                                    require_once("../../service/connect.php");
                                                                    $obj = new ConnectDatabase();
                                                                    $statment = $obj->getConnect()->prepare("SELECT * FROM sub_sport_type_of_stack"); // ใส่โค้ด Sql ลงไป
                                                                    $statment->execute();
                                                                    $count_of_row_sub_stack = 0;
                                                                    while($result_sub_stack = $statment->fetch(PDO::FETCH_ASSOC)){
                                                                        $count_of_row_sub_stack += 1;
                                                                        if($count_of_row_sub_stack == 1){ continue;}
                                                                        $disabled = "";
                                                                        if($result_sub_stack["min_number_people_of_sub_stack"] != ""){
                                                                            if($_POST["number_people"] < $result_sub_stack["min_number_people_of_sub_stack"]){
                                                                                $disabled = "disabled";
                                                                            }
                                                                        } ?>
                                                                        <div class="form-group">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" onclick="check_checkBox();" <?php echo $disabled?> class="form-check-input ml-1" name="sub_stack<?php echo $count_of_row_sub_stack?>" id="sub_stack<?php echo $count_of_row_sub_stack?>" style="width:20px; height:20px;" value="<?php echo $result_sub_stack["type_of_stack_name"]?>" >
                                                                                <label class="form-check-label ml-5" for="sub_stack<?php echo $count_of_row_sub_stack?>"><?php echo $result_sub_stack["type_of_stack_name"]?></label>
                                                                            </div>
                                                                        </div>
                                                            <?php   } ?>
                                                            <input type="hidden" for="type_stack" name="num_of_checkbox" value="<?php echo ($count_of_row_sub_stack-1)?>">
                                                            <label for="type_stack">ประเภทคู่ ต้องมีผู้เข้าแข่งขัน 2 คนขึ้นไป</label>
                                                            <label for="type_stack">ประเภททีมผสม ต้องมีผู้เข้าแข่งขัน 4 คนขึ้นไป</label>
                                                        </div>
                                            <?php   } ?>
                                            <?php for($i = 1; $i <= $_POST["number_people"]; $i++){ ?>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">คนที่ <?php echo $i?></span>
                                                        </div>
                                                        <input type="text" onkeyup="checkCharContestantName('<?php echo $i?>');" class="form-control" name="contestant_name<?php echo $i?>" id="contestant_name<?php echo $i?>" value="" placeholder="กรอกชื่อ-สกุล ผู้เข้าแข่งขันคนที่ <?php echo $i?>" required>
                                                        <div class="input-group-append">
                                                            <a href="#headerFormUploadAll">
                                                                <div class="input-group-text px-2" style="cursor:pointer;"onclick="showFormUpload('<?php echo $i?>')">อัพรูป</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <p id="alertErrorContestantName<?php echo $i?>" style="color:red;"></p>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group col-sm-12">
                                                <button class="btn btn-primary mt-3" onclick="clickForCheckErrorUpFile();" type="submit">ลงทะเบียน</button>
                                                <p> ในกรณีที่<span style="color:red; font-weight:bold;">ไม่สามารถ</span>กดปุ่ม "ลงทะเบียน" ได้ ต้องกลับไปตรวจสอบว่าอัพรูปข้อมูลผู้เข้าแข่งขันครบหรือยัง ถ้าครบแล้วจะสามารถกดได้</p>
                                                <p id="textErrorUpFile" style="color:red;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        
        <div id="headerFormUploadAll">
                <?php   for($i = 1; $i <= $_POST["number_people"]; $i++){ ?>
                            <div id="formUploadIndex<?php echo $i?>" style="display:none;">
                                <section class="d-flex align-items-center min-vh-50">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <section class="col-lg-6">
                                                <div class="card shadow p-3 p-md-4 mt-4">
                                                    <h3 class="text-center text-primary font-weight-bold">ข้อมูลผู้เข้าแข่งขันคนที่ <?php echo $i?></h3>
                                                    <h5 class="text-center font-weight-bold" id="showContestantNameTop<?php echo $i?>"></h5>
                                                    <div class="card-body">
                                                        <!-- อัพรูปหน้าตรง -->
                                                            <div class="form-group text-center">
                                                                <img id="showImage<?php echo $i?>of_cover" src="../../assets/images/avatar.png" alt="Image Profile" class="img-fluid p-5" width="300px" height="300px">
                                                            </div>
                                                            <div class="form-group col-sm-10">
                                                                <label for="customFile">รูปหน้าตรง</label>
                                                                <label for="customFile">** ถ้าหากอัพไฟล์ที่ไม่ใช่ไฟล์รูปจะอัพโหลดได้เหมือนกัน แต่จะไม่แสดงภาพ **</label>
                                                                <div class="custom-file">
                                                                    <input type="file" value="" class="custom-file-input" name="cover<?php echo $i?>" id="customFile<?php echo $i?>of_cover" onchange="readFile(this, <?php echo $i?>, 'of_cover')" required>
                                                                    <label class="custom-file-label" for="customFile" id="statusUpload<?php echo $i?>of_cover">เลือกรูปภาพ</label>
                                                                </div>
                                                            </div>
                                                        <!-- อัพรูปหน้าตรง -->

                                                        <!-- อัพผลเกรด -->
                                                            <div class="form-group text-center">
                                                                <img id="showImage<?php echo $i?>grade" src="../../assets/images/exmaple_g.png" alt="Image Profile" class="img-fluid p-5" width="300px" height="300px">
                                                            </div>
                                                            <div class="form-group col-sm-10">
                                                                <label for="customFile">อัพรูปผลเกรด ขนาดการดาษ A4</label>
                                                                <div class="custom-file">
                                                                    <input type="file" value="" class="custom-file-input" name="grade<?php echo $i?>" id="customFile<?php echo $i?>grade" onchange="readFile(this, <?php echo $i?>, 'grade')" required>
                                                                    <label class="custom-file-label" for="customFile" id="statusUpload<?php echo $i?>grade">เลือกรูปภาพ</label>
                                                                </div>
                                                            </div>
                                                        <!-- อัพผลเกรด -->

                                                        <!-- อัพสำเนาบัตร -->
                                                            <div class="form-group text-center">
                                                                <img id="showImage<?php echo $i?>card" src="../../assets/images/exmaple_g.png" alt="Image Profile" class="img-fluid p-5" width="300px" height="300px">
                                                            </div>
                                                            <div class="form-group col-sm-10">
                                                                <label for="customFile">อัพรูปสำเนาบัตร</label>
                                                                <div class="custom-file">
                                                                    <input type="file" value="" class="custom-file-input" name="card<?php echo $i?>" id="customFile<?php echo $i?>card" onchange="readFile(this, <?php echo $i?>, 'card')" required>
                                                                    <label class="custom-file-label" for="customFile" id="statusUpload<?php echo $i?>card">เลือกรูปภาพ</label>
                                                                </div>
                                                            </div>
                                                        <!-- อัพสำเนาบัตร -->

                                                        <!-- อัพบัตรนักศึกษา -->
                                                            <div class="form-group text-center">
                                                                <img id="showImage<?php echo $i?>card_student" src="../../assets/images/exmaple_w.png" alt="Image Profile" class="img-fluid p-5" width="300px" height="300px">
                                                            </div>
                                                            <div class="form-group col-sm-10">
                                                                <label for="customFile">อัพรูปบัตรนักศึกษา</label>
                                                                <div class="custom-file">
                                                                    <input type="file" value="" class="custom-file-input" name="card_student<?php echo $i?>" id="customFile<?php echo $i?>card_student" onchange="readFile(this, <?php echo $i?>, 'card_student')" required>
                                                                    <label class="custom-file-label" for="customFile" id="statusUpload<?php echo $i?>card_student">เลือกรูปภาพ</label>
                                                                </div>
                                                            </div>
                                                        <!-- อัพบัตรนักศึกษา -->
                                                    </div>
                                                    <h5 class="text-center font-weight-bold" id="showContestantNameBottom<?php echo $i?>"></h5>
                                                    <h3 class="text-center text-primary font-weight-bold">ข้อมูลผู้เข้าแข่งขันคนที่ <?php echo $i?></h3>
                                                    <div class="card-footer text-center" style="background-color:inherit;">
                                                        <a href="#headerFormUploadAll">
                                                            <div class="btn btn-primary mt-3" onclick="showFormUpload('none')">กลับขึ้นไปข้างบน</div>
                                                        </a>    
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </section>
                            </div>
                <?php   } ?>
        </div>
    </form>
<!-- script -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function clickForCheckErrorUpFile(){
            let textErrorUpFile = "";
            for(let i = 1; i <= <?php echo $_POST["number_people"];?> ; i++){
                if(document.getElementById("customFile"+i+"of_cover").value == ""){
                    textErrorUpFile += "- รูปหน้าปกของผู้เข้าแข่งขันคนที่ "+i+" ยังไม่ได้อัพ หรืออาจจะต้องกดอัพอีกครั้ง <br>";
                }
                if(document.getElementById("customFile"+i+"grade").value == ""){
                    textErrorUpFile += "- รูปเกรดของผู้เข้าแข่งขันคนที่ "+i+" ยังไม่ได้อัพ หรืออาจจะต้องกดอัพอีกครั้ง <br>";
                }
                if(document.getElementById("customFile"+i+"card").value == ""){
                    textErrorUpFile += "- รูปบัตรประจำตัวประชาชนของผู้เข้าแข่งขันคนที่ "+i+" ยังไม่ได้อัพ หรืออาจจะต้องกดอัพอีกครั้ง <br>";
                }
                if(document.getElementById("customFile"+i+"card_student").value == ""){
                    textErrorUpFile += "- รูปบัตรนักศึกษาของผู้เข้าแข่งขันคนที่ "+i+" ยังไม่ได้อัพ หรืออาจจะต้องกดอัพอีกครั้ง <br>";
                }
            }
            document.getElementById("textErrorUpFile").innerHTML = textErrorUpFile;
        }
        function readFile(input, index, offf){
            if(input.files[0]){
                let reader = new FileReader();
                reader.onload = function (e) {
                    let element = document.querySelector('#showImage'+index+offf);
                    element.setAttribute("src", e.target.result);

                    let element2 = document.getElementById('statusUpload'+index+offf);
                    element2.innerHTML = "อัพแล้ว";
                    element2.setAttribute("style", "color:green; border:1px solid green");
                }  
                reader.readAsDataURL(input.files[0]);
            }   
        }

        function showFormUpload(indexForm){ 
            for(let i = 1; i < (<?php echo $_POST["number_people"]?>+1); i++){
                document.getElementById("showContestantNameTop"+i).innerHTML = "";
                document.getElementById("showContestantNameBottom"+i).innerHTML = "";
                document.getElementById("formUploadIndex"+i).setAttribute("style", "display:none;");
            }
            if(indexForm != "none"){
                let val = document.getElementById("contestant_name"+indexForm).value;
                document.getElementById("showContestantNameTop"+indexForm).innerHTML = val;
                document.getElementById("showContestantNameBottom"+indexForm).innerHTML = val;
                document.getElementById("formUploadIndex"+indexForm).setAttribute("style", "display:block;");  
            }
        }

        function checkCharContestantName(ind){
            let notError = true;
            let name = document.getElementById("contestant_name"+ind).value;
            if(name != ""){
                if(isNaN(name)){
                    document.getElementById("alertErrorContestantName"+ind).innerHTML = "";    
                }else{
                    document.getElementById("alertErrorContestantName"+ind).innerHTML = "** ชื่อห้ามเป็นตัวเลขทั้งหมด **";
                    notError = false;
                }
            }else{
                document.getElementById("alertErrorContestantName"+ind).innerHTML = "";
                notError = false; 
            }
            return notError;
        }

        function checkBeforeSubmit(){
            let notError = true;
            let notErrorContestantName = true;
            let notErrorCheckBoxSubTypeStack = true;

            <?php if($_POST["sport_type_id"] == "4"){ echo "notErrorCheckBoxSubTypeStack = check_checkBox();";} ?>
            
            for(let i = 0; i < <?php echo $_POST["number_people"]?>; i++){ // เช็คว่าชื่อเจ้าหน้าที่ดูแลทีมเป็นตัวเลขหรือไม่
                if(checkCharContestantName(i+1) === false){
                    notErrorContestantName = false;
                }
            }
            if((notErrorContestantName && notErrorCheckBoxSubTypeStack) === false){
                notError = false;
                Swal.fire({ 
                    text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ', 
                    icon: 'error', 
                    confirmButtonText: 'ตกลง', 
                })
            }
            return notError;
        }

        <?php   if($_POST["sport_type_id"] == "4"){ ?>
                    function check_checkBox(){
                        let checkNotError = false;
                        for(let i = 1 ; i <= <?php echo $count_of_row_sub_stack?>; i++){
                            if(i == 1){ continue; }
                            if(document.getElementById("sub_stack"+i).checked){
                                checkNotError = true;
                            }
                        }
                        if(checkNotError === false){
                            document.getElementById("alertErrorSub_stack").innerHTML = "กรุณาเลือกรูปแบบการแข่งขันมา 1 อย่างหรือมากกว่า";
                        }else{
                            document.getElementById("alertErrorSub_stack").innerHTML = "";
                        }
                        return checkNotError;
                    }
                    check_checkBox();
        <?php   } ?>

    </script>

</body>
</html>
