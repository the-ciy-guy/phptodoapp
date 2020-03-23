<?php
    include 'db.php';

    $update = false;
    // Insert into the database
    if(isset($_POST['submit']))
    {
        // Validation
        if(empty($_POST['todoTitle']))
        {
            $errors = "Title or Description can't be empty";
        }
        else if(empty($_POST['todoDescription']))
        {
            $errors = "Description can't be empty";
        }
        else
        {
            // Insert into the database
            $task = $_POST['todoTitle'];
            $desc = $_POST['todoDescription'];

            $query = "INSERT INTO todo (todoTitle, todoDescription, date) VALUES ('$task', '$desc', now())";
            $sql = mysqli_query($conn, $query);
            header('Location: index.php');
        }
    }

    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        $update = true;
        $editquery = "SELECT * FROM todo WHERE id =" .$id;
        $editsql = mysqli_query($conn, $editquery);

        if(@count($editsql) == 1)
        {
            $n = mysqli_fetch_array($editsql);
            $task = $n['todoTitle'];
            $editdesc = $n['todoDescription'];
        }
    }

    // Delete Task
    if(isset($_GET['task_del']))
    {
        $id = $_GET['task_del'];
        $delquery = "DELETE FROM todo WHERE id =" .$id;
        $delete = mysqli_query($conn, $delquery);
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Task List</title>
</head>
<body>
    <div class="container">
        <?php if(isset($_GET['edit'])): ?><h2>Edit Task</h2>
        <?php else : ?><h2>Create Tasks</h2>
        <?php endif; ?>
        <div class="task__grid">
            <div class="task__form">
                <form action="index.php" method="post">
                    <?php if(isset($errors))
                    {
                        echo $errors;
                    }
                    ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <?php if($update == true): ?>
                        <div class="task__input">
                            <input type="text" name="todoTitle" value="<?php echo $task; ?>" placeholder="Task Name" autocomplete="off">
                        </div>
                        <div class="task__desc">
                            <textarea name="todoDescription" cols="30" rows="10"><?php echo $editdesc; ?></textarea>
                        </div>
                    <?php else: ?>
                        <div class="task__input">
                            <input type="text" name="todoTitle" placeholder="Task Name" autocomplete="off">
                        </div>
                        
                        <div class="task__desc">
                            <textarea name="todoDescription" cols="30" rows="10" placeholder="Description"></textarea>
                        </div>
                    <?php endif; ?>        
                    <?php if($update == true): ?>
                    
                        <button class="task__button button__edit" type="submit" name="update">Update</button>
                        <button onclick="fade_out()" class="task__button button__cancel"><a href="index.php">Cancel</a></button>
                    <?php else: ?> 
                    
                        <button onclick="fade_in()" class="task__button" type="submit" name="submit">Save</button>
                      
                    <?php endif; ?>    
                </form>
            </div>
            <div class="task__display">
            <!-- Display the tasks -->
                <?php
                    $tasks = "SELECT * FROM todo";
                    $result = mysqli_query($conn, $tasks);
                    $check = mysqli_num_rows($result);
                    
                    if($check > 0)
                    {
                        $i = 1;
                        while($row = mysqli_fetch_array($result)) : ?>
                        <div class="task__list">
                            <p id="task"><?php echo $row['todoTitle']; ?> | <?php echo $row['todoDescription']; ?><a class="task__edit" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a><a id="fade_del" class="task__del" href="index.php?task_del=<?php echo $row['id']; ?>">V</a></p>
                        </div>
                        <?php
                        $i++;
                        endwhile;
                    }

                    if(isset($_POST['update']))
                    {
                        if(empty($_POST['todoTitle']))
                        {
                            $errors = "Title can't be empty";
                        }
                        else if(empty($_POST['todoDescription']))
                        {
                            $errors = "Description can't be empty";
                        }
                        else
                        {

                            $id = $_POST['id'];
                            $title = $_POST['todoTitle'];
                            $desc = $_POST['todoDescription'];

                            mysqli_query($conn, "UPDATE todo SET todoTitle='$title', todoDescription='$desc' WHERE id=$id");
                            header('Location: index.php');
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>