<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Bootstrap Sidebar Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include Bootstrap CSS and Font Awesome Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Custom CSS for the sidebar */
        .sidebar {
            width: 250px;
            /* Adjusted sidebar width */
        }

        .content {
            margin-left: 300px;
            /* Margin equal to sidebar width */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            height: 100%;
            width: 300px;
            transition: all 0.3s;
        }

        .sidebar.active {
            left: 0;
        }

        /* Style for the menu icon */
        #sidebarCollapse {
            position: absolute;
            top: 10px;
            left: 60px;
            font-size: 24px;
            cursor: pointer;
        }

        /* Style for the close button */
        #closeSidebar {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;

        }

        /* Style for the menu items and icons */
        .nav-link i {
            margin-right: 10px;
        }

        .nav-link {
            color: #000;
        }
    </style>
</head>

<body>
    <div class="row w-100">