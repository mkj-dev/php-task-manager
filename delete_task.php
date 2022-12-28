<?php
// Read the task index from the request body
$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];

// Read the tasks from the file
$tasks = json_decode(file_get_contents('tasks.json'), true);

// Remove the task at the specified index
if (array_key_exists($index, $tasks)) {
  array_splice($tasks, $index, 1);
  file_put_contents('tasks.json', json_encode($tasks));
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}
