<?php
    include('config/constants.php');
?>

<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <a href="<?php echo SITEURL ?>">Home</a>
    <h3>Add Task Page</h3>
    <p>
        <?php
            if(isset($_SESSION['add_fail'])){
                echo $_SESSION['add_fail'];
                unset($_SESSION['add_fail']);
            }
        ?>
    </p>
    <form method="POST" action="" >
        <table>
            <tr>
                <td>Task Name</th>
                <td>
                    <input type="text" name="task_name" placeholder="Type your Task Name Here" required>
                </td>
            </tr>
            <tr>
                <td>Task Description</th>
                <td>
                    <textarea name="task_desc" placeholder="Type your Task Description Here" required></textarea>
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
                                        $list_id = $row['list_id'];
                                        $list_name = $row['list_name'];
                                        ?>
                                        <option value="<?php echo $list_id ?>"><?php echo $list_name ?></option>
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
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td><input type="date" name="deadline"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php
    //wheather save button is clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //get all the values from the form 
        $task_name=$_POST['task_name'];
        $task_desc=$_POST['task_desc'];
        $list_id=$_POST['list_id'];
        $priority=$_POST['priority'];
        $deadline=$_POST['deadline'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select2 =mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

        $sql2="INSERT INTO tbl_tasks set
            task_name='$task_name',
            task_desc='$task_desc',
            list_id=$list_id,
            priority='$priority',
            deadline='$deadline'
        ";
        $res2 = mysqli_query($conn2, $sql2);

        if($res2==true){
            $_SESSION['add'] = "Task Added Successfully.";
            header('location:'.SITEURL);
        }
        else{
            $_SESSION['add_fail'] = "Failed to Add task";
            header('location:'.SITEURL.'add-task.php');
        }
    }

?>