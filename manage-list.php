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
        <h3>Manage Your Lists</h3>

        <p class="pos-para">
            <?php
                // check if the session created or not
                if(isset($_SESSION['add'])){

                    //display session message
                    echo $_SESSION['add'];
                    //remove the message after displaying once
                    unset($_SESSION['add']);
                }

                //check for the session delete
                if(isset($_SESSION['delete'])){

                    //display session message
                    echo $_SESSION['delete'];
                    //remove the message after displaying once
                    unset($_SESSION['delete']);
                }
                
                //check update session is set or not
                if(isset($_SESSION['update'])){
                    //display session message for update
                    echo $_SESSION['update'];
                    //remove the message after update
                    unset($_SESSION['update']);
                }
            ?>
        </p>
        <p class="neg-para">
            <?php
                if(isset($_SESSION['delete_fail'])){

                    //display session message
                    echo $_SESSION['delete_fail'];
                    //remove the message after displaying once
                    unset($_SESSION['delete_fail']);
                }
            ?>
        </p>

        <!-- table to display list starts here -->
        <div class="all-lists">
        <a class="add-task" href="<?php SITEURL: ?>add-list.php">Add List <i class="far fa-calendar-plus"></i></a>
            <p></p>
            <table class="table table-info cust-table">
                <thead>
                    <tr class="table-dark cust-dark">
                        <th scope="col">S No.</th>
                        <th scope="col">List Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                    //connect the database

                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                    //select dataBASE
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                    //SQL query to display all list
                    $sql = "SELECT * FROM tbl_lists";

                    $res = mysqli_query($conn, $sql);

                    //check wheather query executed or not
                    if($res == true){
                        //echo "Query working";

                        //count the number of data in db 
                        $count_row = mysqli_num_rows($res);
                        $sn = 1;
                        if($count_row > 0){
                            //there data will be displayed

                            while($row=mysqli_fetch_assoc($res)){
                            //data is present as an array
                            
                                //getting data from database
                                $list_id = $row['list_id'];
                                $list_name = $row['list_name'];
                                
                                ?>
                                <tr class="cust-light">
                                    <td> <?php echo $sn++; ?>. </td>
                                    <td> <?php echo "$list_name"; ?> </td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id ?>"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id ?>"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                                <?php
                            }

                        }
                        else{
                             ?>
                                <tr>
                                    <td>NO List to display, Add List Now</td>
                                </tr>

                            <?php   
                        }
                    }

                ?>
            </table>

        </div>
        
        <!-- table to display list ends here -->
    </body>
</html>
