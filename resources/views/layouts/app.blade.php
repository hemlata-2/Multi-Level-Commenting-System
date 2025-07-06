<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            :root {
                --primary-color: #6366f1;
                --primary-dark: #4f46e5;
                --secondary-color: #f8fafc;
                --accent-color: #10b981;
                --text-primary: #1e293b;
                --text-secondary: #64748b;
                --border-color: #e2e8f0;
                --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
                --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            }

            * {
                font-family: 'Inter', sans-serif;
            }

            body {
                background-color: #f8fafc;
                color: var(--text-primary);
                line-height: 1.6;
            }

            .navbar {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                box-shadow: var(--shadow-md);
                padding: 1rem 0;
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: white !important;
            }

            .navbar-nav .nav-link {
                color: rgba(255, 255, 255, 0.9) !important;
                font-weight: 500;
                transition: all 0.3s ease;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                margin: 0 0.25rem;
            }

            .navbar-nav .nav-link:hover {
                color: white !important;
                background-color: rgba(255, 255, 255, 0.1);
                transform: translateY(-1px);
            }

            .main-content {
                min-height: calc(100vh - 80px);
                padding: 2rem 0;
            }

            .card {
                border: none;
                border-radius: 1rem;
                box-shadow: var(--shadow-sm);
                transition: all 0.3s ease;
                overflow: hidden;
            }

            .card:hover {
                box-shadow: var(--shadow-lg);
                transform: translateY(-2px);
            }

            .card-header {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                color: white;
                font-weight: 600;
                border: none;
                padding: 1.5rem;
            }

            .btn {
                border-radius: 0.75rem;
                font-weight: 500;
                padding: 0.75rem 1.5rem;
                transition: all 0.3s ease;
                border: none;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                box-shadow: var(--shadow-sm);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: var(--shadow-md);
            }

            .btn-success {
                background: linear-gradient(135deg, var(--accent-color) 0%, #059669 100%);
            }

            .btn-warning {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: white;
            }

            .btn-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            }

            .list-group-item {
                border: none;
                border-bottom: 1px solid var(--border-color);
                padding: 1.25rem;
                transition: all 0.3s ease;
            }

            .list-group-item:hover {
                background-color: #f8fafc;
                transform: translateX(4px);
            }

            .list-group-item:last-child {
                border-bottom: none;
            }

            .page-title {
                color: var(--text-primary);
                font-weight: 700;
                margin-bottom: 1.5rem;
                position: relative;
            }

            .page-title::after {
                content: '';
                position: absolute;
                bottom: -0.5rem;
                left: 0;
                width: 3rem;
                height: 3px;
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                border-radius: 2px;
            }

            .post-title {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 600;
                font-size: 1.1rem;
                transition: all 0.3s ease;
            }

            .post-title:hover {
                color: var(--primary-dark);
                text-decoration: none;
            }

            .footer {
                background: var(--text-primary);
                color: white;
                text-align: center;
                padding: 2rem 0;
                margin-top: 3rem;
            }

            .stats-card {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border-radius: 1rem;
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .stats-number {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
            }

            .stats-label {
                font-size: 1rem;
                opacity: 0.9;
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('posts.index') }}">
                    <i class="fas fa-comments me-2"></i>
                    MultiLevel Comments
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.index') }}">
                                <i class="fas fa-home me-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.create') }}">
                                <i class="fas fa-plus me-1"></i> New Post
                            </a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-cog me-2"></i> Profile
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <p class="mb-0">
                    <i class="fas fa-heart text-danger me-1"></i>
                    Built with Laravel & Bootstrap
                </p>
            </div>
        </footer>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
