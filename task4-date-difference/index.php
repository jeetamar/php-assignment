<?php
// Task 4: Date Difference and Number to Words in PHP

/**
 * Convert an integer number into English words
 *
 * @param int $number
 * @return string
 */
function numberToWords(int $number): string {
    if ($number === 0) {
        return "Zero";
    }

    $units = [
        '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
        'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
    ];
    $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    if ($number < 20) {
        return $units[$number];
    }

    if ($number < 100) {
        return $tens[intval($number / 10)] . ($number % 10 ? ' ' . $units[$number % 10] : '');
    }

    if ($number < 1000) {
        return $units[intval($number / 100)] . ' Hundred' . ($number % 100 ? ' ' . numberToWords($number % 100) : '');
    }

    if ($number < 1000000) {
        return numberToWords(intval($number / 1000)) . ' Thousand' . ($number % 1000 ? ' ' . numberToWords($number % 1000) : '');
    }

    if ($number < 1000000000) {
        return numberToWords(intval($number / 1000000)) . ' Million' . ($number % 1000000 ? ' ' . numberToWords($number % 1000000) : '');
    }

    return (string)$number;
}

// Default values as per task specification (26/12/2022 to 29/12/2024)
$date1_str = isset($_POST['date1']) ? trim($_POST['date1']) : '2022-12-26';
$date2_str = isset($_POST['date2']) ? trim($_POST['date2']) : '2024-12-29';

$daysCount = null;
$daysInWords = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($date1_str) || empty($date2_str)) {
        $errorMsg = "Both Date 1 and Date 2 are required.";
    } else {
        try {
            $d1 = new DateTime($date1_str);
            $d2 = new DateTime($date2_str);

            // Absolute difference in days
            $interval = $d1->diff($d2);
            $daysCount = $interval->days;

            $suffix = ($daysCount === 1) ? ' Day' : ' Days';
            $daysInWords = numberToWords($daysCount) . $suffix;
        } catch (Exception $e) {
            $errorMsg = "Invalid date selection. Please choose valid dates.";
        }
    }
} else {
    // Initial load calculation with sample values
    $d1 = new DateTime($date1_str);
    $d2 = new DateTime($date2_str);
    $daysCount = $d1->diff($d2)->days;
    $daysInWords = numberToWords($daysCount) . ' Days';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 4 - Date Difference</title>
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
                <a href="index.php" class="nav-link active">Task 4: Date Diff</a>
                <a href="../task5-html-replace/index.php" class="nav-link">Task 5: HTML Replace</a>
                <a href="../task6-triplet/index.php" class="nav-link">Task 6: Triplet Sum</a>
            </nav>
        </div>
    </header>

    <main class="app-container">
        <div class="page-header">
            <h1 class="page-title">Task 4 — Date Difference</h1>
            <p class="page-subtitle">Calculate day count difference and convert total days into words using PHP DateTime</p>
        </div>

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errorMsg); ?></div>
        <?php endif; ?>

        <div class="card">
            <h2 class="card-title">Select Dates</h2>
            <form method="POST" action="">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="date1">Date 1 <span class="required">*</span></label>
                        <input type="date" id="date1" name="date1" value="<?php echo htmlspecialchars($date1_str); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="date2">Date 2 <span class="required">*</span></label>
                        <input type="date" id="date2" name="date2" value="<?php echo htmlspecialchars($date2_str); ?>" required>
                    </div>
                </div>

                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Calculate</button>
                    <a href="index.php" class="btn btn-secondary">Reset Sample Dates</a>
                </div>
            </form>
        </div>

        <?php if ($daysCount !== null): ?>
            <div class="card">
                <h2 class="card-title">Calculation Results</h2>

                <div class="result-box" style="border-left-color: #3b82f6;">
                    <h4>1. Number of Days:</h4>
                    <div class="result-content" style="font-size: 1.2rem; font-weight: bold; color: #1e293b;">
                        <?php echo $daysCount . ($daysCount === 1 ? ' Day' : ' Days'); ?>
                    </div>
                </div>

                <div class="result-box" style="border-left-color: #10b981; margin-top: 1.5rem;">
                    <h4>2. Number of Days in Words:</h4>
                    <div class="result-content" style="font-size: 1.2rem; font-weight: bold; color: #047857;">
                        <?php echo htmlspecialchars($daysInWords); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <footer class="app-footer">
        <p>&copy; PHP Developer Technical Assignment - php-assignment</p>
    </footer>
</body>
</html>

