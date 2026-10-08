<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1 - Student Management</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header class="app-header">
        <div class="header-container">
            <a href="../index.php" class="brand-title">PHP <span>Assignment</span></a>
            <nav class="task-nav">
                <a href="../index.php" class="nav-link">Dashboard</a>
                <a href="index.php" class="nav-link active">Task 1: Students</a>
                <a href="../todo/index.php" class="nav-link">Task 2: Todo</a>
                <a href="../task3-string-replace/index.php" class="nav-link">Task 3: String Replace</a>
                <a href="../task4-date-difference/index.php" class="nav-link">Task 4: Date Diff</a>
                <a href="../task5-html-replace/index.php" class="nav-link">Task 5: HTML Replace</a>
                <a href="../task6-triplet/index.php" class="nav-link">Task 6: Triplet Sum</a>
            </nav>
        </div>
    </header>

    <main class="app-container">
        <div class="page-header">
            <h1 class="page-title">Task 1 — Student Management</h1>
            <p class="page-subtitle">MySQL Database Integration via PHP PDO & AJAX Fetch API</p>
        </div>

        <div id="alertBox" class="alert" style="display: none;"></div>

        <!-- Student Input Form -->
        <div class="card">
            <h2 class="card-title">Add New Student</h2>
            <form id="studentForm" novalidate>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Enter student full name" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="standard">Standard / Grade <span class="required">*</span></label>
                        <input type="text" id="standard" name="standard" placeholder="e.g. 10th Standard, Class 5" required>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth <span class="required">*</span></label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required>
                    </div>

                    <div class="form-group">
                        <label for="age">Age (Auto-calculated)</label>
                        <input type="number" id="age" name="age" readonly placeholder="Calculated automatically">
                    </div>

                    <div class="form-group">
                        <label for="father_name">Father Name</label>
                        <input type="text" id="father_name" name="father_name" placeholder="Enter father's name">
                    </div>

                    <div class="form-group">
                        <label for="father_mobile">Father Mobile Number <span class="required">*</span></label>
                        <input type="tel" id="father_mobile" name="father_mobile" placeholder="10-digit mobile number" maxlength="10" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" placeholder="student@example.com" required>
                    </div>
                </div>

                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Add Student</button>
                    <button type="reset" class="btn btn-secondary">Reset Form</button>
                </div>
            </form>
        </div>

        <!-- Student List Table -->
        <div class="card">
            <h2 class="card-title">Registered Students List (From MySQL Database)</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Standard</th>
                            <th>DOB</th>
                            <th>Age</th>
                            <th>Father Name</th>
                            <th>Father Mobile</th>
                            <th>Email</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody">
                        <tr>
                            <td colspan="10" class="no-data">Loading student data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="app-footer">
        <p>&copy; PHP Developer Technical Assignment - php-assignment</p>
    </footer>

    <script src="js/student.js"></script>
</body>
</html>

