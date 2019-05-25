    <?php
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=ivac", 'root', '');


if(isset($_POST['lost_files'])){

        $user= $_SESSION['user_id']['User_name'];
        $fixed_date = $_POST['lost_files'];
        $sql ="SELECT * FROM `files` WHERE User_name='$user' and Submit_time='$fixed_date' and Status!='DONE' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);

}

    if(isset($_POST['done_files'])){

        $user=$_SESSION['user_id']['User_name'];
        $current_data= $_POST['done_files'];
        $query = "SELECT * FROM `files` WHERE User_name='$user' and Submit_time='$current_data' and Status='DONE' ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

    if(isset($_POST['user'])){
        $user=$_POST['user'];
        $query = "SELECT DISTINCT Submit_time FROM `files` WHERE User_name='$user' and Status='DONE'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    if(isset($_POST['done_files_date']) && $_POST['user_name']){

        $user=$_POST['user_name'];
        $current_data= $_POST['done_files_date'];
        $query = "SELECT * FROM `files` WHERE User_name='$user' and Submit_time='$current_data' and Status='DONE' ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

    ?>