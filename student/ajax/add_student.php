<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../config/database.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$errors = [];

// Retrieve & trim input values
$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
$gender        = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$standard      = isset($_POST['standard']) ? trim($_POST['standard']) : '';
$date_of_birth = isset($_POST['date_of_birth']) ? trim($_POST['date_of_birth']) : '';
$father_name   = isset($_POST['father_name']) ? trim($_POST['father_name']) : '';
$father_mobile = isset($_POST['father_mobile']) ? trim($_POST['father_mobile']) : '';
$email         = isset($_POST['email']) ? trim($_POST['email']) : '';

// 1. Name Validation
if (empty($name)) {
    $errors[] = "Name is required.";
}

// 2. Standard Validation
if (empty($standard)) {
    $errors[] = "Standard is required.";
}

// 3. Date of Birth & Age Validation (Recalculated server-side)
$calculated_age = 0;
if (empty($date_of_birth)) {
    $errors[] = "Date of Birth is required.";
} else {
    $dobDate = DateTime::createFromFormat('Y-m-d', $date_of_birth);
    $today   = new DateTime('today');

    if (!$dobDate || $dobDate->format('Y-m-d') !== $date_of_birth) {
        $errors[] = "Invalid Date of Birth format.";
    } elseif ($dobDate > $today) {
        $errors[] = "Date of Birth cannot be a future date.";
    } else {
        // Calculate age accurately
        $calculated_age = $today->diff($dobDate)->y;
    }
}

// 4. Father Mobile Validation (Exactly 10 numeric digits)
if (empty($father_mobile)) {
    $errors[] = "Father Mobile Number is required.";
} elseif (!preg_match('/^\d{10}$/', $father_mobile)) {
    $errors[] = "Father Mobile Number must be exactly 10 numeric digits.";
}

// 5. Email Validation
if (empty($email)) {
    $errors[] = "Email address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address format.";
}

// If validation errors exist, return error response
if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors),
        'errors'  => $errors
    ]);
    exit;
}

try {
    $pdo = getDbConnection();

    if (!$pdo) {
        echo json_encode(['success' => false, 'message' => 'Failed to connect to the database.']);
        exit;
    }

    // Insert student using PDO prepared statements
    $sql = "INSERT INTO students (name, gender, standard, date_of_birth, age, father_name, father_mobile, email) 
            VALUES (:name, :gender, :standard, :date_of_birth, :age, :father_name, :father_mobile, :email)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name'          => $name,
        ':gender'        => $gender,
        ':standard'      => $standard,
        ':date_of_birth' => $date_of_birth,
        ':age'           => $calculated_age,
        ':father_name'   => $father_name,
        ':father_mobile' => $father_mobile,
        ':email'         => $email
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Student added successfully.'
    ]);
} catch (PDOException $e) {
    error_log("Database error in add_student.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Database error occurred. Failed to add student.'
    ]);
}

