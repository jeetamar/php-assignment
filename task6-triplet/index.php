<?php
// Task 6: Triplet Sum Algorithm in PHP

/**
 * Find if there is a triplet in the array whose sum equals $target
 *
 * @param array $arr
 * @param int $target
 * @return array|null Returns array of 3 numbers if found, null otherwise
 */
function findTriplet(array $arr, int $target): ?array {
    $n = count($arr);
    for ($i = 0; $i < $n - 2; $i++) {
        for ($j = $i + 1; $j < $n - 1; $j++) {
            for ($k = $j + 1; $k < $n; $k++) {
                if ($arr[$i] + $arr[$j] + $arr[$k] === $target) {
                    return [$arr[$i], $arr[$j], $arr[$k]];
                }
            }
        }
    }
    return null;
}

// Default sample values
$arrayInput = isset($_POST['array_input']) ? trim($_POST['array_input']) : '12, 3, 4, 1, 6, 9';
$targetInput = isset($_POST['target_val']) ? trim($_POST['target_val']) : '24';

$parsedArray = [];
$tripletResult = null;
$errorMsg = '';
$isSearched = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['auto'])) {
    $isSearched = true;
    
    // Parse comma-separated array input
    $rawItems = array_map('trim', explode(',', $arrayInput));
    $validNumbers = [];
    $hasInvalid = false;

    foreach ($rawItems as $item) {
        if ($item === '') continue;
        if (is_numeric($item)) {
            $validNumbers[] = (int)$item;
        } else {
            $hasInvalid = true;
        }
    }

    if ($hasInvalid) {
        $errorMsg = "Please enter only valid numeric values separated by commas.";
    } elseif (!is_numeric($targetInput)) {
        $errorMsg = "Target sum value must be a valid integer.";
    } elseif (count($validNumbers) < 3) {
        $errorMsg = "Array must contain at least 3 numbers to search for a triplet.";
    } else {
        $parsedArray = $validNumbers;
        $targetVal = (int)$targetInput;
        $tripletResult = findTriplet($parsedArray, $targetVal);
    }
} else {
    // Initial page load calculation with sample values
    $isSearched = true;
    $parsedArray = [12, 3, 4, 1, 6, 9];
    $targetVal = 24;
    $tripletResult = findTriplet($parsedArray, $targetVal);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 6 - Triplet Sum</title>
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
                <a href="../task5-html-replace/index.php" class="nav-link">Task 5: HTML Replace</a>
                <a href="index.php" class="nav-link active">Task 6: Triplet Sum</a>
            </nav>
        </div>
    </header>

    <main class="app-container">
        <div class="page-header">
            <h1 class="page-title">Task 6 — Triplet Sum</h1>
            <p class="page-subtitle">Find three numbers in an array whose sum equals a target value in PHP</p>
        </div>

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errorMsg); ?></div>
        <?php endif; ?>

        <div class="card">
            <h2 class="card-title">Input Array & Target Sum</h2>

            <form method="POST" action="">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="array_input">Array Elements (Comma-separated numbers) <span class="required">*</span></label>
                        <input type="text" id="array_input" name="array_input" value="<?php echo htmlspecialchars($arrayInput); ?>" placeholder="e.g. 12, 3, 4, 1, 6, 9" required>
                    </div>

                    <div class="form-group">
                        <label for="target_val">Target Sum Value ($val) <span class="required">*</span></label>
                        <input type="number" id="target_val" name="target_val" value="<?php echo htmlspecialchars($targetInput); ?>" placeholder="e.g. 24" required>
                    </div>
                </div>

                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Find Triplet</button>
                    <a href="index.php" class="btn btn-secondary">Reset Sample Data</a>
                </div>
            </form>
        </div>

        <?php if ($isSearched && empty($errorMsg)): ?>
            <div class="card">
                <h2 class="card-title">Search Result</h2>

                <?php if ($tripletResult !== null): ?>
                    <div class="alert alert-success">
                        <strong>Status: True (Triplet Found)</strong>
                    </div>

                    <div class="result-box" style="border-left-color: #10b981;">
                        <h4>Triplet Found:</h4>
                        <div class="result-content" style="font-size: 1.1rem; font-weight: bold; color: #065f46;">
                            [<?php echo implode(', ', $tripletResult); ?>]
                        </div>
                    </div>

                    <div class="result-box" style="border-left-color: #3b82f6; margin-top: 1rem;">
                        <h4>Mathematical Verification:</h4>
                        <div class="result-content" style="font-size: 1.1rem; font-weight: bold; color: #1e40af;">
                            <?php echo implode(' + ', $tripletResult) . ' = ' . htmlspecialchars($targetInput); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <strong>Status: False (No Triplet Found)</strong>
                    </div>
                    <div class="result-box" style="border-left-color: #ef4444;">
                        <h4>Output:</h4>
                        <div class="result-content" style="color: #991b1b;">
                            No triplet exists in the array [<?php echo implode(', ', $parsedArray); ?>] whose sum equals <?php echo htmlspecialchars($targetInput); ?>.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="app-footer">
        <p>&copy; PHP Developer Technical Assignment - php-assignment</p>
    </footer>
</body>
</html>

