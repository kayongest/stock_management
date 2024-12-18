<?php
session_start(); // Start the session at the top of your file

// Ensure session variables are available
$fullName = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest';
$photo = isset($_SESSION['photo']) ? $_SESSION['photo'] : '../assets/img/user/default-user.jpg';
?>


<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from seantheme.com/color-admin/admin/html/table_manage.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Sep 2024 13:58:15 GMT -->

<head>
    <meta charset="utf-8" />
    <title>:: Scan</title>
    <meta
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
        name="viewport" />
    <meta content name="description" />
    <meta content name="author" />

    <link href="../assets/css/vendor.min.css" rel="stylesheet" />
    <link href="../assets/css/default/app.min.css" rel="stylesheet" />

    <!-- Vendor CSS -->
    <link href="../assets/css/vendor.min.css" rel="stylesheet" />
    <link href="../assets/css/default/app.min.css" rel="stylesheet" />

    <!-- FontAwesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link
        href="../assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
        rel="stylesheet" />
    <link
        href="../assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" />

    <!-- Qr Code Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>

    <style>
        /* Google Fonts */
        @import url("https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700&display=swap");

        * {
            font-family: "Titillium Web", sans-serif;
        }

        .app-header {
            background-color: #35374b;
        }

        body {
            filter: none !important;
            backdrop-filter: none !important;
        }

        /* QrCodeScanner */
        main {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #reader {
            width: 600px;
        }

        #result {
            text-align: center;
            font-size: 1.5rem;
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
                    <div class="menu-item active">
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
        <div class="app-sidebar-bg" data-bs-theme="dark"></div>
        <div class="app-sidebar-mobile-backdrop">
            <a
                href="#"
                data-dismiss="app-sidebar-mobile"
                class="stretched-link"></a>
        </div>

        <div id="content" class="app-content">
            <h1 class="page-header">
                SCAN ITEMS <small>real-time analysis...</small>
            </h1>

            <div class="row">
                <div class="col-md-7 mb-2">
                    <div class="tab-content p-3 rounded-top panel rounded-0 m-0">
                        <div class="tab-pane fade active show" id="nav-pills-tab-1">
                            <div class="row">
                                <main>
                                    <div id="reader"></div>
                                    <div id="result"></div>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mb-2">
                    <div class="row">
                        <div class="col-lg-3">
                            <div
                                class="widget widget-stats bg-"
                                style="background-color: #c23007">
                                <div class="stats-icon">
                                    <i class="fa fa-ban"></i>
                                    <img src="" alt="" />
                                </div>
                                <div class="stats-info">
                                    <h4>CANCELLED</h4>
                                    <p>5</p>
                                </div>
                                <div class="stats-link">
                                    <a href="javascript:;">View Detail </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div
                                class="widget widget-stats bg-"
                                style="background-color: #1d8f07">
                                <div class="stats-icon">
                                    <i class="fa fa-comment-dots"></i>
                                </div>
                                <div class="stats-info">
                                    <h4>ONGOING</h4>
                                    <p>3</p>
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
                                <div class="stats-icon"><i class="fa fa-check"></i></div>
                                <div class="stats-info">
                                    <h4>COMPLETE</h4>
                                    <p>5</p>
                                </div>
                                <div class="stats-link">
                                    <a href="javascript:;">
                                        <div class="stats-content">
                                            <div class="stats-progress progress mb-2 mt-2">
                                                <div class="progress-bar" style="width: 100%"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div
                                class="widget widget-stats bg-"
                                style="background: #d6bd98">
                                <div class="stats-icon">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div class="stats-info">
                                    <h4>APPROVAL</h4>
                                    <p><span class="equipments">2</span></p>
                                </div>
                                <div class="stats-link">
                                    <a href="javascript:;">
                                        <div class="stats-content">
                                            <div class="stats-progress progress mb-2 mt-2">
                                                <div class="progress-bar" style="width: 09.1%"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div
                            class="widget widget-stats bg-teal mb-7px"
                            style="width: fit-content">
                            <div class="stats-icon stats-icon-sm">
                                <!-- <i class="fa fa-"></i> -->
                            </div>
                            <div class="stats-content">
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%"></div>
                                </div>
                                <div class="stats-desc">Overall Analysis</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Data Table - Default</h4>
                    <div class="panel-heading-btn">
                        <a
                            href="javascript:;"
                            class="btn btn-xs btn-icon btn-default"
                            data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a
                            href="javascript:;"
                            class="btn btn-xs btn-icon btn-success"
                            data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    </div>
                </div>

                <div class="panel-body">
                    <table
                        id="data-table-default"
                        width="100%"
                        class="table table-striped table-bordered align-middle text-nowrap">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%" data-orderable="false">Image</th>
                                <th class="text-nowrap">Item name</th>
                                <th class="text-nowrap">Event name</th>
                                <th class="text-nowrap">Event Category</th>
                                <th class="text-nowrap">Project manager</th>
                                <th class="text-nowrap">Tech Lead</th>
                                <th class="text-nowrap">Lease Date</th>
                                <th class="text-nowrap">Event Start Date</th>
                                <th class="text-nowrap">Event End Date</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <td
                                    width="1%"
                                    class="fw-bold dtr-control dt-type-numeric sorting_1"
                                    tabindex="0">
                                    1
                                </td>
                                <td width="1%">
                                    <img
                                        src="../assets/img/user/user-1.jpg"
                                        class="rounded h-30px my-n1 mx-n1" />
                                </td>
                                <td>OMEN</td>
                                <td>KIFC</td>
                                <td>
                                    <p class="btn btn-xs btn-outline btn-success mb-1">Forum</p>
                                </td>
                                <td>Elvis Kananura</td>
                                <td>Ndayizeye John</td>
                                <td>
                                    <p class="btn btn-xs btn-outline-secondary mb-1">
                                        10th : Nov : 2024 - 15 : 15 pm
                                    </p>
                                </td>
                                <td>
                                    <p class="btn btn-xs btn-outline-success mb-1">
                                        12th : Nov : 2024
                                    </p>
                                </td>
                                <td>
                                    <p class="btn btn-xs btn-outline-danger mb-1">
                                        15th : Nov : 2024 - 15 : 45 pm
                                    </p>
                                </td>
                                <td>
                                    <button
                                        class="btn btn-success btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button
                                        class="btn btn-secondary btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button
                                        class="btn btn-warning btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-cancel"></i>
                                    </button>
                                    <button
                                        class="btn btn-secondary btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="odd gradeX">
                                <td
                                    width="1%"
                                    class="fw-bold dtr-control dt-type-numeric sorting_1"
                                    tabindex="0">
                                    2
                                </td>
                                <td width="1%">
                                    <img
                                        src="../assets/img/user/user-2.jpg"
                                        class="rounded h-30px my-n1 mx-n1" />
                                </td>
                                <td>Monitor 24' inch</td>
                                <td>KIFC</td>
                                <td>
                                    <p class="btn btn-xs btn-outline btn-success mb-1">Forum</p>
                                </td>
                                <td>Elvis Kananura</td>
                                <td>Ndayizeye John</td>
                                <td>
                                    <p class="btn btn-xs btn-outline-secondary mb-1">
                                        10th : Nov : 2024 - 15 : 23 pm
                                    </p>
                                </td>
                                <td>
                                    <p class="btn btn-xs btn-outline-success mb-1">
                                        12th : Nov : 2024
                                    </p>
                                </td>
                                <td>
                                    <p class="btn btn-xs btn-outline-danger mb-1">
                                        15th : Nov : 2024 - 15 : 45 pm
                                    </p>
                                </td>
                                <td>
                                    <button
                                        class="btn btn-success btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button
                                        class="btn btn-secondary btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button
                                        class="btn btn-warning btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-cancel"></i>
                                    </button>
                                    <button
                                        class="btn btn-secondary btn-xs"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseItemModal">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="hljs-wrapper">
                    <pre><code class="html" data-url="../assets/data/table-manage/default.json"></code></pre>
                </div>
            </div>
        </div>

        <div class="theme-panel">
            <a
                href="javascript:;"
                data-toggle="theme-panel-expand"
                class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div
                class="theme-panel-content"
                data-scrollbar="true"
                data-height="100%">
                <h5>App Settings</h5>

                <div class="theme-list">
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-red"
                            data-theme-class="theme-red"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Red">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-pink"
                            data-theme-class="theme-pink"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Pink">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-orange"
                            data-theme-class="theme-orange"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Orange">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-yellow"
                            data-theme-class="theme-yellow"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Yellow">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-lime"
                            data-theme-class="theme-lime"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Lime">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-green"
                            data-theme-class="theme-green"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Green">&nbsp;</a>
                    </div>
                    <div class="theme-list-item active">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-teal"
                            data-theme-class
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Default">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-cyan"
                            data-theme-class="theme-cyan"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Cyan">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-blue"
                            data-theme-class="theme-blue"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Blue">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-purple"
                            data-theme-class="theme-purple"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Purple">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-indigo"
                            data-theme-class="theme-indigo"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Indigo">&nbsp;</a>
                    </div>
                    <div class="theme-list-item">
                        <a
                            href="javascript:;"
                            class="theme-list-link bg-black"
                            data-theme-class="theme-gray-600"
                            data-toggle="theme-selector"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-container="body"
                            data-bs-title="Black">&nbsp;</a>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <div class="row mt-10px">
                    <div class="col-8 control-label text-body fw-bold">
                        <div>
                            Dark Mode
                            <span
                                class="badge bg-primary ms-1 py-2px position-relative"
                                style="top: -1px">NEW</span>
                        </div>
                        <div class="lh-14">
                            <small class="text-body opacity-50">
                                Adjust the appearance to reduce glare and give your eyes a
                                break.
                            </small>
                        </div>
                    </div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="app-theme-dark-mode"
                                id="appThemeDarkMode"
                                value="1" />
                            <label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="theme-panel-divider"></div>

                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-body fw-bold">
                        Header Fixed
                    </div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="app-header-fixed"
                                id="appHeaderFixed"
                                value="1"
                                checked />
                            <label class="form-check-label" for="appHeaderFixed">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-body fw-bold">
                        Header Inverse
                    </div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="app-header-inverse"
                                id="appHeaderInverse"
                                value="1" />
                            <label class="form-check-label" for="appHeaderInverse">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-body fw-bold">
                        Sidebar Fixed
                    </div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="app-sidebar-fixed"
                                id="appSidebarFixed"
                                value="1"
                                checked />
                            <label class="form-check-label" for="appSidebarFixed">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-body fw-bold">
                        Sidebar Grid
                    </div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="app-sidebar-grid"
                                id="appSidebarGrid"
                                value="1" />
                            <label class="form-check-label" for="appSidebarGrid">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-body fw-bold">
                        Gradient Enabled
                    </div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="app-gradient-enabled"
                                id="appGradientEnabled"
                                value="1" />
                            <label class="form-check-label" for="appGradientEnabled">&nbsp;</label>
                        </div>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <h5>Admin Design (6)</h5>

                <div class="theme-version">
                    <div class="theme-version-item">
                        <a href="index-2.html" class="theme-version-link active">
                            <span
                                style="background-image: url(../assets/img/theme/default.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/transparent/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/theme/transparent.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/apple/"
                            class="theme-version-link">
                            <span
                                style="background-image: url(../assets/img/theme/apple.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/material/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/theme/material.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/facebook/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/theme/facebook.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/google/"
                            class="theme-version-link">
                            <span
                                style="background-image: url(../assets/img/theme/google.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <h5>Language Version (9)</h5>

                <div class="theme-version">
                    <div class="theme-version-item">
                        <a href="index-2.html" class="theme-version-link active">
                            <span
                                style="background-image: url(../assets/img/version/html.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/ajax/"
                            class="theme-version-link">
                            <span
                                style="background-image: url(../assets/img/version/ajax.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/angularjs/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/version/angular1x.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/angularjs18/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/version/angular10x.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/svelte/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/version/svelte.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="javascript:alert('Laravel 11 Version only available in downloaded version.');"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/version/laravel.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="javascript:alert('Django Version only available in downloaded version.');"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/version/django.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/vue3/"
                            class="theme-version-link">
                            <span
                                style="background-image: url(../assets/img/version/vuejs.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/admin/react/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/version/reactjs.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="javascript:alert('.NET Core 8.0 MVC Version only available in downloaded version.');"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/version/dotnet.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <h5>Frontend Design (5)</h5>

                <div class="theme-version">
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/frontend/one-page-parallax/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/theme/one-page-parallax.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/frontend/e-commerce/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/theme/e-commerce.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/frontend/blog/"
                            class="theme-version-link">
                            <span
                                style="background-image: url(../assets/img/theme/blog.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/frontend/forum/"
                            class="theme-version-link">
                            <span
                                style="background-image: url(../assets/img/theme/forum.jpg)"
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a
                            href="https://seantheme.com/color-admin/frontend/corporate/"
                            class="theme-version-link">
                            <span
                                style="
                    background-image: url(../assets/img/theme/corporate.jpg);
                  "
                                class="theme-version-cover"></span>
                        </a>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <a
                    href="https://seantheme.com/color-admin/documentation/"
                    class="btn btn-dark d-block w-100 rounded-pill mb-10px"
                    target="_blank"><b>Documentation</b></a>
                <a
                    href="javascript:;"
                    class="btn btn-default d-block w-100 rounded-pill"
                    data-toggle="reset-local-storage"><b>Reset Local Storage</b></a>
            </div>
        </div>

        <a
            href="javascript:;"
            class="btn btn-icon btn-circle btn-theme btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>

    <script>
        // Initialize QR Code scanner
        const scanner = new Html5QrcodeScanner("reader", {
            qrbox: {
                width: 200,
                height: 200
            }, // Adjust size as needed
            fps: 10,
        });

        // Handle successful QR Code scans
        function onScanSuccess(decodedText, decodedResult) {
            console.log("Scanned QR Code:", decodedText);
            let qrCodeUrl;

            try {
                // Attempt to parse as JSON
                const parsedResult = JSON.parse(decodedText);
                qrCodeUrl = parsedResult["Item ID"] || parsedResult.id || decodedText;
            } catch (e) {
                console.warn("Failed to parse QR code as JSON. Using raw result.");
                qrCodeUrl = decodedText; // Default to the scanned text
            }

            fetchScannedItemData(qrCodeUrl); // Fetch data based on QR Code
        }

        // Handle QR Code scanning errors
        function onScanError(err) {
            console.error("QR Code scanning error:", err);
            document.getElementById("result").innerHTML = `
	  <h2>Error!</h2>
	  <p>${err || "An unknown error occurred."}</p>
	`;
        }

        // Render scanner
        scanner.render(onScanSuccess, onScanError);

        // Fetch item data from the server
        function fetchScannedItemData(qrCodeUrl) {
            console.log("Fetching item data for QR Code:", qrCodeUrl);

            $.ajax({
                url: "get_item_by_qr.php",
                type: "GET",
                data: {
                    qr_code_url: qrCodeUrl
                },
                dataType: "json",
                success: function(response) {
                    console.log("Response from server:", response);
                    if (response.status === "success") {
                        appendToTable(response.item);
                    } else {
                        alert("No item found for the scanned QR code.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching item data:", error);
                    alert("Error fetching item data: " + error);
                },
            });
        }

        // Append scanned item data to the table
        function appendToTable(item) {
            const table = document
                .getElementById("scanned-items-table")
                .getElementsByTagName("tbody")[0];
            const row = table.insertRow();
            row.innerHTML = `
	  <td>${item.id}</td>
	  <td>${item.item_name}</td>
	  <td>${item.item_description}</td>
	  <td>${item.item_category}</td>
	  <td>${item.serial_number}</td>
	  <td>${item.stock_location}</td>
	  <td>${item.item_status}</td>
	  <td>${item.item_type}</td>
	  <td>${item.date_added}</td>
	  <td><button class="btn btn-danger btn-sm">Delete</button></td>
	`;
        }
    </script>

    <script
        src="../assets/js/vendor.min.js"
        type="669e284be813e2276db48d03-text/javascript"></script>
    <script
        src="../assets/js/app.min.js"
        type="669e284be813e2276db48d03-text/javascript"></script>

    <script
        src="../assets/plugins/datatables.net/js/dataTables.min.js"
        type="669e284be813e2276db48d03-text/javascript"></script>
    <script
        src="../assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"
        type="669e284be813e2276db48d03-text/javascript"></script>
    <script
        src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"
        type="669e284be813e2276db48d03-text/javascript"></script>
    <script
        src="../assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"
        type="669e284be813e2276db48d03-text/javascript"></script>
    <script
        src="../assets/js/demo/table-manage-default.demo.js"
        type="669e284be813e2276db48d03-text/javascript"></script>
    <script
        src="../assets/plugins/%40highlightjs/cdn-assets/highlight.min.js"
        type="669e284be813e2276db48d03-text/javascript"></script>
    <script
        src="../assets/js/demo/render.highlight.js"
        type="669e284be813e2276db48d03-text/javascript"></script>

    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3"
        type="669e284be813e2276db48d03-text/javascript"></script>
    
    <script
        src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="669e284be813e2276db48d03-|49"
        defer></script>
    <script
        defer
        src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"></script>
</body>

<!-- Mirrored from seantheme.com/color-admin/admin/html/table_manage.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Sep 2024 13:58:18 GMT -->

</html>