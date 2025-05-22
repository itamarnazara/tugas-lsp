<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>To-Do List dengan Bootstrap</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .task-completed {
      text-decoration: line-through;
      color: gray;
    }
  </style>
</head>
<body class="bg-light py-5">
  <div class="container">
    <div class="card shadow-sm">
      <div class="card-header text-center">
        <h3>To-Do List</h3>
      </div>
      <div class="card-body">
        <!-- Form Tambah Tugas -->
        <form id="todo-form" class="d-flex mb-3">
          <input type="text" id="task-input" class="form-control me-2" placeholder="Tambahkan tugas..." required />
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

        <!-- Daftar Tugas -->
        <ul id="task-list" class="list-group"></ul>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const form = document.getElementById('todo-form');
    const taskInput = document.getElementById('task-input');
    const taskList = document.getElementById('task-list');

    let tasks = [];

    // Tambah Tugas
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const taskText = taskInput.value.trim();
      if (taskText !== '') {
        const task = {
          text: taskText,
          completed: false
        };
        tasks.push(task);
        taskInput.value = '';
        renderTasks();
      }
    });

    // Tampilkan Tugas
    function renderTasks() {
      taskList.innerHTML = '';
      tasks.forEach((task, index) => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.className = 'form-check-input me-2';
        checkbox.checked = task.completed;
        checkbox.addEventListener('change', () => {
          task.completed = checkbox.checked;
          renderTasks();
        });

        const span = document.createElement('span');
        span.textContent = task.text;
        if (task.completed) {
          span.classList.add('task-completed');
        }

        const left = document.createElement('div');
        left.className = 'd-flex align-items-center';
        left.appendChild(checkbox);
        left.appendChild(span);

        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn btn-sm btn-danger';
        deleteBtn.textContent = 'Hapus';
        deleteBtn.addEventListener('click', () => {
          tasks.splice(index, 1);
          renderTasks();
        });

        li.appendChild(left);
        li.appendChild(deleteBtn);
        taskList.appendChild(li);
      });
    }
  </script>
</body>
</html>
