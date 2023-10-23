<?php
// Include the database connection file
include("db_connection.php");

// Initialize variables for user input and error messages
$userName = $userRole = "";
$userNameErr = $userRoleErr = "";

// Function to generate a random password
function generatePassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomPassword;
}

// Default values for userdesc table
$defaultAge = 25; // You can set the default age as needed
$defaultAddress = "123 Main St, City"; // You can set the default address as needed
$defaultAbout = "Brief description for the user"; // You can set the default description as needed

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user name
    if (empty(trim($_POST["userName"]))) {
        $userNameErr = "Please enter a name.";
    } else {
        $userName = trim($_POST["userName"]);
    }

    // Validate user role
    if (empty(trim($_POST["userRole"]))) {
        $userRoleErr = "Please select a role.";
    } else {
        $userRole = trim($_POST["userRole"]);
    }

    // If there are no validation errors, check if the user already exists
    if (empty($userNameErr) && empty($userRoleErr)) {
        $sql_check = "SELECT id FROM users WHERE username = ? AND role = ?";

        if ($stmt_check = $mysqli->prepare($sql_check)) {
            $stmt_check->bind_param("ss", $userName, $userRole);

            $stmt_check->execute();
            $stmt_check->store_result();

            if ($stmt_check->num_rows > 0) {
                // User already exists
                echo "<script>alert('User with the same name and role already exists.');</script>";
            } else {
                // Generate a random password
                $password = generatePassword();

                // Create an email address
                $email = $userName . "" . $userRole . "@sklify.com";

                // Insert user into the 'users' table
                $sql_insert_user = "INSERT INTO users (username, role, email, password) VALUES (?, ?, ?, ?)";

                if ($stmt_insert_user = $mysqli->prepare($sql_insert_user)) {
                    $stmt_insert_user->bind_param("ssss", $userName, $userRole, $email, $password);

                    if ($stmt_insert_user->execute()) {
                        // User added successfully
                        echo "<script>alert('User added successfully. Password: $password. Email: $email');</script>";
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }

                // Insert user details into the 'userdesc' table with default values
                $sql_insert_userdesc = "INSERT INTO userdesc (user_id, age, address, about) VALUES (?, ?, ?, ?)";

                if ($stmt_insert_userdesc = $mysqli->prepare($sql_insert_userdesc)) {
                    $user_id = $stmt_insert_user->insert_id; // Get the ID of the newly inserted user
                    $stmt_insert_userdesc->bind_param("isss", $user_id, $defaultAge, $defaultAddress, $defaultAbout);

                    $stmt_insert_userdesc->execute();
                    $stmt_insert_userdesc->close(); // Close the statement after executing it
                }
            }
            $stmt_insert_user->close();
            $stmt_check->close();
        }
    }
}
?>

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

        #userName {
            width: 200px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        #userRole {
            width: 200px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
            background-color: #0069D9;
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
            </div>
            <ul class="nav-menu">
                <li><a href="studentList.php">Student</a></li>
                <li><a href="instructorList.php">Instructor</a></li>
                <li><a href="QAList.php">QA officer</a></li>
                <li><a href="programCordinatorList.php">Co-ordinator</a></li>
                <li><a href="userInfo.php?username=<?php echo $_SESSION['username']; ?>">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <h1>Admin Dashboard</h1>

    <div class="card" id="addUserForm">
        <h2>Add User</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="userName">Name:</label>
                <input type="text" id="userName" name="userName" required>
                <span class="help-block"><?php echo $userNameErr; ?></span>
            </div>

            <div>
                <label for="userRole">Role:</label>
                <select id="userRole" name="userRole">
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                    <option value="qa">Quality Assurance Officer</option>
                    <option value="coordinator">Program Coordinator</option>
                </select>
                <span class="help-block"><?php echo $userRoleErr; ?></span>
            </div>
            <div>
                <button type="submit" id="addUserButton" class="btn">Add User</button>
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
            <?php
            echo "<tbody>";
            for($i=0;$i<count($_SESSION["studentdata"]);$i++){
                echo "<tr class='table-row'>";
                // echo "<td class='table-cell'><a href='userInfo.php'>" . $_SESSION["studentName"][$i]. "</a></td>";
                echo "<td class='table-cell'><a href='userInfo.php?username=" . $_SESSION["studentName"][$i] . "'>" . $_SESSION["studentName"][$i]. "</a></td>";
                echo "<td class='table-cell'>" . $_SESSION["studentdata"][$i] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            ?>
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
            <?php
            echo "<tbody>";
            for($i=0;$i<count($_SESSION["instructordata"]);$i++){
                echo "<tr class='table-row'>";
                // echo "<td class='table-cell'><a href='userInfo.php'>" . $_SESSION["instructorName"][$i]. "</a></td>";
                echo "<td class='table-cell'><a href='userInfo.php?username=" . $_SESSION["instructorName"][$i] . "'>" . $_SESSION["instructorName"][$i]. "</a></td>";
                echo "<td class='table-cell'>" . $_SESSION["instructordata"][$i] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            ?>
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
            <?php
            echo "<tbody>";
            for($i=0;$i<count($_SESSION["qadata"]);$i++){
                echo "<tr class='table-row'>";                
                // echo "<td class='table-cell'><a href='userInfo.php'>" . $_SESSION["QAName"][$i]. "</a></td>";
                echo "<td class='table-cell'><a href='userInfo.php?username=" . $_SESSION["QAName"][$i] . "'>" . $_SESSION["QAName"][$i]. "</a></td>";
                echo "<td class='table-cell'>" . $_SESSION["qadata"][$i] . "</td>";
                echo "</tr>";            
            }
            echo "</tbody>";
            ?>
        </table>
    </div>

    <div class="card">
        <h2>Coordinator Data</h2>
        <table id="coordinatorTable" border="1">
            <thead class="table-header">
                <tr>
                    <th class="table-cell">Name</th>
                    <th class="table-cell">Description</th>
                </tr>
            </thead>
            <?php
            echo "<tbody>";
            for($i=0;$i<count($_SESSION["coordinatordata"]);$i++){
                echo "<tr class='table-row'>";
                // echo "<td class='table-cell'><a href='userInfo.php'>" . $_SESSION["coordinatorName"][$i]. "</a></td>";
                echo "<td class='table-cell'><a href='userInfo.php?username=" . $_SESSION["coordinatorName"][$i] . "'>" . $_SESSION["coordinatorName"][$i]. "</a></td>";
                echo "<td class='table-cell'>" . $_SESSION["coordinatordata"][$i] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            ?>
        </table>
    </div>
    <footer>
        <div class="container-footer">
            <p>&copy; 2023 Skillify. All rights reserved.</p>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/skilfy" target="_blank"><img width="20" height="20" src="../icon/facebook.png" alt="Facebook"></a>
                <a href="https://www.twitter.com/skilfy" target="_blank"><img width="20" height="20" src="../icon/twitter.png" alt="Twitter"></a>
                <a href="https://www.linkedin.com/company/skilfy" target="_blank"><img width="20" height="20" src="../icon/instagram.png" alt="instagram"></a>
            </div>
        </div>
    </footer>
</body>
</html>
