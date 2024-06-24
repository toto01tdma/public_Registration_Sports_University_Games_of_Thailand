<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();

    $statment = $conn->prepare("SELECT * FROM team_lists WHERE team_name = :team AND type_of_stack_id = :type "); // ใส่โค้ด Sql ลงไป
    $statment->execute(array(   ":team" => $_POST['team'],
                                ":type" => $_POST['type']));
    $result = $statment->fetch(PDO::FETCH_ASSOC);

    if($result){
        $response = [
            'status' => false,
            'message' => 'Failed'
        ];
    
        http_response_code(400);
        echo json_encode($response);
    }else{
        $response = [
            'status' => true,
            'message' => 'Success'
        ];
    
        http_response_code(200);
        echo json_encode($response);
    }

}
?>
    

