<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Desktop Designer</title>
    <link rel="icon" type="image/x-icon" href="images/pcIcon.jpg" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .icon {
            width: 75px;
            height: auto;
            margin-right: 10px;
            /* Adjust spacing between icon and text */
        }

        .nav-item {
            display: flex;
            /* Make items inside the list item flex items */
            align-items: center;
            /* Align items vertically */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
                <ul class="nav me-auto">
                    <li class="nav-item">
                        <a href="index.php"><img src="images/pcIcon.jpg" alt="PC Icon" class="icon"></a>
                        <a href="index.php" class="fs-4 nav-link link-body-emphasis px-2 active"
                            aria-current="page">Desktop Designer</a>
                    </li>
                </ul>
                <ul class="nav align-items-center">
                    <div class="username">
                        <?php function getProfilePic($username)
                        {
                            // Your database connection code goes here
                            $servername = "localhost:3306"; // Change this to your database server hostname
                            $username_db = "hc920_1"; // Change this to your database username
                            $password = "PC_PARTS_BRIGHTON"; // Change this to your database password
                            $dbname = "hc920_pc_parts"; // Change this to your database name
                        
                            // Create connection
                            $conn = new mysqli($servername, $username_db, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            // Query the database for the user's profile picture
                            $query = "SELECT profilePic FROM tblUsers WHERE Username = '$username'";
                            $result = $conn->query($query);

                            // Return the profile picture if it exists, otherwise return null
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $profilePic = $row['profilePic'];
                            } else {
                                $profilePic = null;
                            }
                            // Close the database connection
                            $conn->close();
                            return $profilePic;
                        }
                        // Check if user is logged in
                        if (isset($_COOKIE['username'])) {
                            // Display username
                            echo '<span class="username">' . $_COOKIE['username'] . '</span>';

                            // Get the user's profile picture
                            $profilePic = getProfilePic($_COOKIE['username']);

                            // Display profile icon
                            echo '
                            <!-- Trigger the Modal -->
                            <img id="myImg" src="images/userIcon/icon' . $profilePic . '.jpg" alt="Profile Picture">
                            
                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                            
                              <!-- The Close Button -->
                              <span class="close">&times;</span>
                            
                              <!-- Modal content -->
                              <div class="modal-content">
                                <h2>User Profile</h2>
                                <div class="user-info">
                                <img src="images/userIcon/icon' . $profilePic . '.jpg" alt="Profile Picture">
                                <div>
                                  <span class="nameuser">' . $_COOKIE['username'] . '</span>
                                  <a href="#" class="logout-button" onclick="signOut()">Sign Out</a>
                                </div>
                              </div>
                              </div>
                            </div>
                            ';
                        } else {
                            // Display login and signup buttons
                            echo '<a href="login.php" class="nav-link link-body-emphasis px-2"><i class="fa fa-fw fa-user"></i>Login</a>';
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

        <div class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold text-body-emphasis">Build your dream PC</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4"></p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">
                        <a href="buid.php" style="color: white; text-decoration: none;">
                            Build your PC</button></a>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="container px-5">
                    <img src="images/dream-pc.jpg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image"
                        width="700">
                </div>
            </div>
        </div>

        <div class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold text-body-emphasis">Your perfect prebuilt PC</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4"></p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">
                        <a href="prebuilt.php" style="color: white; text-decoration: none;">
                            Prebuilt PC options</button></a>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="container px-5">
                    <img src="images/dream-pc.jpg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image"
                        width="700">
                </div>
            </div>
        </div>

        <div class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold text-body-emphasis">Do you need any help?</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4"></p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">
                        <a href="help.php" style="color: white; text-decoration: none;">
                            Here to help</button></a>
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
                    <li class="nav-item"><a href="prebuilt.php" class="nav-link px-2 text-body-secondary">Prebuilt</a>
                    </li>
                    <li class="nav-item"><a href="help.php" class="nav-link px-2 text-body-secondary">Help</a></li>
                </ul>
            </footer>
        </div>
    </main>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image that opens the modal
        var IMG = document.getElementById("myImg");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the image, open the modal 
        IMG.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        function signOut() {
            // Delete the username cookie
            document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";

            // Redirect to the login page
            window.location.href = "login.php";
        }
    </script>
</body>

</html>