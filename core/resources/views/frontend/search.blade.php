@extends('frontend.app')

@section('content')

@php
use App\Models\Setting;
$settings = Setting::first();
$currency = $settings?->currency ?? '৳';
@endphp

<style>
/* ===== Café Aroma Theme Variables ===== */
:root {
    --cafe-brown: #6B4F3F;
    --cafe-brown-dark: #5A3E2E;
    --cafe-brown-light: #8B6F5F;
    --cafe-cream: #F5F0E1;
    --cafe-cream-dark: #E8DCC8;
    --cafe-cream-light: #FAF8F2;
    --cafe-espresso: #3C2415;
    --cafe-latte: #D4A574;
    --cafe-mocha: #4A3728;
    --cafe-caramel: #C4956A;
    --cafe-foam: #FFF8EE;
}

/* ===== Coffee Bean Background Pattern ===== */
.cafe-page-wrapper {
    background: var(--cafe-cream-light);
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

.cafe-page-wrapper::before {
    content: '';
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background:
        radial-gradient(ellipse 3px 4px at 10% 20%, var(--cafe-brown) 0%, transparent 100%),
        radial-gradient(ellipse 2px 3px at 85% 15%, var(--cafe-brown-light) 0%, transparent 100%),
        radial-gradient(ellipse 3px 4px at 45% 80%, var(--cafe-brown) 0%, transparent 100%),
        radial-gradient(ellipse 2px 3px at 70% 60%, var(--cafe-brown-light) 0%, transparent 100%),
        radial-gradient(ellipse 3px 4px at 25% 55%, var(--cafe-brown) 0%, transparent 100%),
        radial-gradient(ellipse 2px 3px at 90% 85%, var(--cafe-brown-light) 0%, transparent 100%);
    opacity: 0.06;
    pointer-events: none;
    z-index: 0;
}

/* ===== Steam Animation ===== */
@keyframes steamRise {
    0% { transform: translateY(0) scaleX(1); opacity: 0; }
    15% { opacity: 0.6; }
    50% { transform: translateY(-40px) scaleX(1.3); opacity: 0.3; }
    100% { transform: translateY(-80px) scaleX(1.6); opacity: 0; }
}

@keyframes steamRise2 {
    0% { transform: translateY(0) scaleX(1) rotate(0deg); opacity: 0; }
    15% { opacity: 0.5; }
    50% { transform: translateY(-50px) scaleX(1.2) rotate(5deg); opacity: 0.2; }
    100% { transform: translateY(-90px) scaleX(1.5) rotate(-5deg); opacity: 0; }
}

@keyframes steamRise3 {
    0% { transform: translateY(0) scaleX(1) rotate(0deg); opacity: 0; }
    20% { opacity: 0.4; }
    60% { transform: translateY(-35px) scaleX(1.4) rotate(-3deg); opacity: 0.15; }
    100% { transform: translateY(-70px) scaleX(1.7) rotate(3deg); opacity: 0; }
}

.steam-container {
    position: absolute;
    top: -10px;
    right: 30px;
    width: 60px;
    height: 80px;
    pointer-events: none;
    z-index: 2;
}

.steam {
    position: absolute;
    bottom: 0;
    width: 6px;
    height: 20px;
    border-radius: 50%;
    background: var(--cafe-brown-light);
    filter: blur(4px);
}

.steam:nth-child(1) {
    left: 15px;
    animation: steamRise 2.5s ease-in-out infinite;
    animation-delay: 0s;
}
.steam:nth-child(2) {
    left: 28px;
    animation: steamRise2 3s ease-in-out infinite;
    animation-delay: 0.5s;
}
.steam:nth-child(3) {
    left: 40px;
    animation: steamRise3 2.8s ease-in-out infinite;
    animation-delay: 1s;
}

/* ===== Floating Coffee Beans Animation ===== */
@keyframes floatBean {
    0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.08; }
    25% { transform: translateY(-15px) rotate(45deg); opacity: 0.12; }
    50% { transform: translateY(-5px) rotate(90deg); opacity: 0.06; }
    75% { transform: translateY(-20px) rotate(135deg); opacity: 0.1; }
}

.floating-bean {
    position: fixed;
    color: var(--cafe-brown);
    font-size: 24px;
    pointer-events: none;
    z-index: 0;
    animation: floatBean 8s ease-in-out infinite;
}

.floating-bean:nth-child(1) { top: 15%; left: 5%; animation-delay: 0s; font-size: 18px; }
.floating-bean:nth-child(2) { top: 35%; right: 8%; animation-delay: 2s; font-size: 22px; }
.floating-bean:nth-child(3) { top: 65%; left: 3%; animation-delay: 4s; font-size: 16px; }
.floating-bean:nth-child(4) { top: 80%; right: 5%; animation-delay: 1s; font-size: 20px; }
.floating-bean:nth-child(5) { top: 50%; left: 92%; animation-delay: 3s; font-size: 14px; }
.floating-bean:nth-child(6) { top: 20%; left: 50%; animation-delay: 5s; font-size: 17px; }

/* ===== Pour Animation for Page Load ===== */
@keyframes pourIn {
    0% { opacity: 0; transform: translateY(-30px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes slideInLeft {
    0% { opacity: 0; transform: translateX(-30px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes drip {
    0% { height: 0; opacity: 1; }
    70% { height: 30px; opacity: 1; }
    100% { height: 30px; opacity: 0; }
}

/* ===== Cup Spin on Hover ===== */
@keyframes cupWiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-5deg); }
    75% { transform: rotate(5deg); }
}

/* ===== Latte Art Swirl ===== */
@keyframes latteSwirl {
    0% { transform: rotate(0deg) scale(1); }
    50% { transform: rotate(180deg) scale(1.05); }
    100% { transform: rotate(360deg) scale(1); }
}

/* ===== Page Header ===== */
.page-header {
    background: linear-gradient(135deg, var(--cafe-brown) 0%, var(--cafe-espresso) 100%);
    border-radius: 16px;
    padding: 20px 28px;
    position: relative;
    overflow: hidden;
    animation: pourIn 0.8s ease-out;
    box-shadow: 0 8px 32px rgba(60, 36, 21, 0.25);
    z-index: 1;
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, var(--cafe-latte) 0%, transparent 70%);
    opacity: 0.1;
    border-radius: 50%;
    animation: latteSwirl 15s linear infinite;
}

.page-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--cafe-caramel), var(--cafe-latte), var(--cafe-caramel), transparent);
}

.page-header .header-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: var(--cafe-cream);
    color: var(--cafe-brown);
    border-radius: 10px;
    margin-right: 8px;
    font-size: 16px;
    animation: cupWiggle 2s ease-in-out infinite;
}

.page-header h5 {
    color: var(--cafe-cream) !important;
    font-family: 'Georgia', serif;
    letter-spacing: 0.5px;
}

.page-header .text-primary {
    color: var(--cafe-latte) !important;
    font-style: italic;
}

.page-header .text-muted {
    color: var(--cafe-cream-dark) !important;
    opacity: 0.85;
}

/* ===== View Toggle & Action Buttons ===== */
.btn-outline-primary {
    border-color: var(--cafe-cream) !important;
    color: var(--cafe-cream) !important;
    border-radius: 10px;
    transition: all 0.3s ease;
    backdrop-filter: blur(4px);
    background: rgba(245, 240, 225, 0.08);
}

.btn-outline-primary:hover,
.btn-outline-primary.active {
    background: var(--cafe-cream) !important;
    color: var(--cafe-brown) !important;
    border-color: var(--cafe-cream) !important;
    box-shadow: 0 4px 15px rgba(245, 240, 225, 0.3);
}

.btn-primary {
    background: var(--cafe-brown) !important;
    border-color: var(--cafe-brown) !important;
    color: var(--cafe-cream) !important;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn-primary:hover {
    background: var(--cafe-brown-dark) !important;
    border-color: var(--cafe-brown-dark) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(107, 79, 63, 0.35);
}

.mobile-filter-btn {
    background: var(--cafe-cream) !important;
    color: var(--cafe-brown) !important;
    border-color: var(--cafe-cream) !important;
    font-weight: 600;
}

.mobile-filter-btn:hover {
    background: var(--cafe-cream-dark) !important;
}

/* ===== Filter Card ===== */
.filter-card {
    background: linear-gradient(180deg, var(--cafe-foam) 0%, var(--cafe-cream) 100%) !important;
    border: 1px solid var(--cafe-cream-dark) !important;
    border-radius: 16px !important;
    animation: slideInLeft 0.6s ease-out;
    position: relative;
    overflow: hidden;
    top: 90px;
}

.filter-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--cafe-brown), var(--cafe-latte), var(--cafe-brown));
}

.filter-card h6 {
    color: var(--cafe-espresso);
    font-family: 'Georgia', serif;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-card h6::before {
    content: '\F62E';
    font-family: 'bootstrap-icons';
    color: var(--cafe-brown);
    font-size: 18px;
}

.filter-card .form-label {
    color: var(--cafe-brown);
    font-weight: 600;
}

.filter-card .form-select,
.dark-input {
    background: var(--cafe-cream-light) !important;
    border: 1.5px solid var(--cafe-cream-dark) !important;
    color: var(--cafe-espresso) !important;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.filter-card .form-select:focus,
.dark-input:focus {
    border-color: var(--cafe-brown) !important;
    box-shadow: 0 0 0 3px rgba(107, 79, 63, 0.15) !important;
}

.form-range::-webkit-slider-thumb {
    background: var(--cafe-brown) !important;
    border: 2px solid var(--cafe-cream);
    box-shadow: 0 2px 8px rgba(107, 79, 63, 0.3);
}

.form-range::-webkit-slider-runnable-track {
    background: linear-gradient(90deg, var(--cafe-brown), var(--cafe-latte)) !important;
    border-radius: 4px;
}

/* ===== Product Cards ===== */
.product-card {
    background: var(--cafe-foam) !important;
    border-radius: 16px !important;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    animation: fadeInUp 0.6s ease-out backwards;
    border: 1px solid var(--cafe-cream-dark) !important;
}

.product-item:nth-child(1) .product-card { animation-delay: 0.05s; }
.product-item:nth-child(2) .product-card { animation-delay: 0.1s; }
.product-item:nth-child(3) .product-card { animation-delay: 0.15s; }
.product-item:nth-child(4) .product-card { animation-delay: 0.2s; }
.product-item:nth-child(5) .product-card { animation-delay: 0.25s; }
.product-item:nth-child(6) .product-card { animation-delay: 0.3s; }
.product-item:nth-child(7) .product-card { animation-delay: 0.35s; }
.product-item:nth-child(8) .product-card { animation-delay: 0.4s; }

.product-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 16px 40px rgba(107, 79, 63, 0.2) !important;
    border-color: var(--cafe-brown) !important;
}

.product-img-wrapper {
    position: relative;
    background: var(--cafe-cream);
    border-radius: 16px 16px 0 0;
    overflow: hidden;
}

.product-img-wrapper::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 40px;
    background: linear-gradient(to top, var(--cafe-foam), transparent);
    pointer-events: none;
}

.product-img {
    height: 180px;
    object-fit: cover;
    transition: all 0.5s ease;
}

.product-card:hover .product-img {
    transform: scale(1.08);
    filter: brightness(1.05);
}

/* ===== Badges ===== */
.badge-discount {
    background: linear-gradient(135deg, #C0392B, #E74C3C) !important;
    color: #fff !important;
    font-size: 11px;
    padding: 5px 10px;
    border-radius: 8px;
    font-weight: 700;
    box-shadow: 0 3px 10px rgba(192, 57, 43, 0.3);
    letter-spacing: 0.5px;
}

.badge-price {
    background: linear-gradient(135deg, var(--cafe-brown), var(--cafe-brown-dark)) !important;
    color: var(--cafe-cream) !important;
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 8px;
    font-weight: 700;
    box-shadow: 0 3px 10px rgba(107, 79, 63, 0.3);
}

/* ===== Product Body ===== */
.product-title {
    color: var(--cafe-espresso);
    font-family: 'Georgia', serif;
    font-size: 0.88rem;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.product-card:hover .product-title {
    color: var(--cafe-brown);
}

.card-body {
    background: var(--cafe-foam);
    padding: 12px 14px !important;
}

.stock-in {
    color: #27AE60 !important;
    font-weight: 600;
    font-size: 0.78rem;
    display: flex !important;
    align-items: center;
    gap: 4px;
}

.stock-out {
    color: #C0392B !important;
    font-weight: 600;
    font-size: 0.78rem;
    display: flex !important;
    align-items: center;
    gap: 4px;
}

/* ===== Quick View Button ===== */
.quick-view-btn {
    background: linear-gradient(135deg, var(--cafe-brown), var(--cafe-brown-dark)) !important;
    border: none !important;
    color: var(--cafe-cream) !important;
    border-radius: 10px !important;
    font-weight: 600;
    font-size: 0.8rem;
    padding: 7px 12px;
    position: relative;
    overflow: hidden;
    z-index: 3;
    transition: all 0.3s ease;
}

.quick-view-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(245, 240, 225, 0.2), transparent);
    transition: left 0.5s ease;
}

.quick-view-btn:hover::before {
    left: 100%;
}

.quick-view-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(107, 79, 63, 0.35);
    background: linear-gradient(135deg, var(--cafe-brown-dark), var(--cafe-espresso)) !important;
}

/* ===== List View ===== */
#productWrapper.list-view {
    flex-direction: column;
}

#productWrapper.list-view .product-item {
    width: 100% !important;
    max-width: 100% !important;
    flex: 0 0 100%;
}

#productWrapper.list-view .product-card {
    flex-direction: row !important;
    align-items: stretch;
}

#productWrapper.list-view .product-img-wrapper {
    width: 200px;
    min-width: 200px;
    border-radius: 16px 0 0 16px;
}

#productWrapper.list-view .product-img {
    height: 100%;
    width: 200px;
    object-fit: cover;
}

#productWrapper.list-view .card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-radius: 0 16px 16px 0;
}

#productWrapper.list-view .quick-view-btn {
    width: auto !important;
    align-self: flex-start;
}

/* ===== Empty State ===== */
.empty-state-container {
    background: var(--cafe-foam);
    border-radius: 20px;
    padding: 50px 30px;
    border: 2px dashed var(--cafe-cream-dark);
    animation: fadeInUp 0.6s ease-out;
}

.empty-state-container .bi-search {
    color: var(--cafe-brown) !important;
    filter: drop-shadow(0 4px 8px rgba(107, 79, 63, 0.2));
}

.empty-state-container h5 {
    color: var(--cafe-brown) !important;
    font-family: 'Georgia', serif;
}

.empty-state-container .text-muted {
    color: var(--cafe-brown-light) !important;
}

/* ===== Quick View Modal ===== */
.dark-modal {
    background: var(--cafe-foam) !important;
    border: 1px solid var(--cafe-cream-dark);
    border-radius: 20px !important;
    overflow: hidden;
}

.dark-modal .modal-header {
    background: linear-gradient(135deg, var(--cafe-brown), var(--cafe-espresso));
    border-bottom: 3px solid var(--cafe-latte);
    color: var(--cafe-cream);
    padding: 18px 24px;
}

.dark-modal .modal-header .modal-title {
    font-family: 'Georgia', serif;
    font-weight: 700;
}

.dark-modal .modal-header .btn-close {
    filter: invert(1);
    opacity: 0.8;
}

.dark-modal .modal-body {
    color: var(--cafe-espresso);
    padding: 24px;
}

/* ===== Pagination ===== */
.pagination {
    gap: 5px;
}

.pagination .page-link {
    background: var(--cafe-foam) !important;
    color: var(--cafe-brown) !important;
    border: 1.5px solid var(--cafe-cream-dark) !important;
    border-radius: 10px !important;
    font-weight: 600;
    padding: 8px 14px;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: var(--cafe-cream) !important;
    border-color: var(--cafe-brown) !important;
    transform: translateY(-2px);
}

.pagination .active .page-link {
    background: var(--cafe-brown) !important;
    color: var(--cafe-cream) !important;
    border-color: var(--cafe-brown) !important;
    box-shadow: 0 4px 12px rgba(107, 79, 63, 0.3);
}

/* ===== Coffee Cup Decoration ===== */
.coffee-cup-deco {
    position: absolute;
    bottom: -5px;
    left: 20px;
    font-size: 28px;
    color: var(--cafe-cream);
    opacity: 0.25;
    animation: cupWiggle 3s ease-in-out infinite;
}

/* ===== Scrollbar ===== */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--cafe-cream);
}

::-webkit-scrollbar-thumb {
    background: var(--cafe-brown-light);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--cafe-brown);
}

/* ===== Coffee Ring Stain Effect on Filter Card ===== */
.filter-card::after {
    content: '';
    position: absolute;
    bottom: 15px;
    right: 15px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid var(--cafe-brown);
    opacity: 0.06;
}

/* ===== Responsive ===== */
@media (max-width: 576px) {
    .page-header {
        padding: 15px 18px;
        border-radius: 12px;
    }

    .page-header h5 {
        font-size: 0.95rem;
    }

    .product-img {
        height: 140px;
    }

    .product-title {
        font-size: 0.8rem;
    }

    .quick-view-btn {
        font-size: 0.72rem !important;
        padding: 5px 8px !important;
    }

    #productWrapper.list-view .product-img-wrapper {
        width: 120px;
        min-width: 120px;
    }

    #productWrapper.list-view .product-img {
        width: 120px;
    }

    .steam-container {
        display: none;
    }
}

/* ===== Coffee Drip Loading Indicator on Cards ===== */
@keyframes coffeeShimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.product-img-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg,
        transparent 30%,
        rgba(212, 165, 116, 0.08) 50%,
        transparent 70%
    );
    background-size: 200% 100%;
    animation: coffeeShimmer 3s ease-in-out infinite;
    z-index: 1;
    pointer-events: none;
}

/* ===== Latte Art Divider ===== */
.latte-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 10px 0;
    opacity: 0.4;
}

.latte-divider::before,
.latte-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--cafe-brown), transparent);
}

.latte-divider i {
    color: var(--cafe-brown);
    font-size: 12px;
}
</style>

<!-- Floating Coffee Bean Decorations -->
<div class="floating-bean"><i class="bi bi-circle-fill"></i></div>
<div class="floating-bean"><i class="bi bi-circle-fill"></i></div>
<div class="floating-bean"><i class="bi bi-circle-fill"></i></div>
<div class="floating-bean"><i class="bi bi-circle-fill"></i></div>
<div class="floating-bean"><i class="bi bi-circle-fill"></i></div>
<div class="floating-bean"><i class="bi bi-circle-fill"></i></div>

<div class="cafe-page-wrapper">
<div class="container py-4" style="position:relative; z-index:1;">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 page-header">
        <div class="steam-container">
            <div class="steam"></div>
            <div class="steam"></div>
            <div class="steam"></div>
        </div>
        <span class="coffee-cup-deco"><i class="bi bi-cup-hot-fill"></i></span>

        <div>
            <h5 class="fw-bold mb-1">
                <span class="header-icon"><i class="bi bi-search"></i></span>
                Search result for:
                <span class="text-primary">"{{ $query }}"</span>
            </h5>
            <small class="text-muted">
                <i class="bi bi-box-seam me-1"></i>{{ $products->total() }} Item(s) found
            </small>
        </div>

        <div class="d-flex gap-1 mt-2 mt-md-0 flex-wrap align-items-center">
            <button class="btn btn-sm btn-outline-primary active" id="gridBtn" title="Grid View">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
            <button class="btn btn-sm btn-outline-primary" id="listBtn" title="List View">
                <i class="bi bi-list-ul"></i>
            </button>
            <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm" title="Back to Home">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
            <button class="btn btn-sm mobile-filter-btn ms-2 d-md-none" data-bs-toggle="collapse" data-bs-target="#mobileFilter">
                <i class="bi bi-funnel-fill"></i> Filter
            </button>
        </div>
    </div>

    <div class="row">

        <!-- Filter Sidebar -->
        <div class="col-md-3 mb-3 d-none d-md-block">
            <div class="card p-3 shadow-sm filter-card">
                <h6 class="fw-bold mb-3">Filter Products</h6>

                <div class="latte-divider"><i class="bi bi-cup-hot"></i></div>

                <div class="mb-3">
                    <label class="form-label small"><i class="bi bi-tags-fill me-1"></i> Category</label>
                    <select id="categoryFilter" class="form-select form-select-sm dark-input">
                        <option value="">All Categories</option>
                        @foreach(App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small">
                        <i class="bi bi-cash-stack me-1"></i>
                        Max Price: <span id="priceVal" style="color:var(--cafe-espresso);font-weight:700;">0</span> {{ $currency }}
                    </label>
                    <input type="range" min="0" max="1000" step="10" class="form-range" id="priceRange">
                </div>

                <div class="latte-divider"><i class="bi bi-cup-hot"></i></div>
            </div>
        </div>

        <!-- Mobile Filter Collapse -->
        <div class="col-12 mb-3 d-md-none collapse" id="mobileFilter">
            <div class="card p-3 shadow-sm filter-card">
                <h6 class="fw-bold mb-3">Filter Products</h6>

                <div class="mb-3">
                    <label class="form-label small"><i class="bi bi-tags-fill me-1"></i> Category</label>
                    <select id="categoryFilterMobile" class="form-select form-select-sm dark-input">
                        <option value="">All Categories</option>
                        @foreach(App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small">
                        <i class="bi bi-cash-stack me-1"></i>
                        Max Price: <span id="priceValMobile" style="color:var(--cafe-espresso);font-weight:700;">0</span> {{ $currency }}
                    </label>
                    <input type="range" min="0" max="300000" step="1000" class="form-range" id="priceRangeMobile">
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-9">
            <div class="row g-3" id="productWrapper">

                @forelse($products as $product)
                <div class="col-6 col-sm-4 col-lg-3 product-item"
                    data-category="{{ $product->category_id }}"
                    data-price="{{ $product->price }}">
                    <div class="card product-card h-100 border-0 shadow-sm position-relative">

                        <a href="{{ url('/item/'.$product->id) }}" class="stretched-link"></a>

                        <div class="position-relative overflow-hidden product-img-wrapper">
                            <img src="{{ config('app.storage_url') }}{{ $product->image }}"
                                class="card-img-top product-img"
                                alt="{{ $product->name }}"
                                loading="lazy">

                            <div class="d-flex justify-content-between position-absolute top-0 start-0 w-100 p-1" style="z-index:2;">
                                @if($product->discount > 0)
                                <span class="badge badge-discount">
                                    <i class="bi bi-arrow-down-circle me-1"></i>-{{ $product->discount }}%
                                </span>
                                @endif
                                <span class="badge badge-price ms-auto">
                                    <i class="bi bi-tag-fill me-1"></i>{{ $product->price }} {{ $currency }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column py-2">
                            <h6 class="fw-semibold mb-1 product-title">{{ Str::limit($product->name,50) }}</h6>

                            @if($product->stock > 0)
                            <small class="stock-in mb-2 d-block">
                                <i class="bi bi-check-circle-fill"></i> In Stock
                            </small>
                            @else
                            <small class="stock-out mb-2 d-block">
                                <i class="bi bi-x-circle-fill"></i> Out of Stock
                            </small>
                            @endif

                            <button class="btn btn-sm btn-primary mt-auto quick-view-btn w-100"
                                data-id="{{ $product->id }}">
                                <i class="bi bi-eye-fill"></i> Quick View
                            </button>
                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <div class="empty-state-container">
                        <i class="bi bi-search" style="font-size:50px;"></i>
                        <h5 class="fw-bold mt-3 mb-1">No product found</h5>
                        <p class="text-muted small">Try searching with different keywords.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary btn-sm mt-2">
                            <i class="bi bi-house-fill me-1"></i> Continue Shopping
                        </a>
                    </div>
                </div>
                @endforelse

            </div>

            @if($products->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
</div>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content dark-modal" id="quickViewContent"></div>
    </div>
</div>

<script>
// Grid/List toggle
document.getElementById('listBtn').onclick = function() {
    document.getElementById('productWrapper').classList.add('list-view');
    this.classList.add('active');
    document.getElementById('gridBtn').classList.remove('active');
};
document.getElementById('gridBtn').onclick = function() {
    document.getElementById('productWrapper').classList.remove('list-view');
    this.classList.add('active');
    document.getElementById('listBtn').classList.remove('active');
};

// Price filter
function bindPriceFilter(rangeEl, valEl){
    if(!rangeEl || !valEl) return;
    valEl.innerText = rangeEl.value;
    rangeEl.oninput = ()=>{ valEl.innerText = rangeEl.value; };
    rangeEl.onchange = ()=>{
        const maxPrice = parseInt(rangeEl.value);
        document.querySelectorAll('.product-item').forEach(item=>{
            const price = parseInt(item.dataset.price);
            if(maxPrice === 0) {
                item.style.display = 'block';
            } else {
                item.style.display = price <= maxPrice ? 'block':'none';
            }
        });
    };
}
bindPriceFilter(document.getElementById('priceRange'), document.getElementById('priceVal'));
bindPriceFilter(document.getElementById('priceRangeMobile'), document.getElementById('priceValMobile'));

// Category filter
function bindCategoryFilter(selectEl){
    if(!selectEl) return;
    selectEl.onchange = ()=>{
        const category = selectEl.value;
        document.querySelectorAll('.product-item').forEach(item=>{
            item.style.display = category==='' || item.dataset.category===category ? 'block':'none';
        });
    };
}
bindCategoryFilter(document.getElementById('categoryFilter'));
bindCategoryFilter(document.getElementById('categoryFilterMobile'));
</script>

@endsection
