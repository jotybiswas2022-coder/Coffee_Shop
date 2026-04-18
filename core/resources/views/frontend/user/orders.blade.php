@extends('frontend.app')

@section('content')

<!-- DECORATIVE BACKGROUND ELEMENTS -->
<div class="coffee-bg-beans">
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
    <div class="bean"><i class="bi bi-circle-fill"></i></div>
</div>

<div class="steam-container">
    <div class="steam"></div>
    <div class="steam"></div>
    <div class="steam"></div>
</div>
<div class="coffee-cup-deco"><i class="bi bi-cup-hot-fill"></i></div>
<div class="drip-line"></div>
<div class="latte-art-spinner"><i class="bi bi-flower1"></i></div>

@if (session('success'))
<div class="alert alert-custom m-3">
    <i class="bi bi-check-circle me-1"></i>
    {{ session('success') }}
</div>
@endif

<div class="container py-4">

<!-- HEADER -->
<div class="orders-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h2><i class="bi bi-cup-hot me-2"></i>My Orders</h2>
        <div class="subtitle"><i class="bi bi-geo-alt me-1"></i>Track and manage your recent orders</div>
    </div>

    <div class="search-box">
        <input type="text" id="orderSearch" placeholder="Search orders...">
        <i class="bi bi-search"></i>
    </div>
</div>

<!-- TABLE CARD -->
<div class="orders-card">
    <div class="table-responsive">
        <table class="table align-middle mb-0 text-center table-dark" id="ordersTable">
            <thead>
            <tr>
                <th><i class="bi bi-hash me-1"></i>#</th>
                <th><i class="bi bi-image me-1"></i>Item</th>
                <th><i class="bi bi-tag me-1"></i>Name</th>
                <th><i class="bi bi-currency-dollar me-1"></i>Price</th>
                <th><i class="bi bi-box me-1"></i>Qty</th>
                <th><i class="bi bi-calculator me-1"></i>Total</th>
                <th><i class="bi bi-credit-card me-1"></i>Payment Method</th>
                <th><i class="bi bi-info-circle me-1"></i>Status</th>
                <th><i class="bi bi-gear me-1"></i>Action</th>
            </tr>
            </thead>

            <tbody>
            @php $sl = 1; @endphp

            @forelse($orders as $order)
                @foreach($order->orderdetails as $product)

                    @php
                        $productModel = $product->product;
                        $imageUrl = ($productModel && $productModel->image)
                            ? config('app.storage_url').$productModel->image
                            : '';

                        $status = strtolower($product->status);

                        $statusClass = match($status) {
                            'pending' => 'status-pending',
                            'processing' => 'status-processing',
                            'approve','approved','delivered' => 'status-approved',
                            'canceled','cancelled' => 'status-cancelled',
                            default => 'status-processing'
                        };

                        $method = strtolower($order->payment_method ?? '');

                        $methodClass = match($method) {
                            'cod' => 'method-cod',
                            'bkash' => 'method-bkash',
                            'nagad' => 'method-nagad',
                            default => 'method-cod'
                        };

                        $methodLabel = match($method) {
                            'cod' => 'Cash on Delivery',
                            'bkash' => 'BKash',
                            'nagad' => 'Nagad',
                            default => ucfirst($method ?: 'Cash on Delivery')
                        };
                    @endphp

                    <tr class="order-row">

                        <td data-label="#">
                            <span class="sl-number">{{ $sl++ }}</span>
                        </td>

                        <td data-label="Product">
                            @if($imageUrl)
                                <div class="product-img-wrap">
                                    <img src="{{ $imageUrl }}">
                                </div>
                            @else
                                N/A
                            @endif
                        </td>

                        <td data-label="Name" class="product-name">
                            {{ $product->product_name }}
                        </td>

                        <td data-label="Price" class="price-cell">
                            {{ $currency }} {{ number_format($product->product_price,2) }}
                        </td>

                        <td data-label="Qty">
                            <span class="qty-badge">
                                {{ $product->product_quantity }}
                            </span>
                        </td>

                        <td data-label="Total" class="total-cell">
                            {{ $currency }} {{ number_format($product->product_price * $product->product_quantity ,2) }}
                        </td>

                        <td data-label="Payment Method">
                            <span class="method-badge {{ $methodClass }}">
                                {{ $methodLabel }}
                            </span>
                        </td>

                        <td data-label="Status">
                            <span class="status-badge {{ $statusClass }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>

                        <td data-label="Action">
                            <button class="view-order-btn"
                                data-name="{{ $product->product_name }}"
                                data-price="{{ $currency }} {{ number_format($product->product_price,2) }}"
                                data-qty="{{ $product->product_quantity }}"
                                data-total="{{ $currency }} {{ number_format($product->product_price * $product->product_quantity,2) }}"
                                data-status="{{ ucfirst($product->status) }}"
                                data-statusclass="{{ $statusClass }}"
                                data-image="{{ $imageUrl }}"
                                data-firstname="{{ $order->firstname }}"
                                data-lastname="{{ $order->lastname }}"
                                data-email="{{ $order->email }}"
                                data-phone="{{ $order->phone }}"
                                data-address="{{ $order->address }}"
                                data-bs-toggle="modal"
                                data-bs-target="#orderdetailsmodal">

                                <i class="bi bi-eye"></i>
                            </button>
                        </td>

                    </tr>

                @endforeach
            @empty
                <tr>
                    <td colspan="10">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-bag-x"></i>
                            </div>
                            No orders found.
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>

<!-- MODAL -->

<div class="modal fade" id="orderdetailsmodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content order-modal">

            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-receipt-cutoff me-2"></i>Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

            <div class="d-flex gap-4 flex-wrap align-items-start">

                <div class="modal-product-img">
                    <img id="modalImage">
                </div>

                <div class="flex-grow-1">

                    <h6 id="modalName" class="mb-3 fw-bold" style="color:var(--brown-dark);font-family:'Playfair Display',serif;font-size:1.15rem;"></h6>

                    <div class="row g-3 small">

                        <div class="col-6">
                            <div class="modal-info-label"><i class="bi bi-tag me-1"></i>Price</div>
                            <div id="modalPrice" class="modal-info-value"></div>
                        </div>

                        <div class="col-6">
                            <div class="modal-info-label"><i class="bi bi-box me-1"></i>Qty</div>
                            <div id="modalQty" class="modal-info-value"></div>
                        </div>

                        <div class="col-6">
                            <div class="modal-info-label"><i class="bi bi-calculator me-1"></i>Total</div>
                            <div id="modalTotal" class="modal-info-value" style="color:#2E7D32;"></div>
                        </div>

                        <div class="col-6">
                            <div class="modal-info-label"><i class="bi bi-info-circle me-1"></i>Status</div>
                            <div id="modalStatus"></div>
                        </div>
                    </div>

                    <hr class="modal-divider">

                    <div class="customer-info-card small">
                        <div class="modal-info-label mb-2"><i class="bi bi-person-circle me-1"></i>Customer Info</div>
                        <div id="modalCustomer"><i class="bi bi-person me-1"></i></div>
                        <div id="modalEmail"><i class="bi bi-envelope me-1"></i></div>
                        <div id="modalPhone"><i class="bi bi-telephone me-1"></i></div>
                        <div id="modalAddress"><i class="bi bi-geo-alt me-1"></i></div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

</div>

<!-- SCRIPT -->

<script>
document.getElementById('orderSearch').addEventListener('keyup', function () {
    let v = this.value.toLowerCase();
    document.querySelectorAll('#ordersTable tbody .order-row')
        .forEach(r => r.style.display = r.innerText.toLowerCase().includes(v) ? '' : 'none');
});

document.querySelectorAll('.view-order-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        const modalName = document.getElementById('modalName');
        const modalPrice = document.getElementById('modalPrice');
        const modalQty = document.getElementById('modalQty');
        const modalTotal = document.getElementById('modalTotal');
        const modalCustomer = document.getElementById('modalCustomer');
        const modalEmail = document.getElementById('modalEmail');
        const modalPhone = document.getElementById('modalPhone');
        const modalAddress = document.getElementById('modalAddress');
        const modalStatus = document.getElementById('modalStatus');
        const modalImage = document.getElementById('modalImage');

        modalName.innerText = this.dataset.name;
        modalPrice.innerText = this.dataset.price;
        modalQty.innerText = this.dataset.qty;
        modalTotal.innerText = this.dataset.total;

        modalCustomer.innerHTML = '<i class="bi bi-person me-1"></i>' + this.dataset.firstname + ' ' + this.dataset.lastname;
        modalEmail.innerHTML = '<i class="bi bi-envelope me-1"></i>' + this.dataset.email;
        modalPhone.innerHTML = '<i class="bi bi-telephone me-1"></i>' + this.dataset.phone;
        modalAddress.innerHTML = '<i class="bi bi-geo-alt me-1"></i>' + this.dataset.address;

        modalStatus.innerHTML =
            '<span class="status-badge '+this.dataset.statusclass+'">'+this.dataset.status+'</span>';

        if (this.dataset.image) {
            modalImage.src = this.dataset.image;
            modalImage.style.display = 'block';
        } else {
            modalImage.style.display = 'none';
        }
    });
});
</script>

<style>
/* ===== GOOGLE FONT ===== */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');

/* ===== ROOT VARIABLES ===== */
:root {
    --brown: #6B4F3F;
    --brown-dark: #4A3728;
    --brown-light: #8B6F5F;
    --brown-lighter: #A68B7B;
    --cream: #F5F0E1;
    --cream-dark: #E8DFC8;
    --cream-light: #FAF8F0;
    --espresso: #2C1A0E;
    --latte: #D4B896;
    --mocha: #7B5B3A;
    --caramel: #C4924A;
    --white: #FFFFFF;
    --shadow-sm: 0 2px 8px rgba(107,79,63,0.08);
    --shadow-md: 0 4px 20px rgba(107,79,63,0.12);
    --shadow-lg: 0 8px 40px rgba(107,79,63,0.18);
    --shadow-xl: 0 12px 60px rgba(107,79,63,0.22);
    --radius-sm: 8px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --radius-xl: 28px;
}

/* ===== BACKGROUND & BODY ===== */
body, .content-area {
    background: var(--cream) !important;
    font-family: 'Poppins', sans-serif;
    color: var(--espresso);
    position: relative;
    overflow-x: hidden;
}

/* ===== COFFEE BEAN FLOATING ANIMATION ===== */
.coffee-bg-beans {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}
.coffee-bg-beans .bean {
    position: absolute;
    font-size: 22px;
    color: var(--brown-lighter);
    opacity: 0.10;
    animation: floatBean 18s infinite ease-in-out;
}
.coffee-bg-beans .bean:nth-child(1) { left: 5%; top: 10%; animation-delay: 0s; font-size: 18px; }
.coffee-bg-beans .bean:nth-child(2) { left: 15%; top: 60%; animation-delay: 3s; font-size: 28px; }
.coffee-bg-beans .bean:nth-child(3) { left: 30%; top: 25%; animation-delay: 6s; font-size: 16px; }
.coffee-bg-beans .bean:nth-child(4) { left: 50%; top: 70%; animation-delay: 2s; font-size: 24px; }
.coffee-bg-beans .bean:nth-child(5) { left: 70%; top: 15%; animation-delay: 8s; font-size: 20px; }
.coffee-bg-beans .bean:nth-child(6) { left: 85%; top: 50%; animation-delay: 4s; font-size: 26px; }
.coffee-bg-beans .bean:nth-child(7) { left: 92%; top: 80%; animation-delay: 10s; font-size: 14px; }
.coffee-bg-beans .bean:nth-child(8) { left: 40%; top: 85%; animation-delay: 7s; font-size: 22px; }
.coffee-bg-beans .bean:nth-child(9) { left: 60%; top: 40%; animation-delay: 5s; font-size: 19px; }
.coffee-bg-beans .bean:nth-child(10) { left: 25%; top: 90%; animation-delay: 9s; font-size: 30px; }

@keyframes floatBean {
    0%, 100% { transform: translateY(0) rotate(0deg) scale(1); opacity: 0.08; }
    25% { transform: translateY(-30px) rotate(45deg) scale(1.1); opacity: 0.14; }
    50% { transform: translateY(-15px) rotate(90deg) scale(1.05); opacity: 0.10; }
    75% { transform: translateY(-40px) rotate(135deg) scale(1.15); opacity: 0.12; }
}

/* ===== STEAM ANIMATION ===== */
.steam-container {
    position: fixed;
    bottom: 0;
    right: 30px;
    z-index: 0;
    pointer-events: none;
    width: 80px;
    height: 200px;
}
.steam {
    position: absolute;
    bottom: 60px;
    width: 8px;
    border-radius: 50%;
    background: rgba(107,79,63,0.06);
    animation: steamRise 3s infinite ease-out;
}
.steam:nth-child(1) { left: 20px; animation-delay: 0s; height: 20px; }
.steam:nth-child(2) { left: 38px; animation-delay: 0.8s; height: 14px; }
.steam:nth-child(3) { left: 55px; animation-delay: 1.6s; height: 18px; }

@keyframes steamRise {
    0% { transform: translateY(0) scaleX(1); opacity: 0; }
    15% { opacity: 0.7; }
    50% { transform: translateY(-80px) scaleX(2.5); opacity: 0.3; }
    100% { transform: translateY(-160px) scaleX(4); opacity: 0; }
}

/* Coffee cup icon at bottom right */
.coffee-cup-deco {
    position: fixed;
    bottom: 16px;
    right: 28px;
    font-size: 36px;
    color: var(--brown-lighter);
    opacity: 0.18;
    z-index: 0;
    pointer-events: none;
}

/* ===== ALERT ===== */
.alert-custom {
    background: linear-gradient(135deg, var(--brown), var(--brown-dark));
    color: var(--cream);
    border: none;
    border-radius: var(--radius-md);
    padding: 16px 24px;
    font-weight: 500;
    font-size: 0.95rem;
    box-shadow: var(--shadow-md);
    display: flex;
    align-items: center;
    animation: slideDownAlert 0.5s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
}
.alert-custom::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px; height: 100%;
    background: var(--caramel);
    border-radius: 4px 0 0 4px;
}
.alert-custom i {
    font-size: 1.3rem;
    color: var(--caramel);
}

@keyframes slideDownAlert {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== MAIN CONTAINER ===== */
.container.py-4 {
    position: relative;
    z-index: 1;
}

/* ===== ORDERS HEADER ===== */
.orders-header {
    animation: fadeInUp 0.6s cubic-bezier(.4,0,.2,1);
}
.orders-header h2 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 2rem;
    color: var(--brown-dark);
    margin: 0;
    position: relative;
    display: inline-block;
}
.orders-header h2::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, var(--caramel), var(--brown));
    border-radius: 3px;
    animation: expandLine 0.8s 0.3s ease-out both;
}
@keyframes expandLine {
    from { width: 0; }
    to { width: 50px; }
}
.orders-header .subtitle {
    color: var(--brown-lighter);
    font-size: 0.9rem;
    margin-top: 8px;
    font-weight: 400;
    letter-spacing: 0.2px;
}

/* ===== SEARCH BOX ===== */
.search-box {
    position: relative;
    width: 300px;
    max-width: 100%;
}
.search-box input {
    width: 100%;
    padding: 12px 20px 12px 44px;
    border: 2px solid var(--cream-dark);
    border-radius: 50px;
    background: var(--white);
    font-family: 'Poppins', sans-serif;
    font-size: 0.88rem;
    color: var(--espresso);
    transition: all 0.35s cubic-bezier(.4,0,.2,1);
    box-shadow: var(--shadow-sm);
    outline: none;
}
.search-box input::placeholder {
    color: var(--brown-lighter);
    font-weight: 300;
}
.search-box input:focus {
    border-color: var(--brown);
    box-shadow: 0 0 0 4px rgba(107,79,63,0.10), var(--shadow-md);
    background: var(--cream-light);
}
.search-box i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--brown-lighter);
    font-size: 1rem;
    transition: color 0.3s;
}
.search-box input:focus + i {
    color: var(--brown);
}

/* ===== ORDERS CARD ===== */
.orders-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    animation: fadeInUp 0.7s 0.15s cubic-bezier(.4,0,.2,1) both;
    border: 1px solid rgba(107,79,63,0.06);
    position: relative;
}
.orders-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--brown), var(--caramel), var(--brown-light), var(--brown));
    background-size: 300% 100%;
    animation: shimmerBar 4s linear infinite;
}
@keyframes shimmerBar {
    0% { background-position: 0% 50%; }
    100% { background-position: 300% 50%; }
}

/* ===== TABLE ===== */
.table.table-dark {
    background: transparent !important;
    color: var(--espresso) !important;
    margin-bottom: 0;
    --bs-table-bg: transparent;
    --bs-table-color: var(--espresso);
    --bs-table-border-color: rgba(107,79,63,0.07);
    --bs-table-striped-bg: transparent;
    --bs-table-hover-bg: rgba(107,79,63,0.03);
}

.table.table-dark thead {
    background: linear-gradient(135deg, var(--brown-dark), var(--brown)) !important;
}
.table.table-dark thead tr {
    background: transparent !important;
}
.table.table-dark thead th {
    background: transparent !important;
    color: var(--cream) !important;
    font-weight: 600;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 16px 14px;
    border: none !important;
    white-space: nowrap;
    font-family: 'Poppins', sans-serif;
    position: relative;
}
.table.table-dark thead th::after {
    content: '';
    position: absolute;
    right: 0;
    top: 25%;
    height: 50%;
    width: 1px;
    background: rgba(245,240,225,0.15);
}
.table.table-dark thead th:last-child::after {
    display: none;
}

/* TABLE BODY */
.table.table-dark tbody tr {
    background: transparent !important;
    transition: all 0.3s cubic-bezier(.4,0,.2,1);
    border-bottom: 1px solid rgba(107,79,63,0.06) !important;
}
.table.table-dark tbody tr.order-row:hover {
    background: rgba(107,79,63,0.03) !important;
    transform: scale(1.003);
    box-shadow: var(--shadow-sm);
}
.table.table-dark tbody td {
    padding: 14px;
    vertical-align: middle;
    font-size: 0.88rem;
    border: none !important;
    color: var(--espresso) !important;
}

/* ===== SERIAL NUMBER ===== */
.sl-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--cream), var(--cream-dark));
    color: var(--brown);
    font-weight: 700;
    font-size: 0.8rem;
    border-radius: 50%;
    border: 2px solid rgba(107,79,63,0.1);
}

/* ===== PRODUCT IMAGE ===== */
.product-img-wrap {
    width: 52px;
    height: 52px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 2px solid var(--cream-dark);
    background: var(--cream-light);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}
.product-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(.4,0,.2,1);
}
.order-row:hover .product-img-wrap img {
    transform: scale(1.12);
}
.product-img-wrap:hover {
    border-color: var(--brown);
    box-shadow: 0 0 0 3px rgba(107,79,63,0.1);
}

/* ===== PRODUCT NAME ===== */
.product-name {
    font-weight: 600;
    color: var(--brown-dark) !important;
    font-size: 0.9rem !important;
    max-width: 160px;
    text-align: left;
}

/* ===== PRICE ===== */
.price-cell {
    font-weight: 500;
    color: var(--brown) !important;
}
.total-cell {
    font-weight: 700;
    color: var(--brown-dark) !important;
    font-size: 0.92rem !important;
}

/* ===== QTY BADGE ===== */
.qty-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 34px;
    height: 30px;
    padding: 0 10px;
    background: linear-gradient(135deg, var(--cream), var(--cream-dark));
    color: var(--brown);
    font-weight: 700;
    font-size: 0.82rem;
    border-radius: 50px;
    border: 1.5px solid rgba(107,79,63,0.12);
}

/* ===== STATUS BADGES ===== */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 14px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    text-transform: capitalize;
    white-space: nowrap;
    position: relative;
    overflow: hidden;
}
.status-badge::before {
    content: '';
    width: 7px;
    height: 7px;
    border-radius: 50%;
    flex-shrink: 0;
}
.status-pending {
    background: rgba(196, 146, 74, 0.12);
    color: #9A6F2E;
    border: 1px solid rgba(196, 146, 74, 0.25);
}
.status-pending::before {
    background: #C4924A;
    animation: pulseDot 1.8s infinite;
}
.status-processing {
    background: rgba(107, 79, 63, 0.10);
    color: var(--brown);
    border: 1px solid rgba(107, 79, 63, 0.2);
}
.status-processing::before {
    background: var(--brown);
    animation: pulseDot 1.4s infinite;
}
.status-approved {
    background: rgba(46, 125, 50, 0.10);
    color: #2E7D32;
    border: 1px solid rgba(46, 125, 50, 0.2);
}
.status-approved::before {
    background: #2E7D32;
}
.status-cancelled {
    background: rgba(198, 40, 40, 0.10);
    color: #C62828;
    border: 1px solid rgba(198, 40, 40, 0.2);
}
.status-cancelled::before {
    background: #C62828;
}

@keyframes pulseDot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(0.7); }
}

/* ===== PAYMENT METHOD BADGES ===== */
.method-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 13px;
    border-radius: 50px;
    font-size: 0.73rem;
    font-weight: 600;
    letter-spacing: 0.2px;
    white-space: nowrap;
}
.method-cod {
    background: linear-gradient(135deg, rgba(107,79,63,0.08), rgba(107,79,63,0.14));
    color: var(--brown);
    border: 1px solid rgba(107,79,63,0.15);
}
.method-bkash {
    background: linear-gradient(135deg, rgba(227,26,116,0.08), rgba(227,26,116,0.14));
    color: #E31A74;
    border: 1px solid rgba(227,26,116,0.18);
}
.method-nagad {
    background: linear-gradient(135deg, rgba(255,99,0,0.08), rgba(255,99,0,0.14));
    color: #E05A00;
    border: 1px solid rgba(255,99,0,0.18);
}

/* ===== VIEW BUTTON ===== */
.view-order-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 2px solid var(--brown);
    border-radius: 50%;
    background: transparent;
    color: var(--brown);
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.35s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
}
.view-order-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--brown);
    border-radius: 50%;
    transform: scale(0);
    transition: transform 0.35s cubic-bezier(.4,0,.2,1);
}
.view-order-btn:hover::before {
    transform: scale(1);
}
.view-order-btn:hover {
    color: var(--cream);
    box-shadow: 0 4px 16px rgba(107,79,63,0.3);
    transform: translateY(-2px);
}
.view-order-btn i {
    position: relative;
    z-index: 1;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    padding: 60px 20px;
    text-align: center;
    color: var(--brown-lighter);
    font-size: 1rem;
    font-weight: 400;
    animation: fadeIn 0.6s ease;
}
.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, var(--cream), var(--cream-dark));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: emptyBounce 2s infinite ease-in-out;
}
.empty-icon i {
    font-size: 2rem;
    color: var(--brown-lighter);
}
@keyframes emptyBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* ===== MODAL ===== */
.order-modal {
    border: none !important;
    border-radius: var(--radius-lg) !important;
    box-shadow: var(--shadow-xl) !important;
    overflow: hidden;
    background: var(--cream-light) !important;
    animation: modalPop 0.4s cubic-bezier(.4,0,.2,1);
}
@keyframes modalPop {
    from { transform: scale(0.9) translateY(20px); opacity: 0; }
    to { transform: scale(1) translateY(0); opacity: 1; }
}

.order-modal .modal-header {
    background: linear-gradient(135deg, var(--brown-dark), var(--brown)) !important;
    border-bottom: none !important;
    padding: 20px 28px;
    position: relative;
    overflow: hidden;
}
.order-modal .modal-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -30px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(245,240,225,0.05);
}
.order-modal .modal-header::after {
    content: '';
    position: absolute;
    bottom: -60%;
    left: 20%;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: rgba(245,240,225,0.03);
}
.order-modal .modal-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: var(--cream) !important;
    font-size: 1.2rem;
    position: relative;
    z-index: 1;
}
.order-modal .btn-close {
    filter: invert(1) !important;
    opacity: 0.7;
    transition: all 0.3s;
    position: relative;
    z-index: 1;
}
.order-modal .btn-close:hover {
    opacity: 1;
    transform: rotate(90deg);
}

.order-modal .modal-body {
    padding: 28px;
    background: var(--cream-light);
}

/* Modal Product Image */
.modal-product-img {
    width: 160px;
    height: 160px;
    border-radius: var(--radius-md);
    overflow: hidden;
    background: var(--cream);
    border: 3px solid var(--cream-dark);
    box-shadow: var(--shadow-md);
    flex-shrink: 0;
    position: relative;
}
.modal-product-img::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 60%, rgba(107,79,63,0.06));
    pointer-events: none;
}
.modal-product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(.4,0,.2,1);
}
.modal-product-img:hover img {
    transform: scale(1.08);
}

/* Modal Info Labels & Values */
.modal-info-label {
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--brown-lighter);
    margin-bottom: 4px;
}
.modal-info-value {
    font-weight: 600;
    color: var(--brown-dark);
    font-size: 0.95rem;
}

/* Modal Divider */
.modal-divider {
    border-color: rgba(107,79,63,0.10);
    margin: 18px 0;
}

/* Customer Info Card */
.customer-info-card {
    background: linear-gradient(135deg, var(--brown), var(--brown-dark));
    border-radius: var(--radius-md);
    padding: 18px 20px;
    color: var(--cream);
    border: 1px solid rgba(245,240,225,0.08);
    position: relative;
    overflow: hidden;
}
.customer-info-card::before {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(245,240,225,0.04);
}
.customer-info-card .modal-info-label {
    color: var(--caramel) !important;
}
.customer-info-card div:not(.modal-info-label) {
    color: var(--cream);
    font-size: 0.85rem;
    line-height: 1.6;
    opacity: 0.9;
}

/* ===== ROW ENTRANCE ANIMATION ===== */
.order-row {
    animation: fadeInRow 0.5s ease both;
}
.order-row:nth-child(1) { animation-delay: 0.05s; }
.order-row:nth-child(2) { animation-delay: 0.10s; }
.order-row:nth-child(3) { animation-delay: 0.15s; }
.order-row:nth-child(4) { animation-delay: 0.20s; }
.order-row:nth-child(5) { animation-delay: 0.25s; }
.order-row:nth-child(6) { animation-delay: 0.30s; }
.order-row:nth-child(7) { animation-delay: 0.35s; }
.order-row:nth-child(8) { animation-delay: 0.40s; }
.order-row:nth-child(9) { animation-delay: 0.45s; }
.order-row:nth-child(10) { animation-delay: 0.50s; }

@keyframes fadeInRow {
    from { opacity: 0; transform: translateX(-15px); }
    to { opacity: 1; transform: translateX(0); }
}

/* ===== GENERAL ANIMATIONS ===== */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* ===== SCROLLBAR ===== */
.table-responsive::-webkit-scrollbar {
    height: 6px;
}
.table-responsive::-webkit-scrollbar-track {
    background: var(--cream);
    border-radius: 10px;
}
.table-responsive::-webkit-scrollbar-thumb {
    background: var(--brown-lighter);
    border-radius: 10px;
}
.table-responsive::-webkit-scrollbar-thumb:hover {
    background: var(--brown);
}

/* ===== COFFEE RING WATERMARK ===== */
.orders-card::after {
    content: '';
    position: absolute;
    bottom: -40px;
    right: -40px;
    width: 150px;
    height: 150px;
    border: 12px solid rgba(107,79,63,0.025);
    border-radius: 50%;
    pointer-events: none;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .orders-header h2 { font-size: 1.6rem; }
    .search-box { width: 100%; }
}

@media (max-width: 767px) {
    .orders-card { border-radius: var(--radius-md); }

    .table.table-dark thead { display: none; }

    .table.table-dark tbody tr.order-row {
        display: flex;
        flex-direction: column;
        background: var(--white) !important;
        margin-bottom: 14px;
        border-radius: var(--radius-md) !important;
        box-shadow: var(--shadow-md);
        padding: 16px;
        border: 1px solid rgba(107,79,63,0.06) !important;
        position: relative;
        overflow: hidden;
    }
    .table.table-dark tbody tr.order-row::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px; height: 100%;
        background: linear-gradient(180deg, var(--brown), var(--caramel));
        border-radius: 4px 0 0 4px;
    }
    .table.table-dark tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 12px !important;
        text-align: right;
        border-bottom: 1px solid rgba(107,79,63,0.04) !important;
    }
    .table.table-dark tbody td:last-child {
        border-bottom: none !important;
    }
    .table.table-dark tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: var(--brown);
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
        text-align: left;
        margin-right: 12px;
    }
    .product-name {
        text-align: right;
        max-width: none;
    }
    .modal-product-img {
        width: 120px;
        height: 120px;
    }
}

/* ===== LATTE ART LOADER (decorative top spinner) ===== */
.latte-art-spinner {
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 0;
    pointer-events: none;
    opacity: 0.04;
}
.latte-art-spinner i {
    font-size: 100px;
    color: var(--brown);
    animation: spinLatte 20s linear infinite;
}
@keyframes spinLatte {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* ===== POUR-OVER DRIP ANIMATION (left side deco) ===== */
.drip-line {
    position: fixed;
    left: 14px;
    top: 20%;
    width: 3px;
    height: 0;
    background: linear-gradient(180deg, transparent, rgba(107,79,63,0.08), transparent);
    border-radius: 3px;
    animation: dripDown 4s infinite ease-in-out;
    z-index: 0;
    pointer-events: none;
}
@keyframes dripDown {
    0% { height: 0; top: 15%; opacity: 0; }
    30% { opacity: 0.6; }
    70% { height: 120px; opacity: 0.3; }
    100% { height: 0; top: 75%; opacity: 0; }
}

/* ===== TOOLTIP-STYLE HOVER FOR TABLE HEADER ===== */
.table.table-dark thead th {
    transition: background 0.3s;
    cursor: default;
}
.table.table-dark thead th:hover {
    background: rgba(245,240,225,0.08) !important;
}
</style>

@endsection
