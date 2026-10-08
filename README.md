# PHP Developer Technical Assignment - `php-assignment`

A professional, full-featured technical assignment solution built with **PHP 8+**, **MySQL PDO**, **Vanilla JavaScript (Fetch API)**, **HTML5**, and **CSS3**.

---

## 🚀 Accessing the Application
- **Main Dashboard URL:** [`http://localhost/php-assignment/`](http://localhost/php-assignment/)

---

## 📋 Table of Contents
1. [Project Overview](#project-overview)
2. [Technologies Used & Constraints](#technologies-used--constraints)
3. [XAMPP & Environment Requirements](#xampp--environment-requirements)
4. [Database Setup & Configuration](#database-setup--configuration)
5. [Project Architecture](#project-architecture)
6. [Tasks Overview & Implementation Details](#tasks-overview--implementation-details)
7. [Validation Details](#validation-details)
8. [Testing Instructions](#testing-instructions)

---

## 🛠 Project Overview
This project contains solutions for six distinct technical tasks required by the technical assignment:
1. **Student Management** — Full-stack CRUD interface with MySQL PDO prepared statements, client & server-side validation, automatic age calculation, and AJAX Fetch API table rendering.
2. **Todo List Application** — In-memory Vanilla JavaScript array management (`let todos = []`). Complete CRUD operations without any database, localStorage, or PHP backend.
3. **String Replacement** — PHP `str_replace()` dynamic text template rendering with customizable replacement inputs (`@Name@`, `@email@`, `@mobile@`, `@designation@`).
4. **Date Difference** — PHP `DateTime`/`DateInterval` calculation of total days between two dates, accompanied by a custom reusable number-to-words converter function.
5. **HTML Content Find & Replace** — Text placeholder find-and-replace inside HTML content using PHP `str_replace()` with dynamic multi-pair inputs.
6. **Triplet Sum Algorithm** — Algorithmic solution in PHP to find if any three numbers in an array sum up to a target value.

---

## 💻 Technologies Used & Constraints
- **HTML5 & CSS3** — Custom, clean, responsive UI without external CSS frameworks (No Bootstrap).
- **Vanilla JavaScript** — Pure ES6+ JS, Fetch API for AJAX, DOM manipulation (No jQuery, React, Vue, Angular).
- **PHP 8+** — Strict server-side validation, PDO with prepared statements, object-oriented Date utilities, `str_replace()`.
- **MySQL Database** — Used **strictly and only for Task 1**.

---

## ⚙️ XAMPP & Environment Requirements
- **Web Server:** Apache (via XAMPP)
- **PHP Version:** PHP 8.0+
- **Database:** MySQL / MariaDB
- **Browser:** Any modern browser (Chrome, Firefox, Edge)

---

## 🗄 Database Setup & Configuration

### 1. Database SQL Import
The SQL database setup file is located at `database/assignment.sql`.

**Database Name:** `php_assignment`  
**Table Name:** `students`

#### Import via phpMyAdmin:
1. Open XAMPP Control Panel and start **Apache** and **MySQL**.
2. Open [`http://localhost/phpmyadmin/`](http://localhost/phpmyadmin/).
3. Click on the **Import** tab.
4. Browse and select `database/assignment.sql` from the project directory.
5. Click **Go** to execute and create the database and table schema.

#### Import via MySQL CLI / Terminal:
```bash
mysql -u root -p < database/assignment.sql
```

### 2. Database Configuration File (`config/database.php`)
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'php_assignment');
define('DB_USER', 'root');
define('DB_PASS', ''); // default XAMPP password is empty
```

---

## 📁 Project Architecture
```
php-assignment/
│
├── index.php                      # Main Dashboard with navigation cards
├── README.md                      # Detailed technical documentation
├── .gitignore                     # Ignored files & paths
│
├── config/
│   └── database.php               # PDO database connection configuration
│
├── database/
│   └── assignment.sql             # SQL Schema for database & table creation
│
├── assets/
│   └── css/
│       └── style.css              # Universal modern CSS styles
│
├── student/                       # TASK 1: Student Management
│   ├── index.php                  # Interactive form & AJAX student table
│   ├── ajax/
│   │   ├── add_student.php        # Server-side validation & PDO insertion
│   │   └── get_students.php       # JSON endpoint to fetch student records
│   └── js/
│       └── student.js             # Form validation, age calc & Fetch API JS
│
├── todo/                          # TASK 2: Todo List Application
│   ├── index.php                  # Client-side Todo UI
│   └── js/
│       └── todo.js                # Pure JS Array array storage & CRUD logic
│
├── task3-string-replace/          # TASK 3: String Replacement
│   └── index.php                  # Interactive PHP str_replace form
│
├── task4-date-difference/         # TASK 4: Date Difference
│   └── index.php                  # DateTime diff & Number-to-Words in PHP
│
├── task5-html-replace/            # TASK 5: HTML Content Find & Replace
│   └── index.php                  # Multi-pair find & replace in PHP
│
└── task6-triplet/                 # TASK 6: Triplet Sum Algorithm
    └── index.php                  # Interactive array triplet search in PHP
```

---

## 📑 Tasks Overview & Implementation Details

### Task 1 — Student Management (MySQL + AJAX)
- **Flow:** `HTML Form` → `JavaScript Validation` → `AJAX Fetch API` → `PHP backend` → `MySQL PDO` → `JSON Response` → `Dynamic HTML Table`.
- **Automatic Age Calculation:** Triggered dynamically via JS `change` event on Date of Birth input, and verified/recalculated on server side using `DateTime::diff()`.
- **Security:** Output HTML escaped via `htmlspecialchars()` to prevent XSS. Prepared statements used for all SQL queries to prevent SQL injection.

### Task 2 — Todo List Application (Pure JS Array)
- **Constraint Compliance:** Uses **NO database**, **NO localStorage**, **NO sessionStorage**, and **NO PHP backend**.
- **Data Structure:** Maintained in memory array `let todos = []`.
- **Functions:** `addTodo()`, `editTodo()`, `deleteTodo()`, `toggleComplete()`, `renderTodos()`.

### Task 3 — String Replacement
- **Replaces Placeholders:** `@Name@`, `@email@`, `@mobile@`, `@designation@`.
- **Logic:** PHP `str_replace($placeholders, $replacements, $originalString)`.

### Task 4 — Date Difference
- **Logic:** Calculates difference using `$date1->diff($date2)->days`.
- **Number-to-Words Converter:** Custom reusable PHP function `numberToWords(int $number)` converting total days into words (e.g., `734` → `"Seven Hundred Thirty Four Days"`).

### Task 5 — HTML Content Find & Replace
- **Logic:** Accepts user HTML/text content and multiple search/replace pair arrays. Replaces occurrences using PHP `str_replace()`.

### Task 6 — Triplet Sum Algorithm
- **Logic:** Checks if there exist three distinct elements `$a[i] + $j[j] + $a[k] == $val` in array `$a`.
- **Outputs:** Indicates `true`/`false`, prints triplet elements `[12, 3, 9]`, and displays mathematical verification `12 + 3 + 9 = 24`.

---

## 🔍 Validation Details

### Task 1 Validation Rules:
- **Name:** Mandatory, trimmed, non-empty.
- **Standard:** Mandatory, non-empty.
- **Date of Birth:** Mandatory, valid date, must not be a future date.
- **Age:** Readonly input, calculated automatically on DOB change. Recalculated server-side in PHP.
- **Father Mobile:** Mandatory, exactly 10 numeric digits (`/^\d{10}$/`). Validated in JS and PHP. Stored as `VARCHAR(10)`.
- **Email:** Mandatory, valid email pattern. Validated in JS and PHP (`filter_var(..., FILTER_VALIDATE_EMAIL)`).

---

## ✅ Testing Verification Checklist

| Task | Test Scenario | Expected Result | Status |
|---|---|---|---|
| **Task 1** | Submit valid student | Added to MySQL, success alert, form resets, table reloads via AJAX | **Passed** |
| **Task 1** | Future DOB / invalid mobile | Client & server validation error banners displayed | **Passed** |
| **Task 2** | Add, edit, delete, toggle todo | Operates on JS `todos[]` array in memory, UI updates instantly | **Passed** |
| **Task 3** | Sample string replacement | `@Name@` → `RRRR`, `@email@` → `RRR@RRR.com`, etc. | **Passed** |
| **Task 4** | Dates `26/12/2022` to `29/12/2024` | `734 Days`, `Seven Hundred Thirty Four Days` | **Passed** |
| **Task 5** | Replace `PARTY2NAME`, `P1OFFICEADD` | Replaces in HTML content accurately | **Passed** |
| **Task 6** | Array `12,3,4,1,6,9` & Target `24` | Triplet Found: `[12, 3, 9]` (`12 + 3 + 9 = 24`) | **Passed** |

