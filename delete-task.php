<?php
    include('config/constants.php');

    // to check value of task_id is passed or not
    if(isset($_GET['task_id'])){
        //if true thn only we'll proceed further

        // get the task_id
        $task_id = $_GET['task_id'];

        //connect the database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        //select db
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        //query to dekete list
        $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //to check if delete executed well or not
        if($res == true){
            //echo "list is deleted successfully";
            $_SESSION['delete']="Task Deleted Successfully";
            header('location:'.SITEURL);
        }
        else{
            //echo "list delete failed";
            $_SESSION['delete_fail']="Task can't Deleted Successfully";
            header('location:'.SITEURL);
        }

    }
    else{
        //redirect 
        header('location:'.SITEURL);
    }

    
?>