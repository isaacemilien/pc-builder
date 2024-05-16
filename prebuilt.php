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
  <link rel="stylesheet" href="css/prebuilt.css">
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
              <div id="myModal2" class="modal">
              
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
            <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Name: <span id="modal-name"></span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </ul>
      </div>
    </nav>
    <nav id="navBar" class="py-2 bg-body-tertiary border-bottom">
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

    <section class="py-5 text-center container section-background">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Prebuilt PC's</h1>
          <p class="lead text-body-secondary">Something short and leading about the collection
            below its contents, the creator, etc. Make it short and sweet, but not too short
            so folks do not simply skip over it entirely.</p>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="myModal">
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img src="" id="modalImg" alt="Avatar" style="width:100%">
        <div id="caption">
          <h1>Main Caption</h1>
          <p>Description of the setup...</p>
          <h2>Subtitle 1</h2>
          <p>Description of the first section...</p>
          <h2>Subtitle 2</h2>
          <p>Description of the second section...</p>
          <h2>Subtitle 3</h2>
          <p>Description of the third section...</p>
          <h2>Subtitle 4</h2>
          <p>Description of the second section...</p>
          <h2>Subtitle 5</h2>
          <p>Description of the third section...</p>
          <h2>Subtitle 6</h2>
          <p>Description of the third section...</p>
        </div>
      </div>
    </div>

    <!-- Grid for Flip Cards -->
    <!-- Trigger/Open The Modal -->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Flip Card 1 -->
        <div class="col">
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="images/gaming1.jpg" alt="Avatar" style="width:300px;height:300px;">
              </div>
              <div class="flip-card-back">
                <h1>Entry Level AMD gaming build</h1>
                <ul>
                  <li>Specs:</li>
                  <li>AMD Ryzen 5 5600</li>
                  <li>Parametric Video Card</li>
                  <li>Montech X3 Mesh ATX Mid Tower</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button class="open-modal-btn" onclick="openModal('images/gaming1.jpg', 
                      'Gaming - £568.38', ' ', 
                      'CPU', 'We have chosen the Ryzen 5 5600 for this guides CPU. Using the included CPU cooler you will be able to achieve moderate overclocks on this unlocked processor.', 
                      'Motherboard', 'We are using a parametric selection of motherboards that will be compatible with the Ryzen 5 5600. They also include 2-4 DIMM slots for up to 64GB of DDR4 RAM.', 
                      'Memory', 'For this build and most machines outside of the top end we opted to go with 16GB of DDR4 memory with CAS latency no higher than 18 clock cycles. The parametric filter finds the best price on 2x8GB kits of memory that are within AMD’s recommended specifications. We have limited it to DDR4-3600 or faster, as modern CPUs scale well with higher frequency memory.', 
                      'Storage', 'We are also using a parametric filter to select the best priced NVME SSD available that is at least 960B. Everyones storage needs are different, so feel free to change drive capacity or add a drive to fit yours.', 
                      'Case', 'The Montech X3 Mesh comes with a whopping six pre-installed LED fans. It is an ATX mid tower case with 1x USB 3.2 Gen 1 port and 2x USB 2.0 ports on the front of the case, and it features a tempered glass side panel window. It provides several cable management holes and a couple patterned magnetic dust filters for easy removal and cleaning.',
                      ' ', ' ')">
                      More information
                    </button>
                  </div>
                  <p class="text-body-secondary">£568.36</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Flip Card 2 -->
        <div class="col">
          <!-- Flip card content -->
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="images/gaming2.jpg" alt="Avatar" style="width:300px;height:300px;">
              </div>
              <div class="flip-card-back">
                <!-- Content for back of the card -->
                <h1>Modest AMD Gaming Build</h1>
                <ul>
                  <li>Specs:</li>
                  <li>AMD Ryzen 5 5600</li>
                  <li>Parametric Video Card</li>
                  <li>Deepcool CC360 ARGB MicroATX Mini Tower</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button class="open-modal-btn" onclick="openModal('images/gaming2.jpg', 
                    'Gaming - £725.57', 'The Modest AMD build guide is focused on providing the best performance per dollar on a mid range gaming PC. The components are straightforward to install and the system will run games at 1080p or higher without issue. ', 
                    'CPU', 'Our Modest AMD Gaming Build is centered around the newly released AMD Ryzen 5 5600. This CPU is nearly identical in gaming performance to the 5600X while saving you some money to put into other areas of the build like the graphics card. Using the included CPU cooler you will be able to achieve moderate overclocks on this unlocked processor.', 
                    'Motherboard', 'We are using a parametric filter for B550 mATX motherboards. Our compatibility and pricing engines will automatically select the best-priced motherboard that is compatible with the rest of the build.', 
                    'Memory', 'We are filtering for a 2x8GB kit of DDR4 RAM with a speed of at least DDR4-3200 and maximum Cas latency of 16 as Ryzen CPUs scale well with faster memory.', 
                    'Storage', 'We are also using a parametric filter that will actively select the best-priced SSD of at least 1TB capacity. Solid states drives are significantly faster than hard drives and one of the easiest ways to improve system responsiveness and load times for both applications and games.', 
                    'Case', 'The Deepcool CC360 ARGB comes with one USB2 port, one USB3 port, a large tempered glass side panel and fits full-size graphics cards without issue. It provides several cable management holes as well as a mesh front panel for better airflow.', 
                    ' ', ' ')">
                      More information
                    </button>
                  </div>
                  <p class="text-body-secondary">£725.57</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Flip Card 3 -->
        <div class="col">
          <!-- Flip card content -->
          <div class="col">
            <!-- Flip card content -->
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <img src="images/gaming3.jpg" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                  <!-- Content for back of the card -->
                  <h1>Great AMD Gaming Build</h1>
                  <ul>
                    <li>Specs:</li>
                    <li>AMD Ryzen 5 7600</li>
                    <li>Parametric Video Card</li>
                    <li>NZXT H5 Flow ATX Mid Tower</li>
                  </ul>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button class="open-modal-btn" onclick="openModal('images/gaming3.jpg', 
                      'Gaming - £1,009.14', 'This PC is designed to deliver high performance on all of todays most popular games without being complicated to build or costing too much. It will run well at high settings on 1080p or higher when playing Valorant, Fortnite, Minecraft, Call of Duty, Rainbow Six Siege, Apex Legends, and more.', 
                      'CPU', 'The AMD Ryzen 5 7600 provides some of the best bang for your buck. It offers 6 cores, 12 threads, a base frequency of 3.8GHz, and a turbo frequency of 5.1GHz.', 
                      'Motherboard', 'We are using a parametric filter to constantly select the best-priced motherboard while meeting selected criteria. In this case, we are filtering for ATX and mATX motherboards with B550 chipsets and up to 4 DDR5 DIMM slots for future expansion. The compatibility engine will filter out anything not compatible with the build, and it will automatically update with the best priced option as prices change.', 
                      'Memory', 'We are filtering for the best-priced 2x16GB kit of DDR5 RAM', 
                      'Storage', 'Since storage needs may differ, adjust the capacity as needed. We recommend at least 1TB of SSD storage. We are use parametric filters to incorporate an NVME SSD with at least 2TB of space.', 
                      'Case', 'All of our components are housed in the NZXT H5 Flow. This case features an all black design with a tempered glass side panel and mesh front panel. It includes one front panel USB 3 port, one USB Type-C port, a PSU shroud, and a number of cable management holes and tie-offs to help your build look cleaner. It can also comfortably fit full-sized video cards and large CPU coolers.', 
                      ' ', ' ')">
                        More information
                      </button>
                    </div>
                    <p class="text-body-secondary">£1,009.14</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Flip Card 4 -->
        <div class="col">
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="images/streaming1.jpg" alt="Avatar" style="width:300px;height:300px;">
              </div>
              <div class="flip-card-back">
                <!-- Content for back of the card -->
                <h1>Intel Streaming Build</h1>
                <ul>
                  <li>Specs:</li>
                  <li>Intel Core i5-13500</li>
                  <li>Parametric Video Card</li>
                  <li>Fractal Design Pop Mini Air MicroATX Mid Tower</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button class="open-modal-btn"
                      onclick="openModal('images/streaming1.jpg', 
                    'Streaming - £1286.49', ' ', 
                    'CPU', 'At this budget, we are running the Intel Core i5-13500. The 13500 features 6 Performance-cores with Hyperthreading, 8 Efficient-cores, and will perform exceptionally well with all your gaming needs. While it is not overclockable and does come with a stock cooler we have added the Deepcool AK400 ZERO DARK to the build for better cooling and to reduce the noise level.', 
                    'Motherboard', 'We are using a parametric filter to constantly select the best-priced motherboard while meeting selected criteria. In this case, we are filtering for ATX B760 motherboards with four DDR4 DIMM slots. While there is a small performance increase from DDR5 memory it significantly increases the cost of both the motherboards and DIMMs.', 
                    'Memory', 'We are filtering for a 2x16GB kit of DDR4 RAM with a speed of at least DDR4-3200 and maximum Cas latency of 16 to target the sweet spot for the 13500.', 
                    'Storage', 'We are using parametric filters to incorporate a PCIe Gen 4.0 x4 NVME M.2 SSD with at least 2TB of space. Everyones storage needs differ so feel free to add or remove capacity as needed.', 
                    'Case', 'All of our components are housed in the Fractal Design Pop Mini Air case. This case comes with two USB3 ports, an optional USB-C port (requires a separate purchase), a large tempered glass side panel and fits full-size graphics cards without issue. It provides several cable management holes as well as a mesh front panel for better airflow.',
                    'Operating System', 'For the best performance and fewest issues you will want to use Windows 11. The i5-13500 has a combination of Performance-cores and Efficient-cores that Windows 11 is designed to handle and will send specific tasks to the appropriate types of cores. Windows 10 does not have this functionality and may cause issues with system stability and operation.')">
                      More information
                    </button>
                  </div>
                  <p class="text-body-secondary">£1286.49</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Flip Card 5 -->
        <div class="col">
          <!-- Flip card content -->
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="images/streaming2.jpg" alt="Avatar" style="width:300px;height:300px;">
              </div>
              <div class="flip-card-back">
                <!-- Content for back of the card -->
                <h1>Enthusiast Intel Streaming Build</h1>
                <ul>
                  <li>Specs:</li>
                  <li>Intel Core i5-13500</li>
                  <li>Parametric Video Card</li>
                  <li>Corsair 4000D Airflow ATX Mid Tower</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button class="open-modal-btn"
                      onclick="openModal('images/streaming2.jpg', 
                    'Streaming - £1522.01', ' ', 
                    'CPU', 'At this budget, we are running the Intel Core i5-13500. The 13500 features 6 Performance-cores with Hyperthreading, 8 Efficient-cores, and will perform exceptionally well with all your gaming needs. While it is not overclockable and does come with a stock cooler we have added the Deepcool AK400 ZERO DARK to the build for better cooling and to reduce the noise level.', 
                    'Motherboard', 'We are using a parametric filter to constantly select the best-priced motherboard while meeting selected criteria. In this case, we are filtering for B760 ATX motherboards with four DDR4 slots. The compatibility engine will filter out anything not compatible with the build and include a front panel USB-C header.', 
                    'Memory', 'We are filtering for a 2x16GB kit of DDR4 RAM with a speed of at least DDR4-3200 and maximum Cas latency of 16 to target the sweet spot for the 13500.', 
                    'Storage', 'We are using parametric filters to incorporate a PCIe Gen 4.0 x4 NVME M.2 SSD with at least 2TB of space. Everyones storage needs differ so feel free to add or remove capacity as needed.', 
                    'Case', 'All of our components are housed in the Corsair 4000D Airflow. This case features an all black design with a tempered glass side panel and mesh front panel. It includes one front panel Type-A USB 3 port, one USB3 Type-C port, hidden PSU mount, and a number of cable management holes and tie-offs to help your build look tidy. The case can also comfortably fit full-sized video cards and large CPU coolers',
                    'Operating System', 'For the best performance and fewest issues you will want to use Windows 11. The i5-13500 has a combination of Performance-cores and Efficient-cores that Windows 11 is designed to handle and will send specific tasks to the appropriate types of cores. Windows 10 does not have this functionality and may cause issues with system stability and operation.')">
                      More information
                    </button>
                  </div>
                  <p class="text-body-secondary">£1522.01</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Flip Card 6 -->
        <div class="col">
          <!-- Flip card content -->
          <div class="col">
            <!-- Flip card content -->
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <img src="images/streaming3.jpg" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                  <!-- Content for back of the card -->
                  <h1>Glorious Intel Streaming Build</h1>
                  <ul>
                    <li>Specs:</li>
                    <li>Intel Core i9-14900K</li>
                    <li>Parametric Video Card</li>
                    <li>Corsair iCUE 5000D RGB AIRFLOW ATX Mid Tower</li>
                  </ul>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button class="open-modal-btn"
                        onclick="openModal('images/streaming3.jpg', 
                      'Streaming - £3036.79', ' ', 
                      'CPU', 'The Intel Core i9-14900K is one of the fastest gaming CPUs available. It offers 8 Performance-cores, 16 Performance threads, 16 Efficient-cores, a base frequency of 3.2GHz, and a turbo frequency of 6GHz. The unlocked multiplier enables easy and significant overclocking.', 
                      'Motherboard', 'We are using a parametric filter of Z790 motherboards. The Z790 chipset allows the i9-14900K CPU to be overclocked.', 
                      'Memory', 'For memory, we are filtering for the best-priced 2x16GB kit of DDR5 RAM with a heatsink. We have limited it to DDR5-6000 and faster speeds and 30 CAS latency or lower.', 
                      'Storage', 'We are using a parametric selection of well-reviewed 2TB NVME M.2 SSDs. Everyones storage needs differ, so you may wish to select similar SSDs with different capacities or even adding in a mechanical HDD for larger storage needs.', 
                      'Case', 'The Corsair 5000D AIRFLOW features great airflow, a tempered glass window. Inside the case are a PSU shroud, cable management holes, and tie-offs, which will make the PC easier to keep looking clean.',
                      'Operating System', 'For the best performance and fewest issues you will want to use Windows 11. The i9-14900K has a combination of Performance and Efficiency cores that Windows 11 is designed to handle and will send specific tasks to the appropriate types of cores. Windows 10 does not have this functionality and may cause issues with system stability and operation.')">
                        More information
                      </button>
                    </div>
                    <p class="text-body-secondary">£3036.79</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Flip Card 7 -->
        <div class="col">
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="images/workStation1.jpg" alt="Avatar" style="width:300px;height:300px;">
              </div>
              <div class="flip-card-back">
                <!-- Content for back of the card -->
                <h1>Budget Office Build</h1>
                <ul>
                  <li>Specs:</li>
                  <li>AMD Ryzen 5 5600G</li>
                  <li>Cooler Master N200 MicroATX Mini Tower</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button class="open-modal-btn" onclick="openModal('images/workStation1.jpg', 
                    'Work Station - £413.36', ' ', 
                    'CPU', 'The Ryzen 5 5600G is an APU, which can adequately serve the role of both CPU and GPU. It has 6 cores and 12 threads, with a boost clock of 4.4 GHz and is aptly suited for all software in the Microsoft Office suite or the comparable open source offerings.', 
                    'Motherboard', 'We are using a parametric selection of motherboards that will be compatible with the Ryzen 5 5600G. They also include 2-4 DIMM slots for up to 64GB of DDR4 RAM.', 
                    'Memory', 'For this build and most machines outside of the top end we opted to go with 16GB of DDR4 memory with CAS latency no higher than 18 clock cycles. The parametric filter finds the best price on 2x8GB kits of memory that are within AMD’s recommended specifications. We have limited it to DDR4-3600 or faster, as modern CPUs scale well with higher frequency memory.', 
                    'Storage', 'We are also using a parametric filter to select the best priced NVME SSD available that is at least 1TB. Everyones storage needs are different, so feel free to change drive capacity or add a drive to fit your', 
                    'Case', 'The Cooler Master N200 is an mATX mini tower case with one front panel USB 3.0 Gen 1 port and two front panel USB2.0 port, one optical drive bays and it fits most full-size graphics cards without issue.',
                    ' ', ' ')">
                      More information
                    </button>
                  </div>
                  <p class="text-body-secondary">£413.36</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Flip Card 8 -->
        <div class="col">
          <!-- Flip card content -->
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="images/workStation2.jpg" alt="Avatar" style="width:300px;height:300px;">
              </div>
              <div class="flip-card-back">
                <!-- Content for back of the card -->
                <h1>Modest Intel Build</h1>
                <ul>
                  <li>Specs:</li>
                  <li>Intel Core i5-12400F</li>
                  <li>Parametric Video Card</li>
                  <li>Deepcool CC360 ARGB MicroATX Mini Tower</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button class="open-modal-btn" onclick="openModal('images/workStation2.jpg', 
                    'Work Station - £721.67', 'The Modest Intel build guide is focused on providing the best performance per dollar on a mid range gaming PC. The components are straightforward to install and the system will run games at 1080p or higher without issue', 
                    'CPU', 'Our Modest Intel Gaming Build is centered around the Intel Core i5-12400F. Using the included CPU cooler you will be able to keep temperatures and noise low on this locked processor.', 
                    'Motherboard', 'We have paired the i5-12400F with a parametric filter of Micro ATX and ATX B660 motherboards that support up to 128GB of DDR4 memory, multiple SATA6 ports for storage drives, and front panel USB3.0 ports. ', 
                    'Memory', 'We are filtering for a 2x8GB kit of DDR4 RAM with a speed of at least DDR4-3200 and maximum Cas latency of 16 as the Core i5-12400F scales well with faster memory.', 
                    'Storage', 'We are also using a parametric filter that will actively select the best-priced NVME M.2 SSD of at least 1TB capacity. Solid states drives are significantly faster than hard drives and one of the easiest ways to improve system responsiveness and load times for both applications and games.', 
                    'Case', 'The Deepcool CC360 ARGB comes with one USB2 port, one USB3 port, a large tempered glass side panel and fits full-size graphics cards without issue. It provides several cable management holes as well as a mesh front panel for better airflow.',
                    ' ', ' ')">
                      More information
                    </button>
                  </div>
                  <p class="text-body-secondary">£721.67</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Flip Card 9 -->
        <div class="col">
          <!-- Flip card content -->
          <div class="col">
            <!-- Flip card content -->
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <img src="images/workStation3.jpg" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                  <!-- Content for back of the card -->
                  <h1>AMD Office Build</h1>
                  <ul>
                    <li>Specs:</li>
                    <li>AMD Ryzen 5 7600</li>
                    <li>Parametric Video Card</li>
                    <li>Corsair 4000D Airflow ATX Mid Tower</li>
                  </ul>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button class="open-modal-btn" onclick="openModal('images/workStation3.jpg', 
                      'Work Station - £1525.64', ' ', 
                      'CPU', 'Our Excellent AMD Gaming/Streaming Build is centered around the Ryzen 5 7600X. Since it is overclockable and does not come with a stock cooler we have added the AK400 ZERO DARK to the build. This is an excellent air cooler that will allow a modest overclock without overheating or becoming noisy.', 
                      'Motherboard', 'We are using a parametric filter for B650 mATX motherboards with at least one USB3.2 Gen2 header for front panel USB-C port. Our compatibility and pricing engines will automatically select the best-priced motherboard that is compatible with the rest of the build and there should not be any issues with BIOS compatibility or required updates to support the CPU.', 
                      'Memory', 'We are filtering for a 2x16GB kit of DDR5 RAM with a speed of at least DDR5-6000 and maximum Cas latency of 40 to target the sweet spot for the 7000 series CPUs', 
                      'Storage', 'We are using parametric filters to incorporate a PCIe Gen 4.0 x4 NVME M.2 SSD with at least 2TB of space. Everyones storage needs differ so feel free to add or remove capacity as needed.', 
                      'Case', 'All of our components are housed in the Corsair 4000D Airflow. This case features an all black design with a tempered glass side panel and mesh front panel. It includes one front panel Type-A USB 3 port, one USB3 Type-C port, hidden PSU mount, and a number of cable management holes and tie-offs to help your build look tidy. The case can also comfortably fit full-sized video cards and large CPU coolers.',
                      ' ', ' ')">
                        More information
                      </button>
                    </div>
                    <p class="text-body-secondary">£1525.64</p>
                  </div>
                </div>
              </div>
            </div>
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
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalImg = document.getElementById("modalImg");
    var captionText = document.getElementById("caption");

    // When the user clicks on the button, open the modal
    function openModal(imageSrc, mainCaption, mainDescription, subtitle1, description1, subtitle2, description2, subtitle3, description3, subtitle4, description4, subtitle5, description5, subtitle6, description6) {
      modal.style.display = "block";
      modalImg.src = imageSrc;
      var caption = document.getElementById("caption");
      caption.innerHTML = `<h1>${mainCaption}</h1>`;
      caption.innerHTML += `<p>${mainDescription}</p>`;
      caption.innerHTML += `<h2>${subtitle1}</h2>`;
      caption.innerHTML += `<p>${description1}</p>`;
      caption.innerHTML += `<h2>${subtitle2}</h2>`;
      caption.innerHTML += `<p>${description2}</p>`;
      caption.innerHTML += `<h2>${subtitle3}</h2>`;
      caption.innerHTML += `<p>${description3}</p>`;
      caption.innerHTML += `<h2>${subtitle4}</h2>`;
      caption.innerHTML += `<p>${description4}</p>`;
      caption.innerHTML += `<h2>${subtitle5}</h2>`;
      caption.innerHTML += `<p>${description5}</p>`;
      caption.innerHTML += `<h2>${subtitle6}</h2>`;
      caption.innerHTML += `<p>${description6}</p>`;
    }

    // When the user clicks on <span> (x), close the modal
    function closeModal() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    // Get the modal
    var modal2 = document.getElementById("myModal2");

    // Get the image that opens the modal
    var IMG = document.getElementById("myImg");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the image, open the modal 
    IMG.onclick = function () {
      modal2.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal2.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal2) {
        modal2.style.display = "none";
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