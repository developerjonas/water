{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSMIS - Water Scheme Management Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --ws-blue: rgb(0, 51, 102);
            --ws-red: rgb(163, 29, 29);
            --ws-yellow: rgb(221, 163, 54);
            --ws-cyan: rgb(69, 140, 176);
            --ws-green: rgb(130, 179, 196);
            --ws-grey-dark: rgb(30, 40, 55);
            --ws-grey-light: rgb(18, 25, 33);
            --ws-fawn: rgb(227, 206, 156);
        }

        /* Flex layout to stick footer to bottom */
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        body {
            background-color: var(--ws-grey-light);
            color: var(--ws-blue);
            font-family: Arial, sans-serif;
        }

        a {
            color: var(--ws-blue);
            text-decoration: none;
        }

        a:hover {
            color: var(--ws-red);
            text-decoration: underline;
        }

        /* Floating Navbar */
        .floating-navbar {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            width: 95%;
            background-color: var(--ws-grey-dark);
            border-radius: 12px;
            padding: 0.5rem 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .floating-navbar .navbar-nav .nav-link {
            color: #fff !important;
            margin: 0 0.75rem;
            font-weight: 500;
            text-decoration: none !important;
        }

        .floating-navbar .navbar-nav .nav-link:hover {
            color: var(--ws-red) !important;
        }

        .floating-navbar .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            margin-right: 2rem;
        }

        /* Hero Section */
        .hero-section {
            background-color: var(--ws-grey-dark);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            padding: 20px;
            border-radius: 12px;
            margin: 0 20px;
            margin-top: 90px;
            box-sizing: border-box;
            min-height: calc(100vh - 170px);
            text-decoration: none !important;
        }

        .hero-section h1 {
            color: var(--ws-red);
            font-weight: bold;
        }

        .hero-section p {
            color: #fff;
        }

        .card {
            background-color: var(--ws-grey-dark);
            color: #fff;
            border-radius: 12px;
            margin-bottom: 20px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background-color: var(--ws-blue);
            border-color: var(--ws-blue);
        }

        .btn-primary:hover {
            background-color: var(--ws-red);
            border-color: var(--ws-red);
            text-decoration: none !important;
        }

        .btn-outline-light {
            border-color: var(--ws-yellow);
            color: var(--ws-yellow);
        }

        .btn-outline-light:hover {
            background-color: var(--ws-yellow);
            color: #fff;
            text-decoration: none !important;
        }

        footer {
            background-color: rgb(30, 40, 55);
            color: #f0f0f0;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                margin-top: 100px;
                padding: 60px 20px;
            }

            .floating-navbar {
                width: 98%;
                padding: 0.5rem 1rem;
            }

            .card {
                margin-bottom: 15px;
            }

            .floating-navbar .navbar-nav {
                text-align: center;
                margin-top: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Navbar -->
    <nav class="navbar floating-navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">WSMIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="color:#fff;"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://wsmis.developerjonas.com/manual">User Manual</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://wsmis.developerjonas.com/support" target="_blank">Support</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <div class="hero-section d-flex flex-column align-items-center justify-content-center text-center">
            <h1 class="mb-3" style="font-size: 2.5rem; color: var(--ws-red);">
                💧 Water Scheme Management <br> Information System
            </h1>

            <!-- Quick Stats / Info -->
            <div class="d-flex flex-wrap justify-content-center mb-4 gap-3">
                <div class="card p-3" style="background-color: var(--ws-grey-dark); min-width: 150px;">
                    <h5 class="mb-1" style="color: var(--ws-cyan);">Version</h5>
                    <p class="mb-0">v1.0 – Stable</p>
                </div>
                <div class="card p-3" style="background-color: var(--ws-grey-dark); min-width: 150px;">
                    <h5 class="mb-1" style="color: var(--ws-green);">Last Update</h5>
                    <p class="mb-0">August 2025</p>
                </div>
            </div>

            <!-- Call to Action Buttons -->
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="/admin" class="btn btn-primary btn-lg">Admin Portal</a>
                <a href="https://wsmis.developerjonas.com/manual" class="btn btn-outline-light btn-lg">User Manual</a>
            </div>
        </div>
    </main>


    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p style="margin: 0; font-size: 0.95rem;">
                <strong>WSMIS © {{ date('Y') }}</strong> — Developed by
                <a href="https://developerjonas.com" target="_blank"
                    style="color: var(--ws-yellow); text-decoration: underline; font-weight: bold;">
                    JONAS
                </a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>