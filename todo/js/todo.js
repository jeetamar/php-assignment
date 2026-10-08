// Task 2: Pure JavaScript Array-based Todo List Application
// CRITICAL: NO Database, NO PHP, NO localStorage, NO sessionStorage

// All todo items are strictly stored in memory in this JS array
let todos = [];
let nextId = 1;
let currentEditId = null;

document.addEventListener('DOMContentLoaded', () => {
    const todoForm = document.getElementById('todoForm');
    const todoInput = document.getElementById('todoInput');
    const submitBtn = document.getElementById('submitBtn');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const todoListContainer = document.getElementById('todoList');
    const alertBox = document.getElementById('todoAlert');

    // Helper to escape HTML characters
    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // Helper to show alert messages
    function showAlert(message, type = 'danger') {
        alertBox.className = `alert alert-${type}`;
        alertBox.textContent = message;
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000);
    }

    // Render Todos from todos array
    window.renderTodos = function() {
        if (todos.length === 0) {
            todoListContainer.innerHTML = '<li class="no-data">No todo items available. Add your first task above!</li>';
            return;
        }

        let html = '';
        todos.forEach(todo => {
            const completedClass = todo.completed ? 'completed' : '';
            const statusBadge = todo.completed 
                ? '<span class="badge badge-success">Completed</span>' 
                : '<span class="badge badge-pending">Pending</span>';
            const toggleText = todo.completed ? 'Undo' : 'Complete';
            const toggleBtnClass = todo.completed ? 'btn-warning' : 'btn-success';

            html += `
                <li class="todo-item ${completedClass}" data-id="${todo.id}">
                    <div class="todo-content">
                        ${statusBadge}
                        <span class="todo-text">${escapeHtml(todo.title)}</span>
                    </div>
                    <div class="todo-actions">
                        <button onclick="toggleComplete(${todo.id})" class="btn btn-sm ${toggleBtnClass}">
                            ${toggleText}
                        </button>
                        <button onclick="startEditTodo(${todo.id})" class="btn btn-sm btn-primary">
                            Edit
                        </button>
                        <button onclick="deleteTodo(${todo.id})" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </div>
                </li>
            `;
        });

        todoListContainer.innerHTML = html;
    };

    // Add a new Todo item to todos[]
    window.addTodo = function(title) {
        const trimmedTitle = title.trim();
        if (!trimmedTitle) {
            showAlert('Todo title cannot be empty!', 'danger');
            return false;
        }

        const newTodo = {
            id: nextId++,
            title: trimmedTitle,
            completed: false
        };

        todos.push(newTodo);
        renderTodos();
        return true;
    };

    // Edit an existing Todo item in todos[]
    window.editTodo = function(id, newTitle) {
        const trimmedTitle = newTitle.trim();
        if (!trimmedTitle) {
            showAlert('Todo title cannot be empty!', 'danger');
            return false;
        }

        const todo = todos.find(t => t.id === id);
        if (todo) {
            todo.title = trimmedTitle;
            renderTodos();
            return true;
        }
        return false;
    };

    // Start Edit mode in form
    window.startEditTodo = function(id) {
        const todo = todos.find(t => t.id === id);
        if (!todo) return;

        currentEditId = id;
        todoInput.value = todo.title;
        submitBtn.textContent = 'Update Todo';
        submitBtn.className = 'btn btn-warning';
        cancelEditBtn.style.display = 'inline-flex';
        todoInput.focus();
    };

    // Reset Form from Edit mode to Add mode
    function resetForm() {
        currentEditId = null;
        todoInput.value = '';
        submitBtn.textContent = 'Add Todo';
        submitBtn.className = 'btn btn-primary';
        cancelEditBtn.style.display = 'none';
    }

    window.cancelEdit = function() {
        resetForm();
    };

    // Delete a Todo item from todos[]
    window.deleteTodo = function(id) {
        todos = todos.filter(todo => todo.id !== id);
        if (currentEditId === id) {
            resetForm();
        }
        renderTodos();
    };

    // Toggle Completed state of Todo item in todos[]
    window.toggleComplete = function(id) {
        const todo = todos.find(t => t.id === id);
        if (todo) {
            todo.completed = !todo.completed;
            renderTodos();
        }
    };

    // Form Submit Handler (Add or Edit)
    todoForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const value = todoInput.value;

        if (currentEditId !== null) {
            if (editTodo(currentEditId, value)) {
                resetForm();
            }
        } else {
            if (addTodo(value)) {
                todoInput.value = '';
            }
        }
    });

    cancelEditBtn.addEventListener('click', () => {
        resetForm();
    });

    // Add initial default sample todos for easy testing
    todos.push(
        { id: nextId++, title: "Learn PHP 8 Prepared Statements", completed: true },
        { id: nextId++, title: "Build Task 2 Pure JS Todo List", completed: false },
        { id: nextId++, title: "Test all validation rules", completed: false }
    );

    // Initial render
    renderTodos();
});

