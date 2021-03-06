<?php

    include('config/constants.php');

    if(isset($_GET['task_id'])){
        //get the list id value
        $task_id = $_GET['task_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        //sql query to get the values from database
        $sql = "SELECT * FROM tbl_tasks
                WHERE task_id=$task_id";

        $res = mysqli_query($conn, $sql);
        
        //to check execution of query
        if($res == true){
            //get the value from database
            //value in array format
            $row = mysqli_fetch_assoc($res);
            //print_r($row);

            //create indvidual variable to save the data
            $task_name = $row['task_name'];
            $task_desc = $row['task_desc'];
            $list_id = $row['list_id'];
            $priority = $row['priority'];
            $deadline = $row['deadline'];
            
        }
        else{
            //go back to manage list page
            header('location:'.SITEURL.'index.php');
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
    </div>   
    <h3>Update Task Page</h3>
    <p  class="neg-para">
        <?php
            if(isset($_SESSION['update_fail'])){
                echo $_SESSION['update_fail'];
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>
    <form method="POST" action="" >
        <label for="exampleFormControlInput1" class="form-label">Task Name: </label>
            <input type="text" name="task_name" class="form-control mb-3" id="exampleFormControlInput1"  value="<?php echo $task_name; ?>" required>
            <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
            <textarea name="task_desc" class="form-control" id="exampleFormControlInput1"  required><?php echo $task_desc;?></textarea>
            <label for="exampleFormControlTextarea1" class="form-label">List type:</label>
            <select class="form-control" id="exampleFormControlInput1"  name="list_id">
                        <?php
                            //connect db
                            $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                            //select db
                            $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());
                            //query
                            $sql3 = "SELECT * FROM tbl_lists";

                            $res3 = mysqli_query($conn3, $sql3);

                            if($res3==true){
                                //count res rows
                                $count_rows=mysqli_num_rows($res3);
                                //if any data is there in DB display all in dropdown
                                if($count_rows>0){
                                    //display all lists on dropdown from database
                                    while($row3=mysqli_fetch_assoc($res3)){
                                        $flist_id = $row3['list_id'];
                                        $list_name = $row3['list_name'];
                                        ?>
                                        <option value="<?php echo $flist_id ?>" <?php echo $list_id==$flist_id?"selected":""?> ><?php echo $list_name ?></option>
                                        <?php
                                        
                                    }
                                }
                                else{
                                    ?>
                                    <option value="0">None</option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                <label for="exampleFormControlTextarea1" class="form-label">Priority: </label>
                <select class="form-control" id="exampleFormControlInput1" name="priority">
                        <option value="high" <?php echo $priority=="high"? "selected" : ""?>>High</option>
                        <option value="medium"<?php echo $priority=="medium"? "selected" : ""?>>Medium</option>
                        <option value="low" <?php echo $priority=="low"? "selected" : ""?>>Low</option>
                    </select>
                
                <label for="exampleFormControlTextarea1" class="form-label">Deadline</label>
                <input class="form-control mb-3" id="exampleFormControlInput1" type="date" name="deadline" value="<?php echo $deadline;?>">
                <button type="submit" name="submit" value="Save" type="button" class="btn btn-primary btn-cust">Save</button>
            
        
    </form>
</body>
</html> 
<?php
    //check wheather submit btn clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //get the updated values from form

        $task_name = $_POST['task_name'];
        $task_desc = $_POST['task_desc'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2, DB_NAME);

        echo $sql2 = "UPDATE tbl_tasks SET 
                task_name='$task_name',
                task_desc='$task_desc',
                priority='$priority',
                list_id=$list_id,
                deadline='$deadline'
                WHERE task_id=$task_id
        ";
        $res2 = mysqli_query($conn2, $sql2);
        

        //to check query execution
        if($res2 == true){
             $_SESSION['update']="Task Updated Successfully";
            header("location:".SITEURL.'index.php');
        }
        else{
            $_SESSION['update_fail']="Failed to List Update";
            header('location'.SITEURL.'update-task.php?task_id='.$task_id);
        }
    }

?>