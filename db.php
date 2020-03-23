<?php
// Error function
$errors = "";

// Success message
$success = "";

// Database credentials
    $dbhost = "localhost";
    $dbuser = "winjohan";
    $dbpass = "nahojs2630!";
    $dbname = "todoappinphp";

    // Connect to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Test the connection
    if(mysqli_errno($conn))
    {
        echo "Can't connect to the database" . mysqli_errno($conn);
    }
        
?>
<!-- https://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database -->
<!-- https://blog.devcenter.co/easy-way-to-php-todolist-app-crud-e1284265bb27 -->
<!-- https://github.com/mayomi1/todolist-tutorial/blob/master/todo/delete.php -->
<!-- https://www.studentstutorial.com/php/php-mysql-data-update.php -->
