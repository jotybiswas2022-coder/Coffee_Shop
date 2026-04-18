@extends('frontend.app')

@section('content')

<!-- Coffee Beans Background Animation -->
<div class="coffee-bg-elements">
    <div class="steam-container steam-1">
        <div class="steam"></div>
        <div class="steam"></div>
        <div class="steam"></div>
    </div>
    <div class="steam-container steam-2">
        <div class="steam"></div>
        <div class="steam"></div>
        <div class="steam"></div>
    </div>
    <div class="coffee-bean bean-1"><i class="bi bi-heart-fill"></i></div>
    <div class="coffee-bean bean-2"><i class="bi bi-cup-hot-fill"></i></div>
    <div class="coffee-bean bean-3"><i class="bi bi-droplet-fill"></i></div>
    <div class="coffee-bean bean-4"><i class="bi bi-flower1"></i></div>
    <div class="coffee-bean bean-5"><i class="bi bi-cup-hot-fill"></i></div>
    <div class="coffee-bean bean-6"><i class="bi bi-droplet-fill"></i></div>
</div>

<div class="bg-orbs">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<div class="container py-5 main-content">

    <!-- Coffee Cup Icon Header -->
    <div class="coffee-header-icon animate-in">
        <div class="coffee-cup-wrapper">
            <i class="bi bi-cup-hot-fill"></i>
            <div class="cup-steam">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <h2 class="fw-bold text-center gradient-text mb-2 animate-in">Checkout</h2>
    <p class="text-center section-subtitle mb-4 animate-in">Complete your order & enjoy your coffee</p>

    <!-- Coffee Progress Steps -->
    <div class="checkout-steps animate-in">
        <div class="step completed">
            <div class="step-circle"><i class="bi bi-cup-hot-fill"></i></div>
            <span class="step-label">Menu</span>
        </div>
        <div class="step-line done"></div>
        <div class="step completed">
            <div class="step-circle"><i class="bi bi-cart-fill"></i></div>
            <span class="step-label">Cart</span>
        </div>
        <div class="step-line done"></div>
        <div class="step active">
            <div class="step-circle"><i class="bi bi-credit-card-fill"></i></div>
            <span class="step-label">Payment</span>
        </div>
        <div class="step-line pending"></div>
        <div class="step inactive">
            <div class="step-circle"><i class="bi bi-check-circle-fill"></i></div>
            <span class="step-label">Confirm</span>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-custom-success animate-in">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-custom-danger animate-in">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-custom-danger animate-in">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="/user/order/store" method="post">
@csrf

@if($carts->count() == 0)

<div class="empty-cart animate-in">
    <div class="empty-cart-icon">
        <i class="bi bi-cart-x"></i>
    </div>
    <h4>Your cart is empty</h4>
    <p class="empty-cart-sub">Looks like you haven't added any coffee yet!</p>
    <a href="{{ url('/') }}" class="btn-continue">
        <i class="bi bi-arrow-left"></i> Browse Our Menu
    </a>
</div>

@else

@foreach($carts as $cart)
@php
$product = $cart->product;
$priceAfterDiscount = $product->price * (100 - ($product->discount ?? 0)) / 100;
$subtotal += $priceAfterDiscount * $cart->quantity;
@endphp
@endforeach

@php
$taxAmount  = ($subtotal * $taxPercent) / 100;
$grandTotal = $subtotal + $taxAmount + $delivery;
@endphp

<div class="row g-4">

    <!-- Billing -->
    <div class="col-lg-7 animate-in animate-delay-1">
        <div class="dark-card billing-card">

            <h4><i class="bi bi-person-circle"></i> Billing Details</h4>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-person"></i> First Name</label>
                    <div class="input-icon-wrapper">
                        <input type="text" name="firstname"
                            value="{{ old('firstname', $user->firstname ?? '') }}"
                            class="form-control-dark" placeholder="John" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-person"></i> Last Name</label>
                    <div class="input-icon-wrapper">
                        <input type="text" name="lastname"
                            value="{{ old('lastname', $user->lastname ?? '') }}"
                            class="form-control-dark" placeholder="Doe" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-envelope"></i> Email</label>
                    <div class="input-icon-wrapper">
                        <input type="email" name="email"
                            value="{{ old('email', $user->email ?? '') }}"
                            class="form-control-dark" placeholder="john@email.com" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-telephone"></i> Phone</label>
                    <div class="input-icon-wrapper">
                        <input type="tel" name="phone"
                            value="{{ old('phone', $user->phone ?? '') }}"
                            class="form-control-dark" placeholder="+880 1XXX-XXXXXX" required>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label"><i class="bi bi-geo-alt"></i> Delivery Address</label>
                    <div class="input-icon-wrapper">
                        <input type="text" name="address"
                            value="{{ old('address', $user->address ?? '') }}"
                            class="form-control-dark" placeholder="Enter your full address" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-5 animate-in animate-delay-2">
        <div class="sticky-sidebar">

            <!-- Cart Items -->
            <div class="dark-card mb-4">
                <div class="card-header-dark">
                    <i class="bi bi-cup-hot"></i> Your Order
                    <span class="cart-count">{{ $carts->count() }} items</span>
                </div>

                @foreach($carts as $cart)
                @php
                    $product = $cart->product;
                    $priceAfterDiscount = $product->price * (100 - ($product->discount ?? 0)) / 100;
                @endphp

                <div class="cart-item">
                    <img src="{{ config('app.storage_url') }}{{ $product->image }}" class="cart-img" alt="{{ $product->name }}">
                    <div class="flex-grow-1">
                        <div class="cart-item-name">{{ $product->name }}</div>
                        <div class="cart-item-meta">
                            <i class="bi bi-x-lg"></i> {{ $cart->quantity }} &mdash; {{ number_format($priceAfterDiscount,2) }} {{ $currency }}
                        </div>
                    </div>
                    <div class="cart-item-price">
                        {{ number_format($priceAfterDiscount * $cart->quantity,2) }} {{ $currency }}
                    </div>
                </div>

                @endforeach
            </div>

            <!-- Payment -->
            <div class="dark-card p-3 mb-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-wallet2 me-2"></i>Select Payment Method</h6>

                <label class="payment-option">
                    <input type="radio" name="payment_method" value="cod" required>
                    <div class="payment-icon-wrap"><i class="bi bi-truck"></i></div>
                    <div class="payment-label-text">
                        Cash on Delivery
                        <div class="payment-label-sub">Pay when your order arrives</div>
                    </div>
                    <i class="bi bi-chevron-right payment-arrow"></i>
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment_method" value="bkash">
                    <div class="payment-icon-wrap"><i class="bi bi-phone"></i></div>
                    <div class="payment-label-text">
                        bKash
                        <div class="payment-label-sub">Instant mobile payment</div>
                    </div>
                    <i class="bi bi-chevron-right payment-arrow"></i>
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment_method" value="nagad">
                    <div class="payment-icon-wrap"><i class="bi bi-credit-card"></i></div>
                    <div class="payment-label-text">
                        Nagad
                        <div class="payment-label-sub">Secure online payment</div>
                    </div>
                    <i class="bi bi-chevron-right payment-arrow"></i>
                </label>
            </div>

            <!-- Summary -->
            <div class="dark-card p-4 summary-card">
                <h6 class="fw-bold mb-3"><i class="bi bi-receipt me-2"></i>Order Summary</h6>

                <div class="summary-row">
                    <span><i class="bi bi-basket me-1"></i> Subtotal</span>
                    <span>{{ number_format($subtotal,2) }} {{ $currency }}</span>
                </div>

                <div class="summary-row">
                    <span><i class="bi bi-percent me-1"></i> Tax ({{ $taxPercent }}%)</span>
                    <span>{{ number_format($taxAmount,2) }} {{ $currency }}</span>
                </div>

                <div class="summary-row">
                    <span><i class="bi bi-bicycle me-1"></i> Delivery</span>
                    <span>{{ number_format($delivery,2) }} {{ $currency }}</span>
                </div>

                <hr class="summary-divider">

                <div class="summary-total">
                    <span>Total</span>
                    <span>{{ number_format($grandTotal,2) }} {{ $currency }}</span>
                </div>

                <button type="submit" class="btn-checkout">
                    <i class="bi bi-shield-check"></i>
                    Place Order
                    <div class="btn-shine"></div>
                </button>

                <div class="security-badge">
                    <i class="bi bi-lock-fill"></i>
                    Secure 256-bit SSL encrypted checkout
                </div>
            </div>

        </div>
    </div>

</div>

@endif
</form>
</div>

<!-- Coffee Drip Animation Overlay -->
<div class="coffee-drip-decoration">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none">
        <path d="M0,0 C360,60 1080,60 1440,0 L1440,60 L0,60 Z" fill="var(--cream)"/>
    </svg>
</div>

<script>
document.querySelectorAll('.payment-option input').forEach(radio => {
    radio.addEventListener('change', function(){
        document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('selected'));
        this.closest('.payment-option').classList.add('selected');
    });
});

// Intersection Observer for scroll animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-in').forEach(el => observer.observe(el));

// Parallax effect for coffee beans
document.addEventListener('mousemove', (e) => {
    const beans = document.querySelectorAll('.coffee-bean');
    const x = (e.clientX / window.innerWidth - 0.5) * 2;
    const y = (e.clientY / window.innerHeight - 0.5) * 2;
    beans.forEach((bean, i) => {
        const speed = (i + 1) * 8;
        bean.style.transform = `translate(${x * speed}px, ${y * speed}px) rotate(${x * 20}deg)`;
    });
});
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --brown: #6B4F3F;
        --brown-dark: #4A3628;
        --brown-darker: #3B2A1E;
        --brown-light: #8B6F5F;
        --brown-lighter: #A68B7B;
        --cream: #F5F0E1;
        --cream-dark: #E8E0CC;
        --cream-darker: #D4C9B0;
        --cream-light: #FAF8F0;
        --accent: #C8956C;
        --accent-light: #D4A574;
        --accent-glow: rgba(200, 149, 108, 0.4);
        --text: #3B2A1E;
        --text-muted: #8B7B6B;
        --danger: #C0392B;
        --success: #27AE60;
        --shadow-color: rgba(107, 79, 63, 0.15);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--cream);
        color: var(--text);
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* ── Coffee Background Elements ── */
    .coffee-bg-elements {
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
        color: var(--brown);
        opacity: 0.06;
        font-size: 2.5rem;
        transition: transform 0.3s ease-out;
    }

    .bean-1 { top: 10%; left: 5%; font-size: 3rem; animation: floatBean 8s ease-in-out infinite; }
    .bean-2 { top: 25%; right: 8%; font-size: 2rem; animation: floatBean 10s ease-in-out infinite 1s; }
    .bean-3 { top: 60%; left: 3%; font-size: 2.5rem; animation: floatBean 9s ease-in-out infinite 2s; }
    .bean-4 { top: 75%; right: 5%; font-size: 1.8rem; animation: floatBean 11s ease-in-out infinite 0.5s; }
    .bean-5 { top: 45%; left: 92%; font-size: 2.2rem; animation: floatBean 7s ease-in-out infinite 1.5s; }
    .bean-6 { top: 85%; left: 50%; font-size: 2rem; animation: floatBean 12s ease-in-out infinite 3s; }

    @keyframes floatBean {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-20px) rotate(10deg); }
        50% { transform: translateY(-10px) rotate(-5deg); }
        75% { transform: translateY(-25px) rotate(8deg); }
    }

    /* ── Steam Animations ── */
    .steam-container {
        position: absolute;
        display: flex;
        gap: 8px;
    }

    .steam-1 { bottom: 30%; right: 10%; }
    .steam-2 { top: 20%; left: 8%; }

    .steam {
        width: 6px;
        height: 40px;
        background: linear-gradient(to top, rgba(107, 79, 63, 0.08), transparent);
        border-radius: 50%;
        animation: steamRise 3s ease-in-out infinite;
    }

    .steam:nth-child(2) { animation-delay: 0.5s; height: 50px; }
    .steam:nth-child(3) { animation-delay: 1s; height: 35px; }

    @keyframes steamRise {
        0% { opacity: 0; transform: translateY(0) scaleX(1); }
        50% { opacity: 0.6; transform: translateY(-30px) scaleX(1.5); }
        100% { opacity: 0; transform: translateY(-60px) scaleX(2); }
    }

    /* ── Background Orbs ── */
    .bg-orbs {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .bg-orbs .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.08;
    }

    .bg-orbs .orb-1 {
        width: 600px;
        height: 600px;
        background: var(--brown);
        top: -200px;
        right: -150px;
        animation: orbFloat 15s ease-in-out infinite;
    }

    .bg-orbs .orb-2 {
        width: 500px;
        height: 500px;
        background: var(--accent);
        bottom: -150px;
        left: -150px;
        animation: orbFloat 18s ease-in-out infinite 3s;
    }

    .bg-orbs .orb-3 {
        width: 350px;
        height: 350px;
        background: var(--brown-light);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation: orbFloat 12s ease-in-out infinite 1s;
    }

    @keyframes orbFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -30px) scale(1.05); }
        66% { transform: translate(-20px, 20px) scale(0.95); }
    }

    .main-content {
        position: relative;
        z-index: 1;
    }

    /* ── Coffee Cup Header Icon ── */
    .coffee-header-icon {
        text-align: center;
        margin-bottom: 10px;
    }

    .coffee-cup-wrapper {
        display: inline-block;
        position: relative;
        font-size: 3rem;
        color: var(--brown);
        animation: cupBounce 3s ease-in-out infinite;
    }

    .cup-steam {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 4px;
    }

    .cup-steam span {
        display: block;
        width: 4px;
        height: 20px;
        background: linear-gradient(to top, var(--brown-lighter), transparent);
        border-radius: 50%;
        animation: steamCurl 2s ease-in-out infinite;
    }

    .cup-steam span:nth-child(2) { animation-delay: 0.3s; height: 26px; }
    .cup-steam span:nth-child(3) { animation-delay: 0.6s; height: 18px; }

    @keyframes steamCurl {
        0% { opacity: 0; transform: translateY(0) scaleX(1) rotate(0deg); }
        50% { opacity: 0.7; transform: translateY(-12px) scaleX(1.8) rotate(-5deg); }
        100% { opacity: 0; transform: translateY(-28px) scaleX(2.5) rotate(5deg); }
    }

    @keyframes cupBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
    }

    /* ── Gradient Text ── */
    .gradient-text {
        font-family: 'Playfair Display', serif;
        background: linear-gradient(135deg, var(--brown-dark), var(--brown), var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.2rem;
        letter-spacing: -0.5px;
    }

    .section-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    /* ── Checkout Progress Steps ── */
    .checkout-steps {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0;
        margin-bottom: 2.5rem;
        padding: 20px;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .step-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .step.completed .step-circle {
        background: linear-gradient(135deg, var(--brown), var(--brown-light));
        color: var(--cream);
        box-shadow: 0 4px 15px rgba(107, 79, 63, 0.35);
    }

    .step.active .step-circle {
        background: var(--cream);
        color: var(--brown);
        border: 2.5px solid var(--brown);
        box-shadow: 0 0 0 5px rgba(107, 79, 63, 0.15), 0 4px 15px rgba(107, 79, 63, 0.2);
        animation: activePulse 2s ease-in-out infinite;
    }

    @keyframes activePulse {
        0%, 100% { box-shadow: 0 0 0 5px rgba(107, 79, 63, 0.15), 0 4px 15px rgba(107, 79, 63, 0.2); }
        50% { box-shadow: 0 0 0 10px rgba(107, 79, 63, 0.08), 0 4px 20px rgba(107, 79, 63, 0.3); }
    }

    .step.inactive .step-circle {
        background: var(--cream-dark);
        color: var(--text-muted);
        border: 1.5px solid var(--cream-darker);
    }

    .step-label {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .step.completed .step-label { color: var(--brown); }
    .step.active .step-label { color: var(--brown-dark); font-weight: 700; }
    .step.inactive .step-label { color: var(--text-muted); }

    .step-line {
        width: 50px;
        height: 2.5px;
        margin: 0 6px;
        border-radius: 2px;
        position: relative;
        overflow: hidden;
    }

    .step-line.done {
        background: var(--brown);
    }

    .step-line.done::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        animation: lineShimmer 2s ease-in-out infinite;
    }

    @keyframes lineShimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .step-line.pending {
        background: var(--cream-darker);
    }

    /* ── Alerts ── */
    .alert-custom-success {
        background: rgba(39, 174, 96, 0.08);
        color: var(--success);
        border: 1px solid rgba(39, 174, 96, 0.2);
        border-radius: 14px;
        padding: 14px 20px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
    }

    .alert-custom-danger {
        background: rgba(192, 57, 43, 0.08);
        color: var(--danger);
        border: 1px solid rgba(192, 57, 43, 0.2);
        border-radius: 14px;
        padding: 14px 20px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
    }

    /* ── Cards ── */
    .dark-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 20px;
        border: 1px solid rgba(107, 79, 63, 0.1);
        box-shadow: 0 10px 40px rgba(107, 79, 63, 0.08), 0 1px 3px rgba(107, 79, 63, 0.05);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .dark-card:hover {
        box-shadow: 0 20px 60px rgba(107, 79, 63, 0.12), 0 1px 3px rgba(107, 79, 63, 0.08);
        transform: translateY(-2px);
        border-color: rgba(107, 79, 63, 0.18);
    }

    .card-header-dark {
        background: linear-gradient(135deg, var(--brown), var(--brown-light));
        color: var(--cream);
        font-weight: 700;
        padding: 16px 20px;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        border-bottom: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header-dark i {
        font-size: 1.1rem;
    }

    .cart-count {
        margin-left: auto;
        background: rgba(255, 255, 255, 0.2);
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    /* ── Billing Form ── */
    .billing-card {
        padding: 32px;
    }

    .billing-card h4 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--brown-dark);
        font-size: 1.4rem;
    }

    .billing-card h4 i {
        color: var(--brown);
        font-size: 1.4rem;
    }

    .form-label {
        color: var(--brown);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-label i {
        font-size: 0.75rem;
        color: var(--accent);
    }

    .form-control-dark {
        background: var(--cream-light);
        color: var(--text);
        border: 1.5px solid var(--cream-darker);
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        width: 100%;
        font-family: 'Inter', sans-serif;
    }

    .form-control-dark::placeholder {
        color: var(--text-muted);
        opacity: 0.5;
    }

    .form-control-dark:focus {
        outline: none;
        border-color: var(--brown);
        box-shadow: 0 0 0 4px rgba(107, 79, 63, 0.12), 0 4px 12px rgba(107, 79, 63, 0.08);
        background: #fff;
    }

    textarea.form-control-dark {
        resize: vertical;
        min-height: 80px;
    }

    /* ── Cart Items ── */
    .cart-item {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        border-bottom: 1px solid rgba(107, 79, 63, 0.08);
        transition: all 0.3s ease;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item:hover {
        background: rgba(107, 79, 63, 0.03);
    }

    .cart-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 14px;
        margin-right: 14px;
        border: 2px solid var(--cream-dark);
        transition: transform 0.3s ease;
    }

    .cart-item:hover .cart-img {
        transform: scale(1.05);
    }

    .cart-item-name {
        font-weight: 600;
        font-size: 0.92rem;
        margin-bottom: 2px;
        color: var(--brown-dark);
    }

    .cart-item-meta {
        color: var(--text-muted);
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .cart-item-meta i {
        font-size: 0.6rem;
    }

    .cart-item-price {
        font-weight: 700;
        color: var(--brown);
        white-space: nowrap;
        font-size: 0.95rem;
    }

    /* ── Payment ── */
    .dark-card h6 {
        color: var(--brown-dark);
        font-family: 'Playfair Display', serif;
        display: flex;
        align-items: center;
    }

    .dark-card h6 i {
        color: var(--brown);
    }

    .payment-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border: 1.5px solid var(--cream-darker);
        border-radius: 14px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        position: relative;
        overflow: hidden;
        background: var(--cream-light);
    }

    .payment-option::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(107, 79, 63, 0.04), transparent);
        opacity: 0;
        transition: 0.3s;
    }

    .payment-option:hover {
        border-color: var(--brown-lighter);
        background: white;
        transform: translateX(4px);
    }

    .payment-option:hover::before {
        opacity: 1;
    }

    .payment-option.selected {
        border-color: var(--brown);
        background: rgba(107, 79, 63, 0.05);
        box-shadow: 0 4px 20px rgba(107, 79, 63, 0.12);
    }

    .payment-option.selected .payment-icon-wrap {
        background: var(--brown);
        color: var(--cream);
    }

    .payment-option input[type="radio"] {
        accent-color: var(--brown);
        width: 18px;
        height: 18px;
    }

    .payment-icon-wrap {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--cream-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .payment-icon-wrap i {
        font-size: 1.2rem;
        color: var(--brown);
    }

    .payment-option.selected .payment-icon-wrap i {
        color: var(--cream);
    }

    .payment-label-text {
        flex: 1;
        color: var(--brown-dark);
        font-weight: 600;
    }

    .payment-label-sub {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    .payment-arrow {
        color: var(--cream-darker);
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }

    .payment-option:hover .payment-arrow,
    .payment-option.selected .payment-arrow {
        color: var(--brown);
        transform: translateX(3px);
    }

    /* ── Summary ── */
    .summary-card {
        background: rgba(255, 255, 255, 0.85);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.92rem;
    }

    .summary-row span:first-child {
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .summary-row span:first-child i {
        font-size: 0.8rem;
        color: var(--brown-lighter);
    }

    .summary-row span:last-child {
        font-weight: 600;
        color: var(--brown-dark);
    }

    .summary-divider {
        border: none;
        border-top: 1.5px dashed var(--cream-darker);
        margin: 16px 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-weight: 800;
        font-size: 1.3rem;
        color: var(--brown);
        font-family: 'Playfair Display', serif;
    }

    /* ── Checkout Button ── */
    .btn-checkout {
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--brown), var(--brown-light));
        color: var(--cream);
        font-weight: 800;
        font-size: 1rem;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        margin-top: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        font-family: 'Inter', sans-serif;
    }

    .btn-checkout::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.6s;
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(107, 79, 63, 0.35);
        background: linear-gradient(135deg, var(--brown-dark), var(--brown));
    }

    .btn-checkout:hover::before {
        left: 100%;
    }

    .btn-checkout:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(107, 79, 63, 0.25);
    }

    /* Coffee ripple effect on button */
    .btn-checkout::after {
        content: '';
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        animation: coffeeRipple 3s ease-in-out infinite;
    }

    @keyframes coffeeRipple {
        0% { transform: scale(0); opacity: 0.5; }
        50% { transform: scale(4); opacity: 0; }
        100% { transform: scale(0); opacity: 0; }
    }

    /* ── Sticky Sidebar ── */
    .sticky-sidebar {
        position: sticky;
        top: 90px;
    }

    /* ── Security Badge ── */
    .security-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: var(--text-muted);
        font-size: 0.78rem;
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid var(--cream-dark);
    }

    .security-badge i {
        color: var(--success);
        font-size: 0.85rem;
    }

    /* ── Empty Cart ── */
    .empty-cart {
        text-align: center;
        padding: 80px 20px;
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(107, 79, 63, 0.08);
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: var(--brown-lighter);
        opacity: 0.4;
        margin-bottom: 20px;
        animation: emptyCartBounce 3s ease-in-out infinite;
    }

    @keyframes emptyCartBounce {
        0%, 100% { transform: translateY(0) rotate(0); }
        25% { transform: translateY(-10px) rotate(-3deg); }
        75% { transform: translateY(-5px) rotate(3deg); }
    }

    .empty-cart h4 {
        color: var(--brown);
        margin-bottom: 8px;
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
    }

    .empty-cart-sub {
        color: var(--text-muted);
        margin-bottom: 24px;
        font-size: 0.95rem;
    }

    .btn-continue {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 32px;
        background: var(--brown);
        color: var(--cream);
        border: none;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .btn-continue:hover {
        background: var(--brown-dark);
        color: var(--cream);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 79, 63, 0.3);
    }

    /* ── Coffee Drip Decoration ── */
    .coffee-drip-decoration {
        position: relative;
        margin-top: -1px;
        z-index: 1;
    }

    .coffee-drip-decoration svg {
        display: block;
        width: 100%;
        height: 60px;
    }

    /* ── Animations ── */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-in {
        animation: fadeInUp 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    .animate-delay-1 {
        animation: slideInLeft 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        animation-delay: 0.2s;
        opacity: 0;
    }

    .animate-delay-2 {
        animation: slideInRight 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        animation-delay: 0.4s;
        opacity: 0;
    }

    .animate-delay-3 { animation-delay: 0.6s; opacity: 0; }
    .animate-delay-4 { animation-delay: 0.8s; opacity: 0; }

    /* ── Coffee Pour Loading Animation (for form submission) ── */
    @keyframes coffeePour {
        0% { height: 0; }
        100% { height: 100%; }
    }

    /* ── Input Focus Coffee Ring ── */
    .form-control-dark:focus {
        animation: coffeeFocusRing 0.4s ease-out;
    }

    @keyframes coffeeFocusRing {
        0% { box-shadow: 0 0 0 0 rgba(107, 79, 63, 0.3); }
        50% { box-shadow: 0 0 0 8px rgba(107, 79, 63, 0.1); }
        100% { box-shadow: 0 0 0 4px rgba(107, 79, 63, 0.12), 0 4px 12px rgba(107, 79, 63, 0.08); }
    }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: var(--cream); }
    ::-webkit-scrollbar-thumb {
        background: var(--brown-lighter);
        border-radius: 10px;
        border: 2px solid var(--cream);
    }
    ::-webkit-scrollbar-thumb:hover {
        background: var(--brown);
    }

    /* ── Responsive ── */
    @media (max-width: 991px) {
        .sticky-sidebar {
            position: static;
        }

        .checkout-steps {
            flex-wrap: wrap;
            gap: 4px;
        }

        .step-line {
            width: 30px;
        }

        .step-label {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .gradient-text {
            font-size: 1.6rem;
        }

        .billing-card {
            padding: 20px;
        }

        .cart-img {
            width: 48px;
            height: 48px;
        }

        .coffee-cup-wrapper {
            font-size: 2.2rem;
        }

        .checkout-steps {
            padding: 10px;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            font-size: 0.85rem;
        }

        .summary-total {
            font-size: 1.1rem;
        }

        .coffee-bean {
            display: none;
        }
    }

    /* ── Pattern overlay for depth ── */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(107, 79, 63, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(200, 149, 108, 0.04) 0%, transparent 50%),
            radial-gradient(circle at 50% 80%, rgba(107, 79, 63, 0.02) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    /* ── Selection Color ── */
    ::selection {
        background: var(--brown);
        color: var(--cream);
    }
</style>

@endsection