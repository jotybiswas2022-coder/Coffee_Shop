@extends('frontend.app')

@section('content')

@if(session('success'))
<div class="alert-success-custom">
    {{ session('success') }}
</div>
@endif

<div class="cafe-wrapper">

    <!-- Floating Coffee Beans Background -->
    <div class="coffee-beans-bg">
        <div class="coffee-bean"><i class="bi bi-cup-hot-fill"></i></div>
        <div class="coffee-bean"><i class="bi bi-stars"></i></div>
        <div class="coffee-bean"><i class="bi bi-cup-hot-fill"></i></div>
        <div class="coffee-bean"><i class="bi bi-star-fill"></i></div>
        <div class="coffee-bean"><i class="bi bi-cup-hot-fill"></i></div>
        <div class="coffee-bean"><i class="bi bi-stars"></i></div>
        <div class="coffee-bean"><i class="bi bi-cup-hot-fill"></i></div>
        <div class="coffee-bean"><i class="bi bi-star-fill"></i></div>
        <div class="coffee-bean"><i class="bi bi-cup-hot-fill"></i></div>
        <div class="coffee-bean"><i class="bi bi-stars"></i></div>
    </div>

    <!-- ================= HERO SLIDER ================= -->
    <section class="hero-slider">

        @if($slider && ($slider->slider1 || $slider->slider2))

            @if($slider->slider1)
            <div class="slide active">
                <img src="{{ config('app.storage_url') }}{{ $slider->slider1 }}" alt="Café Aroma Slide">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <span class="badge-tag">
                        <i class="bi bi-cup-hot-fill"></i> Artisan Coffee
                    </span>
                    <h1>Welcome to <span>Café Aroma</span></h1>
                    <p>Handcrafted coffee brewed with passion. Every cup tells a story of flavor and warmth.</p>
                    <div class="slide-btns">
                        <a href="#products" class="btn-primary-custom">
                            View Menu <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="steam-container">
                        <div class="steam"></div>
                        <div class="steam"></div>
                        <div class="steam"></div>
                    </div>
                </div>
            </div>
            @endif

            @if($slider->slider2)
            <div class="slide {{ !$slider->slider1 ? 'active' : '' }}">
                <img src="{{ config('app.storage_url') }}{{ $slider->slider2 }}" alt="Café Aroma Slide">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <span class="badge-tag">
                        <i class="bi bi-stars"></i> Freshly Roasted
                    </span>
                    <h1>Discover Our <span>Signature Blends</span></h1>
                    <p>From single-origin beans to house specials — taste the difference quality makes.</p>
                    <div class="slide-btns">
                        <a href="#products" class="btn-primary-custom">
                            Explore Blends <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

        @endif

        <div class="hero-coffee-cup">
            <i class="bi bi-cup-hot-fill"></i>
            <div class="steam-container">
                <div class="steam"></div>
                <div class="steam"></div>
                <div class="steam"></div>
            </div>
        </div>

        <div class="slider-dots">
            <div class="slider-dot active" data-index="0"></div>
            <div class="slider-dot" data-index="1"></div>
        </div>

        <div class="scroll-indicator">
            <div class="scroll-mouse"></div>
            <span>Scroll</span>
        </div>

    </section>

    <!-- Coffee Drip Divider -->
    <div class="coffee-divider">
        <div class="coffee-drip"></div>
        <div class="coffee-drip"></div>
        <div class="coffee-drip"></div>
        <div class="coffee-drip"></div>
        <div class="coffee-drip"></div>
        <div class="coffee-drip"></div>
        <div class="coffee-drip"></div>
    </div>

    <!-- ================= MENU / CATEGORIES SECTION ================= -->
    <section class="category-section py-5" id="products">
        <div class="container" style="position: relative;">

            <div class="coffee-ring coffee-ring-1"></div>
            <div class="coffee-ring coffee-ring-2"></div>
            <div class="coffee-ring coffee-ring-3"></div>

            <div class="pour-line"></div>
            <h2 class="section-title text-center mb-3" style="display: block;">Browse Our Menu</h2>
            <p class="section-subtitle text-center">Explore our handcrafted selection of drinks and treats, made with love and the finest ingredients.</p>

            <div class="latte-art-loader">
                <div class="latte-swirl"></div>
            </div>

            <!-- CENTERED MENU GRID -->
            <div class="menu-grid d-flex flex-wrap justify-content-center gap-4 mt-4">
                @foreach($categories as $category)
                <div class="menu-card-wrapper reveal-on-scroll">
                    <a href="{{ url('category/'.$category->id) }}" class="category-box d-block">
                        <h5>{{ $category->name }}</h5>
                        <span class="menu-desc">{{ $category->description ?? 'Delicious items' }}</span>
                        <div class="menu-arrow mt-2">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </section>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ===== HERO SLIDER =====
    const slides = document.querySelectorAll(".hero-slider .slide");
    const dots = document.querySelectorAll(".slider-dot");

    if (!slides.length) return;

    let current = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });
    }

    function nextSlide() {
        current = (current + 1) % slides.length;
        showSlide(current);
    }

    // Dot click navigation
    dots.forEach(dot => {
        dot.addEventListener("click", function() {
            current = parseInt(this.dataset.index);
            showSlide(current);
        });
    });

    // First show
    showSlide(current);

    // Auto change every 5 seconds
    setInterval(nextSlide, 5000);

    // ===== SCROLL REVEAL =====
    const revealElements = document.querySelectorAll('.reveal-on-scroll');

    function checkReveal() {
        revealElements.forEach(el => {
            const rect = el.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            if (rect.top < windowHeight - 80) {
                el.classList.add('revealed');
            }
        });
    }

    window.addEventListener('scroll', checkReveal);
    checkReveal(); // initial check

    // ===== HIDE LATTE LOADER AFTER A MOMENT =====
    const loader = document.querySelector('.latte-art-loader');
    if (loader) {
        setTimeout(() => {
            loader.style.transition = 'opacity 0.5s ease';
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.display = 'none'; }, 500);
        }, 2500);
    }

    // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ===== PARALLAX EFFECT REMOVED (slider stays fixed on scroll) =====

    // ===== CURSOR COFFEE TRAIL (SUBTLE) =====
    let trailTimeout;
    document.querySelector('.cafe-wrapper').addEventListener('mousemove', function(e) {
        if (trailTimeout) return;
        trailTimeout = setTimeout(() => { trailTimeout = null; }, 120);

        const trail = document.createElement('div');
        trail.style.cssText = 'position:fixed;pointer-events:none;z-index:9999;width:6px;height:6px;border-radius:50%;background:rgba(107,79,63,0.15);left:' + e.clientX + 'px;top:' + e.clientY + 'px;transition:all 0.8s ease;';
        document.body.appendChild(trail);

        requestAnimationFrame(() => {
            trail.style.transform = 'translateY(-20px) scale(0)';
            trail.style.opacity = '0';
        });

        setTimeout(() => trail.remove(), 900);
    });

});
</script>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* ========== ROOT & THEME VARIABLES ========== */
:root {
    --brown: #6B4F3F;
    --brown-dark: #4A3628;
    --brown-light: #8B6F5F;
    --cream: #F5F0E1;
    --cream-dark: #E8E0CC;
    --cream-light: #FBF8F0;
    --accent: #D4A574;
    --accent-dark: #B8895A;
    --text-dark: #2C1810;
    --text-light: #F5F0E1;
    --shadow: rgba(107, 79, 63, 0.25);
    --shadow-strong: rgba(107, 79, 63, 0.45);
}

/* ========== GLOBAL RESETS ========== */
.cafe-wrapper {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: var(--cream);
    color: var(--text-dark);
    overflow-x: hidden;
    position: relative;
}

.cafe-wrapper *, .cafe-wrapper *::before, .cafe-wrapper *::after {
    box-sizing: border-box;
}

/* ========== SUCCESS ALERT ========== */
.alert-success-custom {
    background: linear-gradient(135deg, var(--brown), var(--brown-dark));
    color: var(--cream);
    padding: 16px 24px;
    text-align: center;
    font-weight: 600;
    font-size: 15px;
    letter-spacing: 0.5px;
    border-bottom: 3px solid var(--accent);
    animation: slideDown 0.5s ease-out;
    position: relative;
    z-index: 1000;
}

@keyframes slideDown {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* ========== FLOATING COFFEE BEANS BACKGROUND ========== */
.coffee-beans-bg {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}

.coffee-bean {
    position: absolute;
    color: var(--brown);
    opacity: 0.06;
    font-size: 2rem;
    animation: floatBeans linear infinite;
}

.coffee-bean:nth-child(1)  { left: 5%;  font-size: 1.5rem; animation-duration: 18s; animation-delay: 0s; }
.coffee-bean:nth-child(2)  { left: 15%; font-size: 1.2rem; animation-duration: 22s; animation-delay: 2s; }
.coffee-bean:nth-child(3)  { left: 25%; font-size: 2rem;   animation-duration: 16s; animation-delay: 4s; }
.coffee-bean:nth-child(4)  { left: 35%; font-size: 1rem;   animation-duration: 25s; animation-delay: 1s; }
.coffee-bean:nth-child(5)  { left: 45%; font-size: 1.8rem; animation-duration: 20s; animation-delay: 3s; }
.coffee-bean:nth-child(6)  { left: 55%; font-size: 1.3rem; animation-duration: 19s; animation-delay: 5s; }
.coffee-bean:nth-child(7)  { left: 65%; font-size: 2.2rem; animation-duration: 23s; animation-delay: 0.5s; }
.coffee-bean:nth-child(8)  { left: 75%; font-size: 1.1rem; animation-duration: 17s; animation-delay: 6s; }
.coffee-bean:nth-child(9)  { left: 85%; font-size: 1.6rem; animation-duration: 21s; animation-delay: 2.5s; }
.coffee-bean:nth-child(10) { left: 93%; font-size: 1.4rem; animation-duration: 24s; animation-delay: 4.5s; }

@keyframes floatBeans {
    0% {
        transform: translateY(110vh) rotate(0deg) scale(1);
        opacity: 0;
    }
    10% { opacity: 0.07; }
    90% { opacity: 0.07; }
    100% {
        transform: translateY(-10vh) rotate(720deg) scale(0.6);
        opacity: 0;
    }
}

/* ========== HERO SLIDER ========== */
.hero-slider {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    overflow: hidden;
    background: var(--brown-dark);
}

.slide {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    opacity: 0;
    transition: opacity 1.2s ease-in-out, transform 1.2s ease-in-out;
    transform: scale(1.05);
    z-index: 1;
}

.slide.active {
    opacity: 1;
    transform: scale(1);
    z-index: 2;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slide-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(
        180deg,
        rgba(44, 24, 16, 0.3) 0%,
        rgba(44, 24, 16, 0.55) 40%,
        rgba(44, 24, 16, 0.85) 100%
    );
    z-index: 1;
}

.slide-content {
    position: absolute;
    bottom: 18%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    text-align: center;
    width: 90%;
    max-width: 750px;
    animation: fadeUpContent 1s ease-out 0.3s both;
}

@keyframes fadeUpContent {
    from { opacity: 0; transform: translateX(-50%) translateY(40px); }
    to { opacity: 1; transform: translateX(-50%) translateY(0); }
}

.badge-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(212, 165, 116, 0.25);
    border: 1px solid rgba(212, 165, 116, 0.5);
    color: var(--accent);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 20px;
    backdrop-filter: blur(10px);
    animation: pulseGlow 3s ease-in-out infinite;
}

@keyframes pulseGlow {
    0%, 100% { box-shadow: 0 0 15px rgba(212, 165, 116, 0.2); }
    50% { box-shadow: 0 0 30px rgba(212, 165, 116, 0.4); }
}

.slide-content h1 {
    font-size: 3.2rem;
    font-weight: 800;
    color: var(--cream);
    margin-bottom: 18px;
    line-height: 1.15;
    text-shadow: 0 4px 20px rgba(0,0,0,0.4);
    letter-spacing: -0.5px;
}

.slide-content h1 span {
    color: var(--accent);
    position: relative;
}

.slide-content h1 span::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--accent);
    border-radius: 2px;
    animation: underlineGrow 1.5s ease-out 0.8s both;
}

@keyframes underlineGrow {
    from { width: 0; }
    to { width: 100%; }
}

.slide-content p {
    font-size: 1.1rem;
    color: rgba(245, 240, 225, 0.85);
    margin-bottom: 30px;
    line-height: 1.7;
    max-width: 550px;
    margin-left: auto;
    margin-right: auto;
}

.slide-btns {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--brown), var(--brown-dark));
    color: var(--cream);
    padding: 14px 34px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 15px;
    letter-spacing: 0.5px;
    border: 2px solid transparent;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    overflow: hidden;
    box-shadow: 0 6px 25px rgba(107, 79, 63, 0.4);
}

.btn-primary-custom::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(245, 240, 225, 0.15), transparent);
    transition: left 0.5s ease;
}

.btn-primary-custom:hover {
    background: var(--cream);
    color: var(--brown-dark);
    border-color: var(--cream);
    transform: translateY(-3px);
    box-shadow: 0 10px 35px rgba(107, 79, 63, 0.5);
}

.btn-primary-custom:hover::before {
    left: 100%;
}

.btn-primary-custom:hover i {
    transform: translateX(5px);
}

.btn-primary-custom i {
    transition: transform 0.3s ease;
    font-size: 16px;
}

/* ========== STEAM ANIMATION ========== */
.steam-container {
    position: relative;
    width: 60px;
    height: 50px;
    margin: 20px auto 0;
    display: flex;
    justify-content: center;
    gap: 8px;
}

.steam {
    width: 8px;
    height: 8px;
    background: rgba(245, 240, 225, 0.5);
    border-radius: 50%;
    position: relative;
    animation: steamRise 2s ease-in-out infinite;
    filter: blur(3px);
}

.steam:nth-child(1) { animation-delay: 0s; }
.steam:nth-child(2) { animation-delay: 0.4s; }
.steam:nth-child(3) { animation-delay: 0.8s; }

@keyframes steamRise {
    0% {
        opacity: 0;
        transform: translateY(0) scaleX(1);
    }
    15% {
        opacity: 0.7;
    }
    50% {
        opacity: 0.4;
        transform: translateY(-25px) scaleX(1.8) translateX(5px);
    }
    100% {
        opacity: 0;
        transform: translateY(-50px) scaleX(2.5) translateX(-5px);
    }
}

/* ========== HERO COFFEE CUP ICON ========== */
.hero-coffee-cup {
    position: absolute;
    bottom: 80px;
    right: 60px;
    z-index: 5;
    font-size: 3.5rem;
    color: var(--cream);
    opacity: 0.15;
    animation: gentleFloat 4s ease-in-out infinite;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.hero-coffee-cup .steam-container {
    position: absolute;
    top: -30px;
}

.hero-coffee-cup .steam {
    background: rgba(245, 240, 225, 0.3);
}

@keyframes gentleFloat {
    0%, 100% { transform: translateY(0) rotate(-3deg); }
    50% { transform: translateY(-15px) rotate(3deg); }
}

/* ========== SLIDER DOTS ========== */
.slider-dots {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 12px;
}

.slider-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(245, 240, 225, 0.3);
    border: 2px solid rgba(245, 240, 225, 0.5);
    cursor: pointer;
    transition: all 0.4s ease;
    position: relative;
}

.slider-dot.active {
    background: var(--accent);
    border-color: var(--accent);
    transform: scale(1.3);
    box-shadow: 0 0 15px rgba(212, 165, 116, 0.5);
}

.slider-dot::after {
    content: '';
    position: absolute;
    top: -4px; left: -4px;
    right: -4px; bottom: -4px;
    border-radius: 50%;
    border: 2px solid var(--accent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.slider-dot.active::after {
    opacity: 0.5;
    animation: dotPulse 2s ease-in-out infinite;
}

@keyframes dotPulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.4); opacity: 0; }
}

/* ========== SCROLL INDICATOR ========== */
.scroll-indicator {
    position: absolute;
    bottom: 30px;
    right: 40px;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    animation: fadeInUp 1s ease-out 1.5s both;
}

.scroll-mouse {
    width: 26px;
    height: 42px;
    border: 2px solid rgba(245, 240, 225, 0.5);
    border-radius: 15px;
    position: relative;
}

.scroll-mouse::before {
    content: '';
    position: absolute;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 10px;
    background: var(--accent);
    border-radius: 4px;
    animation: scrollWheel 2s ease-in-out infinite;
}

@keyframes scrollWheel {
    0% { transform: translateX(-50%) translateY(0); opacity: 1; }
    100% { transform: translateX(-50%) translateY(14px); opacity: 0; }
}

.scroll-indicator span {
    font-size: 11px;
    color: rgba(245, 240, 225, 0.6);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 600;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ========== COFFEE DRIP DIVIDER ========== */
.coffee-divider {
    position: relative;
    width: 100%;
    height: 50px;
    background: var(--brown-dark);
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    overflow: visible;
    z-index: 5;
}

.coffee-drip {
    width: 14px;
    height: 0;
    background: linear-gradient(180deg, var(--brown-dark), var(--brown));
    border-radius: 0 0 50% 50%;
    animation: dripDown 3s ease-in-out infinite;
    position: relative;
    top: 100%;
}

.coffee-drip:nth-child(1) { animation-delay: 0s; }
.coffee-drip:nth-child(2) { animation-delay: 0.5s; }
.coffee-drip:nth-child(3) { animation-delay: 1s; }
.coffee-drip:nth-child(4) { animation-delay: 0.3s; }
.coffee-drip:nth-child(5) { animation-delay: 0.8s; }
.coffee-drip:nth-child(6) { animation-delay: 1.3s; }
.coffee-drip:nth-child(7) { animation-delay: 0.6s; }

@keyframes dripDown {
    0% { height: 0; opacity: 1; }
    40% { height: 40px; opacity: 1; }
    60% { height: 40px; opacity: 0.7; }
    80% { height: 5px; opacity: 0.3; }
    100% { height: 0; opacity: 0; }
}

/* ========== CATEGORY / MENU SECTION ========== */
.category-section {
    background: var(--cream);
    position: relative;
    z-index: 1;
    padding: 80px 0 100px;
    overflow: hidden;
}

/* Coffee Ring Stains */
.coffee-ring {
    position: absolute;
    border-radius: 50%;
    border: 3px solid rgba(107, 79, 63, 0.06);
    pointer-events: none;
}

.coffee-ring-1 {
    width: 200px; height: 200px;
    top: -40px; right: -60px;
    animation: ringFade 6s ease-in-out infinite;
}

.coffee-ring-2 {
    width: 150px; height: 150px;
    bottom: 50px; left: -30px;
    animation: ringFade 6s ease-in-out infinite 2s;
}

.coffee-ring-3 {
    width: 120px; height: 120px;
    top: 40%; right: 10%;
    animation: ringFade 6s ease-in-out infinite 4s;
}

@keyframes ringFade {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.1); }
}

/* Pour Line */
.pour-line {
    width: 3px;
    height: 60px;
    background: linear-gradient(180deg, transparent, var(--brown), transparent);
    margin: 0 auto 20px;
    border-radius: 2px;
    animation: pourPulse 2.5s ease-in-out infinite;
}

@keyframes pourPulse {
    0%, 100% { opacity: 0.3; height: 40px; }
    50% { opacity: 0.7; height: 60px; }
}

/* Section Title */
.section-title {
    font-size: 2.6rem;
    font-weight: 800;
    color: var(--brown-dark);
    letter-spacing: -0.5px;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--brown), var(--accent));
    border-radius: 4px;
    animation: titleLine 2s ease-in-out infinite;
}

@keyframes titleLine {
    0%, 100% { width: 60px; }
    50% { width: 100px; }
}

.section-subtitle {
    color: var(--brown-light);
    font-size: 1.05rem;
    max-width: 550px;
    margin: 20px auto 0;
    line-height: 1.7;
}

/* Latte Art Loader */
.latte-art-loader {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 0;
}

.latte-swirl {
    width: 50px;
    height: 50px;
    border: 4px solid var(--cream-dark);
    border-top: 4px solid var(--brown);
    border-right: 4px solid var(--accent);
    border-radius: 50%;
    animation: latteSwirl 1.2s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
}

@keyframes latteSwirl {
    0% { transform: rotate(0deg) scale(1); }
    50% { transform: rotate(180deg) scale(0.85); }
    100% { transform: rotate(360deg) scale(1); }
}

/* ========== MENU CARDS ========== */
.menu-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 28px;
    margin-top: 30px;
    padding: 10px;
}

.menu-card-wrapper {
    flex: 0 0 220px;
    text-align: center;
    opacity: 0;
    transform: translateY(40px) scale(0.95);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.menu-card-wrapper.revealed {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.menu-card-wrapper:nth-child(1) { transition-delay: 0.1s; }
.menu-card-wrapper:nth-child(2) { transition-delay: 0.2s; }
.menu-card-wrapper:nth-child(3) { transition-delay: 0.3s; }
.menu-card-wrapper:nth-child(4) { transition-delay: 0.4s; }
.menu-card-wrapper:nth-child(5) { transition-delay: 0.5s; }
.menu-card-wrapper:nth-child(6) { transition-delay: 0.6s; }
.menu-card-wrapper:nth-child(7) { transition-delay: 0.7s; }
.menu-card-wrapper:nth-child(8) { transition-delay: 0.8s; }

.category-box {
    display: block;
    padding: 30px 22px;
    background: var(--cream-light);
    border: 2px solid rgba(107, 79, 63, 0.1);
    border-radius: 20px;
    text-decoration: none;
    color: var(--text-dark);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(107, 79, 63, 0.08);
}

.category-box::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(135deg, var(--brown), var(--brown-dark));
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 0;
}

.category-box::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(212, 165, 116, 0.15) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 0;
}

.category-box:hover {
    transform: translateY(-10px) scale(1.03);
    border-color: var(--brown);
    box-shadow: 0 15px 40px rgba(107, 79, 63, 0.25);
}

.category-box:hover::before {
    opacity: 1;
}

.category-box:hover::after {
    opacity: 1;
}

.category-box h5 {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--brown-dark);
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
    transition: color 0.4s ease;
}

.category-box:hover h5 {
    color: var(--cream);
}

.menu-desc {
    display: block;
    font-size: 0.85rem;
    color: var(--brown-light);
    position: relative;
    z-index: 1;
    transition: color 0.4s ease;
    line-height: 1.5;
}

.category-box:hover .menu-desc {
    color: rgba(245, 240, 225, 0.75);
}

.menu-arrow {
    margin-top: 15px;
    position: relative;
    z-index: 1;
}

.menu-arrow i {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(107, 79, 63, 0.1);
    color: var(--brown);
    font-size: 16px;
    transition: all 0.4s ease;
}

.category-box:hover .menu-arrow i {
    background: var(--cream);
    color: var(--brown-dark);
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .slide-content h1 {
        font-size: 2rem;
    }

    .slide-content p {
        font-size: 0.95rem;
    }

    .btn-primary-custom {
        padding: 12px 24px;
        font-size: 14px;
    }

    .hero-coffee-cup {
        display: none;
    }

    .scroll-indicator {
        right: 20px;
    }

    .section-title {
        font-size: 2rem;
    }

    .menu-card-wrapper {
        flex: 0 0 160px;
    }

    .category-box {
        padding: 22px 16px;
    }
}

@media (max-width: 480px) {
    .hero-slider {
        min-height: 500px;
    }

    .slide-content {
        bottom: 25%;
    }

    .slide-content h1 {
        font-size: 1.6rem;
    }

    .badge-tag {
        font-size: 11px;
        padding: 6px 14px;
    }

    .slide-btns {
        flex-direction: column;
        align-items: center;
    }

    .menu-grid {
        gap: 18px;
    }

    .menu-card-wrapper {
        flex: 0 0 140px;
    }

    .section-title {
        font-size: 1.6rem;
    }

    .coffee-divider {
        height: 35px;
    }
}

/* ========== EXTRA COFFEE ANIMATIONS ========== */

/* Coffee Cup Tilt on Hover (for hero cup) */
.hero-coffee-cup:hover {
    animation-play-state: paused;
    transform: rotate(-15deg) scale(1.2);
    opacity: 0.3;
    transition: all 0.3s ease;
}

/* Grain / Texture Overlay for Hero */
.hero-slider::after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 3;
}

/* Category Section Background Pattern */
.category-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(107, 79, 63, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(212, 165, 116, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 60% 80%, rgba(107, 79, 63, 0.03) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.category-section .container {
    position: relative;
    z-index: 1;
}

/* Smooth text rendering */
.cafe-wrapper {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Custom scrollbar matching theme */
.cafe-wrapper::-webkit-scrollbar {
    width: 8px;
}

.cafe-wrapper::-webkit-scrollbar-track {
    background: var(--cream-dark);
}

.cafe-wrapper::-webkit-scrollbar-thumb {
    background: var(--brown-light);
    border-radius: 4px;
}

.cafe-wrapper::-webkit-scrollbar-thumb:hover {
    background: var(--brown);
}
</style>

@endsection
