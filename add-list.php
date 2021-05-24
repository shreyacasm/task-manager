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
        <a class="c-list" href="<?php echo SITEURL; ?>manage-list.php"><i class="fas fa-tasks"> Customize Lists</i></a>
    </div>
    
    <h3>Add New List</h3>
    <p class="neg-para">
        <?php
            // check if the session created or not
            if(isset($_SESSION['add_fail'])){

                //display session message
                echo $_SESSION['add_fail'];
                //remove the message after displaying once
                unset($_SESSION['add_fail']);
            }
        ?>
    </p>
    <!-- form to add list starts here -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">List Name: </label>
            <input type="text" name="list_name"  class="form-control" id="exampleFormControlInput1" placeholder="Example: Shopping, To-Do" required="required" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Add a description</label>
            <textarea type="text" name="list_desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
            <button type="submit" name="submit" value="Submit" type="button" class="btn btn-primary btn-cust">Save</button>
    </form>
    <!-- form to add list ends here -->
</body>
</html>

<?php

    // check wheather the form is submitted or not
    if(isset($_POST['submit'])){
        // to get the value from the table 

        $list_name= $_POST['list_name'];
        $list_desc=$_POST['list_desc'];
        // echo $list_name, $list_desc;

        //connect database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //check wheather the database connected or not
        // if($conn == true){
        //     echo "database connected";
        // }

        //select database
        $db_select = mysqli_select_db($conn, DB_NAME);
        
        //check if database selected or not
        /*if($db_select==true){
            echo "data base selected is connected";
        }
        */
        //sql query to insert data into database 
        $sql = "INSERT INTO tbl_lists SET
            list_name = '$list_name' ,
            list_desc = '$list_desc'
        ";

        //execute query and insert into database

        $res = mysqli_query($conn, $sql);

        if($res == true){
            
            //echo "Query executed and data inserted into database";

            // create a session to display message
            $_SESSION['add'] = "List added successfully";

            //redirect to manage list page

            header('location:'.SITEURL.'manage-list.php');
            
            
        }
        else{
            //echo "Query failed";

            $_SESSION['add_fail'] ="List failed";

            header('location:'.SITEURL.'add-list.php');
        }

    }

?>