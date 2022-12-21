<?php
// PHP code for creating a new task

// Check if the form was submitted
if (isset($_POST['task-title']) && isset($_POST['task-description']) && isset($_POST['task-deadline'])) {
  // Get the task data from the form
  $title = $_POST['task-title'];
  $description = $_POST['task-description'];
  $deadline = $_POST['task-deadline'];

  // Create a new task as an array
  $task = [
    'title' => $title,
    'description' => $description,
    'deadline' => $deadline,
  ];

  // Read the tasks from the file
  $tasks = json_decode(file_get_contents('tasks.json'), true);

  // Add the new task to the array
  $tasks[] = $task;

  // Write the tasks back to the file
  file_put_contents('tasks.json', json_encode($tasks));

  // Redirect to the homepage
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task manager</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- HTML code for the task creation form -->
  <form id="task-form" method="post">
    <label for="task-title">Task title:</label>
    <input type="text" id="task-title" name="task-title">
    <label for="task-description">Task description:</label>
    <textarea id="task-description" name="task-description"></textarea>
    <label for="task-deadline">Deadline:</label>
    <input type="date" id="task-deadline" name="task-deadline">
    <button type="submit">Create a task</button>
  </form>
  <script src="./scripts/form_validation.js"></script>
</body>

</html>