<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../config/database.php';

try {
    $pdo = getDbConnection();
    
    if (!$pdo) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to connect to the database.'
        ]);
        exit;
    }

    $stmt = $pdo->query("SELECT id, name, gender, standard, date_of_birth, age, father_name, father_mobile, email, created_at FROM students ORDER BY id DESC");
    $students = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data' => $students
    ]);
} catch (Exception $e) {
    error_log("Error in get_students.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while fetching student data.'
    ]);
}

