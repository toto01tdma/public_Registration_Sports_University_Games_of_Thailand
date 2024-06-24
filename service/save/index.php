<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
    session_start();

    require_once("../connect.php");
    $obj = new ConnectDatabase();

        // --------------------------------------------------------------------------------------
            do{
                $ind = rand(0000, 9999);
                $statment = $obj->getConnect()->prepare("SELECT team_id FROM team_lists WHERE team_id = '$ind' "); // ใส่โค้ด Sql ลงไป
                $statment->execute(); // รันคำสั่ง Sql
                $check = $statment->fetch(PDO::FETCH_ASSOC);
            }while($check != false);
        // --------------------------------------------------------------------------------------

    $sport_type_detail = "";
    if(isset($_POST["num_of_checkbox"])){
        for($i = 1; $i <= $_POST["num_of_checkbox"]; $i++){
            if(isset($_POST["sub_stack".$i])){
                $sport_type_detail = $sport_type_detail."".$_POST["sub_stack".$i]."<br>";
            }
        }
    }

    $team_manager = [];
    for($i = 0; $i < 4; $i++){
        if(isset($_POST["team_manager_name".($i+1)])){
            $team_manager[$i] = "ชื่อ ".$_POST["team_manager_name".($i+1)]." หน้าที่ ".$_POST["team_manager_role".($i+1)];
        }else{
            $team_manager[$i] = "";
        }
    }

    $sql = "INSERT INTO `team_lists`(`team_id`, `team_name`, `number_people`, `sport_type`, `sport_type_detail`, `team_manager_01`, `team_manager_02`, `team_manager_03`, `team_manager_04`, `coordinator_name`, `coordinator_email`, `coordinator_phonenumber`) 
            VALUES (:team_id, :t_name, :number_people, :sport_type, :sport_type_detail, :team_manager_01, :team_manager_02, :team_manager_03, :team_manager_04, :coordinator_name, :coordinator_email, :coordinator_phonenumber)";
    $statment = $obj->getConnect()->prepare($sql); // ใส่โค้ด Sql ลงไป
    $result = $statment->execute(array(
                        ":team_id" => $ind,
                        ":t_name" => $_POST["team_name"],
                        ":number_people" => $_POST["number_people"],
                        ":sport_type" => $_POST["sport_type_id"],
                        ":sport_type_detail" => $sport_type_detail,
                        ":team_manager_01" => $team_manager[0],
                        ":team_manager_02" => $team_manager[1],
                        ":team_manager_03" => $team_manager[2],
                        ":team_manager_04" => $team_manager[3],
                        ":coordinator_name" => $_POST["coordinator_name"],
                        ":coordinator_email" => $_POST["coordinator_email"],
                        ":coordinator_phonenumber" => $_POST["coordinator_phonenumber"])); // รันคำสั่ง Sql
    if($result){
        for($i = 1; $i <= $_POST["number_people"]; $i++){

            $img_tmp_cover = $_FILES["cover".$i]['tmp_name'];
            $typeImage_cover = strtolower(pathinfo($_FILES["cover".$i]['name'], PATHINFO_EXTENSION)); // นามสกุลของรูปที่ส่งมา
            $image_cover = $ind."cover".$i.".".$typeImage_cover; // เอาไว้ตั้งเป็นชื่อไฟล์รูปเก็บลงฐานข้อมูล
            $upload = copy($img_tmp_cover, "../../assets/data/cover/".$image_cover); 

            $img_tmp_card = $_FILES["card".$i]['tmp_name'];
            $typeImage_card = strtolower(pathinfo($_FILES["card".$i]['name'], PATHINFO_EXTENSION)); // นามสกุลของรูปที่ส่งมา
            $image_card = $ind."card".$i.".".$typeImage_card; // เอาไว้ตั้งเป็นชื่อไฟล์รูปเก็บลงฐานข้อมูล
            $upload = copy($img_tmp_card, "../../assets/data/card/".$image_card); 

            $img_tmp_card_student = $_FILES["card_student".$i]['tmp_name'];
            $typeImage_card_student = strtolower(pathinfo($_FILES["card_student".$i]['name'], PATHINFO_EXTENSION)); // นามสกุลของรูปที่ส่งมา
            $image_card_student = $ind."card_student".$i.".".$typeImage_card_student; // เอาไว้ตั้งเป็นชื่อไฟล์รูปเก็บลงฐานข้อมูล
            $upload = copy($img_tmp_card_student, "../../assets/data/card_student/".$image_card_student); 

            $img_tmp_grade = $_FILES["grade".$i]['tmp_name'];
            $typeImage_grade = strtolower(pathinfo($_FILES["grade".$i]['name'], PATHINFO_EXTENSION)); // นามสกุลของรูปที่ส่งมา
            $image_grade = $ind."grade".$i.".".$typeImage_grade; // เอาไว้ตั้งเป็นชื่อไฟล์รูปเก็บลงฐานข้อมูล
            $upload = copy($img_tmp_grade, "../../assets/data/grade/".$image_grade); 

            $sql = "INSERT INTO `sub_image`(`cover`, `card`, `card_student`, `grade`, `team`, `contestant_name`) 
                    VALUES (:cover, :card, :card_student, :grade, :team, :contestant_name)";
            $statment = $obj->getConnect()->prepare($sql); // ใส่โค้ด Sql ลงไป
            $result2 = $statment->execute(array(
                                ":cover" => $image_cover,
                                ":card" => $image_card,
                                ":card_student" => $image_card_student,
                                ":grade" => $image_grade,
                                ":team" => $ind,
                                ":contestant_name" => $_POST["contestant_name".$i])); // รันคำสั่ง Sql
            if($result2){
                $_SESSION["alert"] = "เพิ่มข้อมูลสำเร็จ"; 
                header("location: ../../pages/sport_report/");
            }else{
                $_SESSION["alert"] = "เพิ่มรูปไม่สำเร็จ"; 
                header("location: ../../pages/sport_register/");
            }
        }       
    }else{
        $_SESSION["alert"] = "เพิ่มข้อมูลไม่สำเร็จ";
        header("location: ../../pages/sport_register/");
    }
    
}else{
    echo "No";
}
?>
