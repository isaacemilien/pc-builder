<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $email = $_POST["email"];
  $password1 = $_POST["password"];

  // Your database connection code goes here
  $servername = "localhost:3306"; // Change this to your database server hostname
  $username = "hc920_1"; // Change this to your database username
  $password = "PC_PARTS_BRIGHTON"; // Change this to your database password
  $dbname = "hc920_pc_parts"; // Change this to your database name

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare SQL statement
  $sql = "SELECT * FROM tblUsers WHERE Email=?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  // Check if query was successful
  if ($result) {
    // Check if user with given email exists
    if ($result->num_rows > 0) {
      // Get user data from result
      $row = $result->fetch_assoc();
      $hashedPassword = $row['Password'];

      // Verify password
      if (password_verify($password1, $hashedPassword)) {
        // Password is correct, set cookie and redirect to homepage
        $username = $row['Username'];
        setcookie("username", $username, time() + (86400 * 3), "/");
        header("Location: index.php");
        echo "<script>userLoggedIn();</script>";
        exit;
      } else {
        // Password is incorrect
        echo "<script type='text/javascript'>alert('Invalid email or password'); history.back();</script>";
      }
    } else {
      // User does not exist
      echo "<script type='text/javascript'>alert('User does not exist. Please register or try again.'); history.back();</script>";
    }
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close database connection
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Desktop Designer</title>
  <link rel="icon" type="image/x-icon" href="images/pcIcon.jpg">
  <style>
    .icon {
      width: 75px;
      height: auto;
      margin-right: 10px;
    }

    .nav-item {
      display: flex;
      align-items: center;
    }

    .password-toggle-icon {
      position: absolute;
      top: 65%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .password-toggle-icon i {
      font-size: 18px;
      line-height: 1;
      color: #333;
      transition: color 0.3s ease-in-out;
      margin-bottom: 20px;
    }

    .password-toggle-icon i:hover {
      color: #000;
    }

    .username {
      display: flex;
      align-items: center;
      height: 100%;
      font-size: 1.1em;
      margin-right: 10px;
    }

    .username a {
      font-size: 1rem;
    }

    #myImg {
      width: 60px;
      border-radius: 25px;
      cursor: pointer;
      transition: 0.3s;
    }

    #myImg:hover {
      opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 100px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.9);
      /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #888;
      width: 40%;
      text-align: center;
    }

    .modal-content h2 {
      text-align: center;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .user-info {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-top: 2rem;
      text-align: center;
    }

    .user-info img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto;
    }

    span.nameuser {
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
      text-align: center;
    }

    a.logout-button {
      display: block;
      background-color: #f44336;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      text-decoration: none;
      margin: 1rem auto;
      opacity: 1;
      transition: 0.3s;
    }

    a.logout-button:hover {
      opacity: 0.6
    }
  </style>
</head>

<body>
  <main>
    <nav class="py-2 bg-body-tertiary border-bottom">
      <div class="container d-flex flex-wrap">
        <!-- Unneeded ul -->
        <ul class="nav me-auto">
          <li class="nav-item">
            <a href="index.php"><img src="images/pcIcon.jpg" alt="PC Icon" class="icon"></a>
            <a href="index.php" class="fs-4 nav-link link-body-emphasis px-2 active" aria-current="page">Desktop
              Designer</a>
          </li>
        </ul>
        <ul class="nav align-items-center">
          <div class="username">
            <?php
            // Start session
            session_start();

            // Check if user is logged in
            if (isset($_SESSION['username'])) {
              // Display username
              echo $_SESSION['username'];
              // Display profile icon
              echo '<a href="#"><img src="images/userIcon/basicIcon.jpg" alt="Profile Icon" class="profileIcon"></a>';
            } else {
              // Display login and signup buttons
              echo '<a href="signup.php" class="nav-link link-body-emphasis px-2">Sign up</a>';
            }
            ?>
          </div>
        </ul>
      </div>
    </nav>
    <nav class="py-2 bg-body-tertiary border-bottom">
      <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
          <li class="nav-item"><a href="buid.php" class="nav-link link-body-emphasis px-2 active"
              aria-current="page">Build</a></li>
          <li class="nav-item"><a href="prebuilt.php" class="nav-link link-body-emphasis px-2 active"
              aria-current="page">Prebuilt</a></li>
          <li class="nav-item"><a href="help.php" class="nav-link link-body-emphasis px-2 active"
              aria-current="page">Help</a></li>
        </ul>
      </div>
    </nav>

    <div class="px-3 py-3 my-3 text-center">
      <h1 class="display-5 fw-bold text-body-emphasis">Log in </h1>
    </div>

    <div class="col-md-10 mx-auto col-lg-5">
      <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method="post">
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
          <label for="floatingPassword">Password</label>
          <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
      </form>
    </div>

    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">&copy; 2024 Desktop Designer</p>

        <!-- Middle section with the clickable image -->
        <a href="index.php"
          class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          <!-- Inserting the PC icon here -->
          <img src="images/pcIcon.jpg" alt="PC Icon" class="icon">
        </a>

        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="index.php" class="nav-link px-2 text-body-secondary">Home</a></li>
          <li class="nav-item"><a href="buid.php" class="nav-link px-2 text-body-secondary">Build</a></li>
          <li class="nav-item"><a href="prebuilt.php" class="nav-link px-2 text-body-secondary">Prebuilt</a></li>
          <li class="nav-item"><a href="help.php" class="nav-link px-2 text-body-secondary">Help</a></li>
        </ul>
      </footer>
    </div>
  </main>

  <script>
    const passwordField = document.getElementById("floatingPassword");
    const togglePassword = document.querySelector(".password-toggle-icon i");

    togglePassword.addEventListener("click", function () {
      if (passwordField.type === "password") {
        passwordField.type = "text";
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
      }
    });
  </script>
</body>

</html>