<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2 - Todo List Application</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header class="app-header">
        <div class="header-container">
            <a href="../index.php" class="brand-title">PHP <span>Assignment</span></a>
            <nav class="task-nav">
                <a href="../index.php" class="nav-link">Dashboard</a>
                <a href="../student/index.php" class="nav-link">Task 1: Students</a>
                <a href="index.php" class="nav-link active">Task 2: Todo</a>
                <a href="../task3-string-replace/index.php" class="nav-link">Task 3: String Replace</a>
                <a href="../task4-date-difference/index.php" class="nav-link">Task 4: Date Diff</a>
                <a href="../task5-html-replace/index.php" class="nav-link">Task 5: HTML Replace</a>
                <a href="../task6-triplet/index.php" class="nav-link">Task 6: Triplet Sum</a>
            </nav>
        </div>
    </header>

    <main class="app-container">
        <div class="page-header">
            <h1 class="page-title">Task 2 — Todo List Application</h1>
            <p class="page-subtitle">Client-Side JavaScript Array Management (No Database / No Storage)</p>
        </div>

        <div id="todoAlert" class="alert" style="display: none;"></div>

        <div class="card">
            <h2 class="card-title">Manage Your Todos</h2>
            
            <form id="todoForm" class="todo-input-group">
                <input type="text" id="todoInput" placeholder="Enter a new todo item..." required style="flex: 1;">
                <button type="submit" id="submitBtn" class="btn btn-primary">Add Todo</button>
                <button type="button" id="cancelEditBtn" class="btn btn-secondary" style="display: none;">Cancel</button>
            </form>

            <ul id="todoList" class="todo-list">
                <!-- Rendered dynamically from JavaScript todos[] array -->
            </ul>
        </div>
    </main>

    <footer class="app-footer">
        <p>&copy; PHP Developer Technical Assignment - php-assignment</p>
    </footer>

    <script src="js/todo.js"></script>
</body>
</html>

