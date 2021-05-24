<?php
    include('config/constants.php');
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
    <h3>Add New Task</h3>
    <p class="neg-para">
        <?php
            if(isset($_SESSION['add_fail'])){
                echo $_SESSION['add_fail'];
                unset($_SESSION['add_fail']);
            }
        ?>
    </p>
    <form method="POST" action="" >
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Task Name: </label>
            <input type="text" name="task_name"  class="form-control" id="exampleFormControlInput1" placeholder="Example: Design a Website, visit rock garden, etc..." required="required" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Add a description</label>
            <textarea type="text" name="task_desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
            
            <label for="exampleFormControlTextarea1" class="form-label">Select List (Task Type):</label>
                    <select class="form-select mb-3"  name="list_id">
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
            
                <label for="exampleFormControlTextarea1" class="form-label">Set Priority Level:</label>
            
                
                    <select class="form-select mb-3" name="priority">
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                
            <label for="exampleFormControlTextarea1" class="form-label">Deadline:</label>
            <input type="date" name="deadline" class="form-control mb-3" id="exampleFormControlInput1">
            <button type="submit" name="submit" value="Save" type="button" class="btn btn-primary btn-cust">Save</button>
        
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