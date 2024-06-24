<?php
// session_start();
error_reporting(E_ALL); // ให้แสดง Error หากมี Error ถ้าไม่ต้องการแสดงให้ Error ใส่พารามิเตอร์เป็น 0
date_default_timezone_set('Asia/Bangkok'); // ตั้งวันที่และเวลาตามโซนที่อยู่ของตัวเอง

/** Class Database สำหรับติดต่อฐานข้อมูล */
class ConnectDatabase {
    /**
     * กำหนดตัวแปรแบบ private
     * Method Connect ใช้สำหรับการเชื่อมต่อ Database
     *
     * @var string|null
     * @return PDO
     */
    private $host = "localhost";   // ชื่อเซิฟเวอร์
    private $dbname = "sportgame"; // ชื่อฐานข้อมูล
    private $username = "root"; // ชื่อผู้ใช้งานที่ใช้เข้าสู่ฐานข้อมูล
    private $password = ""; // // รหัสผ่านผู้ใช้งานที่ใช้เข้าสู่ฐานข้อมูล
    private $conn = null;

    function __construct() {
        try{
            /** PHP PDO */
            $this->conn = new PDO('mysql:host='.$this->host.'; 
                                dbname='.$this->dbname.'; 
                                charset=utf8', 
                                $this->username, 
                                $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $exception->getMessage();
            exit();
        }
    }

    function __destruct(){}

    public function getConnect(){
        return $this->conn;
    }
}
    

