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
          <div class="menu-item active">
            <a href="items.html" class="menu-link">
              <div class="menu-icon">
                <i class="fa fa-boxes-packing"></i>
              </div>
              <div class="menu-text">Dashboard</div>
            </a>
          </div>
          <div class="menu-item">
            <a href="stocks.php" class="menu-link">
              <div class="menu-icon">
                <i class="fa fa-warehouse">+076</i>
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
              <h4 class="panel-title">ITEMS</h4>
              <div class="panel-heading-btn">
                <a
                  href="#modal-dialog"
                  class="btn btn-xs text-white"
                  style="background-color: #0b6b94"
                  data-bs-toggle="modal"
                  data-bs-target="#categoryModal">CATEGORIES</a>
                <a
                  href="#modal-dialog"
                  class="btn btn-xs text-white"
                  style="background-color: #0b6b94"
                  data-bs-toggle="modal"
                  data-bs-target="#brandModal">BRANDS</a>
                <a
                  href="#modal-dialog"
                  class="btn btn-xs text-white"
                  style="background-color: #0b6b94"
                  data-bs-toggle="modal"
                  data-bs-target="#itemModal">ADD AN ITEM</a>
                <a
                  href="./backend/api.php?action=generateQrs"
                  class="btn btn-xs text-white"
                  style="background-color: #0b6b94"
                  onClick="downloadQrCodes()">DOWNLOAD QR CODES</a>
                <a
                  href="javascript:;"
                  class="btn btn-xs btn-icon btn-success"
                  data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
              </div>
            </div>

            <div class="panel-body">
              <table
                id="itemTable"
                class="display table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                    <th>Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="itemList">
                  <!-- Table rows will be inserted here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Start Modlals -->
    <!-- Add Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #20425f">
            <h4 class="modal-title text-white" id="itemModalLabel">CATEGORIES</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="categoryForm" enctype="multipart/form-data">
              <!-- Grid System for Two Columns -->
              <div class="row">
                <!-- Column 1 -->
                <div class="col-md-5">
                  <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required />
                  </div>
                  <div class="mb-3">
                    <label for="category_description" class="form-label">Category Description</label>
                    <textarea class="form-control" id="category_description" name="category_description"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="category_tag" class="form-label">Category Tag</label>
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
                    <button type="button" class="btn btn-success" onclick="addACategory()" id="addCategory">Add A Category</button>
                  </div>
                </div>
                <div class="col-md-7">
                  <h6>Categories</h6>
                  <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Tag</th>
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

    <!-- Brands Modal -->
    <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #20425f">
            <h4 class="modal-title text-white" id="itemModalLabel">ADD ITEM</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-5">
                <form id="brandForm" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="brand_name" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" id="brand_name" name="brand_name" required />
                  </div>
                  <div class="mb-3">
                    <button type="button" class="btn btn-success" onclick="addABrand()" id="addCategory">Add A Category</button>
                  </div>
                </form>
              </div>
              <div class="col-md-7">
                <h6>Brands</h6>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                  <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody id="brandTableBody">
                        <!-- Dynamic rows will be appended here -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Add item Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #20425f">
            <h4 class="modal-title text-white" id="itemModalLabel">ADD ITEM</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="itemForm" enctype="multipart/form-data">
              <!-- Grid System for Two Columns -->
              <div class="row">
                <!-- Column 1 -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="categories" class="form-label">Category</label>
                    <select class="form-select" id="categories" name="categories">
                      <option value="">Chose a category</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="brands" class="form-label">Brand</label>
                    <select class="form-select" id="brands" name="brands">
                      <option value="">Chose a Brand</option>
                    </select>
                  </div>
                </div>
                <!-- Column 2 -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="serial_number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number" required />
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="addAnItem()">Add Item</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Editing Items -->
    <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #20425f">
            <h4 class="modal-title text-white" id="editItemModalLabel">EDIT ITEM</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editItemForm" enctype="multipart/form-data">
              <input type="hidden" id="edit_item_id" name="item_id" />
              <div class="row">
                <div class="col-md-6">
                  <!-- Item Name -->
                  <div class="mb-3">
                    <label for="edit_item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="edit_item_name" name="item_name" required />
                  </div>

                  <!-- Item Description -->
                  <div class="mb-3">
                    <label for="edit_item_description" class="form-label">Item Description</label>
                    <textarea class="form-control" id="edit_item_description" name="item_description" required></textarea>
                  </div>

                  <!-- Item Category -->
                  <div class="mb-3">
                    <label for="edit_item_category" class="form-label">Item Category</label>
                    <select class="form-select" id="edit_item_category" name="item_category" required>
                      <option value="">-- select --</option>
                      <option value="VIDEO">VIDEO</option>
                      <option value="IT">IT</option>
                      <option value="SOUND">SOUND</option>
                      <option value="SIS">SIS</option>
                      <option value="LIGHTS">LIGHTS</option>
                      <option value="OTHER">OTHER</option>
                    </select>
                  </div>

                  <!-- Stock Location -->
                  <div class="mb-3">
                    <label for="edit_item_location" class="form-label">Stock Location</label>
                    <select class="form-select" id="edit_stock_location" name="stock_location" required>
                      <option value="">-- select --</option>
                      <option value="Masoro">Masoro</option>
                      <option value="KCC">KCC</option>
                      <option value="BK Arena">BK Arena</option>
                      <option value="Ndera">Ndera</option>
                      <option value="Rugando">Rugando</option>
                    </select>
                  </div>

                  <!-- Serial Number -->
                  <div class="mb-3">
                    <label for="edit_item_serial_number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="edit_item_serial_number" name="serial_number" required />
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- Item Status -->
                  <div class="mb-3">
                    <label for="edit_item_status" class="form-label">Item Status</label>
                    <select class="form-select" id="edit_item_status" name="item_status" required>
                      <option value="">-- select --</option>
                      <option value="Working">Working</option>
                      <option value="Faulty">Faulty</option>
                      <option value="Needs Repair">Needs Repair</option>
                      <option value="Repaired">Repaired</option>
                      <option value="Leased">Leased</option>
                    </select>
                  </div>

                  <!-- Item State -->
                  <div class="mb-3">
                    <label for="edit_item_type" class="form-label">Item State</label>
                    <select class="form-select" id="edit_item_type" name="item_type" required>
                      <option value="Existing">Existing</option>
                      <option value="New">New</option>
                    </select>
                  </div>

                  <!-- Item Image -->
                  <div class="mb-3">
                    <label for="item_image" class="form-label">Item Image</label>
                    <input
                      type="file"
                      class="form-control"
                      id="edit_item_image"
                      name="item_image"
                      accept="image/*" />
                    <img
                      id="edit_image_preview"
                      src="#"
                      alt="Image Preview"
                      class="img-fluid mt-2"
                      style="display: none; max-width: 100%" />
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="updateItem">Update Item</button>
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
  <script>
    $(document).ready(function() {
      
      fetchCategories();
      fetchBrands();
      fetchItems();


      // Function to preview the image
      function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image_preview');
        const reader = new FileReader();

        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block'; // Show the preview
        };

        if (file) {
          reader.readAsDataURL(file);
        } else {
          preview.src = '#'; // Reset preview if no file selected
          preview.style.display = 'none'; // Hide preview
        }
      }

      // Function to handle form submission
      document.getElementById('saveItem').addEventListener('click', function() {
        const form = document.getElementById('itemForm');
        if (form.checkValidity()) {
          const formData = new FormData(form);
          // Add any additional data or manipulations here
          fetch('add_item.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                // Show SweetAlert2 success pop-up with progress bar
                Swal.fire({
                  icon: "success",
                  html: `Item added successfully!`,
                  timer: 3000,
                  showConfirmButton: false,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading(); // Show progress bar during the countdown

                    // Progress bar animation
                    const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                    let width = 0;
                    const interval = setInterval(() => {
                      width += 1; // Increase width by 1% every 30ms
                      progressBar.style.width = width + '%';
                      if (width >= 100) {
                        clearInterval(interval); // Stop when progress is complete
                      }
                    }, 30);
                  },
                  willClose: () => {
                    // Clear the modal form
                    form.reset();
                    $('#itemModal').modal('hide');

                    // Refresh the item list after the timer
                    fetchItems();
                  }
                });
              } else {
                Swal.fire('Error!', data.message || 'Failed to add item.', 'error');
              }
            })
            .catch(error => {
              console.error('Error:', error);
              Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
            });
        } else {
          form.reportValidity(); // Show validation messages
        }
      });


      $(document).on('click', '.edit-item-btn', function() {
        const itemId = $(this).data('item-id'); // Get item ID from data attribute
        showEditModal(itemId); // Call the function to show modal with item ID
      });

      // Fetch item details and show modal
      function showEditModal(itemId) {
        $.ajax({
          url: 'get_item.php', // Your PHP script to fetch item details
          type: 'GET',
          data: {
            id: itemId
          },
          dataType: 'json',
          success: function(item) {
            // Check if the item is returned correctly
            if (item) {
              // Populate modal fields with item data
              $('#edit_item_id').val(item.id);
              $('#edit_item_name').val(item.item_name);
              $('#edit_item_description').val(item.item_description);
              $('#edit_item_serial_number').val(item.serial_number);
              $('#edit_item_status').val(item.item_status);
              $('#edit_item_category').val(item.item_category);
              $('#edit_stock_location').val(item.stock_location); // Ensure this is correctly set

              // Set the image preview to the current item's image
              $('#edit_image_preview').attr('src', `uploads/${item.item_image || "3.jpg"}`).show();

              // Clear the file input for new image upload
              $('#edit_item_image').val('');

              // Open the modal after populating the data
              $('#editItemModal').modal('show');
            } else {
              console.error('Item not found or invalid response.');
            }
          },
          error: function(xhr, status, error) {
            console.error('Error fetching item:', error);
          }
        });
      }

      // Function to preview the image
      function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image_preview');
        const reader = new FileReader();

        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block'; // Show the preview
        };

        if (file) {
          reader.readAsDataURL(file);
        } else {
          preview.src = '#'; // Reset preview if no file selected
          preview.style.display = 'none'; // Hide preview
        }
      }

      // Example of attaching the event listener using jQuery
      $(document).ready(function() {
        $("#edit_item_image").on("change", function() {
          const file = this.files[0];
          const preview = $("#edit_image_preview");

          if (file) {
            preview.attr("src", URL.createObjectURL(file)).show();
          } else {
            preview.hide();
          }
        });

        // Optionally attach a change event for adding items
        $("#item_image").on("change", previewImage);
      });

      // For the 'Edit Item' form preview
      $("#edit_item_image").on("change", function() {
        const file = this.files[0];
        const preview = $("#edit_image_preview");

        if (file) {
          preview.attr("src", URL.createObjectURL(file)).show();
        } else {
          preview.hide();
        }
      });

      // Ensure this function is bound to the correct input fields
      document.getElementById('item_image').addEventListener('change', previewImage);

      // When populating edit modal data:
      function showEditModal(itemId) {
        $.ajax({
          url: 'get_item.php',
          type: 'GET',
          data: {
            id: itemId
          },
          dataType: 'json',
          success: function(item) {
            if (item) {
              $('#edit_item_id').val(item.id);
              $('#edit_item_name').val(item.item_name);
              $('#edit_item_description').val(item.item_description);
              $('#edit_item_serial_number').val(item.serial_number);
              $('#edit_item_status').val(item.item_status);
              $('#edit_item_category').val(item.item_category);
              $('#edit_stock_location').val(item.stock_location);

              // Set image preview
              $('#edit_image_preview')
                .attr('src', `uploads/${item.item_image || "3.jpg"}`)
                .show();
              $('#edit_item_image').val('');
              $('#editItemModal').modal('show');
            }
          },
          error: function(xhr, status, error) {
            console.error('Error fetching item:', error);
          }
        });
      }


      // Attach the previewImage function to the file input for the add item section
      document.getElementById('item_image').addEventListener('change', previewImage);

      // Function to preview the image when editing an item
      $("#edit_item_image").on("change", function() {
        const [file] = this.files; // Get the first file
        const preview = $("#edit_image_preview");

        if (file) {
          // Use URL.createObjectURL for temporary preview
          preview.attr("src", URL.createObjectURL(file)).show();
        } else {
          preview.hide(); // Hide preview if no file is selected
        }
      });

      // Handle item update
      $('#updateItem').on('click', function(e) {
        e.preventDefault();

        const formData = new FormData($('#editItemForm')[0]);

        // Log form data for debugging
        for (var pair of formData.entries()) {
          console.log(pair[0] + ', ' + pair[1]);
        }

        // AJAX request to update item
        $.ajax({
          url: 'update_item.php', // PHP script to handle the update
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message,
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
              });
              $('#editItemModal').modal('hide');
              fetchItems(); // Refresh the item list
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message,
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
              });
            }
          },
          error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'An unexpected error occurred.',
              toast: true,
              position: 'top-right',
              showConfirmButton: false,
              timer: 3000,
            });
          },
        });
      });
    });

    // START CATEGORIES
      function addACategory() {
        const form = document.getElementById('categoryForm');
        if (form.checkValidity()) {
            const formData = new FormData(form);

            // Convert FormData to a plain object
            const formDataObject = {};
            formData.forEach((value, key) => {
                formDataObject[key] = value;
            });

            // Add the action field
            formDataObject.action = "addCategory";

            // Send as JSON
            fetch('./backend/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Indicate that you're sending JSON
                },
                body: JSON.stringify(formDataObject), // Convert to JSON string
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show SweetAlert2 success pop-up with progress bar
                    Swal.fire({
                        icon: "success",
                        html: `Category added successfully!`,
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading(); // Show progress bar during the countdown

                            // Progress bar animation
                            const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                            let width = 0;
                            const interval = setInterval(() => {
                                width += 1; // Increase width by 1% every 30ms
                                progressBar.style.width = width + '%';
                                if (width >= 100) {
                                    clearInterval(interval); // Stop when progress is complete
                                }
                            }, 30);
                        },
                        willClose: () => {
                            // Clear the modal form
                            form.reset();
                            $('#itemModal').modal('hide');

                            // Refresh the item list after the timer
                            fetchItems();
                        }
                    });

                    const tableBody = $("#categoryTableBody");
                    const categories = data.data;

                    categories.forEach(category => {
                        const row = `
                            <tr>
                                <td>${category.name}</td>
                                <td>${category.Description || "N/A"}</td>
                                <td>${category.tag || "N/A"}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                } else {
                    Swal.fire('Error!', data.message || 'Failed to add category.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
            });
          } else {
              form.reportValidity(); // Show validation messages
          }
      }

      function fetchCategories() {
        console.log('Fetching categories');
        $.ajax({
          url: './backend/api.php', // Adjust the path to your API file
          type: 'POST', // Sending POST request
          dataType: 'json', // Expecting a JSON response
          contentType: 'application/json', // Inform the server about the data type
          data: JSON.stringify({ action: 'getCategories' }), // The action to invoke getCategories
          success: function(response) {
            if (response.length > 0) {
              const tableBody = $("#categoryTableBody");
              tableBody.empty(); // Clear existing table rows

              updateCategoryList(response);
              // Loop through categories and create table rows
              response.forEach(category => {
                const row = `
                  <tr>
                      <td>${category.name}</td>
                      <td>${category.Description || "N/A"}</td>
                      <td>${category.tag || "N/A"}</td>
                  </tr>
                `;
                tableBody.append(row);
              });

              // Initialize or refresh DataTable
              if (!$.fn.DataTable.isDataTable("#categoryTable")) {
                $("#categoryTable").DataTable({
                  responsive: true,
                  paging: true,
                  searching: true,
                  info: true,
                  lengthMenu: [
                      [5, 10, 20, -1],
                      [5, 10, 20, "All"]
                  ],
                  pageLength: 5
                });
              } else {
                $("#categoryTable").DataTable().clear().destroy();
                $("#categoryTable").DataTable();
              }
              } 
              else {
                Swal.fire({
                  icon: "info",
                  title: "No Categories",
                  text: "No categories were found.",
                });
              }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching categories:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An error occurred while fetching categories.",
                });
            }
        });
      }

      function updateCategoryList(categoriesData) {
        const categoriesSelect = document.getElementById("categories");
        categoriesSelect.innerHTML = '<option value="">Choose a category</option>'; // Reset options

        categoriesData.forEach(category => {
            const option = document.createElement("option");
            option.value = category.category_id;
            option.textContent = category.name+' | '+category.Description;
            categoriesSelect.appendChild(option);
        });
      }
    // END CATEGORIES

    // START BRANDS
      function addABrand() {
        const form = document.getElementById('brandForm');
        if (form.checkValidity()) {
            const formData = new FormData(form);

            // Convert FormData to a plain object
            const formDataObject = {};
            formData.forEach((value, key) => {
                formDataObject[key] = value;
            });

            // Add the action field
            formDataObject.action = "addBrand";

            // Send as JSON
            fetch('./backend/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Indicate that you're sending JSON
                },
                body: JSON.stringify(formDataObject), // Convert to JSON string
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show SweetAlert2 success pop-up with progress bar
                    Swal.fire({
                        icon: "success",
                        html: `Brand added successfully!`,
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading(); // Show progress bar during the countdown

                            // Progress bar animation
                            const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                            let width = 0;
                            const interval = setInterval(() => {
                                width += 1; // Increase width by 1% every 30ms
                                progressBar.style.width = width + '%';
                                if (width >= 100) {
                                    clearInterval(interval); // Stop when progress is complete
                                }
                            }, 30);
                        },
                        willClose: () => {
                            // Clear the modal form
                            form.reset();
                            $('#itemModal').modal('hide');

                            // Refresh the item list after the timer
                            fetchBrands();
                        }
                    });

                    const tableBody = $("#brandTableBody");
                    const brands = data.data;

                    brands.forEach(brand => {
                        const row = `
                            <tr>
                                <td>${brand.name}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                } else {
                    Swal.fire('Error!', data.message || 'Failed to add brand.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An error occurred. Please try again.'+error, 'error');
            });
          } else {
              form.reportValidity(); // Show validation messages
          }
      }

      function fetchBrands() {
        console.log('Fetching brands...');
        $.ajax({
          url: './backend/api.php', // Adjust the path to your API file
          type: 'POST', // Sending POST request
          dataType: 'json', // Expecting a JSON response
          contentType: 'application/json', // Inform the server about the data type
          data: JSON.stringify({ action: 'getBrands' }), // The action to invoke getCategories
          success: function(response) {
            if (response.length > 0) {
              const tableBody = $("#brandTableBody");
              tableBody.empty(); // Clear existing table rows

              updateBrandList(response);
              // Loop through categories and create table rows
              response.forEach(brand => {
                const row = `
                  <tr>
                      <td>${brand.name}</td>
                  </tr>
                `;
                tableBody.append(row);
              });

              // Initialize or refresh DataTable
              if (!$.fn.DataTable.isDataTable("#brandTable")) {
                $("#brandTable").DataTable({
                  responsive: true,
                  paging: true,
                  searching: true,
                  info: true,
                  lengthMenu: [
                      [5, 10, 20, -1],
                      [5, 10, 20, "All"]
                  ],
                  pageLength: 5
                });
              } else {
                $("#brandTable").DataTable().clear().destroy();
                $("#brandTable").DataTable();
              }
              } 
              else {
                Swal.fire({
                  icon: "info",
                  title: "No Brands",
                  text: "No brands were found.",
                });
              }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching brands:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An error occurred while fetching brands.",
                });
            }
        });
      }

      function updateBrandList(brandsData) {
        const brandsSelect = document.getElementById("brands");
        brandsSelect.innerHTML = '<option value="">Choose a Brans</option>'; // Reset options

        brandsData.forEach(brand => {
            const option = document.createElement("option");
            option.value = brand.brand_id;
            option.textContent = brand.name;
            brandsSelect.appendChild(option);
        });
      }
    // END BRANDS

    // START ITEMS
      function addAnItem() {
        const form = document.getElementById('itemForm');
        console.log(form.checkValidity())
        if (form.checkValidity()) {
            const formData = new FormData(form);

            // Convert FormData to a plain object
            const formDataObject = {};
            formData.forEach((value, key) => {
                formDataObject[key] = value;
            });

            // Add the action field
            formDataObject.action = "addItem";

            console.log({"addAnItem":formDataObject});
            // Send as JSON
            fetch('./backend/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Indicate that you're sending JSON
                },
                body: JSON.stringify(formDataObject), // Convert to JSON string
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show SweetAlert2 success pop-up with progress bar
                    Swal.fire({
                        icon: "success",
                        html: `Category added successfully!`,
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading(); // Show progress bar during the countdown

                            // Progress bar animation
                            const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                            let width = 0;
                            const interval = setInterval(() => {
                                width += 1; // Increase width by 1% every 30ms
                                progressBar.style.width = width + '%';
                                if (width >= 100) {
                                    clearInterval(interval); // Stop when progress is complete
                                }
                            }, 30);
                        },
                        willClose: () => {
                            // Clear the modal form
                            form.reset();
                            $('#itemModal').modal('hide');

                            // Refresh the item list after the timer
                            fetchItems();
                        }
                    });

                    const tableBody = $("#categoryTableBody");
                    const categories = data.data;

                    categories.forEach(category => {
                        const row = `
                            <tr>
                                <td>${category.name}</td>
                                <td>${category.Description || "N/A"}</td>
                                <td>${category.tag || "N/A"}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                } else {
                    Swal.fire('Error!', data.message || 'Failed to add category.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
            });
          } else {
              form.reportValidity(); // Show validation messages
          }
      }

      function fetchItems() {
        
        $.ajax({
          url: './backend/api.php', // Adjust the path to your API file
          type: 'POST', // Sending POST request
          dataType: 'json', // Expecting a JSON response
          contentType: 'application/json', // Inform the server about the data type
          data: JSON.stringify({ action: 'getItems' }), // The action to invoke getCategories
          success: function(response) {
            try {
              if (response.status === "success") {
                let items = response.items;
                // Define category and status colors
                const categoryBadgeColors = {
                  VIDEO: "#10538e",
                  IT: "#5C5470",
                  SOUND: "#03C988",
                  SIS: "#17a2b8",
                  LIGHTS: "#D36B00",
                  OTHER: "#6c757d",
                };

                const statusBadgeColors = {
                  New: "#262A56",
                  Working: "#42855B",
                  Faulty: "#461111",
                  "Needs Repair": "#C69749",
                  Repaired: "#577BC1",
                  Leased: "#6c757d",
                };

                // Define item type button classes based on item type
                const itemTypeButtonClasses = {
                  New: "btn-sm btn-success", // Green button for New
                  Existing: "btn-sm btn-info" // Gray button for Existing
                };
                // Prepare the data for DataTables
                let tableData = items.map(function(item) {
                  const buttonClass = itemTypeButtonClasses[item.item_type] || "btn-outline-secondary"; // Fallback to a default class
                  return {
                    category_name: item.category_name,
                    brand_name: item.brand_name,
                    item_description: item.item_description,
                    serial_number: item.serial_number,
                    item_status: `<span class="badge badge-pill badge-secondary" style="background-color: ${statusBadgeColors[item.item_status] || "#6c757d"};">${item.item_status}</span>`,
                    stock_location: item.stock_location,
                    actions: `<button class="btn btn-primary btn-xs btn-icon" data-item-id="${item.id}" data-bs-toggle="modal" data-bs-target="#editItemModal">
                                <i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-xs btn-icon lease-item-btn" data-item-id="${item.id}" data-item-name="${item.item_name}" data-item-category="${item.category_tag}" data-bs-toggle="modal" data-bs-target="#leaseItemModal"><i class="fa fa-trash"></i></button>`,
                  };
                });

                // Update the DataTable
                if ($.fn.DataTable.isDataTable("#itemTable")) {
                  const table = $("#itemTable").DataTable();
                  table.clear().rows.add(tableData).draw();
                } else {
                  $("#itemList").html(
                      `<table id="itemTable" class="display table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Brand</th>
                              <th>Description</th>
                              <th>Serial Number</th>
                              <th>Status</th>
                              <th>Stock</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                      </table>`
                  );

                  $("#itemTable").DataTable({
                    data: tableData,
                    columns: [
                      {
                        data: "category_name"
                      },
                      {
                        data: "brand_name"
                      },
                      {
                        data: "item_description"
                      },
                      {
                        data: "serial_number"
                      },
                      {
                        data: "item_status"
                      },
                      {
                        data: "stock_location"
                      },
                      {
                        data: "actions"
                      },
                    ],
                    responsive: true,
                    paging: true,
                    searching: true,
                    info: true,
                    dom: '<"top"lf>rt<"bottom"ip><"clear">',
                    buttons: ["copy", "excel", "pdf", "print"],
                    lengthMenu: [
                      [5, 10, 20, -1],
                      [5, 10, 20, "All"]
                    ],
                    pageLength: 5,
                  });
                }

                // Update the equipment count
                const table = $("#itemTable").DataTable();

                function updateEquipmentCount() {
                  const equipmentCount = table.rows({
                    filter: 'applied'
                  }).count();
                  $(".equipments").text(equipmentCount);
                }

                // Update count on table draw event (when page or filter changes)
                table.on("draw", updateEquipmentCount);

                // Update count on table draw event (when page or filter changes)
                table.on("draw", updateEquipmentCount);

                // Initial count update
                updateEquipmentCount();
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Failed to load items. Please try again later.",
                  timer: 500,
                  showConfirmButton: false,
                });
              }
            } catch (e) {
              console.error("Error processing the response:", e);
              $("#itemList").html("<p>An error occurred while loading the items.</p>");
            }
          },
          error: function(xhr, status, error) {
            console.error("Error fetching items:", error);
            $("#itemList").html("<p>Error fetching items. Please try again later.</p>");
          },
        });
      }
    // END ITEMS
  
  </script>

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