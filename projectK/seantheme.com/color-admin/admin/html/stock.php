<?php
  session_start(); // Start the session at the top of your file

  // Ensure session variables are available
  $fullName = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest';
  $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Assuming user_id is saved in session

  // Check if a user is logged in
  if ($userId) {
      // Include database connection file
      require_once 'config.php';

      // Prepare and execute the query to get the user's photo
      $sql = "SELECT photo FROM users WHERE user_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $stmt->bind_result($photo);
      $stmt->fetch();
      $stmt->close();

      // If the photo is empty or not found, use the default photo
      if (empty($photo)) {
          $photo = 'assets/img/user/default-user.jpg'; // Default photo
      }
  } else {
      // If no user is logged in, use the default photo
      $photo = 'assets/img/user/default-user.jpg';
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>ITEMS</title>
  <link rel="shortcut icon" href="../assets/img/users.png" />
  <meta
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    name="viewport" />

  <meta name="description" content="Event Management Platform" />
  <meta name="author" content="Kayonga Raul" />

  <!-- Vendor CSS -->
  <link href="../assets/css/vendor.min.css" rel="stylesheet" />
  <link href="../assets/css/default/app.min.css" rel="stylesheet" />

  <!-- FontAwesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DataTables CSS -->
  <link
    href="../assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
    rel="stylesheet" />
  <link
    href="../assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
    rel="stylesheet" />

  <!-- Qr code script -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"
    integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>

  <!-- Animate -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <style>
    /* Google Fonts  */
    @import url("https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700&display=swap");

    * {
      font-family: "Titillium Web", sans-serif;
    }

    .app-header {
      background-color: #35374b;
    }

    /* Ensure no global styles are applied */
    body {
      filter: none !important;
      backdrop-filter: none !important;
    }
  </style>
</head>

<body>
  <div id="loader" class="app-loader">
    <span class="spinner"></span>
  </div>

  <div id="app" class="app app-header-fixed app-sidebar-fixed">
    <div id="header" class="app-header text-white">
      <div class="navbar-header">
        <a href="index.html" class="navbar-brand text-white">
          <b class="me-3px">[aB]</b>ility</a>
        <button
          type="button"
          class="navbar-mobile-toggler"
          data-toggle="app-sidebar-mobile">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="navbar-nav">
        <div class="navbar-item dropdown">
          <a
            href="#"
            data-bs-toggle="dropdown"
            class="navbar-link dropdown-toggle icon">
            <i class="fa fa-bell text-white"></i>
            <!-- <span class="badge">5</span> -->
          </a>
          <div class="dropdown-menu media-list dropdown-menu-end">
            <div
              class="dropdown-header text-white"
              style="background-color: #535c91">
              NOTIFICATIONS (5)
            </div>
            <a href="javascript:;" class="dropdown-item media">
              <div class="media-left">
                <i class="fa fa-bug media-object bg-gray-500"></i>
              </div>
              <div class="media-body">
                <h6 class="media-heading">
                  user ($name logged in)
                  <i class="fa fa-exclamation-circle text-danger"></i>
                </h6>
                <div class="text-muted fs-10px">3 minutes ago</div>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item media">
              <div class="media-left">
                <img
                  src="../assets/img/user/user-1.jpg"
                  class="media-object"
                  alt />
                <i
                  class="fab fa-facebook-messenger text-blue media-object-icon"></i>
              </div>
              <div class="media-body">
                <h6 class="media-heading">John Smith</h6>
                <p>
                  Quisque pulvinar tellus sit amet sem scelerisque tincidunt.
                </p>
                <div class="text-muted fs-10px">25 minutes ago</div>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item media">
              <div class="media-left">
                <img
                  src="../assets/img/user/user-2.jpg"
                  class="media-object"
                  alt />
                <i
                  class="fab fa-facebook-messenger text-blue media-object-icon"></i>
              </div>
              <div class="media-body">
                <h6 class="media-heading">Olivia</h6>
                <p>
                  Quisque pulvinar tellus sit amet sem scelerisque tincidunt.
                </p>
                <div class="text-muted fs-10px">35 minutes ago</div>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item media">
              <div class="media-left">
                <i class="fa fa-plus media-object bg-gray-500"></i>
              </div>
              <div class="media-body">
                <h6 class="media-heading">New User Registered</h6>
                <div class="text-muted fs-10px">1 hour ago</div>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item media">
              <div class="media-left">
                <i class="fa fa-envelope media-object bg-gray-500"></i>
                <i
                  class="fab fa-google text-warning media-object-icon fs-14px"></i>
              </div>
              <div class="media-body">
                <h6 class="media-heading">New Email From John</h6>
                <div class="text-muted fs-10px">2 hour ago</div>
              </div>
            </a>
            <div class="dropdown-footer text-center">
              <a href="javascript:;" class="text-decoration-none">View more</a>
            </div>
          </div>
        </div>
        <div class="navbar-item navbar-user dropdown text-white">
          <a
            href="#"
            class="navbar-link dropdown-toggle d-flex align-items-center"
            data-bs-toggle="dropdown">
            <img
              src="<?php echo isset($_SESSION['photo']) ? $_SESSION['photo'] : '../assets/img/user/default-user.jpg'; ?>"
              alt="User Image" />
            <span>
              <span class="d-none d-md-inline text-white"><?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest'; ?></span>
            </span>
          </a>

          <div class="dropdown-menu dropdown-menu-end me-1">
            <a
              href="email_inbox.html"
              class="dropdown-item d-flex align-items-center">
              Settings
              <span class="badge bg-warning rounded-pill ms-auto pb-4px">2</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="login.html" class="dropdown-item">Log Out</a>
          </div>
        </div>
      </div>
    </div>

    <div id="sidebar" class="app-sidebar" data-bs-theme="dark">
      <div
        class="app-sidebar-content"
        data-scrollbar="true"
        data-height="100%">
        <div class="menu">
          <div class="menu-profile">
            <div class="menu-profile-cover with-shadow"></div>
            <div class="menu-profile-image">
              <img src="../assets/img/user/user-13.jpg" alt />
            </div>
            <div class="menu-profile-info">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1">Kayonga Raul</div>
              </div>
              <small>Administrator</small>
            </div>
          </div>
          <div class="menu-header">Navigation</div>
          <div class="menu-item">
            <a href="items.php" class="menu-link">
              <div class="menu-icon">
                <i class="fa fa-boxes-packing"></i>
              </div>
              <div class="menu-text">Dashboard</div>
            </a>
          </div>
          <div class="menu-item active">
            <a href="stock.php" class="menu-link">
              <div class="menu-icon">
                <i class="fa fa-warehouse"></i>
              </div>
              <div class="menu-text">Stocks</div>
            </a>
          </div>
          <div class="menu-item">
            <a href="scan.html" class="menu-link">
              <div class="menu-icon">
                <i class="fa fa-qrcode"></i>
              </div>
              <div class="menu-text">Scan</div>
            </a>
          </div>
          <div class="menu-item">
            <a href="users.html" class="menu-link">
              <div class="menu-icon">
                <i class="fa fa-users"></i>
              </div>
              <div class="menu-text">Users</div>
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <div class="app-sidebar-mobile-backdrop">
      <a
        href="#"
        data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a>
    </div>

    <div id="content" class="app-content">
   
      <div class="row">
        <div class="col-xl-12">
          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title">Requests</h4>
              <div class="panel-heading-btn">
                <a
                  href="#modal-dialog"
                  class="btn btn-xs text-white"
                  style="background-color: #0b6b94"
                  data-bs-toggle="modal"
                  data-bs-target="#categoryModal">Add a request</a>
              </div>
            </div>

            <div class="panel-body">
             
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Start Modlals -->
    <!-- Add Request Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #20425f">
            <h4 class="modal-title text-white" id="itemModalLabel">Request #1127 | (2024/12/23)</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="categoryForm" enctype="multipart/form-data">
              <!-- Grid System for Two Columns -->
              <div class="row">
                <!-- Column 1 -->
                <div class="col-md-5">
                  <div class="mb-3">
                    <label for="category_tag" class="form-label">Item Name</label>
                    <select class="form-select" id="category_tag" name="category_tag" required>
                      <option value="">-- select --</option>
                      <option value="VIDEO">VIDEO</option>
                      <option value="IT">IT</option>
                      <option value="SOUND">SOUND</option>
                      <option value="SIS">SIS</option>
                      <option value="LIGHTS">LIGHTS</option>
                      <option value="OTHER">OTHER</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="category_tag" class="form-label">Item Brand</label>
                    <select class="form-select" id="category_tag" name="category_tag" required>
                      <option value="">-- select --</option>
                      <option value="VIDEO">VIDEO</option>
                      <option value="IT">IT</option>
                      <option value="SOUND">SOUND</option>
                      <option value="SIS">SIS</option>
                      <option value="LIGHTS">LIGHTS</option>
                      <option value="OTHER">OTHER</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="category_tag" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="category_name" name="category_name" required />
                  </div>
                  
                  <div class="mb-3">
                    <button type="button" class="btn btn-success" onclick="addACategory()" id="addCategory">Add an Item</button>
                  </div>
                </div>
                <div class="col-md-7">
                  <h6>Items</h6>
                  <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Brand</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            <!-- Dynamic rows will be appended here -->
                        </tbody>
                    </table>
                </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <!-- End Modals -->


  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

  <!-- Your custom scripts -->
  <script src="scripts/items.js"></script>

  <!-- Vendor and Plugin Scripts -->
  <script src="../assets/js/vendor.min.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/plugins/datatables.net/js/dataTables.min.js"></script>
  <script src="../assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
  <script src="../assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
  <script src="../assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
  <script src="../assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../assets/plugins/pdfmake/build/vfs_fonts.js"></script>
  <script src="../assets/plugins/jszip/dist/jszip.min.js"></script>
  <script src="../assets/js/demo/table-manage-buttons.demo.js"></script>
  <script src="../assets/plugins/%40highlightjs/cdn-assets/highlight.min.js"></script>
  <script src="../assets/js/demo/render.highlight.js"></script>
</body>

</html>