<div class="login-container">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Background Grid -->
    <div class="grid-bg"></div>

    <!-- Glow Orb -->
    <div class="glow-orb"></div>

    <!-- Floating Coffee Bean Particles -->
    <div class="particles" id="particles"></div>

    <!-- Corner Decorations -->
    <div class="corner-decor top-left"></div>
    <div class="corner-decor bottom-right"></div>

    <!-- Coffee Drips -->
    <div class="coffee-drip" style="left: 15%; animation-delay: 0s;"></div>
    <div class="coffee-drip" style="left: 45%; animation-delay: 1.2s;"></div>
    <div class="coffee-drip" style="left: 75%; animation-delay: 2.4s;"></div>
    <div class="coffee-drip" style="left: 90%; animation-delay: 0.6s;"></div>

    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 d-flex justify-content-center">

                <div class="card login-card">

                    <!-- Latte Art Decoration -->
                    <div class="latte-art">
                        <div class="latte-swirl"></div>
                    </div>

                    <!-- Cup Ring Decoration -->
                    <div class="cup-ring"></div>

                    <!-- Steam Animation -->
                    <div class="steam-container">
                        <div class="steam"></div>
                        <div class="steam"></div>
                        <div class="steam"></div>
                    </div>

                    <!-- HEADER -->
                    <div class="card-header login-header text-center">
                        <span class="icon-coffee">
                            <span class="icon-steam"></span>
                            <span class="icon-steam"></span>
                            <span class="icon-steam"></span>
                            <i class="bi bi-cup-hot-fill"></i>
                        </span>

                        <div>Café Aroma</div>
                        <span class="brand-subtitle">Brewed with Passion</span>
                    </div>

                    <div class="card-body login-body">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- EMAIL -->
                            <div class="form-group-custom">
                                <label for="email" class="login-label pb-2">
                                    <i class="bi bi-envelope"></i>
                                    {{ __('Email Address') }}
                                </label>

                                <input id="email"
                                       type="email"
                                       class="form-control login-input @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="you@example.com"
                                       required
                                       autocomplete="email"
                                       autofocus>

                                <i class="bi bi-envelope input-icon"></i>

                                @error('email')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group-custom">
                                <label for="password" class="login-label">
                                    <i class="bi bi-shield-lock"></i>
                                    {{ __('Password') }}
                                </label>

                                <input id="password"
                                       type="password"
                                       class="form-control login-input @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="••••••••"
                                       required
                                       autocomplete="current-password">

                                <i class="bi bi-lock input-icon"></i>

                                <button type="button"
                                        class="password-toggle"
                                        id="togglePassword"
                                        aria-label="Toggle password visibility">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>

                                @error('password')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- REMEMBER -->
                            <div class="form-check custom-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="remember"
                                       id="remember"
                                       {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label login-remember" for="remember">
                                    <i class="bi bi-bookmark-heart"
                                       style="font-size:0.8rem;margin-right:2px;"></i>
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit" class="login-btn mt-3">
                                <i class="bi bi-cup-hot"></i>
                                <span>Login</span>
                                <i class="bi bi-arrow-repeat btn-spinner"></i>
                            </button>

                            @if (Route::has('password.request'))
                            <div class="text-end mt-2">
                                <a class="login-link" href="{{ route('password.request') }}">
                                    <i class="bi bi-key"></i>
                                    Forgot Password?
                                </a>
                            </div>
                            @endif

                        </form>

                        <div class="divider">
                            <i class="bi bi-diamond-fill"></i>
                            <span>OR</span>
                            <i class="bi bi-diamond-fill"></i>
                        </div>

                        <div class="text-center">
                            <span class="signup-text">Don't have an account?</span>
                            <br>
                            <a href="{{ route('register') }}" class="signup-btn">
                                <i class="bi bi-person-plus"></i>
                                Sign Up
                            </a>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="login-footer">
                        <span>
                            <i class="bi bi-cup-hot-fill"
                               style="font-size:0.6rem;"></i>
                            Café Aroma &copy; 2025
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ====== FLOATING COFFEE BEAN PARTICLES ======
    const particlesContainer = document.getElementById('particles');
    const beanIcons = ['bi-circle-fill']; // small dots resembling beans

    function createBean() {
        const bean = document.createElement('i');
        bean.className = `bi bi-circle-fill coffee-bean`;
        bean.style.left = Math.random() * 100 + '%';
        bean.style.fontSize = (Math.random() * 0.6 + 0.3) + 'rem';
        bean.style.animationDuration = (Math.random() * 8 + 8) + 's';
        bean.style.animationDelay = (Math.random() * 5) + 's';
        bean.style.color = `rgba(212, 184, 150, ${Math.random() * 0.2 + 0.05})`;
        particlesContainer.appendChild(bean);

        // Clean up after animation
        setTimeout(() => {
            bean.remove();
        }, 16000);
    }

    // Initial batch
    for (let i = 0; i < 20; i++) {
        createBean();
    }

    // Continuously create beans
    setInterval(createBean, 1500);

    // ====== PASSWORD TOGGLE ======
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.className = type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    }

    // ====== INPUT FOCUS RIPPLE EFFECT ======
    document.querySelectorAll('.login-input').forEach(input => {
        input.addEventListener('focus', function () {
            this.parentElement.style.transform = 'scale(1.01)';
            this.parentElement.style.transition = 'transform 0.3s ease';
        });
        input.addEventListener('blur', function () {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
</script>

<style>
        :root {
            --brown: #6B4F3F;
            --brown-dark: #4A3628;
            --brown-light: #8B6F5F;
            --cream: #F5F0E1;
            --cream-dark: #E8DFC8;
            --cream-light: #FAF7F0;
            --espresso: #2C1A0E;
            --latte: #D4B896;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            height: 100vh;
        }

        /* ==================== LOGIN CONTAINER ==================== */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--espresso) 0%, var(--brown-dark) 40%, var(--brown) 70%, var(--brown-light) 100%);
            position: relative;
            overflow: hidden;
        }

        /* ==================== COFFEE BEAN PATTERN BG ==================== */
        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(ellipse 8px 12px at 50% 50%, rgba(107, 79, 63, 0.15) 0%, transparent 70%),
                radial-gradient(ellipse 6px 10px at 30% 70%, rgba(107, 79, 63, 0.1) 0%, transparent 70%);
            background-size: 80px 80px, 120px 120px;
            background-position: 0 0, 40px 40px;
            animation: patternDrift 20s linear infinite;
            z-index: 0;
        }

        @keyframes patternDrift {
            0% { background-position: 0 0, 40px 40px; }
            100% { background-position: 80px 80px, 120px 120px; }
        }

        /* ==================== GLOW ORB (Warm Coffee Glow) ==================== */
        .glow-orb {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(212, 184, 150, 0.25) 0%, rgba(107, 79, 63, 0.1) 40%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: glowPulse 4s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes glowPulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.6; }
            50% { transform: translate(-50%, -50%) scale(1.15); opacity: 1; }
        }

        /* ==================== FLOATING COFFEE BEANS ==================== */
        .particles {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .coffee-bean {
            position: absolute;
            font-size: 1rem;
            color: rgba(212, 184, 150, 0.3);
            animation: floatBean linear infinite;
            will-change: transform;
        }

        @keyframes floatBean {
            0% {
                transform: translateY(110vh) rotate(0deg) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) rotate(720deg) scale(0.5);
                opacity: 0;
            }
        }

        /* ==================== STEAM ANIMATION ==================== */
        .steam-container {
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 80px;
            z-index: 1;
            pointer-events: none;
        }

        .steam {
            position: absolute;
            bottom: 0;
            width: 8px;
            height: 30px;
            background: rgba(245, 240, 225, 0.15);
            border-radius: 50%;
            filter: blur(5px);
            animation: steamRise 2.5s ease-out infinite;
        }

        .steam:nth-child(1) { left: 20px; animation-delay: 0s; }
        .steam:nth-child(2) { left: 36px; animation-delay: 0.5s; }
        .steam:nth-child(3) { left: 52px; animation-delay: 1s; }

        @keyframes steamRise {
            0% {
                transform: translateY(0) scaleX(1) scaleY(1);
                opacity: 0.6;
            }
            50% {
                transform: translateY(-30px) scaleX(1.8) scaleY(1.5);
                opacity: 0.3;
            }
            100% {
                transform: translateY(-70px) scaleX(2.5) scaleY(2);
                opacity: 0;
            }
        }

        /* ==================== COFFEE CUP RING (Decorative) ==================== */
        .cup-ring {
            position: absolute;
            bottom: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            border: 3px solid rgba(212, 184, 150, 0.08);
            border-radius: 50%;
            animation: ringRotate 15s linear infinite;
            pointer-events: none;
        }

        .cup-ring::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 2px dashed rgba(212, 184, 150, 0.05);
            border-radius: 50%;
        }

        @keyframes ringRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* ==================== CORNER DECORATIONS ==================== */
        .corner-decor {
            position: absolute;
            width: 120px;
            height: 120px;
            pointer-events: none;
            z-index: 0;
        }

        .corner-decor.top-left {
            top: 20px;
            left: 20px;
            border-top: 2px solid rgba(212, 184, 150, 0.15);
            border-left: 2px solid rgba(212, 184, 150, 0.15);
            border-radius: 8px 0 0 0;
        }

        .corner-decor.bottom-right {
            bottom: 20px;
            right: 20px;
            border-bottom: 2px solid rgba(212, 184, 150, 0.15);
            border-right: 2px solid rgba(212, 184, 150, 0.15);
            border-radius: 0 0 8px 0;
        }

        /* ==================== LOGIN CARD ==================== */
        .login-card {
            background: rgba(44, 26, 14, 0.65);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(212, 184, 150, 0.15);
            border-radius: 20px;
            width: 100%;
            max-width: 440px;
            overflow: visible;
            position: relative;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.4),
                0 0 40px rgba(107, 79, 63, 0.15),
                inset 0 1px 0 rgba(245, 240, 225, 0.05);
            animation: cardEntry 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes cardEntry {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 30px;
            right: 30px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--latte), transparent);
            opacity: 0.4;
            border-radius: 2px;
        }

        /* ==================== CARD HEADER ==================== */
        .login-header {
            background: transparent;
            border-bottom: 1px solid rgba(212, 184, 150, 0.1);
            padding: 35px 30px 25px;
            position: relative;
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--cream);
            letter-spacing: 0.5px;
        }

        .brand-subtitle {
            display: block;
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem;
            font-weight: 300;
            color: var(--latte);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .icon-coffee {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brown), var(--brown-dark));
            border: 2px solid rgba(212, 184, 150, 0.25);
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(107, 79, 63, 0.4);
            position: relative;
        }

        .icon-coffee i {
            font-size: 1.4rem;
            color: var(--cream);
        }

        /* Mini steam on icon */
        .icon-steam {
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 10px;
            background: rgba(245, 240, 225, 0.4);
            border-radius: 50%;
            filter: blur(2px);
            animation: miniSteam 1.8s ease-out infinite;
        }

        .icon-steam:nth-child(2) { left: 40%; animation-delay: 0.4s; }
        .icon-steam:nth-child(3) { left: 60%; animation-delay: 0.8s; }

        @keyframes miniSteam {
            0% { transform: translateX(-50%) translateY(0); opacity: 0.6; }
            100% { transform: translateX(-50%) translateY(-14px); opacity: 0; }
        }

        /* ==================== CARD BODY ==================== */
        .login-body {
            padding: 30px 30px 35px;
        }

        /* ==================== FORM ELEMENTS ==================== */
        .form-group-custom {
            margin-bottom: 20px;
            position: relative;
        }

        .login-label {
            color: var(--latte);
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
        }

        .login-label i {
            font-size: 0.85rem;
            color: var(--brown-light);
        }

        .login-input {
            background: rgba(44, 26, 14, 0.5);
            border: 1.5px solid rgba(212, 184, 150, 0.15);
            border-radius: 12px;
            color: var(--cream);
            padding: 13px 16px 13px 44px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            width: 100%;
        }

        .login-input::placeholder {
            color: rgba(212, 184, 150, 0.35);
        }

        .login-input:focus {
            outline: none;
            border-color: var(--latte);
            background: rgba(44, 26, 14, 0.7);
            box-shadow: 0 0 0 3px rgba(212, 184, 150, 0.1), 0 0 20px rgba(107, 79, 63, 0.2);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            bottom: 15px;
            color: var(--brown-light);
            font-size: 1rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .login-input:focus ~ .input-icon,
        .form-group-custom:focus-within .input-icon {
            color: var(--latte);
        }

        .invalid-feedback {
            color: #E8A87C;
            font-size: 0.78rem;
            margin-top: 6px;
        }

        /* ==================== PASSWORD TOGGLE ==================== */
        .password-toggle {
            position: absolute;
            right: 15px;
            bottom: 13px;
            background: none;
            border: none;
            color: var(--brown-light);
            cursor: pointer;
            font-size: 1rem;
            padding: 2px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--latte);
        }

        /* ==================== CHECKBOX ==================== */
        .custom-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 18px 0;
        }

        .custom-check .form-check-input {
            width: 18px;
            height: 18px;
            border: 1.5px solid rgba(212, 184, 150, 0.3);
            border-radius: 5px;
            background: rgba(44, 26, 14, 0.4);
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0;
        }

        .custom-check .form-check-input:checked {
            background: var(--brown);
            border-color: var(--latte);
        }

        .custom-check .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(212, 184, 150, 0.15);
        }

        .login-remember {
            color: var(--latte);
            font-size: 0.85rem;
            cursor: pointer;
            user-select: none;
        }

        /* ==================== LOGIN BUTTON ==================== */
        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--brown), var(--brown-dark));
            color: var(--cream);
            border: 1.5px solid rgba(212, 184, 150, 0.2);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(245, 240, 225, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, var(--brown-light), var(--brown));
            border-color: var(--latte);
            box-shadow: 0 8px 25px rgba(107, 79, 63, 0.4), 0 0 20px rgba(212, 184, 150, 0.1);
            transform: translateY(-2px);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Coffee bean spinner for loading state */
        .login-btn .btn-spinner {
            display: none;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* ==================== FORGOT PASSWORD LINK ==================== */
        .login-link {
            color: var(--latte);
            font-size: 0.82rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 12px;
        }

        .login-link:hover {
            color: var(--cream);
            text-decoration: underline;
        }

        /* ==================== DIVIDER ==================== */
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            gap: 15px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 184, 150, 0.2), transparent);
        }

        .divider span {
            color: rgba(212, 184, 150, 0.4);
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .divider i {
            color: rgba(212, 184, 150, 0.3);
            font-size: 0.7rem;
        }

        /* ==================== SIGN UP SECTION ==================== */
        .signup-text {
            color: rgba(212, 184, 150, 0.5);
            font-size: 0.85rem;
        }

        .signup-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--cream);
            background: rgba(107, 79, 63, 0.3);
            border: 1.5px solid rgba(212, 184, 150, 0.15);
            padding: 8px 22px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .signup-btn:hover {
            background: rgba(107, 79, 63, 0.5);
            border-color: var(--latte);
            color: var(--cream);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(107, 79, 63, 0.3);
        }

        /* ==================== FOOTER BRANDING ==================== */
        .login-footer {
            text-align: center;
            padding: 0 30px 20px;
        }

        .login-footer span {
            color: rgba(212, 184, 150, 0.25);
            font-size: 0.7rem;
            letter-spacing: 1px;
        }

        /* ==================== SWIRL LATTE ART ANIMATION ==================== */
        .latte-art {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 60px;
            height: 60px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.06;
        }

        .latte-swirl {
            width: 100%;
            height: 100%;
            border: 2px solid var(--cream);
            border-radius: 50%;
            position: relative;
            animation: swirlRotate 8s linear infinite;
        }

        .latte-swirl::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1.5px solid var(--cream);
            border-radius: 50%;
        }

        .latte-swirl::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 1px solid var(--cream);
            border-radius: 50%;
        }

        @keyframes swirlRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* ==================== DRIP ANIMATION ==================== */
        .coffee-drip {
            position: absolute;
            top: 0;
            width: 3px;
            background: linear-gradient(to bottom, transparent, rgba(139, 111, 79, 0.4), transparent);
            border-radius: 50%;
            animation: dripFall 3s ease-in infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes dripFall {
            0% { height: 0; opacity: 0; top: 0; }
            30% { height: 40px; opacity: 0.6; }
            100% { height: 0; opacity: 0; top: 100%; }
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 576px) {
            .login-card {
                max-width: 95%;
                border-radius: 16px;
            }

            .login-header {
                padding: 28px 20px 20px;
                font-size: 1.5rem;
            }

            .login-body {
                padding: 24px 20px 28px;
            }

            .icon-coffee {
                width: 44px;
                height: 44px;
            }

            .icon-coffee i {
                font-size: 1.2rem;
            }

            .glow-orb {
                width: 300px;
                height: 300px;
            }

            .corner-decor {
                width: 60px;
                height: 60px;
            }
        }

        /* ==================== SCROLLBAR ==================== */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--espresso); }
        ::-webkit-scrollbar-thumb {
            background: var(--brown);
            border-radius: 4px;
        }
    </style>