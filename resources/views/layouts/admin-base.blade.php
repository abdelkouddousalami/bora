<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bora Fish - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 70px;
            --gold: #ffd700;
            --dark: #1a1a1a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            min-height: 100vh;
            color: #fff;
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            border-right: 2px solid rgba(255, 215, 0, 0.3);
            height: 100vh;
            position: fixed;
            padding-top: var(--header-height);
            z-index: 1000;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar-menu li {
            margin: 5px 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 15px 25px;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-size: 16px;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255, 215, 0, 0.1);
            border-left-color: var(--gold);
        }

        .sidebar-menu i {
            margin-right: 10px;
            color: var(--gold);
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 20px;
            padding-top: calc(var(--header-height) + 20px);
            min-height: 100vh;
            background: rgba(0, 0, 0, 0.3);
        }

        /* Header */
        .header {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(255, 215, 0, 0.3);
            height: var(--header-height);
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1001;
            display: flex;
            align-items: center;
        }

        .header-content {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px 0 calc(var(--sidebar-width) + 20px);
        }

        .logo h1 {
            background: linear-gradient(135deg, var(--gold) 0%, #ffed4e 50%, var(--gold) 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }

        /* Card Styles */
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 215, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: rgba(0, 0, 0, 0.2);
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 215, 0, 0.1);
            font-weight: bold;
            color: var(--gold);
        }

        .card-body {
            padding: 20px;
        }

        /* Table Styles */
        .table {
            color: #fff;
            margin-bottom: 0;
        }

        .table th {
            background: rgba(0, 0, 0, 0.3);
            color: var(--gold);
            font-weight: 600;
            border-bottom: 2px solid rgba(255, 215, 0, 0.2);
        }

        .table td {
            vertical-align: middle;
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Button Styles */
        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--gold);
            color: var(--dark);
            border: none;
        }

        .btn-primary:hover {
            background-color: #ffed4e;
            transform: translateY(-2px);
        }

        .btn i {
            font-size: 14px;
        }

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            border-color: #28a745;
            color: #28a745;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding-left: 20px;
            }

            .header-content {
                padding-left: 20px;
            }
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper {
            padding: 20px;
            color: #fff;
        }

        .dataTables_filter input,
        .dataTables_length select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            outline: none;
            border-color: var(--gold);
        }

        .dataTables_length select option {
            background: var(--dark);
        }

        .dataTables_info {
            color: rgba(255, 255, 255, 0.7);
        }

        .dataTables_paginate .paginate_button {
            color: #fff !important;
        }

        .dataTables_paginate .paginate_button.current {
            background: var(--gold) !important;
            color: var(--dark) !important;
            border: none !important;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <h1>Bora Fish Admin</h1>
            </div>
            <div class="user-menu">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <nav class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="fas fa-concierge-bell"></i> Services
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tours.index') }}" class="{{ request()->routeIs('admin.tours.*') ? 'active' : '' }}">
                    <i class="fas fa-fish"></i> Tours
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    @stack('scripts')
</body>
</html>
