<?php
    include('config/constants.php');
?>
<html>
    <head>
        <title>Task Manager</title>
    </head>
    <body>
        <h1>Task Manager</h1>
        <!-- Menu starts here -->
        <div class="menu">    
            <a href="<?php echo SITEURL; ?>index.php">Home</a>
            <?php
                //displaying lists from database in our menu

                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                $sql2="SELECT * FROM tbl_lists";
                $res2 = mysqli_query($conn2, $sql2);

                if($res2 == true){
                    //display lists in menu
                    while($row2=mysqli_fetch_assoc($res2)){
                        $list_id = $row2['list_id'];
                        $list_name = $row2['list_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                        <?php
                    }
                }

            ?>            
            
            <a href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>
        </div>
        <!-- Menu ends here -->
        <p>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                
                if(isset($_SESSION['delete_fail'])){
                    echo $_SESSION['delete_fail'];
                    unset($_SESSION['delete_fail']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
    
            ?>
        </p> 
        <!-- Task Starts here  -->
        <div class="all-task">
            <a href="<?php SITEURL: ?>add-task.php">Add Task</a>
            <table>
                <tr>
                    <th>Serial No</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
                <?php
                    $conn=mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
                    $db_select=mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                    $sql="SELECT * FROM tbl_tasks";

                    $res=mysqli_query($conn,$sql);
                    
                    if($res==true){
                        //display the tasks from the database
                        $count_rows = mysqli_num_rows($res);
                        $sn = 1;    
                        if($count_rows>0){
                            //data is there in db
                            while($row=mysqli_fetch_assoc($res)){
                                $task_id=$row['task_id'];
                                $priority=$row['priority'];
                                $deadline=$row['deadline'];
                                $task_name=$row['task_name'];
                            
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                </td>
                            </tr>

                            <?php
                            }
                        }
                        else{
                            //no tb
                            ?>
                            <tr>
                                <td colspan="5">No Task Added Yet</td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>

        </div>
        <!-- Task Starts here  -->

    </body>
</html>