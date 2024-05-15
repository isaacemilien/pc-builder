<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Desktop Designer</title>
    <link rel="icon" type="image/x-icon" href="images/pcIcon.jpg">
    <link rel="stylesheet" href="css/help.css">

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
                        <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Name: <span id="modal-name"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-mdb-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Frequently asked questions</h1>
                </div>
            </div>
        </section>

        <div class="content">
            <div class="tab">
                <button class="tablinks" onmouseover="faqs(event, 'Question1')">How do I choose the right components for my pc?</button>
                <button class="tablinks" onmouseover="faqs(event, 'Question2')">How do I troubleshoot common PC building issues?</button>
                <button class="tablinks" onmouseover="faqs(event, 'Question3')">How do I maintain my PC after building it?</button>
                <button class="tablinks" onmouseover="faqs(event, 'Question4')">What are the benefits of a Custom PC?</button>
                <button class="tablinks" onmouseover="faqs(event, 'Question5')">How hard is it to build a PC?</button>
            </div>

            <div id="Question1" class="tabcontent">
                <h3>How do I choose the right components for my pc?</h3>
                <p>
                    Choosing the right components can be a tricky and lengthly process but dont worry as you've come to the right place.
                    We have a list of the most popular components that you can use to build your pc, however before you get started, you should read the following reccomendations to plan what your pc will be made of.
                    First of all you should identify a budget. Determine how much you are willing to spend on your pc, keeping in mind that the GPU and CPU are likely to be some of the more expensive items in your pc and also have a bigger impact than other things.
                    Once you have a budget in mind, you should also consider the type of pc you want to build. There are many different types of pcs that you can build, but the most common ones are gaming, business, and home.
                </p>
            </div>

            <div id="Question2" class="tabcontent">
                <h3>How do I troubleshoot common PC building issues?</h3>
                <p>
                    If you are having trouble with your pc, it is important to know what to look for. Simple things can go wrong such as the pc not turning on so make sure you check all the obvious things such as making sure that the pc is plugged into the wall and make sure that the power supply cables are in a good condition.
                    However there might be some harder issues to fix such as the pc not booting or the BIOS/EUFI screen not appearing. To fix this, once again check to make sure all the cables are plugged in correctly and also check to make sure your hard drive is set as the primary boot device.

                </p>
            </div>

            <div id="Question3" class="tabcontent">
                <h3>How do I maintain my PC after building it?</h3>
                <p>
                    To keep your pc clean, make sure you keep it clean by blowing it with compressed air but make sure that the fans do not move when you blow on them.
                    Make sure you also keep up with updating your drivers and firmware as not updating them could cause compatibility issues.
                    If you are having trouble with your pc, it is important to know what to look for. You should also backup your data regularly and perform systems scans to make sure everything on your pc is fine.

                </p>
            </div>

            <div id="Question4" class="tabcontent">
                <h3>Whaat are the benefits of a Custom PC?</h3>
                <p>
                    The main benefits of building a custom PC are cost savings and having it just how you like. Building a Custom PC allows you to have all the parts you want and allows you to choose colour schemes and sizes of your build.
                    It will also help you save money as it is much cheaper to build a PC compared to bying a prebuild one. Upgradability is also a big benefit of building a custom PC as it is much easier to upgrade than a prebuilt one

                </p>
            </div>

            <div id="Question5" class="tabcontent">
                <h3>How hard is it to build a PC?</h3>
                <p>
                    Building a PC can be a challenging tast, however it is definatly something most people are able to do with a bit of patience and dedication. 
                    If you have experience with hardware, you will find it much easier to build a new PC. But if you are new to building PC's it will take some time to learn how different components fit together. 
                    Also, it is much easier to build a simple cpmputer in comparison to a high-performance one which will take more parts and skill to build.
                </p>
            </div>

            <div class="clearfix"></div>

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
        function faqs(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

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