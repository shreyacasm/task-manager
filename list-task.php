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
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        
    </head>

    <body>
        <div  class="icon-tray">
            <h1><img src="images/icon.png" alt="icon" width=48 height=48>BusyDay</h1>
        </div>
        <div class="menu">    
        <a href="<?php echo SITEURL; ?>index.php"><i class="fas fa-home">Home</i></a>
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
                        if($list_id==$list_id_url){
                        ?>
                        <a class="list-name list-selected" href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                        <?php
                        }
                        else{
                        ?>
                        <a class="list-name" href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                        <?php
                        }
                    }
                }

            ?>            
            
            <a class="c-list" href="<?php echo SITEURL; ?>manage-list.php"><i class="fas fa-tasks"> Customize Lists</i></a>
        </div>
        <!-- Menu ends here -->
        <div class=all-task>
        <a class="add-task" href="<?php SITEURL: ?>add-task.php">Add Task <i class="far fa-calendar-plus"></i></a>
            <p></p>
            <table class="table table-info cust-table">
                <tr class="table-dark cust-dark">
                    <th scope="col">S. No.</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Actions</th>
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
                                <tr class="cust-light">
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>"><i class="fas fa-trash-alt"></i></a>
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