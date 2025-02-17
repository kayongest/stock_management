<?php
session_start(); // Start the session at the top of your file

// Ensure session variables are available
$fullName = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest';
$photo = isset($_SESSION['photo']) ? $_SESSION['photo'] : '../assets/img/user/default-user.jpg';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>:: USERS</title>
    <link rel="shortcut icon" href="../assets/img/stock.png" />
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

    <!-- Sweet Alert -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <!-- jQuery (necessary for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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
                        <span class="badge">5</span>
                    </a>
                    <div class="dropdown-menu media-list dropdown-menu-end">
                        <div
                            class="dropdown-header text-white"
                            style="background-color: #044a42">
                            NOTIFICATIONS (5)
                        </div>
                        <a href="javascript:;" class="dropdown-item media">
                            <div class="media-left">
                                <i class="fa fa-bug media-object bg-gray-500"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">
                                    Server Error Reports
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
                        <a href="extra_profile.html" class="dropdown-item">Edit Profile</a>
                        <a
                            href="email_inbox.html"
                            class="dropdown-item d-flex align-items-center">
                            Inbox
                            <span class="badge bg-danger rounded-pill ms-auto pb-4px">2</span>
                        </a>
                        <a href="calendar.html" class="dropdown-item">Calendar</a>
                        <a href="extra_settings_page.html" class="dropdown-item">Settings</a>
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
                        <a href="items.html" class="menu-link">
                            <div class="menu-icon">
                                <i class="fa fa-boxes-packing"></i>
                            </div>
                            <div class="menu-text">Dashboard</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="stocks.html" class="menu-link">
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
                    <div class="menu-item active">
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
        <div class="app-sidebar-bg" data-bs-theme="dark"></div>
        <div class="app-sidebar-mobile-backdrop">
            <a
                href="#"
                data-dismiss="app-sidebar-mobile"
                class="stretched-link"></a>
        </div>

        <div id="content" class="app-content">

            <div class="row">
                <div class="col-lg-3">
                    <div
                        class="widget widget-stats bg-"
                        style="background-color: #535c91">
                        <div class="stats-icon">
                            <i class="fa fa-users-gear"></i>
                            <img src="" alt="" />
                        </div>
                        <div class="stats-info">
                            <h4>TECHNICIANS</h4>
                            <p>15</p>
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;">View Detail </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div
                        class="widget widget-stats bg-"
                        style="background-color: #474e68">
                        <div class="stats-icon"><i class="fa fa-user-friends"></i></div>
                        <div class="stats-info">
                            <h4>USERS</h4>
                            <p class="users">6</p>
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;">View Detail
                                <!-- <i class="fa fa-arrow-alt-circle-right"></i> -->
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div
                        class="widget widget-stats bg-"
                        style="background-color: #2f576e">
                        <div class="stats-icon"><i class="fa fa-warehouse"></i></div>
                        <div class="stats-info">
                            <h4>STOCKS</h4>
                            <p>5</p>
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;">View Detail
                                <!-- <i class="fa fa-arrow-alt-circle-right"></i> -->
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget widget-stats bg-" style="background: #3a9188">
                        <div class="stats-icon"><i class="fa fa-tools"></i></div>
                        <div class="stats-info">
                            <h4>EQUIPMENTS</h4>
                            <p><span class="equipments">0</span></p>
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;">View Detail
                                <!-- <i class="fa fa-arrow-alt-circle-right"></i> -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- First Column -->
                <div class="col-md-5">
                    <div
                        class="panel panel-inverse"
                        data-sortable-id="form-validation-1">
                        <div class="panel-heading" style="background: #04364a">
                            <h4 class="panel-title">User Management</h4>
                            <div class="panel-heading-btn">
                                <a
                                    href="javascript:;"
                                    class="btn btn-xs btn-icon btn-default"
                                    data-toggle="panel-expand">
                                    <i class="fa fa-expand"></i>
                                </a>
                                <a
                                    href="javascript:;"
                                    class="btn btn-xs btn-icon btn-success"
                                    data-toggle="panel-reload">
                                    <i class="fa fa-redo"></i>
                                </a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form
                                id="addUserForm"
                                class="form-horizontal"
                                data-parsley-validate="true"
                                method="POST"
                                enctype="multipart/form-data">
                                <div class="form-group row mb-3">
                                    <label
                                        class="col-lg-4 col-form-label form-label"
                                        for="fullname">Full Name</label>
                                    <div class="col-lg-8">
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="fullname"
                                            name="fullname"
                                            placeholder="Full name"
                                            data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label
                                        class="col-lg-4 col-form-label form-label"
                                        for="email">Email</label>
                                    <div class="col-lg-8">
                                        <input
                                            class="form-control"
                                            type="email"
                                            id="email"
                                            name="email"
                                            placeholder="Email"
                                            data-parsley-required="true"
                                            data-parsley-type="email" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label
                                        class="col-lg-4 col-form-label form-label"
                                        for="password">Password</label>
                                    <div class="col-lg-8">
                                        <input
                                            class="form-control"
                                            type="password"
                                            id="password"
                                            name="password"
                                            placeholder="Password"
                                            data-parsley-required="true"
                                            data-parsley-minlength="6" />
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label
                                        class="col-lg-4 col-form-label form-label"
                                        for="confirm_password">Confirm Password</label>
                                    <div class="col-lg-8">
                                        <input
                                            class="form-control"
                                            type="password"
                                            id="confirm_password"
                                            name="confirm_password"
                                            placeholder="Confirm Password"
                                            data-parsley-required="true"
                                            data-parsley-equalto="#password" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label
                                        class="col-lg-4 col-form-label form-label"
                                        for="phone">Phone</label>
                                    <div class="col-lg-8">
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="phone"
                                            name="phone"
                                            placeholder="Phone" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label
                                        class="col-lg-4 col-form-label form-label"
                                        for="profile-picture">Profile Picture</label>
                                    <div class="col-lg-8">
                                        <input
                                            type="file"
                                            class="form-control"
                                            id="profile-picture"
                                            name="profile_picture"
                                            accept="image/*" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="role">Role</label>
                                    <div class="col-lg-8">
                                        <select
                                            class="form-select"
                                            id="role"
                                            name="role"
                                            required>
                                            <option value="">-- select --</option>
                                            <option value="User">User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Tech Lead">Tech Lead</option>
                                            <option value="Technician">Technician</option>
                                            <option value="Stock Controller">
                                                Stock Controller
                                            </option>
                                            <option value="Event Coordinator">
                                                Event Coordinator
                                            </option>
                                            <option value="Project Manager">Project Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 offset-lg-4">
                                        <button
                                            type="submit"
                                            class="btn btn-success btn-sm float-end">
                                            Add User
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Second Column -->
                <div class="col-md-7">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">All Users</h4>
                            <span class="badge bg-teal users" id="userCount"></span>
                        </div>
                        <div class="panel-body">
                            <table
                                id="userTable"
                                class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Photo</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody">
                                    <!-- User rows will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a
            href="javascript:;"
            class="btn btn-icon btn-circle btn-theme btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Your custom scripts -->

    <!-- Your custom scripts -->
    <script>
        $(document).ready(function() {

            $("#addUserForm").on("submit", function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Function to update user count
                function updateUserCount(newCount) {
                    // Use conditional (ternary) operator to check if newCount is 1 or more
                    const userText = newCount => 1 ? `${newCount} new user` : `${newCount} new users`;
                    $("#userCount").text(userText);
                }

                var formData = new FormData(this); // Get the form data

                $.ajax({
                    url: "add_user.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response); // Log the raw response
                        try {
                            const res = JSON.parse(response); // Parse the JSON response

                            console.log(res); // Log the parsed response

                            if (res.status === "success") {
                                // Create a new row for the table
                                const newRow = `
                        <tr>
                            <td>${res.user_id}</td>
                            <td>${$("#fullname").val()}</td>
                            <td>${$("#email").val()}</td>
                            <td>${$("#phone").val()}</td>
                            <td>${$("#role").val()}</td>
                            <td><img src="${
                              res.photo
                            }" alt="Profile Picture" style="width: 50px; height: auto;"></td>
                            <td>${new Date()
                              .toISOString()
                              .slice(0, 19)
                              .replace("T", " ")}</td>
                        </tr>
                    `;

                                $("#userTableBody").append(newRow); // Append the new row to the table body

                                // Optionally refresh DataTable if already initialized
                                if ($.fn.DataTable.isDataTable("#userTable")) {
                                    $("#userTable").DataTable().row.add($(newRow)).draw(false);
                                }

                                // Update the user count
                                const currentCount = parseInt($("#userCount").text()) || 0; // Get current count, default to 0 if not a number
                                updateUserCount(currentCount + 1); // Increment the count

                                Swal.fire({
                                    toast: true,
                                    icon: "success",
                                    title: res.message,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                }).then(() => {
                                    $("#addUserModal").modal("hide"); // Hide the modal
                                    $("#addUserForm")[0].reset(); // Reset the form
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: res.message,
                                });
                            }
                        } catch (error) {
                            console.error("Error parsing response:", error);
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong with the response!",
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong with the request!",
                        });
                    },
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "get_users.php", // Path to your PHP file
                method: "GET",
                dataType: "json",
                success: function(response) {
                    const users = response.users;
                    const count = response.count;

                    // Update user count
                    $("#userCount").text(`${count} new users`);

                    // Populate table
                    let rows = "";
                    users.forEach((user) => {
                        rows += `
                    <tr>
                        <td>${user.user_id}</td>
                        <td>${user.full_name}</td>
                        <td>${user.email}</td>
                        <td>${user.phone}</td>
                        <td>${user.role}</td>
                        <td><img src="${user.photo}" alt="Profile Picture" style="width: 50px; height: auto;"></td>
                        <td>${user.created_at}</td>
                    </tr>
                `;
                    });

                    $("#userTableBody").html(rows);

                    // Initialize DataTable with length menu
                    $("#userTable").DataTable({
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        lengthChange: true,
                        pageLength: 5, // Default entries per page
                        lengthMenu: [5, 10, 15, 50, 100], // Entries per page options
                        language: {
                            lengthMenu: "Show _MENU_ entries", // Customize the text
                        },
                    });
                },
                error: function() {
                    console.error("Error fetching user data");
                    $("#userCount").text("Error loading users");
                },
            });
        });
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