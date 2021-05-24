<?php
    include('config/constants.php');
    //get the list id from URL
    $list_id_url=$_GET['list_id'];
?>

<html>
    <head>
        <title>Task Manager</title>
        <link rel="stylesheet" href="<?php echo SITEURL;?>css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>

    <body>
        <div  class="icon-tray">
            <h1><img src="images/icon.png" alt="icon" width=48 height=48>BusyDay</h1>
        </div>
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
        <div class=all-task>
            <a href="<?php echo SITEURL; ?>add-task.php">Add Task</a>
            <table>
                <tr>
                    <th>S. No.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                    $sql = "SELECT * FROM tbl_tasks 
                        WHERE list_id=$list_id_url";
                    $res=mysqli_query($conn, $sql);

                    if($res==true){
                        //display the tasks based on list
                        $count_rows=mysqli_num_rows($res);
                        $sn=1;
                        if($count_rows>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $task_id=$row['task_id'];
                                $task_name=$row['task_name'];
                                $priority=$row['priority'];
                                $deadline=$row['deadline'];
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
                            ?>
                            <tr>
                                <td colspan=5>No Tasks added in this list</td>
                            </tr>
                            <?php
                        }
                    }
                ?>
                
            </table>
        </div>
    </body>
</html>