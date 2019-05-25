<?php
namespace App\reg;
use PDO;
class reg
{

    private $dbuser= 'root';
    private $dbpass= '';
    private $dbname= 'ivac';
    private $fullname,$total,$username,$password,$mobile,$referEmail;
    public $countfiles, $countotp, $countdone,$File_submit_Amount,$File_number;
    public $BGD, $Passport, $G_name, $B_place, $F_name,$M_name,$Mission;
    public $i=1,$file=0,$Done=0,$otp=0;

    public function setData($data = ''){
        $this->fullname=$data['fullname'];
        $this->username=$data['User_name'];
        $this->total=$data['File_amount'];
        $this->mobile=$data['Mobile'];
        $this->referEmail=$data['reffer_email'];
        $this->password=md5($data['Password']);

        return $this;
    }

    public function Add_User(){

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            // set the PDO error mode to exception
            $query = "INSERT INTO `user` (id, Full_name, User_name, Password, Mobile,File_amount,User_type,Reffer_email) VALUES (:i , :fn, :u, :p, :m, :f, :t, :rm )";
            $stmt = $pdo->prepare($query);
            $data = array(
                ':i' => null,
                ':fn' => strtoupper($this->fullname),
                ':u' => strtoupper($this->username),
                ':p' => $this->password,
                ':m' => $this->mobile,
                ':f' => $this->total,
                ':t' => 'USER',
                ':rm' => $this->referEmail

            );
            $stmt->execute($data);
            $result= $stmt->rowCount();


            if($result ){
                $_SESSION['adduser'] = "New User Added Successfully.";
            }else{
                $_SESSION['adderror'] ="Already Exists User Name !";
            }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

            }


    public function login($data=''){

            $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);

            $username = "'" . $data['username'] . "'";
            $password = "'" . md5($data['password']) . "'";

            $query = "SELECT * FROM `user` WHERE User_name=$username AND Password=$password";

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $data = $stmt->fetch();

            if (!empty($data) && $data['User_type']=='USER') {
                $_SESSION['user_id'] = $data;
                header('location:../portal/index.php');
            }
            elseif (!empty($data) && $data['User_type']=='ADMIN'){
                $_SESSION['user_id'] = $data;
                header('location:../portal/Admin.php');
            }
            else {
                $_SESSION['Message'] = "Invalid Username And Password ! Try Again.";
            }

    }


    public function setfile($data=''){
        $this->Mission= strtoupper($data['Mission']);
        $this->BGD= strtoupper($data['BGD']);
        $this->Passport= strtoupper($data['Passport']);
        $this->G_name= strtoupper($data['Given_name']);
        $this->B_place= strtoupper($data['Birth_place']);
        $this->F_name=strtoupper($data['Father_name']);
        $this->M_name= strtoupper($data['Mother_name']);
        return $this;

    }

    public function storfile(){
        date_default_timezone_set('Asia/Dhaka');

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);

            $this->Mising_number();

            $query = "INSERT INTO files (id,Mission, BGD, Passport, Given_name, Birth_place, Father_name, Mother_name,Status,Submit_time,User_name,File_number) VALUES (:i ,:mi,:bgd, :pas, :gi, :br, :fa,:ma, :s,:t,:use,:finu )";
            $stmt = $pdo->prepare($query);
            $data = array(
                ':i' => null,
                ':mi' => $this->Mission,
                ':bgd' => $this->BGD,
                ':pas' => $this->Passport,
                ':gi' => $this->G_name,
                ':br' => $this->B_place,
                ':fa' => $this->F_name,
                ':ma' => $this->M_name,
                ':s' => "PENDING",
                ':t' => date("d-m-Y"),
                ':use' => $_SESSION['user_id']['User_name'],
                ':finu' => $this->File_number
            );

           $stmt->execute($data);
            $result= $stmt->rowCount();
            if($result){
                $_SESSION['department'] = "Your File Added Successfully.";
                //header('location:showdepartment.php');
            }else{
                $_SESSION['error'] = " Your File Already Exists !";
            }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function Mising_number(){
        date_default_timezone_set('Asia/Dhaka');
        if(!isset($user)){
            $user=$_SESSION['user_id']['User_name'];
        }
        $this->getallfiles($user);
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $user=$_SESSION['user_id']['User_name'];
        $current_data=date("d-m-Y");
        $query = "SELECT File_number FROM `files` WHERE User_name='$user' and Submit_time='$current_data'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $Current_numbers=$stmt->fetchAll(PDO::FETCH_ASSOC);

        if($this->countfiles==0){
            $this->File_number= 1;
        }
        else{
            $Array_range = range(1,$_SESSION['user_id']['File_amount']);

            for ($i =0; $i <count($Current_numbers); $i++) {
                $NewArray[$i] = $Current_numbers[$i]['File_number'];
            }
            $Unused_Number=array_diff($Array_range ,$NewArray);

            $this->File_number= min($Unused_Number);
        }

    }

    public function DeleteOneFile($data=''){
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $Id=$data;
        $query = "DELETE FROM `files` WHERE id=$Id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    public function DeleteAllFiles(){
        date_default_timezone_set('Asia/Dhaka');
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $user=$_SESSION['user_id']['User_name'];
        $current_data= date("d-m-Y");
        $query = "DELETE FROM `files` WHERE User_name='$user' and Submit_time='$current_data' ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        header('location:upload_files.php');
    }

    public function OneFiledata($data=''){
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $Id=$data;
        $query = "SELECT * FROM `files` WHERE id='$Id'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetch();
        return $alldata;
    }

    public function getallfiles($user){
        date_default_timezone_set('Asia/Dhaka');
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $current_data= date("d-m-Y");
        $query = "SELECT * FROM `files` WHERE User_name='$user' and Submit_time='$current_data' ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetchall();
        $this->countfiles= $stmt->rowCount();
        return $alldata;
    }
    public function EditOneFile($Id){
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            $query = "UPDATE `files` SET Mission='$this->Mission', BGD='$this->BGD', Passport='$this->Passport', Given_name='$this->G_name', Birth_place='$this->B_place', Father_name='$this->F_name', Mother_name='$this->M_name' WHERE id=".$Id;
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result= $stmt->rowCount();
            if($result){
                $_SESSION['department'] = "Your File Successfully Modified";
            }else{
                $_SESSION['error'] = " Please Modify Your Data !";
            }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function getdonefiles(){
        date_default_timezone_set('Asia/Dhaka');
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $user=$_SESSION['user_id']['User_name'];
        $current_data= date("d-m-Y");
        $query = "SELECT * FROM `files` WHERE User_name='$user' and Submit_time='$current_data' and Status='Done' ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetchall();
        $this->countdone= $stmt->rowCount();
        return $alldata;
    }

    public function GetAllDate(){
        date_default_timezone_set('Asia/Dhaka');
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $user=$_SESSION['user_id']['User_name'];
        $current_data= date("d-m-Y");
        $query = "SELECT DISTINCT Submit_time FROM `files` WHERE User_name='$user' and Submit_time !='$current_data' and Status!='DONE'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetchall();
        return $alldata;
    }
    public function GetDoneFileDate(){

        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $user=$_SESSION['user_id']['User_name'];
        $current_data= date("d-m-Y");
        $query = "SELECT DISTINCT Submit_time FROM `files` WHERE User_name='$user' and Status='DONE'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetchall();
        return $alldata;
    }

    public function FileOverCount(){

        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $user=$_SESSION['user_id']['User_name'];
        $query = "SELECT File_amount FROM `user` WHERE User_name='$user'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetch(PDO::FETCH_ASSOC);
        $this->File_submit_Amount= $stmt->rowCount();
        return $alldata;
    }
    public function OTP_Count(){
        date_default_timezone_set('Asia/Dhaka');
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $user=$_SESSION['user_id']['User_name'];
        $current_data= date("d-m-Y");
        $query = "SELECT OTP FROM files WHERE OTP = '' and User_name='$user' and Submit_time='$current_data'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $this->countotp= $stmt->rowCount();
    }
    public function ResubmitFile($ID){
        date_default_timezone_set('Asia/Dhaka');
        if($this->countfiles<6){
            $this->Mising_number();
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
                $current_data= date("d-m-Y");
                $query = "UPDATE `files` SET File_number='$this->File_number',Submit_time='$current_data' WHERE id='$ID'";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $result= $stmt->rowCount();
                if($result){
                    header('location:../portal/upload_files.php');
                }

            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        else{
            $_SESSION['error'] = " Already You Added Maximum Amount !";
        }

    }

    public function getalluser(){
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $query = "SELECT * FROM `user` WHERE User_type !='ADMIN'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetchall();
        return $alldata;
    }

    public function Total_file(){
        date_default_timezone_set('Asia/Dhaka');
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $current_data= date("d-m-Y");
        $query = "SELECT * FROM `files` WHERE Submit_time='$current_data'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetchall();
        return $alldata;
    }

    public function DeleteOneUser($fileId){
        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $query = "DELETE FROM `user` WHERE id='$fileId'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        header('location:manageuser.php');

    }
    public  function OneUserdata($fileId){

        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $query = "SELECT * FROM `user` WHERE id='$fileId'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetch();
        return $alldata;

    }
    public function EditOneUser($Id){

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            $query = "UPDATE `user` SET Full_name='$this->fullname', User_name='$this->username', Mobile='$this->mobile', File_amount='$this->total', Reffer_email='$this->referEmail', Password='$this->password' WHERE id=".$Id;
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result= $stmt->rowCount();
            if($result){
                header('location:manageuser.php');
            }else{
                $_SESSION['adderror'] = " Please Modify Your Data !";
            }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function Edit_admin_profile($data=''){

        $this->fullname=$data['fullname'];
        $this->username=$data['User_name'];
        $this->mobile=$data['Mobile'];
        $this->password=md5($data['Password']);
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            $query = "UPDATE `user` SET Full_name='$this->fullname', User_name='$this->username', Mobile='$this->mobile', Password='$this->password' WHERE User_type='ADMIN'";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result= $stmt->rowCount();
            if($result){
                $_SESSION['adduser'] = "Profile Modified Successfully.";
            }else{
                $_SESSION['adderror'] = " Please Modify Your Data !";
            }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function getMail($user){

        $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $query = "SELECT Reffer_email FROM `user` WHERE User_name='$user'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $alldata=$stmt->fetch();
        return $alldata;

    }


}