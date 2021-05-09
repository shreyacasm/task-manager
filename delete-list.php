<?php
    include('config/constants.php');

    // to check value of list_id is passed or not
    if(isset($_GET['list_id'])){
        //if true thn only we'll proceed further

        // get the list_id
        $list_id = $_GET['list_id'];

        //connect the database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        //select db
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        //query to dekete list
        $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //to check if delete executed well or not
        if($res == true){
            //echo "list is deleted successfully";
            $_SESSION['delete']="List Deleted Successfully";
            header('location:'.SITEURL.'manage-list.php');
        }
        else{
            //echo "list delete failed";
            $_SESSION['delete_fail']="List can't Deleted Successfully";
            header('location:'.SITEURL.'manage-list.php');
        }

    }
    else{
        //redirect 
        header('location:'.SITEURL.'manage-list.php');
    }

    
?>