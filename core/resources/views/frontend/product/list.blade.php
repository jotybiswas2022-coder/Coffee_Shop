@extends('frontend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3 alert-success-custom ca-alert" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show m-3 alert-danger-custom ca-alert" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- ================= HERO MINI BANNER ================= -->
<section class="ca-hero-mini">
    <div class="ca-hero-overlay"></div>
    <!-- Floating Coffee Beans -->
    <div class="ca-bean ca-bean-1"><i class="bi bi-flower1"></i></div>
    <div class="ca-bean ca-bean-2"><i class="bi bi-flower1"></i></div>
    <div class="ca-bean ca-bean-3"><i class="bi bi-flower1"></i></div>
    <div class="ca-bean ca-bean-4"><i class="bi bi-flower1"></i></div>
    <div class="ca-bean ca-bean-5"><i class="bi bi-flower1"></i></div>
    <div class="ca-bean ca-bean-6"><i class="bi bi-flower1"></i></div>

    <div class="ca-hero-content">
        <div class="ca-steam-wrap">
            <div class="ca-steam ca-steam-1"></div>
            <div class="ca-steam ca-steam-2"></div>
            <div class="ca-steam ca-steam-3"></div>
            <i class="bi bi-cup-hot-fill ca-hero-icon"></i>
        </div>
        <h1 class="ca-hero-title">Our Menu</h1>
        <p class="ca-hero-subtitle">Freshly brewed, crafted with passion</p>
        <div class="ca-divider">
            <span class="ca-divider-bean"><i class="bi bi-three-dots"></i></span>
        </div>
    </div>
</section>

<!-- ================= PRODUCTS ================= -->
<section id="products" class="ca-products-section">
    <!-- Background Decorations -->
    <div class="ca-bg-circle ca-bg-circle-1"></div>
    <div class="ca-bg-circle ca-bg-circle-2"></div>
    <div class="ca-ring ca-ring-1"></div>
    <div class="ca-ring ca-ring-2"></div>

    <div class="ca-products-container">

        <div class="ca-section-header ca-animate" data-animation="fadeInUp">
            <span class="ca-label"><i class="bi bi-stars"></i> Café Aroma</span>
            <h2 class="ca-section-title">Latest Products</h2>
            <p class="ca-section-desc">Browse all available products from our finest collection</p>
            <div class="ca-title-underline">
                <span></span>
                <i class="bi bi-cup-hot"></i>
                <span></span>
            </div>
        </div>

        <div class="ca-products-grid">

            @forelse(($products ?? collect())->sortByDesc('created_at') as $product)
            <div class="ca-product-card ca-animate" data-animation="fadeInUp">

                @if($product->discount > 0)
                    <span class="ca-product-badge">
                        <i class="bi bi-tag-fill"></i> {{ $product->discount }}% OFF
                    </span>
                @endif

                <div class="ca-product-img-wrap">
                    <a href="{{ url('/item/'.$product->id) }}">
                        <img src="{{ $product->image ? config('app.storage_url').$product->image : asset('frontend/img/no-image.png') }}" alt="{{ $product->name }}">
                        <div class="ca-img-overlay">
                            <span class="ca-view-btn"><i class="bi bi-eye"></i> View Details</span>
                        </div>
                    </a>
                </div>

                <div class="ca-product-info">
                    <div class="ca-product-name">
                        {{ $product->name }}
                    </div>

                    <div class="ca-product-price-row">
                        <div class="ca-product-price">
                            @if($product->discount > 0)
                                <span class="ca-price-old">
                                    {{ number_format($product->price,2) }} {{ $currency }}
                                </span>
                                <span class="ca-price-current">
                                    {{ number_format($product->price - ($product->price*$product->discount/100),2) }} {{ $currency }}
                                </span>
                            @else
                                <span class="ca-price-current">
                                    {{ number_format($product->price,2) }} {{ $currency }}
                                </span>
                            @endif
                        </div>

                        @if(function_exists('IsAddedToCart') && IsAddedToCart(auth()->id(), $product->id))
                            <a href="{{ url('/item/'.$product->id) }}" class="ca-cart-btn ca-in-cart" title="Already in Cart">
                                <i class="bi bi-check-lg"></i>
                            </a>
                        @else
                            <a href="{{ url('/item/'.$product->id) }}" class="ca-cart-btn" title="Add to Cart">
                                <i class="bi bi-cart-plus"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="ca-empty-state">
                <div class="ca-empty-icon">
                    <i class="bi bi-cup"></i>
                </div>
                <h5>No Products Available</h5>
                <p>Check back soon for freshly added items!</p>
            </div>
            @endforelse

        </div>
    </div>
</section>

<style>
/* =============================================
   CAFÉ AROMA – PRODUCT SECTION THEME
   Colors: Brown #6B4F3F | Cream #F5F0E1
   ============================================= */

:root {
    --ca-brown: #6B4F3F;
    --ca-brown-dark: #523A2D;
    --ca-brown-light: #8B6F5F;
    --ca-cream: #F5F0E1;
    --ca-cream-dark: #E8DFCa;
    --ca-cream-light: #FAF8F0;
    --ca-accent: #D4A574;
    --ca-text: #3E2723;
    --ca-text-light: #7B6B63;
    --ca-white: #FFFFFF;
    --ca-shadow: rgba(107, 79, 63, 0.15);
    --ca-shadow-lg: rgba(107, 79, 63, 0.25);
}

/* ---- Alert Overrides ---- */
.ca-alert {
    font-family: 'Poppins', sans-serif;
    border: none;
    border-radius: 12px;
    font-size: 0.95rem;
}
.alert-success-custom {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
}
.alert-danger-custom {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
}

/* ---- HERO MINI BANNER ---- */
.ca-hero-mini {
    position: relative;
    background: linear-gradient(135deg, var(--ca-brown-dark) 0%, var(--ca-brown) 50%, var(--ca-brown-light) 100%);
    padding: 80px 20px 60px;
    text-align: center;
    overflow: hidden;
}
.ca-hero-overlay {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.ca-hero-content {
    position: relative;
    z-index: 2;
}

/* Steam Animation */
.ca-steam-wrap {
    position: relative;
    display: inline-block;
    margin-bottom: 16px;
}
.ca-hero-icon {
    font-size: 3.5rem;
    color: var(--ca-cream);
    filter: drop-shadow(0 4px 15px rgba(0,0,0,0.3));
    animation: ca-icon-pulse 3s ease-in-out infinite;
}
.ca-steam {
    position: absolute;
    width: 8px;
    height: 30px;
    background: rgba(245, 240, 225, 0.4);
    border-radius: 50%;
    filter: blur(5px);
    animation: ca-steam-rise 2s ease-out infinite;
}
.ca-steam-1 { left: 30%; top: -10px; animation-delay: 0s; }
.ca-steam-2 { left: 50%; top: -10px; animation-delay: 0.5s; }
.ca-steam-3 { left: 70%; top: -10px; animation-delay: 1s; }

@keyframes ca-steam-rise {
    0%   { opacity: 0; transform: translateY(0) scaleX(1); }
    30%  { opacity: 0.7; }
    70%  { opacity: 0.3; transform: translateY(-40px) scaleX(1.8); }
    100% { opacity: 0; transform: translateY(-70px) scaleX(2.5); }
}
@keyframes ca-icon-pulse {
    0%, 100% { transform: scale(1); }
    50%      { transform: scale(1.08); }
}

.ca-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 700;
    color: var(--ca-cream);
    margin: 0 0 8px;
    letter-spacing: 1px;
}
.ca-hero-subtitle {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    color: var(--ca-cream-dark);
    font-weight: 300;
    margin: 0;
    letter-spacing: 0.5px;
}
.ca-divider {
    margin-top: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
}
.ca-divider::before,
.ca-divider::after {
    content: '';
    width: 60px;
    height: 1px;
    background: var(--ca-accent);
    opacity: 0.5;
}
.ca-divider-bean {
    color: var(--ca-accent);
    font-size: 1.2rem;
    margin: 0 12px;
    animation: ca-bean-spin 8s linear infinite;
}
@keyframes ca-bean-spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

/* Floating Beans */
.ca-bean {
    position: absolute;
    color: rgba(245, 240, 225, 0.08);
    font-size: 2rem;
    animation: ca-float-bean 12s ease-in-out infinite;
    z-index: 1;
}
.ca-bean-1 { top: 15%; left: 8%;  font-size: 1.8rem; animation-duration: 14s; }
.ca-bean-2 { top: 60%; left: 5%;  font-size: 1.3rem; animation-duration: 10s; animation-delay: 2s; }
.ca-bean-3 { top: 25%; right: 10%; font-size: 2.2rem; animation-duration: 16s; animation-delay: 1s; }
.ca-bean-4 { top: 70%; right: 8%; font-size: 1.5rem; animation-duration: 11s; animation-delay: 3s; }
.ca-bean-5 { top: 40%; left: 15%; font-size: 1rem;  animation-duration: 13s; animation-delay: 4s; }
.ca-bean-6 { top: 50%; right: 15%; font-size: 1.6rem; animation-duration: 15s; animation-delay: 0.5s; }

@keyframes ca-float-bean {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    25%      { transform: translateY(-20px) rotate(90deg); }
    50%      { transform: translateY(10px) rotate(180deg); }
    75%      { transform: translateY(-15px) rotate(270deg); }
}

/* ---- PRODUCTS SECTION ---- */
.ca-products-section {
    position: relative;
    background: var(--ca-cream);
    padding: 80px 20px 100px;
    overflow: hidden;
    min-height: 60vh;
}

/* Background Decorations */
.ca-bg-circle {
    position: absolute;
    border-radius: 50%;
    opacity: 0.04;
    background: var(--ca-brown);
    pointer-events: none;
}
.ca-bg-circle-1 {
    width: 500px; height: 500px;
    top: -200px; right: -150px;
}
.ca-bg-circle-2 {
    width: 350px; height: 350px;
    bottom: -100px; left: -100px;
}
.ca-ring {
    position: absolute;
    border-radius: 50%;
    border: 2px solid var(--ca-brown);
    opacity: 0.04;
    pointer-events: none;
    animation: ca-ring-pulse 8s ease-in-out infinite;
}
.ca-ring-1 { width: 200px; height: 200px; top: 120px; left: 60px; }
.ca-ring-2 { width: 150px; height: 150px; bottom: 100px; right: 80px; animation-delay: 4s; }

@keyframes ca-ring-pulse {
    0%, 100% { transform: scale(1); opacity: 0.04; }
    50%      { transform: scale(1.15); opacity: 0.08; }
}

.ca-products-container {
    max-width: 1280px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

/* Section Header */
.ca-section-header {
    text-align: center;
    margin-bottom: 60px;
}
.ca-label {
    display: inline-block;
    font-family: 'Poppins', sans-serif;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 3px;
    color: var(--ca-brown-light);
    background: rgba(107, 79, 63, 0.08);
    padding: 6px 20px;
    border-radius: 30px;
    margin-bottom: 16px;
}
.ca-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.8rem;
    font-weight: 700;
    color: var(--ca-brown);
    margin: 0 0 12px;
}
.ca-section-desc {
    font-family: 'Poppins', sans-serif;
    font-size: 1.05rem;
    color: var(--ca-text-light);
    margin: 0 0 20px;
    font-weight: 300;
}
.ca-title-underline {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.ca-title-underline span {
    display: block;
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--ca-accent), transparent);
    border-radius: 2px;
}
.ca-title-underline i {
    color: var(--ca-accent);
    font-size: 1.2rem;
    animation: ca-icon-pulse 3s ease-in-out infinite;
}

/* Products Grid */
.ca-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
    gap: 30px;
}

/* Product Card */
.ca-product-card {
    position: relative;
    background: var(--ca-white);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px var(--ca-shadow);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.ca-product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--ca-brown), var(--ca-accent), var(--ca-brown));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.5s ease;
    z-index: 5;
}
.ca-product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 40px var(--ca-shadow-lg);
}
.ca-product-card:hover::before {
    transform: scaleX(1);
}

/* Badge */
.ca-product-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 30px;
    z-index: 4;
    display: flex;
    align-items: center;
    gap: 4px;
    box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
    animation: ca-badge-bounce 2s ease-in-out infinite;
}
@keyframes ca-badge-bounce {
    0%, 100% { transform: scale(1); }
    50%      { transform: scale(1.05); }
}

/* Image Wrapper */
.ca-product-img-wrap {
    width: 100%;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    position: relative;
    background: var(--ca-cream);
}
.ca-product-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.4s ease;
}
.ca-product-card:hover .ca-product-img-wrap img {
    transform: scale(1.1);
    filter: brightness(0.85);
}

/* Image Overlay */
.ca-img-overlay {
    position: absolute;
    inset: 0;
    background: rgba(107, 79, 63, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s ease;
}
.ca-product-card:hover .ca-img-overlay {
    opacity: 1;
}
.ca-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--ca-cream);
    font-family: 'Poppins', sans-serif;
    font-size: 0.9rem;
    font-weight: 500;
    padding: 10px 24px;
    border: 2px solid var(--ca-cream);
    border-radius: 30px;
    transform: translateY(20px);
    transition: all 0.4s ease 0.1s;
    letter-spacing: 0.5px;
}
.ca-product-card:hover .ca-view-btn {
    transform: translateY(0);
}
.ca-view-btn:hover {
    background: var(--ca-cream);
    color: var(--ca-brown);
}

/* Product Info */
.ca-product-info {
    padding: 20px;
}
.ca-product-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--ca-brown);
    margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
}
.ca-product-card:hover .ca-product-name {
    color: var(--ca-brown-dark);
}

/* Price Row */
.ca-product-price-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}
.ca-product-price {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.ca-price-old {
    font-family: 'Poppins', sans-serif;
    font-size: 0.82rem;
    color: #b0a090;
    text-decoration: line-through;
    font-weight: 400;
}
.ca-price-current {
    font-family: 'Poppins', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--ca-brown);
    letter-spacing: 0.3px;
}

/* Cart Button */
.ca-cart-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--ca-cream);
    color: var(--ca-brown);
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.35s ease;
    border: 2px solid transparent;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}
.ca-cart-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--ca-brown);
    border-radius: 50%;
    transform: scale(0);
    transition: transform 0.4s ease;
}
.ca-cart-btn i {
    position: relative;
    z-index: 1;
}
.ca-cart-btn:hover {
    color: var(--ca-cream);
    box-shadow: 0 4px 15px var(--ca-shadow-lg);
    transform: rotate(10deg) scale(1.1);
}
.ca-cart-btn:hover::before {
    transform: scale(1);
}

/* In Cart State */
.ca-in-cart {
    background: var(--ca-brown);
    color: var(--ca-cream);
    animation: ca-cart-success 0.5s ease;
}
.ca-in-cart::before {
    background: var(--ca-brown-dark);
}
@keyframes ca-cart-success {
    0%   { transform: scale(0.5); }
    50%  { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Empty State */
.ca-empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
}
.ca-empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 24px;
    background: rgba(107, 79, 63, 0.08);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: ca-empty-pulse 3s ease-in-out infinite;
}
.ca-empty-icon i {
    font-size: 2.5rem;
    color: var(--ca-brown-light);
}
@keyframes ca-empty-pulse {
    0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(107,79,63,0.1); }
    50%      { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(107,79,63,0); }
}
.ca-empty-state h5 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--ca-brown);
    margin: 0 0 8px;
}
.ca-empty-state p {
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    color: var(--ca-text-light);
    margin: 0;
}

/* ---- SCROLL ANIMATIONS ---- */
.ca-animate {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.ca-animate.ca-visible {
    opacity: 1;
    transform: translateY(0);
}

/* Stagger children */
.ca-products-grid .ca-product-card:nth-child(1)  { transition-delay: 0.05s; }
.ca-products-grid .ca-product-card:nth-child(2)  { transition-delay: 0.12s; }
.ca-products-grid .ca-product-card:nth-child(3)  { transition-delay: 0.19s; }
.ca-products-grid .ca-product-card:nth-child(4)  { transition-delay: 0.26s; }
.ca-products-grid .ca-product-card:nth-child(5)  { transition-delay: 0.33s; }
.ca-products-grid .ca-product-card:nth-child(6)  { transition-delay: 0.40s; }
.ca-products-grid .ca-product-card:nth-child(7)  { transition-delay: 0.47s; }
.ca-products-grid .ca-product-card:nth-child(8)  { transition-delay: 0.54s; }
.ca-products-grid .ca-product-card:nth-child(9)  { transition-delay: 0.61s; }
.ca-products-grid .ca-product-card:nth-child(10) { transition-delay: 0.68s; }
.ca-products-grid .ca-product-card:nth-child(11) { transition-delay: 0.75s; }
.ca-products-grid .ca-product-card:nth-child(12) { transition-delay: 0.82s; }

/* ---- Coffee Drip Animation on Section ---- */
.ca-products-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: linear-gradient(180deg, var(--ca-brown) 0%, transparent 100%);
    opacity: 0.04;
    pointer-events: none;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 992px) {
    .ca-hero-title { font-size: 2.4rem; }
    .ca-section-title { font-size: 2.2rem; }
    .ca-products-grid { gap: 24px; }
}
@media (max-width: 768px) {
    .ca-hero-mini { padding: 60px 16px 50px; }
    .ca-hero-title { font-size: 2rem; }
    .ca-hero-subtitle { font-size: 0.95rem; }
    .ca-products-section { padding: 60px 16px 80px; }
    .ca-section-title { font-size: 1.8rem; }
    .ca-section-desc { font-size: 0.9rem; }
    .ca-products-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }
    .ca-product-info { padding: 16px; }
    .ca-product-name { font-size: 1.05rem; }
    .ca-price-current { font-size: 1.05rem; }
}
@media (max-width: 480px) {
    .ca-products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    .ca-product-info { padding: 12px; }
    .ca-product-name { font-size: 0.95rem; }
    .ca-price-current { font-size: 0.95rem; }
    .ca-price-old { font-size: 0.75rem; }
    .ca-cart-btn { width: 38px; height: 38px; font-size: 1rem; }
    .ca-hero-title { font-size: 1.7rem; }
    .ca-section-header { margin-bottom: 40px; }
}
</style>

<script>
// Scroll Animation Observer
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.ca-animate');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('ca-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -40px 0px'
    });

    animatedElements.forEach(el => observer.observe(el));
});
</script>

@endsection
