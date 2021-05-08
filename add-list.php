<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    
    <a href="index.php">Home</a>
    <a href="manage-list.php">Manage List</a>
    
    <h3>Add List Page</h3>

    <!-- form to add list starts here -->
    <form method="POST" action="">
        <table>
            <tr>
                <td>List Name</td>
                <td><input type="text" name="list_name" placeholder="type list name here"></td>
            </tr>
            <tr>
                <td>List Description</td>
                <td><textarea type="text" name="list_desc" placeholder="type list description here"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </table>
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
        $conn = mysqli_connect("localhost","root", "") or die(mysqli_error());

        //check wheather the database connected or not
        // if($conn == true){
        //     echo "database connected";
        // }

        //select database
        $db_select = mysqli_select_db($conn, 'task_manager');
        
        //check if database selected or not
        /*if($db_select==true){
            echo "data base selected is connected";
        }
        /*
        
    }

?>