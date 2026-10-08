document.addEventListener('DOMContentLoaded', () => {
    const studentForm = document.getElementById('studentForm');
    const dobInput = document.getElementById('date_of_birth');
    const ageInput = document.getElementById('age');
    const alertBox = document.getElementById('alertBox');
    const studentsTableBody = document.getElementById('studentsTableBody');

    // Helper: Escapes HTML to prevent XSS
    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // Helper: Displays alert banner
    function showAlert(message, type = 'success') {
        alertBox.className = `alert alert-${type}`;
        alertBox.textContent = message;
        alertBox.style.display = 'block';
        
        // Scroll to alert box
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function clearAlert() {
        alertBox.style.display = 'none';
        alertBox.textContent = '';
    }

    // Automatically calculate age on DOB change
    dobInput.addEventListener('change', () => {
        const dobValue = dobInput.value;
        if (!dobValue) {
            ageInput.value = '';
            return;
        }

        const dobDate = new Date(dobValue);
        const today = new Date();
        
        // Zero out time for exact day comparisons
        today.setHours(0, 0, 0, 0);

        if (dobDate > today) {
            showAlert('Date of Birth cannot be a future date.', 'danger');
            dobInput.value = '';
            ageInput.value = '';
            return;
        }

        clearAlert();

        // Calculate age
        let age = today.getFullYear() - dobDate.getFullYear();
        const monthDiff = today.getMonth() - dobDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
            age--;
        }

        ageInput.value = age >= 0 ? age : 0;
    });

    // Fetch and display student list from database via AJAX
    function loadStudents() {
        fetch('ajax/get_students.php')
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    studentsTableBody.innerHTML = `<tr><td colspan="10" class="no-data">Failed to load student list.</td></tr>`;
                    return;
                }

                const students = data.data;
                if (!students || students.length === 0) {
                    studentsTableBody.innerHTML = `<tr><td colspan="10" class="no-data">No students found.</td></tr>`;
                    return;
                }

                let html = '';
                students.forEach(student => {
                    html += `
                        <tr>
                            <td>${escapeHtml(student.id)}</td>
                            <td><strong>${escapeHtml(student.name)}</strong></td>
                            <td>${escapeHtml(student.gender || '-')}</td>
                            <td>${escapeHtml(student.standard)}</td>
                            <td>${escapeHtml(student.date_of_birth)}</td>
                            <td>${escapeHtml(student.age)}</td>
                            <td>${escapeHtml(student.father_name || '-')}</td>
                            <td>${escapeHtml(student.father_mobile)}</td>
                            <td>${escapeHtml(student.email)}</td>
                            <td>${escapeHtml(student.created_at)}</td>
                        </tr>
                    `;
                });

                studentsTableBody.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching students:', error);
                studentsTableBody.innerHTML = `<tr><td colspan="10" class="no-data">Error loading student list.</td></tr>`;
            });
    }

    // Form submission via Fetch API
    studentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        clearAlert();

        const name = document.getElementById('name').value.trim();
        const gender = document.getElementById('gender').value.trim();
        const standard = document.getElementById('standard').value.trim();
        const dob = dobInput.value.trim();
        const fatherName = document.getElementById('father_name').value.trim();
        const fatherMobile = document.getElementById('father_mobile').value.trim();
        const email = document.getElementById('email').value.trim();

        // Client-side validations
        if (!name) {
            showAlert('Name is required.', 'danger');
            return;
        }

        if (!standard) {
            showAlert('Standard is required.', 'danger');
            return;
        }

        if (!dob) {
            showAlert('Date of Birth is required.', 'danger');
            return;
        }

        const dobDate = new Date(dob);
        const today = new Date();
        today.setHours(0,0,0,0);

        if (dobDate > today) {
            showAlert('Date of Birth cannot be a future date.', 'danger');
            return;
        }

        const mobileRegex = /^\d{10}$/;
        if (!fatherMobile) {
            showAlert('Father Mobile Number is required.', 'danger');
            return;
        }
        if (!mobileRegex.test(fatherMobile)) {
            showAlert('Father Mobile Number must be numeric and exactly 10 digits.', 'danger');
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            showAlert('Email is required.', 'danger');
            return;
        }
        if (!emailRegex.test(email)) {
            showAlert('Please enter a valid email address.', 'danger');
            return;
        }

        const formData = new FormData(studentForm);

        // Submit via AJAX Fetch
        fetch('ajax/add_student.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                showAlert(result.message || 'Student added successfully.', 'success');
                studentForm.reset();
                ageInput.value = '';
                loadStudents();
            } else {
                showAlert(result.message || 'Failed to add student.', 'danger');
            }
        })
        .catch(error => {
            console.error('AJAX Error:', error);
            showAlert('An unexpected network or server error occurred.', 'danger');
        });
    });

    // Initial load of students
    loadStudents();
});

