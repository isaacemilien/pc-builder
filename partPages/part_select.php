<!DOCTYPE html>
<html lang="en">
<!-- Blame on Ilja if this doesn't work-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/build.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Desktop Designer</title>
    <link rel="icon" type="image/x-icon" href="../images/pcIcon.jpg">
    <link rel="stylesheet" href="part-select.css">
</head>

<body>
    <main>
        <nav class="py-2 bg-body-tertiary border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li class="nav-item">
                        <a href="../index.php"><img src="../images/pcIcon.jpg" alt="PC Icon" class="icon"></a>
                        <a href="../index.php" class="fs-4 nav-link link-body-emphasis px-2 active"
                            aria-current="page">Desktop Designer</a>
                    </li>
                </ul>
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
                    if (isset($_COOKIE['username'])) {
                        // Display username
                        echo '<span class="username">' . $_COOKIE['username'] . '</span>';

                        // Get the user's profile picture
                        $profilePic = getProfilePic($_COOKIE['username']);

                        // Display profile icon
                        echo '
                            <!-- Trigger the Modal -->
                            <img id="myImg" src="../images/userIcon/icon' . $profilePic . '.jpg" alt="Profile Picture">
                            
                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                            
                              <!-- The Close Button -->
                              <span class="close">&times;</span>
                            
                              <!-- Modal content -->
                              <div class="modal-content">
                                <h2>User Profile</h2>
                                <div class="user-info">
                                <img src="../images/userIcon/icon' . $profilePic . '.jpg" alt="Profile Picture">
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
        </nav>
        <nav class="py-2 bg-body-tertiary border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li class="nav-item"><a href="../buid.php" class="nav-link link-body-emphasis px-2 active"
                            aria-current="page">Build</a></li>
                    <li class="nav-item"><a href="../prebuilt.php" class="nav-link link-body-emphasis px-2 active"
                            aria-current="page">Prebuilt</a></li>
                    <li class="nav-item"><a href="../help.php" class="nav-link link-body-emphasis px-2 active"
                            aria-current="page">Help</a></li>
                </ul>
            </div>
        </nav>

        <!-- json time -->
        <div class="table-section">
            <div id="navbar">
                <a>Select Part</a>
                <a id="selected"></a>
                <a id="confirm" style="display: none"><button onclick="confirmSelect()">Confirm?</button></a>
            </div>

            <p></p>

            <div>
                <!-- gen table from Json -->
                <table id="head">
                    <tbody id="content"></tbody>
                </table>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="partdata.js"></script>
</body>

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

</html>