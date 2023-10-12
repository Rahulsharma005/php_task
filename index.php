<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/Home.css">
    <title>Home Page</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Skillify</a>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="chat.php">Chat</a></li>
                <?php if (isset($_SESSION['username'])) : ?>
                    <?php if ($_SESSION['role'] == "student") : ?>
                        <li><a href="student.php">Student <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "instructor") : ?>
                        <li><a href="instructor.php">Instructor <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "admin") : ?>
                        <li><a href="admin.php">Admin <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "coordinator") : ?>
                        <li><a href="programCordinator.php">Coordinator <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] == "qa_officer") : ?>
                        <li><a href="QA.php">QA Officer <?php echo $_SESSION['username']; ?></a></li>
                    <?php endif ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif ?>
                <?php if (!isset($_SESSION['username'])) : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Signup</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>

    <!-- Landing page code starts -->
    <section class="landing-section">
        <div class="container-home">
            <h1>Welcome to Our Website</h1>
            <p>This is the landing section of our website. You can add a brief introduction or any important information here.</p>
        </div>
    </section>

    <section class="about-us-section">
        <div class="container-home">
            <h1>About Us</h1>
            <div class="about-cards">
                <div class="about-card">
                    <h2>Our College</h2>
                    <p>Welcome to our college. We are committed to providing a world-class education and fostering a supportive learning environment.</p>
                    <p>Founded in 15, our college has been a hub of academic excellence, empowering students to reach their full potential.</p>
                </div>
                <div class="about-card">
                    <h2>What We Provide</h2>
                    <p>At our college, we offer a wide range of services and opportunities for our students:</p>
                    <ul class="about_list">
                        <li>Quality Education</li>
                        <li>Career Guidance</li>
                        <li>Extracurricular Activities</li>
                        <li>State-of-the-Art Facilities</li>
                    </ul>
                    <p>We are dedicated to helping students achieve their academic and career goals.</p>
                </div>
            </div>
        </div>
    </section>



    <section class="services-section">
        <div class="container-service">
            <h2>Our Services</h2>
            <div class="service-cards">
                <!-- Service Card 1: Student Enrollment -->
                <div class="service-card ">
                    <h3>Student Enrollment</h3>
                    <ul class="service-list">
                        <li>Easy online application</li>
                        <li>Admission counseling</li>
                        <li>Financial aid assistance</li>
                    </ul>
                </div>

                <!-- Service Card 2: Teacher Enrollment -->
                <div class="service-card">
                    <h3>Teacher Enrollment</h3>
                    <ul class="service-list">
                        <li>Competitive compensation</li>
                        <li>Professional development</li>
                        <li>Supportive work environment</li>
                    </ul>
                </div>

                <!-- Service Card 3: Need Assistance -->
                <div class="service-card">
                    <h3>Need Assistance</h3>
                    <ul class="service-list">
                        <li>24/7 customer support</li>
                        <li>Online chat assistance</li>
                        <li>FAQ and knowledge base</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <section class="contact-form-section">
        <div class="container-home">
            <h1>Contact Us</h1>
            <div class="contact-form">
                <form action="#" method="post">
                    <input class="contact-input" type="text" name="name" placeholder="Your Name">
                    <input class="contact-input" type="email" name="email" placeholder="Your Email">
                    <textarea class="contact-input" name="message" placeholder="Your Message"></textarea>
                    <input class="contact-input-sub" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
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

</body>

</html>