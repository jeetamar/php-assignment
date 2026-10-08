<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Assignment - Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="app-header">
        <div class="header-container">
            <a href="index.php" class="brand-title">PHP <span>Assignment</span></a>
            <nav class="task-nav">
                <a href="index.php" class="nav-link active">Dashboard</a>
                <a href="student/index.php" class="nav-link">Task 1: Students</a>
                <a href="todo/index.php" class="nav-link">Task 2: Todo</a>
                <a href="task3-string-replace/index.php" class="nav-link">Task 3: String Replace</a>
                <a href="task4-date-difference/index.php" class="nav-link">Task 4: Date Diff</a>
                <a href="task5-html-replace/index.php" class="nav-link">Task 5: HTML Replace</a>
                <a href="task6-triplet/index.php" class="nav-link">Task 6: Triplet Sum</a>
            </nav>
        </div>
    </header>

    <main class="app-container">
        <div class="page-header">
            <h1 class="page-title">Technical Assignment Dashboard</h1>
            <p class="page-subtitle">PHP 8+, MySQL PDO, Vanilla JavaScript, AJAX Fetch API & Clean UI</p>
        </div>

        <div class="dashboard-grid">
            <!-- Task 1 -->
            <div class="dashboard-card">
                <div>
                    <h3>1. Student Management</h3>
                    <p>MySQL Database integration using PHP PDO & AJAX Fetch API. Form validation (client & server side) with auto age calculation.</p>
                </div>
                <a href="student/index.php" class="btn btn-primary">Open Task 1 &rarr;</a>
            </div>

            <!-- Task 2 -->
            <div class="dashboard-card">
                <div>
                    <h3>2. Todo List Application</h3>
                    <p>Client-side Todo List using Vanilla JS Array in memory. Complete CRUD (Add, Edit, Delete, Toggle Complete) without DB/storage.</p>
                </div>
                <a href="todo/index.php" class="btn btn-primary">Open Task 2 &rarr;</a>
            </div>

            <!-- Task 3 -->
            <div class="dashboard-card">
                <div>
                    <h3>3. String Replacement</h3>
                    <p>PHP <code>str_replace()</code> program to dynamic replace variables (@Name@, @email@, @mobile@, @designation@) in text.</p>
                </div>
                <a href="task3-string-replace/index.php" class="btn btn-primary">Open Task 3 &rarr;</a>
            </div>

            <!-- Task 4 -->
            <div class="dashboard-card">
                <div>
                    <h3>4. Date Difference</h3>
                    <p>Calculate day count difference between two dates using PHP DateTime/DateInterval & convert total days into words.</p>
                </div>
                <a href="task4-date-difference/index.php" class="btn btn-primary">Open Task 4 &rarr;</a>
            </div>

            <!-- Task 5 -->
            <div class="dashboard-card">
                <div>
                    <h3>5. HTML Find & Replace</h3>
                    <p>Find and replace text placeholders within HTML content using PHP str_replace() with full UI customizable inputs.</p>
                </div>
                <a href="task5-html-replace/index.php" class="btn btn-primary">Open Task 5 &rarr;</a>
            </div>

            <!-- Task 6 -->
            <div class="dashboard-card">
                <div>
                    <h3>6. Triplet Sum</h3>
                    <p>Algorithm in PHP to discover if three elements in an array sum up to a target value. Interactive array & target input.</p>
                </div>
                <a href="task6-triplet/index.php" class="btn btn-primary">Open Task 6 &rarr;</a>
            </div>
        </div>
    </main>

    <footer class="app-footer">
        <p>&copy; PHP Developer Technical Assignment - php-assignment</p>
    </footer>
</body>
</html>

