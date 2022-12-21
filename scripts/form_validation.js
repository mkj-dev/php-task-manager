const form = document.getElementById('task-form');

form.addEventListener('submit', (event) => {
    event.preventDefault(); // prevent the form from being sent

    const title = document.getElementById('task-title').value;
    const description = document.getElementById('task-description').value;
    const deadline = document.getElementById('task-deadline').value;

    if (!title) {
        alert('Please, add a task title.');
        return;
    }

    if (!description) {
        alert('Please, add a task description.');
        return;
    }

    if (!deadline) {
        alert('Please, add a task deadline.');
        return;
    }

    form.submit(); // sent the form
});