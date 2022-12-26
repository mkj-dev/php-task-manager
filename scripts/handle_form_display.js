const taskForm = document.getElementById('task-form');
const showFormBtn = document.getElementById('show-form-btn');
const hideFormBtn = document.getElementById('hide-form-btn');

showFormBtn.addEventListener('click', () => {
  taskForm.style.display = 'block';
  showFormBtn.style.display = 'none';
  hideFormBtn.style.display = 'block';
});

hideFormBtn.addEventListener('click', () => {
  taskForm.style.display = 'none';
  showFormBtn.style.display = 'block';
  hideFormBtn.style.display = 'none';
});
