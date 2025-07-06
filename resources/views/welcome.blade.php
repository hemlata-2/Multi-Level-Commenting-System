@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Hero Section -->
            <div class="text-center mb-5">
                <div class="mb-4">
                    <i class="fas fa-comments fa-4x text-primary mb-3"></i>
                    <h1 class="display-4 fw-bold text-primary mb-3">Welcome to MultiLevel Comments</h1>
                    <p class="lead text-muted mb-4">A modern platform for creating, sharing, and discussing posts with a beautiful interface.</p>
                </div>
                
                <div class="row justify-content-center mb-5">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-edit text-white fa-2x"></i>
                                </div>
                                <h5 class="card-title">Create Posts</h5>
                                <p class="card-text text-muted">Share your thoughts, ideas, and questions with the community.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-comments text-white fa-2x"></i>
                                </div>
                                <h5 class="card-title">Engage & Discuss</h5>
                                <p class="card-text text-muted">Join conversations and interact with other community members.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-users text-white fa-2x"></i>
                                </div>
                                <h5 class="card-title">Build Community</h5>
                                <p class="card-text text-muted">Connect with like-minded individuals and grow together.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-rocket me-2"></i>Get Started
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        @endif
                    @else
                        <a href="{{ route('posts.create') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-plus me-2"></i>Create Post
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Features Section -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="text-center mb-4">Why Choose Our Platform?</h2>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="fas fa-palette text-white"></i>
                        </div>
                        <div>
                            <h5>Beautiful Design</h5>
                            <p class="text-muted mb-0">Modern, responsive design that looks great on all devices.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        <div>
                            <h5>Fast & Responsive</h5>
                            <p class="text-muted mb-0">Built with Laravel for optimal performance and reliability.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <div>
                            <h5>Secure & Reliable</h5>
                            <p class="text-muted mb-0">Enterprise-grade security with user authentication and data protection.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="fas fa-mobile-alt text-white"></i>
                        </div>
                        <div>
                            <h5>Mobile Friendly</h5>
                            <p class="text-muted mb-0">Optimized for mobile devices with touch-friendly interface.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-bar me-2"></i>Platform Statistics
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <div class="stats-number">{{ App\Models\Post::count() }}</div>
                                        <div class="stats-label">Total Posts</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                        <div class="stats-number">{{ App\Models\User::count() }}</div>
                                        <div class="stats-label">Active Users</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                        <div class="stats-number">{{ App\Models\Post::where('created_at', '>=', now()->subDays(7))->count() }}</div>
                                        <div class="stats-label">Posts This Week</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                        <div class="stats-number">{{ App\Models\Post::where('created_at', '>=', now()->subDays(30))->count() }}</div>
                                        <div class="stats-label">Posts This Month</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <div class="card bg-primary text-white">
                    <div class="card-body p-5">
                        <h3 class="mb-3">Ready to Get Started?</h3>
                        <p class="mb-4">Join our community today and start sharing your thoughts with the world.</p>
                        <a href="{{ route('posts.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-arrow-right me-2"></i>Explore Posts
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
