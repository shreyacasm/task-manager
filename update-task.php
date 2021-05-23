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
</head>
<body>
<h1>Task Manager</h1>
    <a href="<?php echo SITEURL ?>">Home</a>
    <h3>Update Task Page</h3>
    <p>
        <!-- <?php
            if(isset($_SESSION['add_fail'])){
                echo $_SESSION['add_fail'];
                unset($_SESSION['add_fail']);
            }
        ?> -->
    </p>
    <form method="POST" action="" >
        <table>
            <tr>
                <td>Task Name</th>
                <td>
                    <input type="text" name="task_name" value="<?php echo $task_name; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Task Description</th>
                <td>
                    <textarea name="task_desc" required><?php echo $task_desc;?></textarea>
                </td>
            </tr>
            <tr>
                <td>Select List</td>
                <td>
                    <select name="list_id">
                        <?php
                            //connect db
                            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                            //select db
                            $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                            //query
                            $sql = "SELECT * FROM tbl_lists";

                            $res = mysqli_query($conn, $sql);

                            if($res==true){
                                //count res rows
                                $count_rows=mysqli_num_rows($res);
                                //if any data is there in DB display all in dropdown
                                if($count_rows>0){
                                    //display all lists on dropdown from database
                                    while($row=mysqli_fetch_assoc($res)){
                                        $flist_id = $row['list_id'];
                                        $list_name = $row['list_name'];
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
                </td>
            </tr>
            <tr>
                <td>Priority:</td>
                <td>
                    <select name="priority">
                        <option value="high" <?php echo $priority=="high"? "selected" : ""?>>High</option>
                        <option value="medium"<?php echo $priority=="medium"? "selected" : ""?>>Medium</option>
                        <option value="low" <?php echo $priority=="low"? "selected" : ""?>>Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td><input type="date" name="deadline" value="<?php echo $deadline;?>"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<!-- 
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

?> -->