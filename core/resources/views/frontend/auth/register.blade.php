<div class="login-container">

    <!-- Background Coffee Rings -->
    <div class="coffee-ring coffee-ring-1"></div>
    <div class="coffee-ring coffee-ring-2"></div>
    <div class="coffee-ring coffee-ring-3"></div>

    <!-- Swirl Background -->
    <div class="swirl-bg">
        <svg viewBox="0 0 200 200">
            <path fill="none" stroke="#6B4F3F" stroke-width="0.3" opacity="0.06"
                d="M100,10 C140,10 190,60 190,100 C190,140 140,190 100,190 C60,190 10,140 10,100"/>
        </svg>
    </div>

    <!-- Particles -->
    <div class="particles" id="particles"></div>

    <!-- ===== MAIN CARD ===== -->
    <div class="login-wrapper">
        <div class="card login-card">

            <!-- Header -->
            <div class="card-header login-header">

                <div class="header-icon">
                    <i class="bi bi-cup-hot-fill"></i>
                </div>

                Café Aroma

                <div class="bean-separator">
                    <div class="line"></div>
                    <i class="bi bi-circle-fill"></i>
                    <i class="bi bi-diamond-fill"></i>
                    <i class="bi bi-circle-fill"></i>
                    <div class="line"></div>
                </div>

                <span class="brand-tagline">Create Your Account</span>

            </div>

            <!-- Body -->
            <div class="card-body login-body">

                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <!-- Name -->
                    <div class="input-group-animated">
                        <label for="name" class="login-label">
                            <i class="bi bi-person"></i> Name
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-person-fill"></i>

                            <input id="name"
                                   type="text"
                                   class="form-control login-input @error('name') is-invalid @enderror"
                                   name="name"
                                   placeholder="Enter your name"
                                   required
                                   autofocus
                                   autocomplete="name">
                        </div>

                        @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <!-- Email -->
                    <div class="input-group-animated">
                        <label for="email" class="login-label">
                            <i class="bi bi-envelope"></i> Email Address
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-envelope-fill"></i>

                            <input id="email"
                                   type="email"
                                   class="form-control login-input @error('email') is-invalid @enderror"
                                   name="email"
                                   placeholder="you@example.com"
                                   required
                                   autocomplete="email">
                        </div>

                        @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <!-- Password -->
                    <div class="input-group-animated">
                        <label for="password" class="login-label">
                            <i class="bi bi-shield-lock"></i> Password
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-lock-fill"></i>

                            <input id="password"
                                   type="password"
                                   class="form-control login-input @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="••••••••"
                                   required
                                   autocomplete="new-password">

                            <button type="button" class="password-toggle"
                                    onclick="togglePassword('password', this)">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>

                        @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <!-- Confirm Password -->
                    <div class="input-group-animated">
                        <label for="password-confirm" class="login-label">
                            <i class="bi bi-shield-check"></i> Confirm Password
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-lock-fill"></i>

                            <input id="password-confirm"
                                   type="password"
                                   class="form-control login-input"
                                   name="password_confirmation"
                                   placeholder="••••••••"
                                   required
                                   autocomplete="new-password">

                            <button type="button" class="password-toggle"
                                    onclick="togglePassword('password-confirm', this)">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>


                    <!-- Divider -->
                    <div class="divider">
                        <span>
                            <i class="bi bi-cup-hot" style="font-size:10px;"></i>
                            Brew Your Journey
                            <i class="bi bi-cup-hot" style="font-size:10px;"></i>
                        </span>
                    </div>


                    <!-- Button -->
                    <div class="input-group-animated mt-3 d-flex flex-column gap-3">

                        <button type="submit" class="btn login-btn">
                            <i class="bi bi-person-plus-fill"></i>
                            Register
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="login-link">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Already have an account? Login
                            </a>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            field.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ===== ROOT & RESET ===== */
        :root {
            --brown: #6B4F3F;
            --brown-dark: #5A3E2F;
            --brown-light: #8B6F5F;
            --cream: #F5F0E1;
            --cream-dark: #E8DFC8;
            --cream-light: #FAF8F0;
            --espresso: #3C2415;
            --latte: #D4A574;
            --mocha: #967259;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ===== BODY ===== */
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== LOGIN CONTAINER ===== */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 50%, #D9C9A8 100%);
            padding: 20px;
        }

        /* ===== PARTICLE / COFFEE BEANS BACKGROUND ===== */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        /* Coffee bean particles */
        .coffee-bean {
            position: absolute;
            font-size: 20px;
            color: var(--brown);
            opacity: 0;
            animation: floatBean linear infinite;
        }

        @keyframes floatBean {
            0% {
                opacity: 0;
                transform: translateY(100vh) rotate(0deg) scale(0.5);
            }
            10% {
                opacity: 0.15;
            }
            90% {
                opacity: 0.15;
            }
            100% {
                opacity: 0;
                transform: translateY(-10vh) rotate(720deg) scale(1);
            }
        }

        /* Steam particles */
        .steam-particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: var(--brown-light);
            border-radius: 50%;
            opacity: 0;
            filter: blur(3px);
            animation: steamRise ease-in-out infinite;
        }

        @keyframes steamRise {
            0% {
                opacity: 0;
                transform: translateY(0) translateX(0) scale(0.5);
            }
            30% {
                opacity: 0.12;
            }
            70% {
                opacity: 0.08;
            }
            100% {
                opacity: 0;
                transform: translateY(-200px) translateX(30px) scale(2);
            }
        }

        /* ===== COFFEE CUP DECORATION ===== */
        .coffee-cup-deco {
            position: fixed;
            bottom: -60px;
            right: -40px;
            width: 250px;
            height: 250px;
            opacity: 0.06;
            z-index: 0;
            animation: gentleFloat 6s ease-in-out infinite;
        }

        .coffee-cup-deco-left {
            position: fixed;
            top: -30px;
            left: -40px;
            width: 200px;
            height: 200px;
            opacity: 0.05;
            z-index: 0;
            animation: gentleFloat 8s ease-in-out infinite reverse;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }

        /* ===== COFFEE RING STAIN ===== */
        .coffee-ring {
            position: fixed;
            border-radius: 50%;
            border: 3px solid var(--brown);
            opacity: 0.04;
            z-index: 0;
        }

        .coffee-ring-1 {
            width: 180px;
            height: 180px;
            top: 10%;
            right: 15%;
            animation: ringPulse 8s ease-in-out infinite;
        }

        .coffee-ring-2 {
            width: 120px;
            height: 120px;
            bottom: 20%;
            left: 10%;
            animation: ringPulse 10s ease-in-out infinite 2s;
        }

        .coffee-ring-3 {
            width: 90px;
            height: 90px;
            top: 60%;
            right: 8%;
            animation: ringPulse 7s ease-in-out infinite 4s;
        }

        @keyframes ringPulse {
            0%, 100% { transform: scale(1); opacity: 0.04; }
            50% { transform: scale(1.1); opacity: 0.08; }
        }

        /* ===== DRIP ANIMATION ===== */
        .coffee-drip {
            position: fixed;
            top: 0;
            width: 3px;
            background: linear-gradient(to bottom, transparent, var(--brown), transparent);
            opacity: 0;
            z-index: 0;
            border-radius: 0 0 3px 3px;
            animation: drip ease-in infinite;
        }

        @keyframes drip {
            0% {
                opacity: 0;
                height: 0;
                top: -20px;
            }
            20% {
                opacity: 0.1;
                height: 40px;
            }
            80% {
                opacity: 0.1;
            }
            100% {
                opacity: 0;
                top: 110vh;
                height: 40px;
            }
        }

        /* ===== LOGIN WRAPPER ===== */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            animation: cardEntrance 1s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
            opacity: 0;
        }

        @keyframes cardEntrance {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ===== CARD ===== */
        .card {
            border: none;
            border-radius: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow:
                0 20px 60px rgba(107, 79, 63, 0.15),
                0 8px 20px rgba(107, 79, 63, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            overflow: hidden;
            position: relative;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .login-card:hover {
            transform: translateY(-4px);
            box-shadow:
                0 28px 70px rgba(107, 79, 63, 0.2),
                0 12px 28px rgba(107, 79, 63, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        /* Card top accent bar */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--latte), var(--brown), var(--espresso), var(--brown), var(--latte));
            background-size: 200% 100%;
            animation: shimmerBar 4s ease-in-out infinite;
        }

        @keyframes shimmerBar {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* ===== CARD HEADER ===== */
        .card-header {
            border-bottom: none;
            background: none;
        }

        .login-header {
            text-align: center;
            padding: 40px 40px 10px;
            background: transparent;
            color: var(--brown);
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        /* ===== HEADER ICON (Coffee Cup) ===== */
        .header-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--brown) 0%, var(--brown-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                0 8px 24px rgba(107, 79, 63, 0.3),
                0 0 0 6px rgba(107, 79, 63, 0.08);
            position: relative;
            animation: iconBreath 3s ease-in-out infinite;
        }

        .header-icon::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px dashed var(--latte);
            opacity: 0.4;
            animation: rotateDash 20s linear infinite;
        }

        @keyframes rotateDash {
            to { transform: rotate(360deg); }
        }

        @keyframes iconBreath {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .header-icon i {
            font-size: 30px;
            color: var(--cream);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        /* Steam from header icon */
        .header-icon .steam {
            position: absolute;
            top: -8px;
            display: flex;
            gap: 4px;
        }

        .header-icon .steam span {
            display: block;
            width: 3px;
            height: 12px;
            background: var(--brown-light);
            border-radius: 3px;
            opacity: 0.4;
            animation: steamWave 2s ease-in-out infinite;
        }

        .header-icon .steam span:nth-child(1) { animation-delay: 0s; height: 10px; }
        .header-icon .steam span:nth-child(2) { animation-delay: 0.3s; height: 14px; }
        .header-icon .steam span:nth-child(3) { animation-delay: 0.6s; height: 10px; }

        @keyframes steamWave {
            0%, 100% {
                transform: translateY(0) scaleY(1);
                opacity: 0.4;
            }
            50% {
                transform: translateY(-6px) scaleY(1.3);
                opacity: 0.15;
            }
        }

        /* Brand text under header */
        .brand-tagline {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--mocha);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: -6px;
        }

        /* ===== CARD BODY ===== */
        .card-body {
            padding: 0;
        }

        .login-body {
            padding: 20px 40px 40px;
        }

        /* ===== INPUT GROUPS ===== */
        .input-group-animated {
            position: relative;
            margin-bottom: 2px;
            animation: inputSlideIn 0.6s ease forwards;
            opacity: 0;
        }

        .input-group-animated:nth-child(1) { animation-delay: 0.2s; }
        .input-group-animated:nth-child(2) { animation-delay: 0.35s; }
        .input-group-animated:nth-child(3) { animation-delay: 0.5s; }
        .input-group-animated:nth-child(4) { animation-delay: 0.65s; }
        .input-group-animated:nth-child(5) { animation-delay: 0.8s; }

        @keyframes inputSlideIn {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ===== LABELS ===== */
        .login-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--brown);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .login-label i {
            font-size: 15px;
            color: var(--mocha);
        }

        /* ===== INPUTS ===== */
        .form-control {
            display: block;
            width: 100%;
            font-size: 15px;
            line-height: 1.5;
        }

        .login-input {
            background: var(--cream-light);
            border: 2px solid transparent;
            border-radius: 14px;
            padding: 14px 18px 14px 48px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: var(--espresso);
            transition: all 0.35s cubic-bezier(0.22, 0.61, 0.36, 1);
            outline: none;
            position: relative;
        }

        .login-input::placeholder {
            color: var(--mocha);
            opacity: 0.5;
        }

        .login-input:focus {
            background: #fff;
            border-color: var(--brown);
            box-shadow: 0 0 0 4px rgba(107, 79, 63, 0.1), 0 4px 12px rgba(107, 79, 63, 0.08);
            transform: translateY(-1px);
        }

        .login-input:hover:not(:focus) {
            border-color: var(--cream-dark);
            background: #fff;
        }

        /* Input icon wrapper */
        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            color: var(--mocha);
            transition: color 0.3s ease;
            z-index: 2;
        }

        .input-icon-wrap:focus-within i {
            color: var(--brown);
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--mocha);
            cursor: pointer;
            font-size: 17px;
            padding: 4px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--brown);
        }

        /* ===== VALIDATION ===== */
        .is-invalid {
            border-color: #C0392B !important;
        }

        .invalid-feedback {
            display: none;
            font-size: 12px;
            color: #C0392B;
            margin-top: 6px;
            padding-left: 4px;
        }

        .is-invalid ~ .invalid-feedback,
        .is-invalid + .invalid-feedback {
            display: block;
        }

        .invalid-feedback strong {
            font-weight: 500;
        }

        /* ===== BUTTON ===== */
        .btn {
            display: inline-block;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
        }

        .login-btn {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, var(--brown) 0%, var(--brown-dark) 100%);
            color: var(--cream);
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
            box-shadow: 0 6px 20px rgba(107, 79, 63, 0.3);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(245, 240, 225, 0.15), transparent);
            transition: left 0.6s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(107, 79, 63, 0.4);
            background: linear-gradient(135deg, var(--brown-dark) 0%, var(--espresso) 100%);
        }

        .login-btn:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 79, 63, 0.3);
        }

        .login-btn i {
            margin-right: 8px;
            font-size: 16px;
        }

        /* ===== LINK ===== */
        .login-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--brown);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 4px 0;
        }

        .login-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--brown);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 1px;
        }

        .login-link:hover::after {
            width: 100%;
        }

        .login-link:hover {
            color: var(--brown-dark);
        }

        .login-link i {
            font-size: 15px;
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--cream-dark), transparent);
        }

        .divider span {
            font-size: 12px;
            color: var(--mocha);
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        /* ===== FLEX HELPERS ===== */
        .d-flex { display: flex; }
        .flex-column { flex-direction: column; }
        .gap-3 { gap: 16px; }
        .mt-3 { margin-top: 16px; }
        .text-center { text-align: center; }

        /* ===== LATTE ART DECORATION ===== */
        .latte-art {
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 40px;
            opacity: 0.06;
        }

        .latte-art svg {
            width: 100%;
            height: 100%;
        }

        /* ===== COFFEE BEAN SEPARATOR ===== */
        .bean-separator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 8px 0 16px;
            opacity: 0.3;
        }

        .bean-separator i {
            font-size: 8px;
            color: var(--brown);
        }

        .bean-separator .line {
            width: 30px;
            height: 1px;
            background: var(--brown);
        }

        /* ===== CORNER DECORATIONS ===== */
        .corner-deco {
            position: absolute;
            width: 40px;
            height: 40px;
            opacity: 0.1;
        }

        .corner-deco.top-left {
            top: 16px;
            left: 16px;
            border-top: 2px solid var(--brown);
            border-left: 2px solid var(--brown);
            border-radius: 8px 0 0 0;
        }

        .corner-deco.top-right {
            top: 16px;
            right: 16px;
            border-top: 2px solid var(--brown);
            border-right: 2px solid var(--brown);
            border-radius: 0 8px 0 0;
        }

        .corner-deco.bottom-left {
            bottom: 16px;
            left: 16px;
            border-bottom: 2px solid var(--brown);
            border-left: 2px solid var(--brown);
            border-radius: 0 0 0 8px;
        }

        .corner-deco.bottom-right {
            bottom: 16px;
            right: 16px;
            border-bottom: 2px solid var(--brown);
            border-right: 2px solid var(--brown);
            border-radius: 0 0 8px 0;
        }

        /* ===== FLOATING COFFEE ICONS (background) ===== */
        .floating-icons {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .floating-icons i {
            position: absolute;
            color: var(--brown);
            opacity: 0.04;
            animation: floatIcon linear infinite;
        }

        @keyframes floatIcon {
            0% {
                transform: translateY(110vh) rotate(0deg);
                opacity: 0;
            }
            10% { opacity: 0.04; }
            90% { opacity: 0.04; }
            100% {
                transform: translateY(-10vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ===== POUR OVER ANIMATION ===== */
        .pour-animation {
            position: fixed;
            top: 0;
            left: 50%;
            width: 2px;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .pour-animation::after {
            content: '';
            position: absolute;
            top: -100%;
            left: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(to bottom, transparent, var(--latte), transparent);
            opacity: 0.08;
            animation: pourDown 8s linear infinite;
        }

        @keyframes pourDown {
            0% { top: -10%; }
            100% { top: 110%; }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 520px) {
            .login-header {
                padding: 30px 24px 8px;
                font-size: 24px;
            }

            .login-body {
                padding: 16px 24px 32px;
            }

            .login-input {
                padding: 12px 16px 12px 44px;
                font-size: 13px;
            }

            .header-icon {
                width: 60px;
                height: 60px;
            }

            .header-icon i {
                font-size: 24px;
            }

            .login-btn {
                padding: 14px 20px;
                font-size: 14px;
            }
        }

        /* ===== LOADING SHIMMER ON CARD ===== */
        .login-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                105deg,
                transparent 40%,
                rgba(245, 240, 225, 0.3) 45%,
                rgba(245, 240, 225, 0.5) 50%,
                rgba(245, 240, 225, 0.3) 55%,
                transparent 60%
            );
            background-size: 200% 100%;
            animation: cardShimmer 6s ease-in-out infinite;
            pointer-events: none;
            border-radius: 24px;
        }

        @keyframes cardShimmer {
            0%, 100% { background-position: 200% 0; }
            50% { background-position: -200% 0; }
        }

        /* ===== FOCUS RIPPLE ===== */
        .input-icon-wrap::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 16px;
            width: 0;
            height: 0;
            background: rgba(107, 79, 63, 0.05);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
            z-index: 0;
        }

        .input-icon-wrap:focus-within::after {
            width: 280px;
            height: 280px;
        }

        /* ===== SWIRL BACKGROUND ===== */
        .swirl-bg {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 600px;
            height: 600px;
            transform: translate(-50%, -50%);
            z-index: 0;
            pointer-events: none;
        }

        .swirl-bg svg {
            width: 100%;
            height: 100%;
            animation: swirlRotate 40s linear infinite;
        }

        @keyframes swirlRotate {
            to { transform: rotate(360deg); }
        }
    </style>