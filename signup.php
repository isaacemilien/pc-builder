<?php
// Start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $fullName = $_POST["fullName"];
  $email = $_POST["email"];
  $userPassword = $_POST["password"];
  $profilePic = $_POST["profilePic"];

  // Validate the user's password
  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $userPassword)) {
    echo "<script>alert('Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character.'); history.back();</script>";
    exit;
  }

  //validate the user's full name
  if (!preg_match("/^[a-zA-Z-' ]*$/", $fullName)) {
    echo "<script type='text/javascript'>alert('Full name can only contain letters, hyphens, apostrophes, and spaces.'); history.back();</script>";
    exit;
  }

  //validate the user's email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script type='text/javascript'>alert('Invalid email address.'); history.back();</script>";
    exit;
  }

  // Hash the user's password
  $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

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

  // Check if email already exists in database
  $sql = "SELECT * FROM tblUsers WHERE Email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if email already exists
  if ($result->num_rows > 0) {
    echo "Email already exists.";
    exit;
  }

  // Prepare SQL statement with prepared statement
  $sql = "INSERT INTO tblUsers (Username, Email, Password, profilePic) VALUES (?,?,?,?)";
  $stmt = $conn->prepare($sql);

  // Check if prepare() succeeded
  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  // Bind parameters and execute statement
  $result = $stmt->bind_param("sssi", $fullName, $email, $hashedPassword, $profilePic);

  // Check if bind_param() succeeded
  if (!$result) {
    die("Binding parameters failed: " . $stmt->error);
  }

  // Execute SQL query
  if ($stmt->execute()) {
    // Redirect to login page
    header("Location: login.php");
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  // Close statement and database connection
  $stmt->close();
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
  <link rel="stylesheet" href="css/signup.css">
  <link rel="stylesheet" href="css/common-styles.css">
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
            // Check if user is logged in
            if (isset($_SESSION['username'])) {
              // Display username
              echo $_SESSION['username'];
              // Display profile icon
              echo '<a href="#"><img src="images/userIcon/basicIcon.jpg" alt="Profile Icon" class="profileIcon"></a>';
            } else {
              // Display login and signup buttons
              echo '<a href="login.php" class="nav-link link-body-emphasis px-2"><i class="fa fa-fw fa-user"></i>Login</a>';
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

    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Sign up form:</h1>
          <p class="col-lg-10 fs-4">Sign up now so that we can remember who you are!</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method="post">
            <!-- The image container -->
            <div class="imgcontainer">
              <img src="images/userIcon/icon0.jpg" alt="Avatar" class="avatar" id="avatar">
            </div>

            <!-- The modal container -->
            <div class="modal" id="modal">
              <div class="modal-content">
                <h2>Select your profile picture</h2>
                <div class="image-options">
                  <img src="images/userIcon/icon0.jpg" alt="Option 0" class="option"
                    data-src="images/userIcon/icon0.jpg">
                  <img src="images/userIcon/icon1.jpg" alt="Option 1" class="option"
                    data-src="images/userIcon/icon1.jpg">
                  <img src="images/userIcon/icon2.jpg" alt="Option 2" class="option"
                    data-src="images/userIcon/icon2.jpg">
                  <img src="images/userIcon/icon3.jpg" alt="Option 3" class="option"
                    data-src="images/userIcon/icon3.jpg">
                  <img src="images/userIcon/icon4.jpg" alt="Option 4" class="option"
                    data-src="images/userIcon/icon4.jpg">
                  <img src="images/userIcon/icon5.jpg" alt="Option 5" class="option"
                    data-src="images/userIcon/icon5.jpg">
                  <img src="images/userIcon/icon6.jpg" alt="Option 6" class="option"
                    data-src="images/userIcon/icon6.jpg">
                </div>
              </div>
            </div>
            <input type="hidden" name="profilePic" id="profilePic" value="">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingName" name="fullName" placeholder="Full name">
              <label for="floatingName">Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com">
              <label for="floatingEmail">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
              <label for="floatingPassword">Password</label>
              <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
            </div>
            <hr class="my-4">
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
          </form>
        </div>
      </div>
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

    const avatar = document.getElementById('avatar');
    const modal = document.getElementById('modal');
    const options = document.querySelectorAll('.option');

    avatar.addEventListener('click', () => {
      modal.style.display = 'block';
    });

    options.forEach((option) => {
      option.addEventListener('click', () => {
        avatar.src = option.dataset.src;
        var optionNumber = option.dataset.src.replace('images/userIcon/icon', ''); // Extract the option number from the src attribute
        optionNumber = optionNumber.replace('.jpg', ''); // Remove the file extension
        document.getElementById('profilePic').value = optionNumber; // Update the profilePic input field with the option number
        modal.style.display = 'none';
      });
    });

    // Add an event listener to close the modal when the user clicks outside of it
    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>
</body>

</html>