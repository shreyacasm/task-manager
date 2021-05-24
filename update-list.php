<?php

    include('config/constants.php');

    if(isset($_GET['list_id'])){
        //get the list id value
        $list_id = $_GET['list_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        //sql query to get the values from database
        $sql = "SELECT * FROM tbl_lists
                WHERE list_id=$list_id";

        $res = mysqli_query($conn, $sql);

        //to check execution of query
        if($res == true){
            //get the value from database
            //value in array format
            $row = mysqli_fetch_assoc($res);
            //print_r($row);

            //create indvidual variable to save the data
            $list_name = $row['list_name'];
            $list_desc = $row['list_desc'];
            
        }
        else{
            //go back to manage list page
            header('location:'.SITEURL.'manage-list.php');
        }
    }
?>

<html>
<head>
    <title>Task Manager</title>
     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

        <link rel="stylesheet" href="<?php echo SITEURL;?>css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div  class="icon-tray">
        <h1><img src="images/icon.png" alt="icon" width=48 height=48>BusyDay</h1>
    </div>
    <div class="menu">    
        <a href="<?php echo SITEURL; ?>index.php"><i class="fas fa-home">Home</i></a>
        <a class="c-list" href="<?php echo SITEURL; ?>manage-list.php"><i class="fas fa-tasks"> Customize Lists</i></a>
    </div>
    
    <h3>Update List Page</h3>
    <p class="neg-para">
        <?php
            //wheather session is set or not
            if(isset($_SESSION['update_fail'])){
                echo $_SESSION['update_fail'];
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>
    <!-- form to update list starts here -->
    <form method="POST" action="">
    <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">List Name: </label>
            <input type="text" name="list_name"  class="form-control" id="exampleFormControlInput1"  value="<?php echo $list_name; ?>"  required="required" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Add a description</label>
            <textarea type="text" name="list_desc" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $list_desc; ?></textarea>
        </div>
            <button type="submit" name="submit" value="Submit" type="button" class="btn btn-primary btn-cust">Save</button>
    </form>
    <!-- form to add list ends here -->
</body>
</html>

<?php
    //check wheather submit btn clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //get the updated values from form

        $list_name = $_POST['list_name'];
        $list_desc = $_POST['list_desc'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2, DB_NAME);

        $sql2 = "UPDATE tbl_lists SET 
                list_name='$list_name',
                list_desc='$list_desc'
                WHERE list_id=$list_id
        ";
        $res2 = mysqli_query($conn2, $sql2);
        

        // //to check query execution
        if($res2 == true){
             $_SESSION['update']="List Updated Successfully";
            header("location:".SITEURL.'manage-list.php');
        }
        else{
            $_SESSION['update_fail']="Failed to List Update";
            header('location'.SITEURL.'update-list.php?list_id='.$list_id);
        }
    }

?>