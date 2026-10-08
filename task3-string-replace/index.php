<?php
// Task 3: String Replacement in PHP using str_replace()

$defaultOriginalString = "@Name@ ipsum dolor sit amet, consectetur adipiscing elit. Praesent in mollis magna. Donec eu elit pellentesque, maximus nisl vitae, cursus velit. Sed Loremnibh sed elit auctor tincidunt. Donec tempor est id nunc ullamcorper rhoncus. Phasellus nec arcu et dui varius ullamcorper commodo quis ligula. Etiam ultrices nisi @email@, ut euismod elit tempor sed. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor turpis vel nisi fermentum, a sodales magna egestas. Vestibulum lobortis elit sed neque rhoncus, sit amet @mobile@ magna blandit. @designation@ nec leo ac diam euismod fringilla.";

// Retrieve form values or set defaults
$originalString = isset($_POST['original_string']) ? $_POST['original_string'] : $defaultOriginalString;
$name           = isset($_POST['name']) ? $_POST['name'] : 'RRRR';
$email          = isset($_POST['email']) ? $_POST['email'] : 'RRR@RRR.com';
$mobile         = isset($_POST['mobile']) ? $_POST['mobile'] : '9988775566';
$designation    = isset($_POST['designation']) ? $_POST['designation'] : 'Software Developer';

// Perform replacement using PHP str_replace()
$placeholders = ['@Name@', '@email@', '@mobile@', '@designation@'];
$replacements = [$name, $email, $mobile, $designation];

$replacedString = str_replace($placeholders, $replacements, $originalString);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 3 - String Replacement</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header class="app-header">
        <div class="header-container">
            <a href="../index.php" class="brand-title">PHP <span>Assignment</span></a>
            <nav class="task-nav">
                <a href="../index.php" class="nav-link">Dashboard</a>
                <a href="../student/index.php" class="nav-link">Task 1: Students</a>
                <a href="../todo/index.php" class="nav-link">Task 2: Todo</a>
                <a href="index.php" class="nav-link active">Task 3: String Replace</a>
                <a href="../task4-date-difference/index.php" class="nav-link">Task 4: Date Diff</a>
                <a href="../task5-html-replace/index.php" class="nav-link">Task 5: HTML Replace</a>
                <a href="../task6-triplet/index.php" class="nav-link">Task 6: Triplet Sum</a>
            </nav>
        </div>
    </header>

    <main class="app-container">
        <div class="page-header">
            <h1 class="page-title">Task 3 — String Replacement</h1>
            <p class="page-subtitle">Dynamic text replacement using PHP <code>str_replace()</code></p>
        </div>

        <div class="card">
            <h2 class="card-title">Replacement Parameters</h2>
            <form method="POST" action="">
                <div class="form-group full-width">
                    <label for="original_string">Original Template String</label>
                    <textarea id="original_string" name="original_string" rows="5" required><?php echo htmlspecialchars($originalString); ?></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name (Replaces <code>@Name@</code>)</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email (Replaces <code>@email@</code>)</label>
                        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile (Replaces <code>@mobile@</code>)</label>
                        <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="designation">Designation (Replaces <code>@designation@</code>)</label>
                        <input type="text" id="designation" name="designation" value="<?php echo htmlspecialchars($designation); ?>" required>
                    </div>
                </div>

                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Replace</button>
                    <a href="index.php" class="btn btn-secondary">Reset Defaults</a>
                </div>
            </form>
        </div>

        <div class="card">
            <h2 class="card-title">Results</h2>

            <div class="result-box" style="border-left-color: #64748b;">
                <h4>Original String:</h4>
                <div class="result-content"><?php echo htmlspecialchars($originalString); ?></div>
            </div>

            <div class="result-box" style="border-left-color: #10b981; margin-top: 1.5rem;">
                <h4>Replaced Result String:</h4>
                <div class="result-content"><?php echo htmlspecialchars($replacedString); ?></div>
            </div>
        </div>
    </main>

    <footer class="app-footer">
        <p>&copy; PHP Developer Technical Assignment - php-assignment</p>
    </footer>
</body>
</html>

