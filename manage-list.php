<?php
    include('config/constants.php');
?>
<html>
    <head>
        <title>Task Manager</title>
    </head>
    <body>
        <h1>Task Manager</h1>
        <a href="<?php echo SITEURL; ?>index.php">Home</a>
        <h3>Manage List Page</h3>

        <p>
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
            <a href="add-list.php">Add list</a>
            <table>
                <tr>
                    <th>S No.</th>
                    <th>List Name</th>
                    <th>Action</th>
                </tr>

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
                                <tr>
                                    <td> <?php echo $sn++; ?>. </td>
                                    <td> <?php echo "$list_name"; ?> </td>
                                    <td>
                                        <a href="#">Update</a>
                                        <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id ?>">Delete</a>
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
