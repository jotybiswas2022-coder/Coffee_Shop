@extends('frontend.app')

@section('content')

{{-- ========== BACKGROUND DECORATIONS ========== --}}
<div class="coffee-beans-bg">
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
    <i class="bi bi-cup-hot-fill coffee-bean"></i>
</div>

<div class="coffee-ring coffee-ring-1"></div>
<div class="coffee-ring coffee-ring-2"></div>
<div class="coffee-cup-deco"><i class="bi bi-cup-hot-fill"></i></div>

{{-- Alerts --}}
@if (session('success'))
<div class="alert alert-success m-3">
    <span><i class="bi bi-check-circle-fill" style="margin-right:8px;"></i>{{ session('success') }}</span>
    <button class="close-btn" data-bs-dismiss="alert">&times;</button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger m-3">
    <span><i class="bi bi-exclamation-triangle-fill" style="margin-right:8px;"></i>{{ session('error') }}</span>
    <button class="close-btn" data-bs-dismiss="alert">&times;</button>
</div>
@endif

<div class="container">

    <!-- ===== PAGE HEADER with Steam ===== -->
    <div class="page-header">
        <div class="steam-container">
            <div class="steam"></div>
            <div class="steam"></div>
            <div class="steam"></div>
        </div>
        <h1>
            <i class="bi bi-cart3"></i>
            Cart
        </h1>
        <p><i class="bi bi-cup-hot" style="margin-right:4px;"></i> Review your items before checkout</p>
    </div>

    <div class="cart-layout">

        <!-- ================= CART TABLE ================= -->
        <div class="cart-card">
            <div class="cart-table-wrap">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> SL</th>
                            <th><i class="bi bi-image"></i> Item</th>
                            <th><i class="bi bi-tag"></i> Name</th>
                            <th class="text-center"><i class="bi bi-currency-dollar"></i> Price</th>
                            <th class="text-center"><i class="bi bi-box-seam"></i> Stock</th>
                            <th class="text-center"><i class="bi bi-plus-slash-minus"></i> Qty</th>
                            <th class="text-end"><i class="bi bi-calculator"></i> Total</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($carts as $cart)
                    @php
                        $product = $cart->product;
                        if(!$product) continue;

                        $discount = $product->discount ?? 0;
                        $priceAfterDiscount = $product->price * (100 - $discount) / 100;

                        $total = 0;
                        if($product->stock > 0){
                            $total = $priceAfterDiscount * $cart->quantity;
                            $subtotal += $total;
                        }
                    @endphp

                    <tr class="{{ $product->stock <= 0 ? 'out-of-stock' : '' }}">

                        <td data-label="SL">
                            <span class="sl-number">{{ $loop->iteration }}</span>
                        </td>

                        <td data-label="Product" class="text-center">
                            <img src="{{ config('app.storage_url') }}{{ $product->image }}"
                                 class="cart-product-image"
                                 alt="{{ $product->name }}">
                        </td>

                        <td data-label="Name">
                            <div class="product-name">{{ $product->name }}</div>
                        </td>

                        <td data-label="Price" class="text-center price-cell">
                            {{ number_format($priceAfterDiscount,2) }} {{ $currency }}
                        </td>

                        <td data-label="Stock" class="text-center">
                            @if($product->stock <= 0)
                                <span class="stock-badge stock-out"><i class="bi bi-x-circle"></i> Out</span>
                            @elseif($product->stock <= 5)
                                <span class="stock-badge stock-low"><i class="bi bi-exclamation-triangle"></i> {{ $product->stock }}</span>
                            @else
                                <span class="stock-badge stock-in"><i class="bi bi-check-circle"></i> {{number_format($product->stock, 0) }}</span>
                            @endif
                        </td>

                        <td data-label="Qty" class="text-center">
                            @if($product->stock <= 0)
                                <span class="out-of-stock-badge"><i class="bi bi-slash-circle"></i> Out of Stock</span>
                            @else
                                <div class="qty-control">
                                    <a href="/manage/minus/{{ $cart->id }}" class="qty-btn">
                                        <i class="bi bi-dash"></i>
                                    </a>
                                    <span class="qty-badge">{{number_format($cart->quantity, 0) }}</span>
                                    <a href="/manage/plus/{{ $cart->id }}" class="qty-btn">
                                        <i class="bi bi-plus"></i>
                                    </a>
                                </div>
                            @endif
                        </td>

                        <td data-label="Total"
                            class="text-end total-price {{ $product->stock <= 0 ? 'total-out-stock' : 'total-in-stock' }}">
                            {{ number_format($total,2) }} {{ $currency }}
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-cart">
                                <i class="bi bi-cart-x"></i>
                                <h3>Your cart is empty</h3>
                                <p>Add some delicious coffee products to continue shopping</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================= SUMMARY ================= -->
        @if($carts->count() > 0)
        @php
            $taxAmount = ($subtotal * $taxPercent) / 100;
            $grandTotal = $subtotal + $taxAmount + $delivery;
        @endphp

        <div class="summary-card">

            <h5><i class="bi bi-receipt"></i> Order Summary</h5>

            @foreach($carts as $cart)
            @php
                $product = $cart->product;
                if(!$product) continue;
                $priceAfterDiscount = $product->price * (100 - ($product->discount ?? 0)) / 100;
            @endphp

            <div class="summary-item">
                <div class="summary-item-left">
                    <img src="{{ config('app.storage_url') }}{{ $product->image }}"
                         class="mini-cart-img"
                         alt="{{ $product->name }}">

                    <div>
                        <div class="summary-item-name">{{ $product->name }}</div>
                        <div class="summary-item-detail">
                            {{ $cart->quantity }} × {{ number_format($priceAfterDiscount,2) }} {{ $currency }}
                        </div>
                    </div>
                </div>

                <a href="/manage/destroy/{{ $cart->id }}" class="remove-btn-mini">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            @endforeach

            <hr class="summary-divider">

            <div class="summary-row">
                <span class="label"><i class="bi bi-receipt-cutoff" style="margin-right:6px;opacity:.5;"></i>Subtotal</span>
                <span class="value">{{ number_format($subtotal,2) }} {{ $currency }}</span>
            </div>

            <div class="summary-row">
                <span class="label"><i class="bi bi-percent" style="margin-right:6px;opacity:.5;"></i>Tax ({{ $taxPercent }}%)</span>
                <span class="value">{{ number_format($taxAmount,2) }} {{ $currency }}</span>
            </div>

            <div class="summary-row">
                <span class="label"><i class="bi bi-truck" style="margin-right:6px;opacity:.5;"></i>Delivery</span>
                <span class="value">{{ number_format($delivery,2) }} {{ $currency }}</span>
            </div>

            <div class="summary-total">
                <span class="label"><i class="bi bi-wallet2" style="margin-right:6px;"></i>Grand Total</span>
                <span class="value">{{ number_format($grandTotal,2) }} {{ $currency }}</span>
            </div>

            <a href="/billing" class="btn-checkout">
                <i class="bi bi-credit-card"></i>
                Proceed to Checkout
            </a>

        </div>
        @endif

    </div>
</div>

<style>
/* ── Google Font ── */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@300;400;500;600;700&display=swap');

/* ── CSS Variables ── */
:root {
    --brown:       #6B4F3F;
    --brown-dark:  #4E3629;
    --brown-light: #8B6F5F;
    --cream:       #F5F0E1;
    --cream-dark:  #E8DFD0;
    --cream-light: #FAF7F0;
    --white:       #FFFFFF;
    --text-dark:   #3A2A1F;
    --text-muted:  #7A6A5F;
    --danger:      #C0392B;
    --danger-bg:   #FDEDEC;
    --success:     #27AE60;
    --success-bg:  #E8F8F0;
    --warning:     #E67E22;
    --shadow-sm:   0 2px 8px rgba(107,79,63,.08);
    --shadow-md:   0 6px 24px rgba(107,79,63,.12);
    --shadow-lg:   0 12px 40px rgba(107,79,63,.18);
    --radius:      16px;
    --radius-sm:   10px;
    --transition:  .35s cubic-bezier(.4,0,.2,1);
}

/* ── Base ── */
body {
    font-family: 'Poppins', sans-serif;
    background: var(--cream);
    color: var(--text-dark);
    overflow-x: hidden;
}

/* ── Alerts ── */
.alert {
    border: none;
    border-radius: var(--radius-sm);
    font-weight: 500;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    animation: slideDown .5s ease;
    position: relative;
    overflow: hidden;
}
.alert::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 5px;
}
.alert-success {
    background: var(--success-bg);
    color: #1E8449;
}
.alert-success::before { background: var(--success); }
.alert-danger {
    background: var(--danger-bg);
    color: var(--danger);
}
.alert-danger::before { background: var(--danger); }

.close-btn {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    opacity: .6;
    transition: var(--transition);
    line-height: 1;
}
.close-btn:hover { opacity: 1; transform: rotate(90deg); }

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── Container ── */
.container {
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 20px 60px;
    position: relative;
    z-index: 1;
}

/* ══════════════════════════════════
   FLOATING COFFEE BEANS (BG Deco)
   ══════════════════════════════════ */
.coffee-beans-bg {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}
.coffee-bean {
    position: absolute;
    font-size: 24px;
    color: var(--brown);
    opacity: .06;
    animation: floatBean linear infinite;
}
.coffee-bean:nth-child(1)  { left:5%;  font-size:20px; animation-duration:18s; animation-delay:0s; }
.coffee-bean:nth-child(2)  { left:15%; font-size:28px; animation-duration:22s; animation-delay:2s; }
.coffee-bean:nth-child(3)  { left:25%; font-size:16px; animation-duration:16s; animation-delay:4s; }
.coffee-bean:nth-child(4)  { left:35%; font-size:32px; animation-duration:25s; animation-delay:1s; }
.coffee-bean:nth-child(5)  { left:50%; font-size:22px; animation-duration:20s; animation-delay:3s; }
.coffee-bean:nth-child(6)  { left:65%; font-size:18px; animation-duration:19s; animation-delay:5s; }
.coffee-bean:nth-child(7)  { left:75%; font-size:26px; animation-duration:23s; animation-delay:0s; }
.coffee-bean:nth-child(8)  { left:85%; font-size:14px; animation-duration:17s; animation-delay:2s; }
.coffee-bean:nth-child(9)  { left:92%; font-size:30px; animation-duration:21s; animation-delay:4s; }
.coffee-bean:nth-child(10) { left:45%; font-size:20px; animation-duration:24s; animation-delay:6s; }

@keyframes floatBean {
    0%   { transform: translateY(110vh) rotate(0deg);   opacity:.04; }
    50%  { opacity:.08; }
    100% { transform: translateY(-10vh) rotate(720deg);  opacity:.03; }
}

/* ══════════════════════════════════
   PAGE HEADER  –  Coffee cup steam
   ══════════════════════════════════ */
.page-header {
    text-align: center;
    padding: 50px 20px 30px;
    position: relative;
    animation: fadeInUp .7s ease;
}
.page-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.6rem;
    font-weight: 700;
    color: var(--brown);
    margin-bottom: 8px;
    position: relative;
    display: inline-block;
}
.page-header h1 i {
    margin-right: 10px;
    position: relative;
}
/* Steam wisps above the cart icon */
.page-header h1 i::before {
    position: relative;
}
.page-header h1::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, transparent, var(--brown), transparent);
    border-radius: 4px;
}
.page-header p {
    color: var(--text-muted);
    font-size: 1.05rem;
    margin-top: 18px;
    font-weight: 400;
}

/* Steam animation for header icon */
.steam-container {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 40px;
    pointer-events: none;
}
.steam {
    position: absolute;
    bottom: 0;
    width: 6px;
    height: 6px;
    background: var(--brown);
    border-radius: 50%;
    opacity: 0;
}
.steam:nth-child(1) { left: 8px;  animation: steamRise 2.4s ease-in-out infinite; }
.steam:nth-child(2) { left: 18px; animation: steamRise 2.4s ease-in-out infinite .4s; }
.steam:nth-child(3) { left: 28px; animation: steamRise 2.4s ease-in-out infinite .8s; }

@keyframes steamRise {
    0%   { transform: translateY(0) scaleX(1); opacity: .4; }
    50%  { transform: translateY(-25px) scaleX(1.8); opacity: .15; }
    100% { transform: translateY(-50px) scaleX(2.5); opacity: 0; }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ══════════════════════════════════
   LAYOUT  –  Cart + Summary
   ══════════════════════════════════ */
.cart-layout {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 30px;
    align-items: flex-start;
    animation: fadeInUp .8s ease .15s both;
}

/* ── Cart Card ── */
.cart-card {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    border: 1px solid rgba(107,79,63,.06);
    transition: box-shadow var(--transition);
}
.cart-card:hover {
    box-shadow: var(--shadow-lg);
}

/* ── Cart Table ── */
.cart-table-wrap {
    overflow-x: auto;
}
.cart-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 720px;
}
.cart-table thead {
    background: linear-gradient(135deg, var(--brown) 0%, var(--brown-dark) 100%);
}
.cart-table thead th {
    padding: 16px 18px;
    font-size: .82rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: var(--cream);
    white-space: nowrap;
    position: relative;
}
.cart-table thead th::after {
    content: '';
    position: absolute;
    right: 0;
    top: 25%;
    height: 50%;
    width: 1px;
    background: rgba(245,240,225,.15);
}
.cart-table thead th:last-child::after { display: none; }

.cart-table tbody tr {
    border-bottom: 1px solid rgba(107,79,63,.06);
    transition: background var(--transition), transform var(--transition);
    animation: rowFadeIn .5s ease both;
}
.cart-table tbody tr:nth-child(1) { animation-delay: .1s; }
.cart-table tbody tr:nth-child(2) { animation-delay: .18s; }
.cart-table tbody tr:nth-child(3) { animation-delay: .26s; }
.cart-table tbody tr:nth-child(4) { animation-delay: .34s; }
.cart-table tbody tr:nth-child(5) { animation-delay: .42s; }

@keyframes rowFadeIn {
    from { opacity: 0; transform: translateX(-15px); }
    to   { opacity: 1; transform: translateX(0); }
}

.cart-table tbody tr:hover {
    background: var(--cream-light);
}
.cart-table tbody tr.out-of-stock {
    background: repeating-linear-gradient(
        -45deg,
        transparent,
        transparent 10px,
        rgba(192,57,43,.02) 10px,
        rgba(192,57,43,.02) 20px
    );
    opacity: .7;
}
.cart-table tbody td {
    padding: 16px 18px;
    vertical-align: middle;
    font-size: .92rem;
}

/* ── SL Number ── */
.sl-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--cream);
    color: var(--brown);
    font-weight: 700;
    font-size: .85rem;
    border: 2px solid rgba(107,79,63,.1);
}

/* ── Product Image ── */
.cart-product-image {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    border: 2px solid var(--cream-dark);
    transition: transform var(--transition), box-shadow var(--transition);
    box-shadow: var(--shadow-sm);
}
.cart-product-image:hover {
    transform: scale(1.15) rotate(-3deg);
    box-shadow: var(--shadow-md);
}

/* ── Product Name ── */
.product-name {
    font-weight: 600;
    color: var(--text-dark);
    font-size: .95rem;
    line-height: 1.4;
}

/* ── Price Cell ── */
.price-cell {
    font-weight: 600;
    color: var(--brown);
    white-space: nowrap;
}

/* ── Stock Badges ── */
.stock-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .4px;
}
.stock-in {
    background: #E8F8F0;
    color: #1E8449;
    border: 1px solid #A9DFBF;
}
.stock-low {
    background: #FEF5E7;
    color: #D68910;
    border: 1px solid #F9E79F;
    animation: pulseWarning 2s ease-in-out infinite;
}
@keyframes pulseWarning {
    0%, 100% { box-shadow: 0 0 0 0 rgba(230,126,34,.2); }
    50%      { box-shadow: 0 0 0 6px rgba(230,126,34,0); }
}
.stock-out {
    background: var(--danger-bg);
    color: var(--danger);
    border: 1px solid #F5B7B1;
}

/* ── Out of Stock Badge ── */
.out-of-stock-badge {
    display: inline-block;
    padding: 5px 14px;
    background: var(--danger-bg);
    color: var(--danger);
    border-radius: 20px;
    font-size: .78rem;
    font-weight: 600;
    border: 1px solid #F5B7B1;
}

/* ── Qty Control ── */
.qty-control {
    display: inline-flex;
    align-items: center;
    gap: 0;
    background: var(--cream);
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid rgba(107,79,63,.1);
    transition: border-color var(--transition), box-shadow var(--transition);
}
.qty-control:hover {
    border-color: var(--brown-light);
    box-shadow: 0 0 0 3px rgba(107,79,63,.08);
}
.qty-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: transparent;
    color: var(--brown);
    font-size: 1.1rem;
    font-weight: 700;
    text-decoration: none;
    transition: background var(--transition), color var(--transition);
    user-select: none;
}
.qty-btn:hover {
    background: var(--brown);
    color: var(--cream);
}
.qty-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    font-weight: 700;
    font-size: .95rem;
    color: var(--brown-dark);
    background: var(--white);
    border-left: 1px solid rgba(107,79,63,.08);
    border-right: 1px solid rgba(107,79,63,.08);
}

/* ── Total Price ── */
.total-price {
    font-weight: 700;
    font-size: .95rem;
    white-space: nowrap;
}
.total-in-stock { color: var(--brown-dark); }
.total-out-stock { color: #BDC3C7; text-decoration: line-through; }

/* ── Remove Button ── */
.remove-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 16px;
    border-radius: 8px;
    background: var(--danger-bg);
    color: var(--danger);
    font-size: .82rem;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid transparent;
    transition: all var(--transition);
    position: relative;
    overflow: hidden;
}
.remove-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--danger);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform var(--transition);
    z-index: 0;
}
.remove-btn:hover::before { transform: scaleX(1); }
.remove-btn:hover {
    color: var(--white);
    border-color: var(--danger);
    box-shadow: 0 4px 15px rgba(192,57,43,.25);
}
.remove-btn span,
.remove-btn { position: relative; z-index: 1; }

/* ── Empty Cart ── */
.empty-cart {
    text-align: center;
    padding: 60px 20px;
    animation: fadeInUp .6s ease;
}
.empty-cart i {
    font-size: 4rem;
    color: var(--brown-light);
    opacity: .4;
    display: block;
    margin-bottom: 16px;
    animation: emptyBounce 3s ease-in-out infinite;
}
@keyframes emptyBounce {
    0%, 100% { transform: translateY(0); }
    50%      { transform: translateY(-12px); }
}
.empty-cart h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--brown);
    margin-bottom: 6px;
}
.empty-cart p {
    color: var(--text-muted);
    font-size: .95rem;
}

/* ══════════════════════════════════
   SUMMARY CARD  –  with latte art
   ══════════════════════════════════ */
.summary-card {
    background: var(--white);
    border-radius: var(--radius);
    padding: 28px;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(107,79,63,.06);
    position: sticky;
    top: 30px;
    transition: box-shadow var(--transition);
    overflow: hidden;
}
.summary-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--brown-dark), var(--brown), var(--brown-light));
}
.summary-card:hover {
    box-shadow: var(--shadow-lg);
}

.summary-card > h5 {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--brown);
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.summary-card > h5 i {
    font-size: 1.2rem;
    opacity: .7;
}

/* ── Summary Item ── */
.summary-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px dashed rgba(107,79,63,.08);
    transition: background var(--transition);
    border-radius: 8px;
    padding-left: 6px;
    padding-right: 6px;
    animation: summarySlide .4s ease both;
}
.summary-item:nth-child(2) { animation-delay: .1s; }
.summary-item:nth-child(3) { animation-delay: .2s; }
.summary-item:nth-child(4) { animation-delay: .3s; }
.summary-item:nth-child(5) { animation-delay: .4s; }

@keyframes summarySlide {
    from { opacity: 0; transform: translateX(20px); }
    to   { opacity: 1; transform: translateX(0); }
}

.summary-item:hover {
    background: var(--cream-light);
}
.summary-item-left {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
    min-width: 0;
}
.mini-cart-img {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid var(--cream-dark);
    flex-shrink: 0;
    transition: transform var(--transition);
}
.mini-cart-img:hover {
    transform: rotate(-6deg) scale(1.1);
}
.summary-item-name {
    font-weight: 600;
    font-size: .85rem;
    color: var(--text-dark);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.summary-item-detail {
    font-size: .78rem;
    color: var(--text-muted);
    margin-top: 2px;
}
.remove-btn-mini {
    color: #D5D5D5;
    font-size: 1.1rem;
    transition: color var(--transition), transform var(--transition);
    flex-shrink: 0;
    margin-left: 8px;
    text-decoration: none;
}
.remove-btn-mini:hover {
    color: var(--danger);
    transform: scale(1.25) rotate(90deg);
}

/* ── Divider ── */
.summary-divider {
    border: none;
    border-top: 2px dashed rgba(107,79,63,.1);
    margin: 18px 0;
    position: relative;
}
.summary-divider::before,
.summary-divider::after {
    content: '';
    position: absolute;
    top: -6px;
    width: 12px;
    height: 12px;
    background: var(--cream);
    border-radius: 50%;
}
.summary-divider::before { left: -20px; }
.summary-divider::after  { right: -20px; }

/* ── Summary Rows ── */
.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    font-size: .9rem;
}
.summary-row .label {
    color: var(--text-muted);
    font-weight: 400;
}
.summary-row .value {
    font-weight: 600;
    color: var(--text-dark);
}

/* ── Grand Total ── */
.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    margin: 16px -8px;
    background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 100%);
    border-radius: var(--radius-sm);
    border: 2px solid rgba(107,79,63,.08);
    position: relative;
    overflow: hidden;
}
.summary-total::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(107,79,63,.03) 0%, transparent 70%);
    animation: shimmerTotal 4s linear infinite;
}
@keyframes shimmerTotal {
    0%   { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.summary-total .label {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--brown);
    position: relative;
    z-index: 1;
}
.summary-total .value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--brown-dark);
    position: relative;
    z-index: 1;
}

/* ══════════════════════════════════
   CHECKOUT BUTTON  –  coffee pour
   ══════════════════════════════════ */
.btn-checkout {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 16px;
    margin-top: 20px;
    background: linear-gradient(135deg, var(--brown) 0%, var(--brown-dark) 100%);
    color: var(--cream);
    font-size: 1rem;
    font-weight: 700;
    text-decoration: none;
    border-radius: var(--radius-sm);
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: transform var(--transition), box-shadow var(--transition);
    letter-spacing: .5px;
    text-transform: uppercase;
}
.btn-checkout::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(245,240,225,.15),
        transparent
    );
    transition: left .6s ease;
}
.btn-checkout:hover::before {
    left: 100%;
}
.btn-checkout:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(107,79,63,.35);
    color: var(--cream);
}
.btn-checkout:active {
    transform: translateY(-1px);
}
.btn-checkout i {
    font-size: 1.1rem;
    transition: transform var(--transition);
}
.btn-checkout:hover i {
    transform: translateX(4px);
}

/* ══════════════════════════════════
   COFFEE CUP DECORATION (corners)
   ══════════════════════════════════ */
.coffee-cup-deco {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 0;
    opacity: .06;
    font-size: 120px;
    color: var(--brown);
    animation: floatCup 6s ease-in-out infinite;
    pointer-events: none;
}
@keyframes floatCup {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50%      { transform: translateY(-15px) rotate(5deg); }
}

/* ── Coffee Ring Stain ── */
.coffee-ring {
    position: fixed;
    width: 180px;
    height: 180px;
    border: 3px solid var(--brown);
    border-radius: 50%;
    opacity: .03;
    pointer-events: none;
    z-index: 0;
}
.coffee-ring-1 { top: 10%; left: -40px; }
.coffee-ring-2 { bottom: 15%; right: -60px; width: 220px; height: 220px; }

/* ══════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════ */
@media (max-width: 1024px) {
    .cart-layout {
        grid-template-columns: 1fr;
    }
    .summary-card {
        position: static;
    }
}

@media (max-width: 768px) {
    .page-header h1 { font-size: 1.9rem; }
    .page-header { padding: 35px 10px 20px; }

    /* Card-style rows on mobile */
    .cart-table { min-width: unset; }
    .cart-table thead { display: none; }
    .cart-table tbody tr {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        padding: 18px;
        margin: 12px;
        border-radius: var(--radius-sm);
        background: var(--white);
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(107,79,63,.06);
    }
    .cart-table tbody tr.out-of-stock {
        border-left: 3px solid var(--danger);
    }
    .cart-table tbody td {
        padding: 6px 4px;
        text-align: left !important;
    }
    .cart-table tbody td::before {
        content: attr(data-label);
        display: block;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: var(--text-muted);
        margin-bottom: 4px;
    }
    .cart-table tbody td[data-label="Product"] {
        grid-column: 1 / -1;
        text-align: center !important;
    }
    .cart-product-image {
        width: 80px;
        height: 80px;
    }
    .cart-table tbody td[data-label="Name"] {
        grid-column: 1 / -1;
    }
    .cart-table tbody td[data-label="Action"] {
        grid-column: 1 / -1;
        text-align: center !important;
    }
    .remove-btn { width: 100%; justify-content: center; }

    /* Empty cart full width */
    .empty-cart-row td { padding: 0 !important; }

    .summary-card { padding: 20px; }

    .coffee-cup-deco { font-size: 80px; bottom: 15px; right: 15px; }
}

@media (max-width: 480px) {
    .page-header h1 { font-size: 1.5rem; }
    .cart-table tbody tr {
        grid-template-columns: 1fr;
        margin: 8px;
        padding: 14px;
    }
    .summary-total {
        flex-direction: column;
        gap: 4px;
        text-align: center;
    }
}

/* ── Text helpers ── */
.text-center { text-align: center; }
.text-end    { text-align: right; }

/* ══════════════════════════════════
   LATTE ART LOADER (if needed)
   ══════════════════════════════════ */
.latte-loader {
    display: inline-block;
    width: 40px;
    height: 40px;
    border: 3px solid var(--cream-dark);
    border-top-color: var(--brown);
    border-radius: 50%;
    animation: spin .8s linear infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}

/* ── Pour animation for page load ── */
@keyframes pourIn {
    0%   { clip-path: inset(0 0 100% 0); }
    100% { clip-path: inset(0 0 0 0); }
}
.cart-card  { animation: pourIn .8s ease .2s both; }
.summary-card { animation: pourIn .8s ease .4s both; }

/* ── Ripple on table hover ── */
.cart-table tbody tr {
    position: relative;
}
.cart-table tbody tr::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), rgba(107,79,63,.04), transparent 60%);
    opacity: 0;
    transition: opacity .3s;
    pointer-events: none;
}
.cart-table tbody tr:hover::after {
    opacity: 1;
}
</style>

@endsection
