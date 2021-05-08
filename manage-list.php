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

        <!-- table to display list starts here -->
        <div class="all-lists">
            <a href="add-list.php">Add list</a>
            <table>
                <tr>
                    <th>S No.</th>
                    <th>List Name</th>
                    <th>Action</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>To Do</td>
                    <td>
                        <a href="#">Update</a>
                        <a href="#">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Doing</td>
                    <td>
                        <a href="#">Update</a>
                        <a href="#">Delete</a>
                    </td>
                </tr>
            </table>

        </div>
        
        <!-- table to display list ends here -->
    </body>
</html>
