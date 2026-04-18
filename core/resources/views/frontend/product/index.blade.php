@extends('frontend.app')

@section('content')

{{-- ===== Alert Messages ===== --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3 alert-success-custom" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show m-3 alert-danger-custom" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="product-page py-5">

    {{-- Falling Coffee Bean Particles --}}
    <div class="coffee-bean-particle"></div>
    <div class="coffee-bean-particle"></div>
    <div class="coffee-bean-particle"></div>
    <div class="coffee-bean-particle"></div>
    <div class="coffee-bean-particle"></div>
    <div class="coffee-bean-particle"></div>
    <div class="coffee-bean-particle"></div>
    <div class="coffee-bean-particle"></div>

    {{-- Steam Decoration --}}
    <div class="steam-container">
        <div class="steam-line"></div>
        <div class="steam-line"></div>
        <div class="steam-line"></div>
    </div>

    {{-- SVG Coffee Cup Decoration --}}
    <svg class="coffee-cup-deco" viewBox="0 0 100 100" fill="currentColor" color="#6B4F3F">
        <path d="M20 30h50v5H20zM15 40h60c0 25-10 45-30 48C25 85 15 65 15 40zm62-2h8c6 0 10 5 10 12s-4 12-10 12h-6c-1-8-2-16-2-24z"/>
    </svg>

    <!-- Product Detail -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product-card p-4 p-md-5">

                    <div class="row g-5 align-items-start">

                        <!-- Image -->
                        <div class="col-md-6 text-center position-relative animate-in delay-1">
                            <div class="image-wrapper position-relative">
                                <img src="{{ config('app.storage_url') }}{{ $product->image }}"
                                     alt="{{ $product->name }}"
                                     class="img-fluid main-image">
                                @if($product->discount)
                                    <span class="discount-badge-3d">
                                        <i class="bi bi-tag-fill me-1"></i>{{ $product->discount }}% OFF
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="col-md-6 animate-in delay-2">
                            <h2 class="fw-bold mt-2 product-title">{{ $product->name }}</h2>

                            <!-- Price -->
                            <div class="price-box my-4">
                                @if($product->discount)
                                    <div>
                                        <span class="original-price">
                                            <i class="bi bi-currency-exchange me-1"></i>{{ number_format($product->price, 2) }} {{ currency() }}
                                        </span>
                                    </div>
                                    <h4 class="discounted-price">
                                        <i class="bi bi-fire me-1"></i>{{ number_format($product->price * (100 - $product->discount)/100, 2) }} {{ currency() }}
                                    </h4>
                                @else
                                    <h4 class="final-price">
                                        <i class="bi bi-cup-hot-fill me-1"></i>{{ number_format($product->price, 2) }} {{ currency() }}
                                    </h4>
                                @endif
                            </div>

                            <!-- Stock -->
                            @if($product->stock > 0)
                                <div class="stock-status mb-3">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" style="width:100%"></div>
                                    </div>
                                    <small class="fw-semibold mt-1 d-block">
                                        <i class="bi bi-check-circle-fill text-success me-1"></i>
                                        In Stock ({{number_format($product->stock, 0) }} available)
                                    </small>
                                </div>
                            @else
                                <div class="stock-status mb-3">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width:100%"></div>
                                    </div>
                                    <small class="fw-semibold mt-1 d-block text-danger">
                                        <i class="bi bi-x-circle-fill me-1"></i>
                                        Out of Stock
                                    </small>
                                </div>
                            @endif

                            <!-- View Details Button -->
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-dark btn-lg w-100" data-bs-toggle="modal" data-bs-target="#productDetailsModal">
                                    <i class="bi bi-info-circle me-2"></i> View Details
                                </button>
                            </div>

                            <!-- Cart Buttons -->
                            @if($product->stock <= 0)
                                <button class="btn btn-dark-theme btn-lg w-100" disabled>
                                    <i class="bi bi-x-circle me-2"></i> Out of Stock
                                </button>
                            @elseif (IsAddedToCart(auth()->id(), $product->id))
                                <button class="btn btn-dark-theme btn-lg w-100" disabled>
                                    <i class="bi bi-cart-check-fill me-2"></i> Already Added
                                </button>
                            @else
                                <a href="{{ url('/add_cart/'.$product->id) }}" class="btn btn-dark-theme btn-lg w-100">
                                    <i class="bi bi-cart-plus-fill me-2"></i> Add to Cart
                                </a>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Modal -->
    <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              
              <div class="modal-header">
                <h5 class="modal-title fw-bold" id="productDetailsModalLabel">{{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6 text-center mb-3">
                    <img src="{{ config('app.storage_url') }}{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded">
                  </div>
                  <div class="col-md-6">
                    <h6 class="fw-semibold mb-2"><i class="bi bi-cash-coin me-1"></i> Price:</h6>
                    @if($product->discount)
                        <span class="text-muted text-decoration-line-through">
                            {{ number_format($product->price,2) }} {{ currency() }}
                        </span>
                        <span class="fw-bold ms-2 text-danger">
                            {{ number_format($product->price * (100 - $product->discount)/100,2) }} {{ currency() }}
                        </span>
                    @else
                        <span class="fw-bold" style="color: var(--cafe-brown);">
                            {{ number_format($product->price,2) }} {{ currency() }}
                        </span>
                    @endif

                    <h6 class="fw-semibold mt-3"><i class="bi bi-box-seam me-1"></i> Stock:</h6>
                    @if($product->stock > 0)
                        <span class="text-success"><i class="bi bi-check-circle me-1"></i>{{number_format($product->stock, 0) }} available</span>
                    @else
                        <span class="text-danger"><i class="bi bi-x-circle me-1"></i>Out of Stock</span>
                    @endif

                    <h6 class="fw-semibold mt-3"><i class="bi bi-card-text me-1"></i> Details:</h6>
                    <div style="color: #555; line-height: 1.7;">{!! $product->details !!}</div>
                  </div>
                </div>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i> Close
                </button>
                @if($product->stock > 0 && !IsAddedToCart(auth()->id(), $product->id))
                    <a href="{{ url('/add_cart/'.$product->id) }}" class="btn btn-dark-theme">
                        <i class="bi bi-cart-plus-fill me-2"></i> Add to Cart
                    </a>
                @endif
              </div>

            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="container mt-5 pt-3 animate-in delay-3">
        <h3 class="section-title mb-4">Related Items</h3>

        @if($otherProducts->where('id', '!=', $product->id)->count() > 0)
            <div class="swiper mySwiper mt-3">
                <div class="swiper-wrapper">
                    @foreach($otherProducts as $item)
                        @if($item->id != $product->id)
                            <div class="swiper-slide">
                                <div class="related-card rounded-3 text-center p-3">
                                    <a href="{{ url('/item/'.$item->id) }}" class="text-decoration-none">
                                        <div class="related-img-wrapper position-relative mb-2">
                                            <img src="{{ config('app.storage_url') }}{{ $item->image }}"
                                                 class="img-fluid related-img">
                                            @if($item->discount)
                                                <span class="discount-badge-small">
                                                    <i class="bi bi-tag-fill me-1"></i>{{ $item->discount }}% OFF
                                                </span>
                                            @endif
                                        </div>
                                        <h6 class="fw-semibold mb-1">{{ $item->name }}</h6>
                                    </a>
                                    <div class="mb-2">
                                        @if($item->discount)
                                            <span class="old-price small">
                                                {{ number_format($item->price,2) }} {{ currency() }}
                                            </span>
                                            <span class="new-price">
                                                <i class="bi bi-fire"></i> {{ number_format($item->price * (100 - $item->discount)/100,2) }} {{ currency() }}
                                            </span>
                                        @else
                                            <span class="new-price">
                                                {{ number_format($item->price,2) }} {{ currency() }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        @endif
    </div>

</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 25,
    loop: true,
    autoplay: { delay: 3000, disableOnInteraction: false },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    breakpoints: {
        0:   { slidesPerView: 1, spaceBetween: 15 },
        576: { slidesPerView: 2, spaceBetween: 20 },
        768: { slidesPerView: 3, spaceBetween: 20 },
        992: { slidesPerView: 4, spaceBetween: 25 },
    },
});

// Scroll-triggered Animations
const observerOptions = { threshold: 0.1 };
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-in').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    observer.observe(el);
});

// Auto-dismiss alerts after 5 seconds
document.querySelectorAll('.alert-dismissible').forEach(alert => {
    setTimeout(() => {
        alert.style.transition = 'all 0.5s ease';
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        setTimeout(() => alert.remove(), 500);
    }, 5000);
});
</script>


<style>
/* ============================================
   Café Aroma — Coffee Shop Theme
   Primary: #6B4F3F (Brown)
   Secondary: #F5F0E1 (Cream)
   ============================================ */

:root {
    --cafe-brown: #6B4F3F;
    --cafe-brown-dark: #5A3E30;
    --cafe-brown-light: #8B6F5F;
    --cafe-cream: #F5F0E1;
    --cafe-cream-dark: #E8DEC8;
    --cafe-cream-light: #FBF8F0;
    --cafe-espresso: #3C2415;
    --cafe-latte: #C4A882;
    --cafe-mocha: #967259;
    --cafe-gold: #D4A96A;
    --cafe-shadow: rgba(107, 79, 63, 0.15);
    --cafe-shadow-strong: rgba(107, 79, 63, 0.3);
}

/* ===== Page Wrapper ===== */
.product-page {
    position: relative;
    background: linear-gradient(170deg, var(--cafe-cream) 0%, var(--cafe-cream-light) 40%, var(--cafe-cream-dark) 100%);
    min-height: 100vh;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Coffee grain texture overlay */
.product-page::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-image:
        radial-gradient(ellipse at 20% 50%, rgba(107,79,63,0.03) 0%, transparent 50%),
        radial-gradient(ellipse at 80% 20%, rgba(107,79,63,0.04) 0%, transparent 50%),
        radial-gradient(ellipse at 50% 80%, rgba(107,79,63,0.02) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.product-page > .container {
    position: relative;
    z-index: 1;
}

.product-page > .steam-container,
.product-page > .coffee-cup-deco,
.product-page > .coffee-bean-particle {
    z-index: 0;
}

/* ===== Alert Styles ===== */
.alert-success-custom {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 1px solid #b1dfbb;
    color: #155724;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.15);
    animation: alertSlideIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.alert-danger-custom {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    border: 1px solid #f1b0b7;
    color: #721c24;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.15);
    animation: alertSlideIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

@keyframes alertSlideIn {
    from { opacity: 0; transform: translateY(-30px) scale(0.95); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* ===== Falling Coffee Bean Particles ===== */
.coffee-bean-particle {
    position: absolute;
    width: 14px;
    height: 20px;
    background: var(--cafe-brown);
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
    opacity: 0;
    z-index: 0;
    pointer-events: none;
    animation: fallBean linear infinite;
    box-shadow:
        inset -2px -2px 4px rgba(0,0,0,0.3),
        inset 2px 2px 4px rgba(255,255,255,0.1);
}

/* Coffee bean center line */
.coffee-bean-particle::before {
    content: '';
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%);
    width: 1.5px;
    height: 40%;
    background: rgba(0,0,0,0.3);
    border-radius: 1px;
}

.coffee-bean-particle:nth-child(1) { left: 5%;  animation-duration: 12s; animation-delay: 0s;   width: 10px; height: 15px; }
.coffee-bean-particle:nth-child(2) { left: 15%; animation-duration: 15s; animation-delay: 2s;   width: 12px; height: 18px; }
.coffee-bean-particle:nth-child(3) { left: 30%; animation-duration: 11s; animation-delay: 4s;   width: 8px;  height: 12px; }
.coffee-bean-particle:nth-child(4) { left: 45%; animation-duration: 14s; animation-delay: 1s;   width: 14px; height: 20px; }
.coffee-bean-particle:nth-child(5) { left: 60%; animation-duration: 13s; animation-delay: 3s;   width: 11px; height: 16px; }
.coffee-bean-particle:nth-child(6) { left: 75%; animation-duration: 16s; animation-delay: 5s;   width: 9px;  height: 13px; }
.coffee-bean-particle:nth-child(7) { left: 88%; animation-duration: 12s; animation-delay: 2.5s; width: 13px; height: 19px; }
.coffee-bean-particle:nth-child(8) { left: 95%; animation-duration: 14s; animation-delay: 6s;   width: 10px; height: 14px; }

@keyframes fallBean {
    0%   { top: -5%; opacity: 0; transform: rotate(0deg) translateX(0); }
    10%  { opacity: 0.25; }
    50%  { opacity: 0.15; }
    90%  { opacity: 0.08; }
    100% { top: 105%; opacity: 0; transform: rotate(720deg) translateX(40px); }
}

/* ===== Steam Animation ===== */
.steam-container {
    position: absolute;
    top: 60px;
    right: 80px;
    display: flex;
    gap: 10px;
    z-index: 0;
    pointer-events: none;
}

.steam-line {
    width: 3px;
    height: 60px;
    background: linear-gradient(to top, rgba(107,79,63,0.12), transparent);
    border-radius: 50px;
    animation: steamRise 3s ease-in-out infinite;
    transform-origin: bottom center;
}

.steam-line:nth-child(1) { animation-delay: 0s;    height: 50px; }
.steam-line:nth-child(2) { animation-delay: 0.5s;  height: 65px; }
.steam-line:nth-child(3) { animation-delay: 1s;    height: 45px; }

@keyframes steamRise {
    0%   { opacity: 0; transform: translateY(0) scaleY(0.5) scaleX(1); }
    30%  { opacity: 0.4; }
    50%  { transform: translateY(-25px) scaleY(1.2) scaleX(1.3); opacity: 0.25; }
    100% { opacity: 0; transform: translateY(-55px) scaleY(1.5) scaleX(0.6); }
}

/* ===== SVG Coffee Cup Decoration ===== */
.coffee-cup-deco {
    position: absolute;
    bottom: 30px;
    left: 30px;
    width: 80px;
    height: 80px;
    opacity: 0.06;
    z-index: 0;
    pointer-events: none;
    animation: cupFloat 6s ease-in-out infinite;
}

@keyframes cupFloat {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50%      { transform: translateY(-10px) rotate(3deg); }
}

/* ===== Product Card ===== */
.product-card {
    background: linear-gradient(145deg, #ffffff 0%, var(--cafe-cream-light) 100%);
    border-radius: 24px;
    box-shadow:
        0 20px 60px var(--cafe-shadow),
        0 8px 20px rgba(107,79,63,0.08),
        inset 0 1px 0 rgba(255,255,255,0.8);
    border: 1px solid rgba(107,79,63,0.08);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    position: relative;
    overflow: hidden;
}

.product-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--cafe-brown), var(--cafe-gold), var(--cafe-brown));
    border-radius: 24px 24px 0 0;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow:
        0 30px 80px var(--cafe-shadow-strong),
        0 12px 30px rgba(107,79,63,0.12),
        inset 0 1px 0 rgba(255,255,255,0.8);
}

/* ===== Image Wrapper ===== */
.image-wrapper {
    background: linear-gradient(135deg, var(--cafe-cream) 0%, var(--cafe-cream-dark) 100%);
    border-radius: 20px;
    padding: 20px;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 2px 15px rgba(107,79,63,0.08);
}

.image-wrapper::before {
    content: '';
    position: absolute;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: conic-gradient(
        from 0deg,
        transparent 0deg,
        rgba(107,79,63,0.03) 60deg,
        transparent 120deg
    );
    animation: imageShimmer 8s linear infinite;
    pointer-events: none;
}

@keyframes imageShimmer {
    0%   { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.main-image {
    border-radius: 16px;
    max-height: 420px;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 8px 20px rgba(107,79,63,0.2));
}

.image-wrapper:hover .main-image {
    transform: scale(1.05) rotate(1deg);
}

/* ===== Discount Badge ===== */
.discount-badge-3d {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: #fff;
    padding: 8px 16px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 700;
    z-index: 2;
    box-shadow:
        0 4px 15px rgba(220,53,69,0.4),
        0 2px 5px rgba(0,0,0,0.1);
    animation: badgePulse 2s ease-in-out infinite;
    letter-spacing: 0.5px;
}

@keyframes badgePulse {
    0%, 100% { transform: scale(1); }
    50%      { transform: scale(1.06); }
}

/* ===== Product Title ===== */
.product-title {
    color: var(--cafe-espresso);
    font-size: 1.9rem;
    letter-spacing: -0.5px;
    position: relative;
    display: inline-block;
}

.product-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, var(--cafe-brown), var(--cafe-gold));
    border-radius: 3px;
    animation: titleLineExpand 1.5s ease-out forwards;
}

@keyframes titleLineExpand {
    from { width: 0; }
    to   { width: 50px; }
}

/* ===== Price Styles ===== */
.price-box {
    background: linear-gradient(135deg, var(--cafe-cream) 0%, var(--cafe-cream-dark) 100%);
    border-radius: 16px;
    padding: 18px 22px;
    border: 1px solid rgba(107,79,63,0.1);
    position: relative;
    overflow: hidden;
}

.price-box::before {
    content: '\2615';
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 2.5rem;
    opacity: 0.06;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    font-size: 1rem;
}

.discounted-price {
    color: #dc3545;
    font-weight: 800;
    font-size: 1.6rem;
    margin-bottom: 0;
}

.final-price {
    color: var(--cafe-brown);
    font-weight: 800;
    font-size: 1.6rem;
    margin-bottom: 0;
}

.final-price .bi,
.discounted-price .bi {
    animation: priceIconBounce 2s ease-in-out infinite;
}

@keyframes priceIconBounce {
    0%, 100% { transform: translateY(0); }
    50%      { transform: translateY(-3px); }
}

/* ===== Stock Status ===== */
.stock-status .progress {
    height: 6px;
    border-radius: 10px;
    background: rgba(107,79,63,0.1);
    overflow: hidden;
}

.stock-status .progress-bar {
    border-radius: 10px;
    animation: progressFill 1.5s ease-out;
    position: relative;
}

.stock-status .progress-bar::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(
        90deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,0.4) 50%,
        rgba(255,255,255,0) 100%
    );
    animation: progressShine 2s ease-in-out infinite;
}

@keyframes progressFill {
    from { width: 0 !important; }
}

@keyframes progressShine {
    0%   { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* ===== Buttons ===== */
.btn-dark-theme {
    background: linear-gradient(135deg, var(--cafe-brown) 0%, var(--cafe-brown-dark) 100%);
    color: var(--cafe-cream) !important;
    border: none;
    border-radius: 14px;
    font-weight: 600;
    letter-spacing: 0.3px;
    padding: 14px 28px;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    box-shadow: 0 6px 20px rgba(107,79,63,0.3);
}

.btn-dark-theme::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(245,240,225,0.15),
        transparent
    );
    transition: left 0.6s ease;
}

.btn-dark-theme:hover::before {
    left: 100%;
}

.btn-dark-theme:hover {
    background: linear-gradient(135deg, var(--cafe-brown-dark) 0%, var(--cafe-espresso) 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(107,79,63,0.4);
    color: var(--cafe-cream) !important;
}

.btn-dark-theme:active {
    transform: translateY(0);
    box-shadow: 0 4px 12px rgba(107,79,63,0.3);
}

.btn-dark-theme:disabled {
    background: linear-gradient(135deg, #999 0%, #777 100%);
    box-shadow: none;
    cursor: not-allowed;
    opacity: 0.7;
}

.btn-dark-theme:disabled::before {
    display: none;
}

/* View Details Button */
.btn-outline-dark {
    border: 2px solid var(--cafe-brown) !important;
    color: var(--cafe-brown) !important;
    border-radius: 14px;
    font-weight: 600;
    padding: 12px 28px;
    background: transparent;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.btn-outline-dark::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 0; height: 100%;
    background: var(--cafe-brown);
    transition: width 0.4s ease;
    z-index: -1;
}

.btn-outline-dark:hover::before {
    width: 100%;
}

.btn-outline-dark:hover {
    color: var(--cafe-cream) !important;
    border-color: var(--cafe-brown) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(107,79,63,0.25);
}

/* ===== Modal Styles ===== */
.modal-content {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 80px rgba(0,0,0,0.2);
    background: linear-gradient(145deg, #fff, var(--cafe-cream-light));
}

.modal-header {
    background: linear-gradient(135deg, var(--cafe-brown) 0%, var(--cafe-brown-dark) 100%);
    color: var(--cafe-cream);
    border-bottom: none;
    padding: 20px 28px;
}

.modal-header .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
    opacity: 0.8;
    transition: opacity 0.3s;
}

.modal-header .btn-close:hover {
    opacity: 1;
}

.modal-title {
    letter-spacing: -0.3px;
}

.modal-body {
    padding: 28px;
}

.modal-body img {
    border-radius: 16px;
    box-shadow: 0 8px 25px var(--cafe-shadow);
    transition: transform 0.3s ease;
}

.modal-body img:hover {
    transform: scale(1.02);
}

.modal-body h6 {
    color: var(--cafe-brown);
}

.modal-footer {
    border-top: 1px solid rgba(107,79,63,0.1);
    padding: 16px 28px;
    background: var(--cafe-cream-light);
}

.modal-footer .btn-secondary {
    background: var(--cafe-brown-light);
    border: none;
    border-radius: 12px;
    color: var(--cafe-cream);
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s;
}

.modal-footer .btn-secondary:hover {
    background: var(--cafe-brown);
}

/* ===== Section Title ===== */
.section-title {
    color: var(--cafe-espresso);
    font-weight: 800;
    font-size: 1.7rem;
    position: relative;
    display: inline-block;
    padding-bottom: 12px;
}

.section-title::before {
    content: '\f5cb';
    font-family: 'bootstrap-icons';
    margin-right: 10px;
    color: var(--cafe-brown);
    font-size: 1.4rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, var(--cafe-brown), var(--cafe-gold), transparent);
    border-radius: 3px;
}

/* ===== Related Products Card ===== */
.related-card {
    background: linear-gradient(145deg, #ffffff, var(--cafe-cream-light));
    border: 1px solid rgba(107,79,63,0.08);
    border-radius: 18px !important;
    box-shadow: 0 6px 20px var(--cafe-shadow);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    overflow: hidden;
}

.related-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--cafe-brown), var(--cafe-gold));
    transform: scaleX(0);
    transition: transform 0.4s ease;
    border-radius: 18px 18px 0 0;
}

.related-card:hover::before {
    transform: scaleX(1);
}

.related-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 40px var(--cafe-shadow-strong);
    border-color: rgba(107,79,63,0.15);
}

.related-card a {
    color: var(--cafe-espresso) !important;
    transition: color 0.3s;
}

.related-card:hover a h6 {
    color: var(--cafe-brown) !important;
}

.related-img-wrapper {
    background: linear-gradient(135deg, var(--cafe-cream), var(--cafe-cream-dark));
    border-radius: 14px;
    padding: 12px;
    overflow: hidden;
}

.related-img {
    border-radius: 10px;
    max-height: 180px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.related-card:hover .related-img {
    transform: scale(1.08);
}

.discount-badge-small {
    position: absolute;
    top: 8px;
    right: 8px;
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: #fff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 700;
    box-shadow: 0 3px 10px rgba(220,53,69,0.3);
    z-index: 2;
}

.old-price {
    text-decoration: line-through;
    color: #999;
}

.new-price {
    color: var(--cafe-brown);
    font-weight: 700;
    font-size: 0.95rem;
}

.new-price .bi-fire {
    color: #dc3545;
}

/* ===== Swiper Navigation ===== */
.swiper-button-next,
.swiper-button-prev {
    color: var(--cafe-brown) !important;
    background: rgba(255,255,255,0.9);
    width: 44px !important;
    height: 44px !important;
    border-radius: 50%;
    box-shadow: 0 4px 15px var(--cafe-shadow);
    transition: all 0.3s ease;
}

.swiper-button-next::after,
.swiper-button-prev::after {
    font-size: 18px !important;
    font-weight: 700;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: var(--cafe-brown);
    color: var(--cafe-cream) !important;
    transform: scale(1.1);
}

/* ===== Scroll Animations ===== */
.animate-in {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.animate-in.delay-1 { transition-delay: 0.1s; }
.animate-in.delay-2 { transition-delay: 0.3s; }
.animate-in.delay-3 { transition-delay: 0.5s; }

/* ===== Floating Coffee Beans Background Decoration ===== */
.product-page::after {
    content: '';
    position: absolute;
    bottom: -50px;
    right: -30px;
    width: 200px;
    height: 200px;
    background: radial-gradient(ellipse, rgba(107,79,63,0.04) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    animation: bgBlobFloat 10s ease-in-out infinite;
}

@keyframes bgBlobFloat {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33%      { transform: translate(-20px, -15px) scale(1.1); }
    66%      { transform: translate(10px, -25px) scale(0.95); }
}

/* ===== Latte Art Ripple on Image Hover ===== */
.image-wrapper::after {
    content: '';
    position: absolute;
    top: 50%; left: 50%;
    width: 0; height: 0;
    background: radial-gradient(circle, rgba(107,79,63,0.08) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    pointer-events: none;
    z-index: 0;
}

.image-wrapper:hover::after {
    width: 300px;
    height: 300px;
}

/* ===== Coffee Cup Steam on Price Box ===== */
.price-box::after {
    content: '';
    position: absolute;
    top: 5px;
    right: 35px;
    width: 2px;
    height: 20px;
    background: linear-gradient(to top, rgba(107,79,63,0.1), transparent);
    border-radius: 10px;
    animation: miniSteam 2.5s ease-in-out infinite;
}

@keyframes miniSteam {
    0%   { opacity: 0; transform: translateY(0) scaleX(1); }
    50%  { opacity: 0.5; transform: translateY(-8px) scaleX(1.5); }
    100% { opacity: 0; transform: translateY(-18px) scaleX(0.5); }
}

/* ===== Responsive Tweaks ===== */
@media (max-width: 767.98px) {
    .product-card {
        border-radius: 18px;
    }

    .product-title {
        font-size: 1.5rem;
    }

    .steam-container {
        top: 30px;
        right: 40px;
    }

    .coffee-cup-deco {
        width: 50px;
        height: 50px;
        bottom: 15px;
        left: 15px;
    }

    .main-image {
        max-height: 300px;
    }

    .btn-dark-theme,
    .btn-outline-dark {
        padding: 12px 20px;
        border-radius: 12px;
    }

    .section-title {
        font-size: 1.4rem;
    }

    .swiper-button-next,
    .swiper-button-prev {
        width: 36px !important;
        height: 36px !important;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 14px !important;
    }
}

@media (max-width: 575.98px) {
    .coffee-bean-particle:nth-child(n+5) {
        display: none;
    }

    .product-card {
        border-radius: 14px;
    }

    .image-wrapper {
        padding: 12px;
        border-radius: 14px;
    }
}

/* ===== Drip Animation on Page Load ===== */
@keyframes coffeeDrip {
    0%   { height: 0; opacity: 1; }
    60%  { height: 80px; opacity: 0.6; }
    100% { height: 80px; opacity: 0; }
}

.product-card::after {
    content: '';
    position: absolute;
    top: 4px;
    left: 60px;
    width: 3px;
    height: 0;
    background: linear-gradient(to bottom, var(--cafe-brown), transparent);
    border-radius: 0 0 3px 3px;
    animation: coffeeDrip 2s ease-out 0.5s forwards;
    pointer-events: none;
    z-index: 0;
}

/* ===== Pour-over effect on hover of Add to Cart ===== */
.btn-dark-theme .bi {
    transition: transform 0.4s ease;
}

.btn-dark-theme:hover .bi {
    animation: cartWiggle 0.5s ease;
}

@keyframes cartWiggle {
    0%   { transform: rotate(0deg); }
    25%  { transform: rotate(-10deg); }
    50%  { transform: rotate(10deg); }
    75%  { transform: rotate(-5deg); }
    100% { transform: rotate(0deg); }
}

/* ===== Mug Ring Stain Decoration ===== */
.product-page > .container::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -20px;
    width: 120px;
    height: 120px;
    border: 3px solid rgba(107,79,63,0.04);
    border-radius: 50%;
    pointer-events: none;
}

/* ===== Scroll bar styling ===== */
.product-page ::-webkit-scrollbar {
    width: 6px;
}

.product-page ::-webkit-scrollbar-track {
    background: var(--cafe-cream);
}

.product-page ::-webkit-scrollbar-thumb {
    background: var(--cafe-brown-light);
    border-radius: 3px;
}

.product-page ::-webkit-scrollbar-thumb:hover {
    background: var(--cafe-brown);
}
</style>

@endsection
