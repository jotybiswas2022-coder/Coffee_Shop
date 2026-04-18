<!-- ================= TOP NAVBAR ================= -->
<nav class="navbar navbar-expand-lg shadow-sm py-2 dark-navbar">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5 text-light" href="{{ url('/') }}">
            <i class="bi bi-cup-straw"></i>
            <span>Café Aroma</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTopNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Top Nav Links -->
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('/') ? 'active-link' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('orders') ? 'active-link' : '' }}" href="{{ url('/orders') }}">
                        <i class="bi bi-bag-check me-1"></i> Orders
                    </a>
                </li>

                @auth
                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link top-nav-link {{ request()->is('admin') ? 'active-link' : '' }}" href="{{ url('/admin') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="btn-logout w-100 text-start">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link top-nav-link {{ request()->is('login') ? 'active-link' : '' }}" href="{{ url('/login') }}">
                            <i class="bi bi-person-circle me-1"></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link signup-btn text-center" href="{{ url('/register') }}">
                            <i class="bi bi-person-plus me-1"></i> Signup
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- ================= BOTTOM SEARCH + CART BAR ================= -->
<div class="bottom-glass-bar py-2 shadow-sm">
    <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">

        <!-- Search -->
        <form action="{{ url('/search') }}" method="GET" class="search-form flex-grow-1 me-3" style="min-width: 300px; flex: 1 1 70%;">
            <div class="input-group">
                <input type="text" name="q" class="form-control glass-input"
                       placeholder="Search Item name or category..." required>
                <button class="btn search-btn" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <!-- Cart -->
        <a href="{{ url('/cart') }}" class="cart-link position-relative">
            <i class="bi bi-cart3 fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-badge">
                {{ cart() }}
            </span>
        </a>

    </div>
</div>

<style>
        /* ============================================
           CAFÉ AROMA — THEME VARIABLES
           ============================================ */
        :root {
            --brown:        #6B4F3F;
            --brown-dark:   #5A3E30;
            --brown-deeper: #4A3228;
            --cream:        #F5F0E1;
            --cream-light:  #FAF7EE;
            --cream-dark:   #E8DFC8;
            --espresso:     #3B2417;
            --latte:        #C4A882;
            --mocha:        #8B6F5E;
        }

        /* ============================================
           GLOBAL RESETS
           ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--cream);
            overflow-x: hidden;
        }

        /* ============================================
           KEYFRAME ANIMATIONS
           ============================================ */

        /* Steam rising animation for brand icon */
        @keyframes steamRise {
            0%   { opacity: 0; transform: translateY(0) scaleX(1); }
            15%  { opacity: 1; }
            50%  { opacity: 0.6; transform: translateY(-8px) scaleX(1.2); }
            100% { opacity: 0; transform: translateY(-18px) scaleX(0.8); }
        }

        /* Gentle cup wobble */
        @keyframes cupWobble {
            0%, 100% { transform: rotate(0deg); }
            25%      { transform: rotate(3deg); }
            75%      { transform: rotate(-3deg); }
        }

        /* Slide down entrance for navbar */
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }

        /* Fade-in up for bottom bar */
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }

        /* Soft pulse glow for cart badge */
        @keyframes badgePulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); box-shadow: 0 0 0 0 rgba(107, 79, 63, 0.5); }
            50%      { transform: translate(-50%, -50%) scale(1.15); box-shadow: 0 0 8px 4px rgba(107, 79, 63, 0.15); }
        }

        /* Shimmer sweep for search bar */
        @keyframes shimmerSweep {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        /* Bean spin for loading / hover flair */
        @keyframes beanSpin {
            0%   { transform: rotate(0deg) scale(1); }
            50%  { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }

        /* Drip animation for active link underline */
        @keyframes coffeeDrip {
            0%   { width: 0; opacity: 0; }
            60%  { width: 100%; opacity: 1; }
            100% { width: 100%; opacity: 1; }
        }

        /* Floating coffee beans background decoration */
        @keyframes floatBean1 {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.07; }
            50%      { transform: translateY(-12px) rotate(20deg); opacity: 0.13; }
        }
        @keyframes floatBean2 {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.05; }
            50%      { transform: translateY(-18px) rotate(-15deg); opacity: 0.1; }
        }

        /* Pour effect for signup button */
        @keyframes pourFill {
            0%   { background-position: 0 100%; }
            100% { background-position: 0 0; }
        }

        /* Gentle breathing glow */
        @keyframes breatheGlow {
            0%, 100% { box-shadow: 0 2px 12px rgba(107, 79, 63, 0.15); }
            50%      { box-shadow: 0 4px 24px rgba(107, 79, 63, 0.3); }
        }

        /* ============================================
           TOP NAVBAR — DARK COFFEE STYLE
           ============================================ */
        .dark-navbar {
            background: linear-gradient(135deg, var(--espresso) 0%, var(--brown-deeper) 50%, var(--brown-dark) 100%);
            border-bottom: 3px solid var(--latte);
            animation: slideDown 0.7s cubic-bezier(0.23, 1, 0.32, 1) forwards;
            position: relative;
            z-index: 1050;
        }

        /* Decorative floating beans inside navbar (pseudo-elements) */
        .dark-navbar::before,
        .dark-navbar::after {
            content: "☕";
            position: absolute;
            font-size: 1.2rem;
            pointer-events: none;
            opacity: 0.06;
        }
        .dark-navbar::before {
            top: 8px;
            right: 60px;
            animation: floatBean1 4s ease-in-out infinite;
        }
        .dark-navbar::after {
            bottom: 5px;
            right: 150px;
            animation: floatBean2 5s ease-in-out infinite 1s;
        }

        /* ============================================
           BRAND
           ============================================ */
        .navbar-brand {
            gap: 10px;
            color: var(--cream) !important;
            font-family: 'Georgia', serif;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--latte) !important;
            transform: scale(1.03);
        }

        /* Cup icon with steam effect */
        .navbar-brand .bi-cup-straw {
            font-size: 1.6rem;
            color: var(--latte);
            position: relative;
            animation: cupWobble 3s ease-in-out infinite;
            filter: drop-shadow(0 0 6px rgba(196, 168, 130, 0.4));
        }

        /* Steam particles via pseudo-elements on brand container */
        .navbar-brand::before,
        .navbar-brand::after {
            content: "";
            position: absolute;
            left: 12px;
            top: -2px;
            width: 4px;
            height: 10px;
            background: rgba(245, 240, 225, 0.35);
            border-radius: 50%;
            animation: steamRise 2s ease-out infinite;
        }
        .navbar-brand::before {
            left: 8px;
            animation-delay: 0s;
        }
        .navbar-brand::after {
            left: 16px;
            animation-delay: 0.7s;
            width: 3px;
            height: 8px;
        }

        /* ============================================
           TOGGLER (MOBILE)
           ============================================ */
        .navbar-toggler {
            color: var(--cream);
            padding: 6px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(196, 168, 130, 0.4);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23F5F0E1' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* ============================================
           NAV LINKS
           ============================================ */
        .top-nav-link {
            color: var(--cream) !important;
            font-weight: 500;
            font-size: 0.92rem;
            padding: 8px 14px !important;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            letter-spacing: 0.3px;
        }

        .top-nav-link i {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .top-nav-link:hover {
            color: var(--espresso) !important;
            background: var(--cream);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(245, 240, 225, 0.25);
        }

        .top-nav-link:hover i {
            transform: scale(1.2);
            color: var(--brown);
        }

        /* Coffee drip underline on hover */
        .top-nav-link::after {
            content: "";
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--latte);
            border-radius: 2px;
            transition: width 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .top-nav-link:hover::after {
            width: 60%;
        }

        /* Active link state */
        .active-link {
            background: rgba(245, 240, 225, 0.12) !important;
            color: var(--latte) !important;
            border-bottom: 2px solid var(--latte);
        }

        .active-link::after {
            animation: coffeeDrip 0.6s ease forwards;
            background: var(--latte);
            width: 60%;
        }

        /* ============================================
           LOGOUT BUTTON
           ============================================ */
        .btn-logout {
            background: transparent;
            border: 1.5px solid rgba(245, 240, 225, 0.3);
            color: var(--cream);
            font-weight: 500;
            font-size: 0.92rem;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.35s ease;
            letter-spacing: 0.3px;
        }

        .btn-logout::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(220, 53, 69, 0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-logout:hover::before {
            left: 100%;
        }

        .btn-logout:hover {
            background: rgba(220, 53, 69, 0.15);
            border-color: #dc3545;
            color: #ff8a8a;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
        }

        .btn-logout:hover i {
            animation: beanSpin 0.5s ease;
        }

        /* ============================================
           SIGNUP BUTTON — CREAM FILLED
           ============================================ */
        .signup-btn {
            background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 100%) !important;
            color: var(--brown-dark) !important;
            font-weight: 700 !important;
            font-size: 0.92rem;
            padding: 8px 22px !important;
            border-radius: 50px !important;
            border: 2px solid var(--latte) !important;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 2px 10px rgba(196, 168, 130, 0.3);
        }

        /* Coffee pour fill effect on hover */
        .signup-btn::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(to top, var(--brown) 0%, var(--brown-dark) 100%);
            transition: height 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            z-index: 0;
            border-radius: 50px;
        }

        .signup-btn:hover::before {
            height: 100%;
        }

        .signup-btn span,
        .signup-btn i {
            position: relative;
            z-index: 1;
        }

        .signup-btn:hover {
            color: var(--cream) !important;
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(107, 79, 63, 0.4);
            border-color: var(--brown) !important;
        }

        .signup-btn:hover i {
            animation: beanSpin 0.6s ease;
        }

        /* ============================================
           BOTTOM GLASS BAR — SEARCH + CART
           ============================================ */
        .bottom-glass-bar {
            background: linear-gradient(135deg,
                rgba(107, 79, 63, 0.92) 0%,
                rgba(90, 62, 48, 0.95) 50%,
                rgba(74, 50, 40, 0.92) 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 2px solid rgba(196, 168, 130, 0.3);
            animation: fadeInUp 0.6s cubic-bezier(0.23, 1, 0.32, 1) 0.3s both;
            position: relative;
            z-index: 1040;
            min-width: 250px; 
        }

        /* Subtle coffee ring decorations */
        .bottom-glass-bar::before {
            content: "";
            position: absolute;
            right: 10%;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border: 2px solid rgba(196, 168, 130, 0.06);
            border-radius: 50%;
            pointer-events: none;
            animation: breatheGlow 4s ease-in-out infinite;
            box-shadow: none;
        }

        /* ============================================
           SEARCH FORM
           ============================================ */
        .search-form {
            max-width: 600px;
            min-width: 250px; 
        }

        .search-form .input-group {
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.35s ease;
            border: 2px solid rgba(196, 168, 130, 0.2);
        }

        .search-form .input-group:focus-within {
            border-color: var(--latte);
            box-shadow: 0 4px 25px rgba(196, 168, 130, 0.3);
            transform: scale(1.01);
        }

        /* Glass input */
        .glass-input {
            background: rgba(245, 240, 225, 0.1) !important;
            border: none !important;
            color: var(--cream) !important;
            padding: 10px 20px !important;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }

        .glass-input::placeholder {
            color: rgba(245, 240, 225, 0.45) !important;
            font-style: italic;
        }

        .glass-input:focus {
            background: rgba(245, 240, 225, 0.15) !important;
            box-shadow: none !important;
            outline: none !important;
        }

        /* Shimmer placeholder animation */
        .glass-input:not(:focus)::placeholder {
            background: linear-gradient(
                90deg,
                rgba(245, 240, 225, 0.4) 0%,
                rgba(196, 168, 130, 0.7) 50%,
                rgba(245, 240, 225, 0.4) 100%
            );
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmerSweep 3s linear infinite;
        }

        /* Search button */
        .search-btn {
            background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 100%) !important;
            border: none !important;
            color: var(--brown-dark) !important;
            padding: 10px 18px !important;
            font-size: 1rem;
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .search-btn::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(107, 79, 63, 0.15);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s ease, height 0.5s ease;
        }

        .search-btn:hover::before {
            width: 200%;
            height: 200%;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, var(--latte) 0%, var(--cream) 100%) !important;
            transform: scale(1.05);
        }

        .search-btn:hover i {
            animation: beanSpin 0.5s ease;
        }

        .search-btn:active {
            transform: scale(0.96);
        }

        /* ============================================
           CART LINK
           ============================================ */
        .cart-link {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(245, 240, 225, 0.1);
            border: 2px solid rgba(196, 168, 130, 0.25);
            color: var(--cream);
            font-size: 1.3rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            flex-shrink: 0;
        }

        .cart-link:hover {
            background: var(--cream);
            color: var(--brown-dark);
            border-color: var(--cream);
            transform: translateY(-3px) scale(1.08);
            box-shadow: 0 6px 20px rgba(245, 240, 225, 0.3);
        }

        .cart-link:hover i {
            animation: cupWobble 0.5s ease;
        }

        /* Cart badge with pulse */
        .cart-badge {
            background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 100%) !important;
            color: var(--brown-dark) !important;
            font-weight: 700;
            font-size: 0.65rem;
            padding: 3px 6px;
            border: 2px solid var(--brown-dark);
            animation: badgePulse 2.5s ease-in-out infinite;
            box-shadow: 0 2px 8px rgba(107, 79, 63, 0.3);
        }

        /* ============================================
           RESPONSIVE TWEAKS
           ============================================ */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(59, 36, 23, 0.97);
                border-radius: 0 0 16px 16px;
                padding: 15px 20px;
                margin-top: 10px;
                border: 1px solid rgba(196, 168, 130, 0.15);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            }

            .bottom-glass-bar .search-form {
                flex: 1 1 75%; 
            }

            .top-nav-link {
                padding: 12px 16px !important;
                border-radius: 10px;
                margin-bottom: 4px;
            }

            .top-nav-link:hover {
                transform: translateX(6px);
            }

            .signup-btn {
                margin-top: 8px;
                display: block;
                padding: 12px 22px !important;
            }

            .btn-logout {
                margin-top: 4px;
                padding: 12px 16px;
                width: 100%;
            }

            .search-form {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand span {
                font-size: 0.95rem;
            }

            .cart-link {
                width: 40px;
                height: 40px;
                font-size: 1.15rem;
            }

            .glass-input {
                font-size: 0.82rem;
                padding: 8px 14px !important;
            }

            .search-btn {
                padding: 8px 14px !important;
            }
        }

        /* ============================================
           SCROLLBAR STYLE (BONUS THEME TOUCH)
           ============================================ */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--cream);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--brown);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--brown-dark);
        }

        /* ============================================
           DEMO CONTENT AREA (just for preview)
           ============================================ */
        .demo-content {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
            color: var(--brown);
            text-align: center;
            padding: 40px 20px;
        }
        .demo-content h1 {
            font-family: 'Georgia', serif;
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
        .demo-content p {
            color: var(--mocha);
            font-size: 1.1rem;
            max-width: 500px;
        }
        .demo-content .bi-cup-hot-fill {
            font-size: 4rem;
            color: var(--brown);
            animation: cupWobble 3s ease-in-out infinite;
            filter: drop-shadow(0 4px 12px rgba(107, 79, 63, 0.3));
        }
    </style>