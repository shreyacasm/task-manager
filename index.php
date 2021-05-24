<?php
    include('config/constants.php');
?>
<html>
    <head>
        <title>Task Manager</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo SITEURL;?>css/style.css">
        
    </head>
    <body>
        <div  class="icon-tray">
            <h1><img src="images/icon.png" alt="icon" width=48 height=48>BusyDay</h1>
        </div>
        <!-- Menu starts here -->
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
                        ?>
                        <a class="list-name" href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                        <?php
                    }
                }

            ?>            
            
            <a class="c-list" href="<?php echo SITEURL; ?>manage-list.php"><i class="fas fa-tasks"> Customize Lists</i></a>
        </div>
        <!-- Menu ends here -->
        <p class="pos-para">
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
        
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
    
            ?>
        </p>
        <p class="neg-para">
            <?php
            if(isset($_SESSION['delete_fail'])){
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }
            ?>
        </p> 
        <!-- Task Starts here  -->
        <div class="all-task">
            <a class="add-task" href="<?php SITEURL: ?>add-task.php">Add Task <i class="far fa-calendar-plus"></i></a>
            <p></p>
            <table class="table table-info cust-table">
                <thead>
                <tr class="table-dark cust-dark">
                    <th scope="col">S. No.</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
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
                            //no tb
                            ?>
                            <tr>
                                <td scope="row" colspan="5">No Task Added Yet</td>
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