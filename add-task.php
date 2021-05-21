<?php
    include('config/constants.php');
?>

<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <a href="<?php echo SITEURL ?>">Home</a>
    <h3>Add Task Page</h3>

    <form method="POST" action="" >
        <table>
            <tr>
                <td>Task Name</th>
                <td>
                    <input type="text" name="task_name" placeholder="Type your Task Name Here" required>
                </td>
            </tr>
            <tr>
                <td>Task Description</th>
                <td>
                    <textarea name="task_desc" placeholder="Type your Task Description Here" required></textarea>
                </td>
            </tr>
            <tr>
                <td>Select List</td>
                <td>
                    <select name="list_id">
                        <option value="1">To Do</option>
                        <option value="2">Doing</option>
                        <option value="3">Done</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Priority:</td>
                <td>
                    <select name="priority">
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td><input type="date" name="deadline"></td>
            </tr>
            <tr>
                <td><input type="submit" name="save" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
</html>