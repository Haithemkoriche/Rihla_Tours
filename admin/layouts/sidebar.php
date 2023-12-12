<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Bootstrap Sidebar Example</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for the sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            width: 250px;
            transition: all 0.3s;
        }

        .sidebar.active {
            left: 0;
        }
    </style>
</head>

<body>
    <div class="row w-100">
        <div class=" min-h-100">
            <!-- Toggle Button -->
            <div class="col-2">
                <button class="btn btn-dark" id="sidebarCollapse">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <img src="../assets/img/logo.png" alt="Logo" class="img-fluid mb-3" style="max-width: 100px;">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Vols
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>
        <!-- Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Your website content goes here -->
        </main>
    </div>

    <!-- Include Bootstrap JS, Popper.js, and Custom JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Toggle sidebar when the button is clicked
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>