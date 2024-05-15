<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/build.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Desktop Designer</title>
    <link rel="icon" type="image/x-icon" href="images/pcIcon.jpg">
    <link rel="stylesheet" href="css/buid.css">
    <link rel="stylesheet" href="css/common-styles.css">
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
                    <h1 class="fw-light">Build Your PC</h1>
                    <p class="lead text-body-secondary">Something short and leading about the collection
                        below—its contents, the creator, etc. Make it short and sweet, but not too short
                        so folks do not simply skip over it entirely.</p>
                </div>
            </div>
        </section>
        <!-- bruuuh -->
        <div class="table-section">
            <div id="navbar">
                <a>Test</a>
                <a>Will this work</a>
                <a>Total:</a>
            </div>

            <p></p>

            <div class="content">
                <table>
                    <thead>
                        <tr>
                            <th>Part</th>
                            <th>Add</th>
                            <th>Item</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 -->
                        <tr>
                            <td>CPU</td>
                            <td><button class="director cpu"><a>Add</a></button></td>
                            <td class="cpu">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 2 -->
                        <tr>
                            <td>CPU cooler</td>
                            <td><button class="director cpu-cooler"><a>Add</a></button></td>
                            <td class="cpu-cooler">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 3 -->
                        <tr>
                            <td>Motherboard</td>
                            <td><button class="director motherboard"><a>Add</a></button></td>
                            <td class="motherboard">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 4 -->
                        <tr>
                            <td>Memory</td>
                            <td><button class="director memory"><a>Add</a></button></td>
                            <td class="memory">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 5 -->
                        <tr>
                            <td>Storage</td>
                            <td><button class="director external-hard-drive"><a>Add</a></button></td>
                            <td class="external-hard-drive">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 6 -->
                        <tr>
                            <td>Video card</td>
                            <td><button class="director video-card"><a>Add</a></button></td>
                            <td class="video-card">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 7 -->
                        <tr>
                            <td>Case</td>
                            <td><button class="director case"><a>Add</a></button></td>
                            <td class="case">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 8 -->
                        <tr>
                            <td>Power supply</td>
                            <td><button class="director power-supply"><a>Add</a></button></td>
                            <td class="power-supply">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 9 -->
                        <tr>
                            <td>Operating system</td>
                            <td><button class="director os"><a>Add</a></button></td>
                            <td class="os">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                        <!-- Row 10 -->
                        <tr>
                            <td>Monitor</td>
                            <td><button class="director monitor"><a>Add</a></button></td>
                            <td class="monitor">No part added yet.</td>
                            <td><button class="remove-button">X</button></td>
                        </tr>
                    </tbody>
                </table>
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
        window.onbeforeunload = () => {
            localStorage.removeItem('selectedPart');
            localStorage.removeItem('selectedOption');
        };

        window.onscroll = function () { myFunction() };
        function myFunction() {
            if (window.scrollY >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
        window.addEventListener("load", () => {
            // lazy button event assign Zzz
            for (let i = 0; i < directors.length; i++) {
                const selected = directors[i];
                console.log(selected);
                selected.addEventListener("click", () => {
                    directTo(selected.getAttribute("class").split(" ")[1]);
                })
            }
        })
        const navbar = document.getElementById("navbar");
        const sticky = navbar.offsetTop;

        const directors = document.getElementsByClassName("director");


        // load stored data from other pages
        window.addEventListener("load", () => {
            Object.keys(localStorage).forEach((key) => {
                // whitelist the desirable :)
                switch (key) {
                    case "cpu":
                    case "cpu-cooler":
                    case "motherboard":
                    case "memory":
                    case "external-hard-drive":
                    case "video-card":
                    case "case":
                    case "power-supply":
                    case "os":
                    case "monitor":
                        document.querySelector("td." + key).innerText = localStorage.getItem(key).split(",");
                        break
                    default:
                        console.log("caught a stray!" + key);
                }
            })
        })

        // smart code to basically send the correct data to the part-select page to load its Jsons etc
        function directTo(direction) {
            localStorage.setItem("selecting", direction);
            location.href = "partPages/part_select.php";
        }

        // Get all remove buttons
        const removeButtons = document.querySelectorAll('.remove-button');

        // Add event listener to each remove button
        removeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                // Find the parent row of the button
                const row = button.parentNode.parentNode;

                // Update the text content of the next td element to "No part added yet."
                row.children[2].textContent = "No part added yet.";
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
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
        });

        function signOut() {
            // Delete the username cookie
            document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";

            // Redirect to the login page
            window.location.href = "login.php";
        }
    </script>
</body>

</html>