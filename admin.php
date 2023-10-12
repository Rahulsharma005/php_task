<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/Home.css">
    <style>
        /* Additional CSS styles */
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #007BFF;
            color: white;
        }

        .table-row:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-cell {
            padding: 8px;
        }

        /* Style for the form */
        #addUserForm {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Style for buttons */
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Skillify</a>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="student.php">Student</a></li>
                <li><a href="instructor.php">Instructor</a></li>
                <li><a href="QA.php">QA officer</a></li>
                <li><a href="programCordinator.php">Co-ordinator</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <h1>Admin Dashboard</h1>

    <!-- Form for Adding Users -->
    <div class="card" id="addUserForm">
        <h2>Add User</h2>
        <form>
            <div>
                <label for="userName">Name:</label>
                <input type="text" id="userName" required>
            </div>

            <div>
                <label for="userRole">Role:</label>
                <select id="userRole">
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                    <option value="qao">Quality Assurance Officer</option>
                </select>
            </div>

            <div>
                <button type="button" id="addUserButton">Add User</button>
            </div>
        </form>
    </div>

    <!-- Card for Student Data -->
    <div class="card">
        <h2>Student Data</h2>
        <table id="studentTable" border="1">
            <thead class="table-header">
                <tr>
                    <th class="table-cell">Name</th>
                    <th class="table-cell">Description</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy data for students (count: 10) -->
                <tr class="table-row">
                    <td class="table-cell"><a href="userInfo.php">John Doe</a></td>
                    <td class="table-cell">A dedicated student pursuing a degree in Computer Science.</td>
                </tr>
                <!-- Add more dummy data here -->
            </tbody>
        </table>
    </div>

    <!-- Card for Instructor Data -->
    <div class="card">
        <h2>Instructor Data</h2>
        <table id="instructorTable" border="1">
            <thead class="table-header">
                <tr>
                    <th class="table-cell">Name</th>
                    <th class="table-cell">Description</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy data for instructors (count: 10) -->
                <tr class="table-row">
                    <td class="table-cell"><a href="userInfo.php">Mike Johnson</a></td>
                    <td class="table-cell">Experienced instructor specializing in Web Development.</td>
                </tr>
                <!-- Add more dummy data here -->
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2>QAO Data</h2>
        <table id="qaoTable" border="1">
            <thead class="table-header">
                <tr>
                    <th class="table-cell">Name</th>
                    <th class="table-cell">Description</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy data for QAOs (count: 10) -->
                <tr class="table-row">
                    <td class="table-cell"><a href="userInfo.php">David Lee</a></td>
                    <td class="table-cell">Experienced Quality Assurance Officer ensuring the highest educational standards.</td>
                </tr>
                <!-- Add more dummy data for QAOs here -->
            </tbody>
        </table>
    </div>
    <footer>
        <div class="container-footer">
            <p>&copy; 2023 Skillify. All rights reserved.</p>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/yourcompany" target="_blank"><img width="20" height="20" src="../icon/facebook.png" alt="Facebook"></a>
                <a href="https://www.twitter.com/yourcompany" target="_blank"><img width="20" height="20" src="../icon/twitter.png" alt="Twitter"></a>
                <a href="https://www.linkedin.com/company/yourcompany" target="_blank"><img width="20" height="20" src="../icon/instagram.png" alt="instagram"></a>
            </div>
        </div>
    </footer>

    <!-- Add similar cards for QAO, Program Coordinator, and other roles -->
    
    <script>
        document.getElementById("addUserButton").addEventListener("click", function () {
            const userName = document.getElementById("userName").value;
            const userRole = document.getElementById("userRole").value;
    
            // Create a new row in the corresponding table with the user's name and description
            const tableId = `${userRole}Table`;
            const table = document.getElementById(tableId).getElementsByTagName('tbody')[0];
            const newRow = table.insertRow(-1);
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            cell1.innerHTML = `<a href="userInfo.php">${userName}</a>`;
            cell2.innerHTML = `Description of ${userRole} goes here.`;
    
            // Clear the form
            document.getElementById("userName").value = "";
        });
    </script>
    
</body>
</html>
