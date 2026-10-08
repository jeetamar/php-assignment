<?php
// Task 5: HTML Content Find & Replace in PHP using str_replace()

$defaultSampleHtml = "PARTY2NAME, a company incorporated under the laws of ROC2LAW having its Registered Office at P1OFFICEADD. which expression, shall unless it be repugnant to the context or meaning thereof, mean and include its successors and assigns (hereinafter referred to as ‘‘ Service Provider’) of the ONE PART";

$htmlContent = isset($_POST['html_content']) ? $_POST['html_content'] : $defaultSampleHtml;

// Default replacement pairs
$defaultFind = ['PARTY2NAME', 'P1OFFICEADD', 'ROC2LAW'];
$defaultReplace = ['Abc india pvt. Ltd.', 'Mount Road,chennai-60014.', 'MCA India'];

$findInputs    = isset($_POST['find']) && is_array($_POST['find']) ? $_POST['find'] : $defaultFind;
$replaceInputs = isset($_POST['replace']) && is_array($_POST['replace']) ? $_POST['replace'] : $defaultReplace;

// Process replacement
$findPairs = [];
$replacePairs = [];

for ($i = 0; $i < count($findInputs); $i++) {
    $f = isset($findInputs[$i]) ? $findInputs[$i] : '';
    $r = isset($replaceInputs[$i]) ? $replaceInputs[$i] : '';
    if ($f !== '') {
        $findPairs[] = $f;
        $replacePairs[] = $r;
    }
}

$resultHtml = str_replace($findPairs, $replacePairs, $htmlContent);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 5 - HTML Find & Replace</title>
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
                <a href="../task3-string-replace/index.php" class="nav-link">Task 3: String Replace</a>
                <a href="../task4-date-difference/index.php" class="nav-link">Task 4: Date Diff</a>
                <a href="index.php" class="nav-link active">Task 5: HTML Replace</a>
                <a href="../task6-triplet/index.php" class="nav-link">Task 6: Triplet Sum</a>
            </nav>
        </div>
    </header>

    <main class="app-container">
        <div class="page-header">
            <h1 class="page-title">Task 5 — HTML Content Find & Replace</h1>
            <p class="page-subtitle">Find and replace text placeholders inside HTML content using PHP <code>str_replace()</code></p>
        </div>

        <div class="card">
            <h2 class="card-title">HTML Content & Replacement Pairs</h2>
            
            <form method="POST" action="">
                <div class="form-group full-width">
                    <label for="html_content">HTML / Text Content</label>
                    <textarea id="html_content" name="html_content" rows="6" required><?php echo htmlspecialchars($htmlContent); ?></textarea>
                </div>

                <h3 style="font-size: 1.05rem; margin-bottom: 1rem; color: var(--dark-bg);">Search & Replace Rules</h3>

                <div id="replacementPairs">
                    <?php 
                    $pairCount = max(count($findInputs), 3);
                    for ($i = 0; $i < $pairCount; $i++): 
                        $valFind = isset($findInputs[$i]) ? $findInputs[$i] : '';
                        $valReplace = isset($replaceInputs[$i]) ? $replaceInputs[$i] : '';
                    ?>
                        <div class="form-grid" style="margin-bottom: 0.75rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Text to Find #<?php echo $i + 1; ?></label>
                                <input type="text" name="find[]" value="<?php echo htmlspecialchars($valFind); ?>" placeholder="e.g. PARTY2NAME">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Text to Replace With #<?php echo $i + 1; ?></label>
                                <input type="text" name="replace[]" value="<?php echo htmlspecialchars($valReplace); ?>" placeholder="e.g. Abc india pvt. Ltd.">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Replace HTML Content</button>
                    <a href="index.php" class="btn btn-secondary">Reset Defaults</a>
                </div>
            </form>
        </div>

        <div class="card">
            <h2 class="card-title">Results Comparison</h2>

            <div class="result-box" style="border-left-color: #64748b;">
                <h4>Original Content:</h4>
                <div class="result-content"><?php echo htmlspecialchars($htmlContent); ?></div>
            </div>

            <div class="result-box" style="border-left-color: #10b981; margin-top: 1.5rem;">
                <h4>Replaced Result Content:</h4>
                <div class="result-content"><?php echo htmlspecialchars($resultHtml); ?></div>
            </div>
        </div>
    </main>

    <footer class="app-footer">
        <p>&copy; PHP Developer Technical Assignment - php-assignment</p>
    </footer>
</body>
</html>

