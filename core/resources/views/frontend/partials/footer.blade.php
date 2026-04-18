<!-- Floating Coffee Bean Particles -->
<div class="coffee-particles" id="coffeeParticles"></div>

<!-- ================= CONTACT ================= -->
<section id="contactSection" class="contact-section">
    <!-- Coffee cup watermark -->
    <div class="coffee-cup-deco">
        <i class="bi bi-cup-hot"></i>
    </div>

    <!-- Coffee stain decorations -->
    <div class="coffee-stain coffee-stain-1"></div>
    <div class="coffee-stain coffee-stain-2"></div>

    <div class="contact-container">

        <div class="section-header fade-in-up visible">
            <h2>Get In Touch</h2>
            <p>We would love to hear from you</p>
        </div>

        <div class="contact-grid">

            <!-- FORM CARD -->
            <div class="contact-form-card fade-in-up visible" style="position: relative;">
                <!-- Steam rising from the card -->
                <div class="steam-container">
                    <div class="steam"></div>
                    <div class="steam"></div>
                    <div class="steam"></div>
                </div>

                <!-- Success Overlay -->
                <div class="success-overlay" id="successOverlay">
                    <div class="success-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h4>Message Sent!</h4>
                    <p>We'll get back to you with a fresh brew of answers.</p>
                </div>

                <form action="{{ url('/contactus') }}" method="POST" id="contactForm">
                    @csrf

                    <div class="form-group">
                        <label><i class="bi bi-person me-1"></i> Your Name</label>
                        <div class="input-wrapper">
                            <input type="text" name="name" class="form-input" placeholder="John Doe" required>
                            <i class="bi bi-person input-icon"></i>
                        </div>
                        <div class="focus-bar"></div>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-envelope me-1"></i> Email</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" class="form-input" placeholder="hello@example.com" required>
                            <i class="bi bi-envelope input-icon"></i>
                        </div>
                        <div class="focus-bar"></div>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-chat-dots me-1"></i> Message</label>
                        <div class="input-wrapper">
                            <textarea name="message" class="form-input" placeholder="Tell us what's brewing in your mind..." required></textarea>
                            <i class="bi bi-chat-text input-icon"></i>
                        </div>
                        <div class="focus-bar"></div>
                    </div>

                    <button type="submit" id="submitBtn" class="submit-btn">
                        <i class="bi bi-send"></i>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>

            <!-- INFO CARD -->
            <div class="contact-info-card fade-in-up visible">
                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="info-text">
                        <h6>Our Location</h6>
                        <p>Moylapota, Khulna, Bangladesh</p>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div class="info-text">
                        <h6>Call Us</h6>
                        <p>+880 1234 567 890</p>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="info-text">
                        <h6>Email Us</h6>
                        <p>hello@cafearoma.com</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // ===== FLOATING COFFEE BEANS =====
    const particlesContainer = document.getElementById('coffeeParticles');
    const beanSymbols = ['●','◉','◎'];

    function createBean() {
        const bean = document.createElement('div');
        bean.classList.add('coffee-bean');
        bean.textContent = beanSymbols[Math.floor(Math.random() * beanSymbols.length)];
        bean.style.left = Math.random() * 100 + '%';
        bean.style.fontSize = (12 + Math.random() * 16) + 'px';
        bean.style.animationDuration = (15 + Math.random() * 25) + 's';
        bean.style.animationDelay = Math.random() * 5 + 's';
        particlesContainer.appendChild(bean);
        setTimeout(() => bean.remove(), 40000);
    }

    for(let i=0;i<15;i++) setTimeout(createBean,i*800);
    setInterval(createBean,3000);

    // ===== FADE-IN OBSERVER =====
    const fadeEls = document.querySelectorAll('.fade-in-up');
    const observer = new IntersectionObserver((entries)=>{
        entries.forEach((entry,index)=>{
            if(entry.isIntersecting){
                setTimeout(()=>entry.target.classList.add('visible'),index*150);
                observer.unobserve(entry.target);
            }
        });
    },{threshold:0.15});
    fadeEls.forEach(el=>observer.observe(el));

    // ===== FORM SUBMISSION =====
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const successOverlay = document.getElementById('successOverlay');

    form.addEventListener('submit', function(e){
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="btn-spinner"></span> <span>Sending...</span>';

        setTimeout(()=>{
            successOverlay.classList.add('show');

            setTimeout(()=>{
                successOverlay.classList.remove('show');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-send"></i> <span>Send Message</span>';
                form.reset();
            },3000);
        },1800);
    });

    // ===== INPUT FOCUS ANIMATION =====
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input=>{
        input.addEventListener('focus',function(){
            const label = this.closest('.form-group').querySelector('label');
            label.style.color = '#6B4F3F';
            label.style.transform = 'translateX(4px)';
            label.style.transition = 'all 0.3s ease';
        });
        input.addEventListener('blur',function(){
            const label = this.closest('.form-group').querySelector('label');
            label.style.color = '';
            label.style.transform = '';
        });
    });

    // ===== PARALLAX ON MOUSE MOVE =====
    const section = document.getElementById('contactSection');
    section.addEventListener('mousemove',function(e){
        const rect = section.getBoundingClientRect();
        const x = (e.clientX - rect.left)/rect.width - 0.5;
        const y = (e.clientY - rect.top)/rect.height - 0.5;

        document.querySelectorAll('.coffee-stain').forEach((stain,i)=>{
            stain.style.transform = `translate(${x*(i+1)*15}px,${y*(i+1)*15}px)`;
        });

        const cupDeco = document.querySelector('.coffee-cup-deco');
        if(cupDeco){
            cupDeco.style.transform = `translateX(calc(-50% + ${x*10}px)) translateY(${y*8}px)`;
        }
    });

    // ===== TYPING CURSOR EFFECT ON TEXTAREA =====
    const textarea = document.querySelector('textarea.form-input');
    const phrases = [
        "Tell us what's brewing in your mind...",
        "We'd love to pour you a perfect cup...",
        "Share your thoughts over coffee...",
        "What flavor of help do you need?"
    ];
    let phraseIndex=0,charIndex=0,isDeleting=false,typingSpeed=80;

    function typeEffect(){
        if(document.activeElement===textarea || textarea.value.length>0){
            setTimeout(typeEffect,500);
            return;
        }
        const currentPhrase=phrases[phraseIndex];
        if(!isDeleting){
            textarea.placeholder=currentPhrase.substring(0,charIndex+1);
            charIndex++;
            typingSpeed=60+Math.random()*40;
            if(charIndex===currentPhrase.length){
                isDeleting=true;
                typingSpeed=2000;
            }
        } else {
            textarea.placeholder=currentPhrase.substring(0,charIndex-1);
            charIndex--;
            typingSpeed=30;
            if(charIndex===0){
                isDeleting=false;
                phraseIndex=(phraseIndex+1)%phrases.length;
                typingSpeed=500;
            }
        }
        setTimeout(typeEffect,typingSpeed);
    }

    setTimeout(typeEffect,2000);

});
</script>

<style>
        /* ========== BASE RESET ========== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F5F0E1;
            color: #3a2a1f;
            overflow-x: hidden;
        }

        /* ========== COFFEE BEAN FLOATING PARTICLES ========== */
        .coffee-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .coffee-bean {
            position: absolute;
            font-size: 18px;
            color: rgba(107, 79, 63, 0.12);
            animation: floatBean linear infinite;
        }

        @keyframes floatBean {
            0% {
                transform: translateY(110vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) rotate(720deg);
                opacity: 0;
            }
        }

        /* ========== STEAM ANIMATION ========== */
        .steam-container {
            position: absolute;
            top: -80px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 1;
        }

        .steam {
            width: 3px;
            height: 40px;
            background: rgba(107, 79, 63, 0.15);
            border-radius: 50%;
            animation: steamRise 2.5s ease-in-out infinite;
            filter: blur(2px);
        }

        .steam:nth-child(2) {
            animation-delay: 0.4s;
            height: 50px;
        }

        .steam:nth-child(3) {
            animation-delay: 0.8s;
            height: 35px;
        }

        @keyframes steamRise {
            0% {
                opacity: 0;
                transform: translateY(0) scaleX(1);
            }
            50% {
                opacity: 0.6;
                transform: translateY(-20px) scaleX(1.8);
            }
            100% {
                opacity: 0;
                transform: translateY(-50px) scaleX(2.5);
            }
        }

        /* ========== CONTACT SECTION ========== */
        .contact-section {
            position: relative;
            min-height: 100vh;
            padding: 80px 20px;
            background: linear-gradient(175deg, #F5F0E1 0%, #ede6d3 40%, #F5F0E1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Coffee ring stain decorations */
        .contact-section::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border: 3px solid rgba(107, 79, 63, 0.06);
            border-radius: 50%;
            top: 60px;
            right: -40px;
            animation: ringPulse 6s ease-in-out infinite;
        }

        .contact-section::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            border: 3px solid rgba(107, 79, 63, 0.05);
            border-radius: 50%;
            bottom: 80px;
            left: -30px;
            animation: ringPulse 6s ease-in-out infinite 3s;
        }

        @keyframes ringPulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.15);
                opacity: 1;
            }
        }

        .contact-container {
            max-width: 1100px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* ========== SECTION HEADER ========== */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            color: #6B4F3F;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .section-header h2::before {
            content: '\2615';
            position: absolute;
            left: -50px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 28px;
            animation: cupWiggle 3s ease-in-out infinite;
            opacity: 0.7;
        }

        .section-header h2::after {
            content: '\2615';
            position: absolute;
            right: -50px;
            top: 50%;
            transform: translateY(-50%) scaleX(-1);
            font-size: 28px;
            animation: cupWiggle 3s ease-in-out infinite 1.5s;
            opacity: 0.7;
        }

        @keyframes cupWiggle {
            0%, 100% { transform: translateY(-50%) rotate(0deg); }
            25% { transform: translateY(-50%) rotate(-8deg); }
            75% { transform: translateY(-50%) rotate(8deg); }
        }

        .section-header p {
            font-size: 1.05rem;
            color: #8a7060;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        /* Decorative line under header */
        .section-header::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #6B4F3F, transparent);
            margin: 18px auto 0;
            border-radius: 2px;
            animation: lineExpand 2s ease-in-out infinite alternate;
        }

        @keyframes lineExpand {
            0% { width: 50px; opacity: 0.5; }
            100% { width: 100px; opacity: 1; }
        }

        /* ========== CONTACT GRID ========== */
        .contact-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: start;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        /* ========== CONTACT FORM CARD ========== */
        .contact-form-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 45px 40px;
            box-shadow:
                0 10px 40px rgba(107, 79, 63, 0.08),
                0 2px 10px rgba(107, 79, 63, 0.04);
            border: 1px solid rgba(107, 79, 63, 0.08);
            position: relative;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .contact-form-card:hover {
            transform: translateY(-5px);
            box-shadow:
                0 20px 60px rgba(107, 79, 63, 0.12),
                0 5px 20px rgba(107, 79, 63, 0.06);
        }

        /* Coffee drip decoration on form card */
        .contact-form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 40px;
            width: 4px;
            height: 0;
            background: linear-gradient(to bottom, #6B4F3F, transparent);
            border-radius: 0 0 4px 4px;
            animation: coffeeDrip 4s ease-in-out infinite;
        }

        @keyframes coffeeDrip {
            0% { height: 0; opacity: 0; }
            30% { height: 50px; opacity: 0.3; }
            60% { height: 50px; opacity: 0.3; }
            100% { height: 0; opacity: 0; top: 50px; }
        }

        /* Latte art swirl inside card */
        .contact-form-card::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 160px;
            height: 160px;
            border: 2px solid rgba(107, 79, 63, 0.04);
            border-radius: 50%;
            animation: latteSwirl 10s linear infinite;
        }

        @keyframes latteSwirl {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #6B4F3F;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid rgba(107, 79, 63, 0.12);
            border-radius: 12px;
            background: #faf8f3;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: #3a2a1f;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            outline: none;
        }

        .form-input:focus {
            border-color: #6B4F3F;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(107, 79, 63, 0.08), 0 4px 15px rgba(107, 79, 63, 0.06);
            transform: translateY(-1px);
        }

        .form-input:focus + .input-coffee-icon,
        .form-group:focus-within label {
            color: #6B4F3F;
        }

        textarea.form-input {
            min-height: 130px;
            resize: vertical;
        }

        /* ========== SUBMIT BUTTON ========== */
        .submit-btn {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, #6B4F3F, #8a6650);
            color: #F5F0E1;
            border: none;
            border-radius: 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(245, 240, 225, 0.15), transparent);
            transition: left 0.6s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #5a3f30, #6B4F3F);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 79, 63, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(107, 79, 63, 0.2);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Button coffee cup spinner */
        .btn-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(245, 240, 225, 0.3);
            border-top-color: #F5F0E1;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ========== CONTACT INFO CARD ========== */
        .contact-info-card {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-box {
            background: #ffffff;
            border-radius: 18px;
            padding: 28px 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow:
                0 6px 25px rgba(107, 79, 63, 0.06),
                0 2px 8px rgba(107, 79, 63, 0.03);
            border: 1px solid rgba(107, 79, 63, 0.06);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
            cursor: default;
        }

        .info-box::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #6B4F3F, #a8806a);
            transition: width 0.5s ease;
            border-radius: 0 3px 0 0;
        }

        .info-box:hover::after {
            width: 100%;
        }

        .info-box:hover {
            transform: translateX(8px) translateY(-2px);
            box-shadow:
                0 12px 35px rgba(107, 79, 63, 0.1),
                0 4px 15px rgba(107, 79, 63, 0.05);
        }

        .info-box:hover .info-box-icon {
            background: #6B4F3F;
            color: #F5F0E1;
            transform: rotate(10deg) scale(1.1);
        }

        .info-box-icon {
            width: 55px;
            height: 55px;
            min-width: 55px;
            background: linear-gradient(135deg, rgba(107, 79, 63, 0.08), rgba(107, 79, 63, 0.15));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #6B4F3F;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .info-box h6 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            color: #6B4F3F;
            margin-bottom: 3px;
        }

        .info-box p {
            font-size: 0.88rem;
            color: #8a7060;
            font-weight: 400;
            line-height: 1.4;
        }

        .info-text {
            display: flex;
            flex-direction: column;
        }

        /* ========== SOCIAL LINKS BOX ========== */
        .social-box {
            background: linear-gradient(135deg, #6B4F3F, #7d5d4b);
            border-radius: 18px;
            padding: 28px 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(107, 79, 63, 0.15);
            transition: transform 0.4s ease;
        }

        .social-box:hover {
            transform: translateY(-3px);
        }

        .social-box h6 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            color: #F5F0E1;
            margin-bottom: 16px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 14px;
        }

        .social-link {
            width: 44px;
            height: 44px;
            background: rgba(245, 240, 225, 0.12);
            border: 1px solid rgba(245, 240, 225, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F5F0E1;
            font-size: 1.15rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #F5F0E1;
            color: #6B4F3F;
            transform: translateY(-3px) rotate(5deg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        /* ========== OPENING HOURS BOX ========== */
        .hours-box {
            background: #ffffff;
            border-radius: 18px;
            padding: 28px 25px;
            box-shadow:
                0 6px 25px rgba(107, 79, 63, 0.06),
                0 2px 8px rgba(107, 79, 63, 0.03);
            border: 1px solid rgba(107, 79, 63, 0.06);
            text-align: center;
            transition: all 0.4s ease;
        }

        .hours-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(107, 79, 63, 0.1);
        }

        .hours-box .hours-icon {
            font-size: 1.6rem;
            color: #6B4F3F;
            margin-bottom: 8px;
            display: inline-block;
            animation: clockTick 2s steps(12) infinite;
        }

        @keyframes clockTick {
            to { transform: rotate(360deg); }
        }

        .hours-box h6 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            color: #6B4F3F;
            margin-bottom: 12px;
        }

        .hours-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px dashed rgba(107, 79, 63, 0.1);
            font-size: 0.85rem;
        }

        .hours-row:last-child {
            border-bottom: none;
        }

        .hours-row span:first-child {
            color: #6B4F3F;
            font-weight: 500;
        }

        .hours-row span:last-child {
            color: #8a7060;
        }

        /* ========== FADE IN UP ANIMATION ========== */
        .fade-in-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s cubic-bezier(0.25, 0.8, 0.25, 1),
                        transform 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger delays for children */
        .contact-info-card .info-box:nth-child(1),
        .contact-info-card .hours-box { transition-delay: 0.1s; }
        .contact-info-card .info-box:nth-child(2) { transition-delay: 0.2s; }
        .contact-info-card .info-box:nth-child(3) { transition-delay: 0.3s; }
        .contact-info-card .social-box { transition-delay: 0.4s; }

        /* ========== RIPPLE ON INPUT FOCUS ========== */
        .form-group {
            position: relative;
        }

        .focus-bar {
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #6B4F3F;
            border-radius: 2px;
            transition: all 0.4s ease;
        }

        .form-input:focus ~ .focus-bar {
            left: 18px;
            width: calc(100% - 36px);
        }

        /* ========== SUCCESS MESSAGE ========== */
        .success-overlay {
            display: none;
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            z-index: 10;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .success-overlay.show {
            display: flex;
            animation: fadeInScale 0.5s ease;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .success-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #6B4F3F, #8a6650);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #F5F0E1;
            animation: bounceIn 0.6s ease 0.2s both;
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .success-overlay h4 {
            font-family: 'Playfair Display', serif;
            color: #6B4F3F;
            font-size: 1.3rem;
        }

        .success-overlay p {
            color: #8a7060;
            font-size: 0.9rem;
        }

        /* ========== COFFEE CUP DECORATION (top of section) ========== */
        .coffee-cup-deco {
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.06;
            font-size: 120px;
            color: #6B4F3F;
            pointer-events: none;
            animation: gentleFloat 5s ease-in-out infinite;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-15px); }
        }

        /* ========== POUR ANIMATION ON CARD BORDERS ========== */
        @keyframes pourShine {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        .contact-form-card {
            background-image: linear-gradient(90deg, #ffffff 40%, rgba(107,79,63,0.03) 50%, #ffffff 60%);
            background-size: 200% 100%;
            animation: pourShine 6s ease-in-out infinite;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .contact-section {
                padding: 60px 16px;
            }

            .contact-form-card {
                padding: 30px 24px;
            }

            .section-header h2::before,
            .section-header h2::after {
                display: none;
            }

            .section-header {
                margin-bottom: 40px;
            }

            .info-box {
                padding: 22px 20px;
            }
        }

        @media (max-width: 480px) {
            .contact-form-card {
                padding: 24px 18px;
                border-radius: 16px;
            }

            .info-box {
                padding: 18px 16px;
                border-radius: 14px;
                gap: 14px;
            }

            .info-box-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                font-size: 1.1rem;
                border-radius: 10px;
            }

            .social-box, .hours-box {
                border-radius: 14px;
            }
        }

        /* ========== INPUT ICON DECORATIONS ========== */
        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(107, 79, 63, 0.2);
            font-size: 1rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        textarea ~ .input-icon {
            top: 20px;
            transform: none;
        }

        .form-input:focus ~ .input-icon {
            color: rgba(107, 79, 63, 0.5);
        }

        /* ========== COFFEE STAIN WATERMARK ========== */
        .coffee-stain {
            position: absolute;
            width: 100px;
            height: 100px;
            border: 3px solid rgba(107, 79, 63, 0.03);
            border-radius: 50%;
            pointer-events: none;
        }

        .coffee-stain-1 {
            top: 15%;
            left: 5%;
            animation: stainFade 8s ease-in-out infinite;
        }

        .coffee-stain-2 {
            bottom: 10%;
            right: 8%;
            width: 130px;
            height: 130px;
            animation: stainFade 8s ease-in-out infinite 4s;
        }

        @keyframes stainFade {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
    </style>