<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mayari - Menstrual Health App</title>
    <link rel="stylesheet" href="templatemo-noir-fashion.css">
<!-- 
TemplateMo 599 Noir Fashion
https://templatemo.com/tm-599-noir-fashion
-->
</head>
<body>
    <nav id="navbar">
        <div class="nav-container">
            <a href="#home" class="logo-link">
                <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#fff;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#ff3366;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <polygon points="50,10 20,50 50,90 80,50" fill="none" stroke="url(#logoGrad)" stroke-width="3"/>
                    <circle cx="50" cy="50" r="5" fill="url(#logoGrad)"/>
                </svg>
                <span class="logo-text">Mayari</span>
            </a>
            <ul class="nav-links">
                <li>  @if (Route::has('login'))
                            @auth
        <a
            href="{{ url('/health-records') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="nav-link">

            Log in
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="nav-link"
            >
                Register
            </a>
        @endif
    @endauth
                        @endif</li>
            </ul>
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <div class="mobile-nav" id="mobileNav">
        <ul class="mobile-nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="/health-records">Health Records</a></li>
            <li><a href="/doctor-directory">Doctor Directory</a></li>
            <li><a href="/health-wellness">Health & Wellness</a></li>
        </ul>
    </div>

    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-container">
            <div class="hero-left">
                <div class="hero-badge">Your Empowering Filipina Menstrual Health Companion</div>
                <h1 class="hero-title">
                    <span class="line"><span>Embrace,</span></span>
                    <span class="line"><span>Empower,</span></span>
                    <span class="line"><span>Thrive.</span></span>
                </h1>
                <p class="hero-description">
                    Mayari is your empowering companion for menstrual health, celebrating the strength of every Filipina. Track your cycle, understand your body, and connect with a supportive community of local doctors and resources. Embrace your beautiful journey with us.
                </p>
                <div class="hero-stats">
                    <div class="stat">
                        <span class="stat-number">10K+</span>
                        <span class="stat-label">Filipinas Joined</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Local Doctors</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">100+</span>
                        <span class="stat-label">Health Articles</span>
                    </div>
                </div>
                <div class="cta-group">
                    <a href="/register" class="cta-button primary">Get Started</a>
                    <a href="/login" class="cta-button outline">Log In</a>
                </div>
            </div>
            <div class="hero-right">
                <div class="hero-image-wrapper">
                    <div class="hero-carousel">
                        <div class="carousel-slide active">
                            <img src="images/filipina-smiling.avif" alt="Menstrual Health 1">
                        </div>
                        <div class="carousel-slide">
                            <img src="images/a-group-of-women.avif" alt="Menstrual Health 2">
                        </div>
                        <div class="carousel-slide">
                            <img src="images/women-having-fun.avif" alt="Menstrual Health 3">
                        </div>
                        <div class="carousel-overlay"></div>
                        <div class="carousel-indicators">
                            <span class="indicator active" data-slide="0"></span>
                            <span class="indicator" data-slide="1"></span>
                            <span class="indicator" data-slide="2"></span>
                        </div>
                    </div>
                    <div class="floating-tags">
                        <div class="tag">Track Your Cycle</div>
                        <div class="tag">Monitor Your Mood</div>
                        <div class="tag">Connect with Doctors</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <span></span>
        </div>
    </section>

    <section class="collections" id="collections">
        <div class="section-header">
            <h2 class="section-title">Features</h2>
            <p class="section-subtitle">Everything you need for your menstrual health</p>
        </div>
        
        <div class="grid" id="collectionsGrid">
            <div class="collection-card">
                <div class="collection-thumbnail">
                    <img src="images/pink-calendar.avif" alt="Cycle Tracker">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Cycle Tracker</h3>
                    <p class="card-subtitle">Log your period, symptoms, and more.</p>
                </div>
            </div>
            <div class="collection-card">
                <div class="collection-thumbnail">
                    <img src="images/woman-menstruating.avif" alt="Mood Tracker">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Mood Tracker</h3>
                    <p class="card-subtitle">Monitor your emotional well-being.</p>
                </div>
            </div>
            <div class="collection-card">
                <div class="collection-thumbnail">
                    <img src="images/weight-scale.avif" alt="Weight & Height Tracker">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Weight & Height Tracker</h3>
                    <p class="card-subtitle">Keep track of your physical health.</p>
                </div>
            </div>
            <div class="collection-card">
                <div class="collection-thumbnail">
                    <img src="images/women-doctor.avif" alt="Doctor Directory">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Doctor Directory</h3>
                    <p class="card-subtitle">Find local OB-GYNs near you.</p>
                </div>
            </div>
            <div class="collection-card">
                <div class="collection-thumbnail">
                    <img src="images/healthy-food.avif" alt="Health & Wellness Articles">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Health & Wellness</h3>
                    <p class="card-subtitle">Read localized articles on menstrual health.</p>
                </div>
            </div>
            <div class="collection-card">
                <div class="collection-thumbnail">
                    <img src="images/period-clock.avif" alt="Irregularity Alerts">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Irregularity Alerts</h3>
                    <p class="card-subtitle">Get notified of any irregularities.</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h3>Mayari</h3>
                <p>Your localized Filipino menstrual health companion.</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Mayari. All rights reserved. | Designed by <a href="https://templatemo.com" target="_blank" rel="nofollow" style="color: var(--accent); text-decoration: none;">TemplateMo</a></p>
        </div>
    </footer>

    <script src="templatemo-noir-scripts.js"></script>
</body>
</html>