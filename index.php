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
  <button id="show-form-btn">Show form</button>
  <button id="hide-form-btn">Hide form</button>

  <!-- HTML code for the task creation form -->
  <form id="task-form" method="post">
    <label for="task-title">Task title:</label>
    <input type="text" id="task-title" name="task-title">
    <label for="task-description">Task description:</label>
    <textarea id="task-description" name="task-description" maxlength="200"></textarea>
    <label for="task-deadline">Deadline:</label>
    <input type="date" id="task-deadline" name="task-deadline">
    <button type="submit">Create a task</button>
  </form>

  <div id="container">
    <ul id="task-list">
      <?php
      // Read the tasks from the file
      $tasks = json_decode(file_get_contents('tasks.json'), true);
      // Loop through the tasks and add them to the list
      foreach ($tasks as $index => $task) :;
        echo "<li class='task'>";
        echo "<h3 class='task-title'>{$task['title']}</h3>";
        echo "<p class='task-description'>{$task['description']}</p>";
        echo "<p class='task-deadline'>Deadline: {$task['deadline']}</p>";
        // Add the task index to the delete button's data attribute, without it console
        // displays 'Reference Error Uncaught ReferenceError: index is not defined' after
        // clicking delete button
        echo "<button class='delete-btn' data-index='$index'>Delete</button>";
        echo "</li>";
      endforeach;
      ?>
    </ul>
  </div>
  <script src="./scripts/form_validation.js"></script>
  <script src="./scripts/handle_form_display.js"></script>
  <script>
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', event => {
        // In the event listener callback function, retrieve the task index from the delete button's data attribute
        const index = event.target.getAttribute('data-index');
        // Send an AJAX request to delete the task
        fetch('delete_task.php', {
            method: 'POST',
            body: JSON.stringify({
              index: index
            }),
            headers: {
              'Content-Type': 'application/json'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Remove the task from the HTML task list
              event.target.closest('.task').remove();
            } else {
              // Show an error message
              console.log('Error deleting task');
            }
          });
      });
    });
  </script>
</body>

</html>