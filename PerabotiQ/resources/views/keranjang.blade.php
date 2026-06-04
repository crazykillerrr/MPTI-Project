@extends('layouts.customer')

@section('title', 'Cart — PerabotiQ')

@push('styles')
<link href="/assets/css/keranjang.css" rel="stylesheet">
@endpush

@section('content')
<div class="keranjang-page">
  <div class="container" style="max-width:1120px;">

    <h2 class="kj-page-title">Cart</h2>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="font-family:'Poppins',sans-serif;font-size:0.875rem;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="font-family:'Poppins',sans-serif;font-size:0.875rem;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="row g-4 align-items-start">

      {{-- ══════════════ LEFT COLUMN: Items ══════════════ --}}
      <div class="col-lg-8">

        @if(isset($cartItems) && $cartItems->count() > 0)

          {{-- Select All --}}
          <div class="kj-select-bar">
            <input type="checkbox" id="checkAll" onchange="toggleAll(this)">
            <label for="checkAll">Select All</label>
          </div>

          {{-- Product list --}}
          <div id="cart-items">
            @foreach($cartItems as $item)

              <div class="kj-item-card"
                   data-id="{{ $item->id }}"
                   data-price="{{ $item->product->price }}"
                   data-qty="{{ $item->quantity }}">

                {{-- Checkbox --}}
                <input type="checkbox" class="item-checkbox" onchange="updateCardSelected(this); updateSummary();">

                {{-- Gambar --}}
                <img
                  src="{{ asset($item->product->image) }}"
                  alt="{{ $item->product->name }}"
                  class="kj-item-img"
                  onerror="this.src='https://placehold.co/80x80/f5f4f2/aaa?text=Foto'"
                >

                {{-- Info (tengah) --}}
                <div class="kj-item-info">
                  <p class="kj-item-name">{{ $item->product->name }}</p>
                  <p class="kj-item-unit-price">Rp{{ number_format($item->product->price, 0, ',', '.') }} / item</p>
                </div>

                {{-- Kanan: subtotal + kontrol --}}
                <div class="kj-item-right">
                  {{-- Subtotal harga (diperbarui JS) --}}
                  <span class="kj-item-subtotal" id="subtotal-{{ $item->id }}">
                    Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                  </span>

                  {{-- Row bawah: trash + qty --}}
                  <div class="kj-item-bottom-row">

                    {{-- Hapus --}}
                    <form action="{{ route('keranjang.hapus') }}" method="POST" style="display:inline;">
                      @csrf
                      <input type="hidden" name="keranjang_id" value="{{ $item->id }}">
                      <button type="submit" class="kj-btn-delete" title="Remove"
                        onclick="return confirm('Remove this product from the cart?')">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </form>

                    {{-- Qty Control --}}
                    <div class="kj-qty-control">
                      <button type="button" class="kj-qty-btn"
                        onclick="changeQty(this, -1, {{ $item->id }})"
                        id="minus-{{ $item->id }}">
                        <i class="bi bi-dash"></i>
                      </button>
                      <span class="kj-qty-value" id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                      <button type="button" class="kj-qty-btn"
                        onclick="changeQty(this, 1, {{ $item->id }})">
                        <i class="bi bi-plus"></i>
                      </button>
                    </div>

                  </div>
                </div>

              </div>
            @endforeach
          </div>

        @else
          {{-- Cart is empty --}}
          <div class="kj-empty-box">
            <div class="kj-empty-icon"><i class="bi bi-cart-x"></i></div>
            <h4>Your cart is empty!</h4>
            <p>Browse our products and find something you love~</p>
            <a href="{{ route('customer.dashboard') }}#products" class="kj-btn-catalog">View Catalog</a>
          </div>
        @endif

      </div>

      {{-- ══════════════ RIGHT COLUMN: Summary ══════════════ --}}
      <div class="col-lg-4">
        <div class="kj-summary-panel">
          <p class="kj-summary-title">Payment Summary</p>

          <div class="kj-summary-row">
            <span class="kj-label">Subtotal (<span id="summary-count">0</span> items)</span>
            <span class="kj-value" id="summary-subtotal">Rp0</span>
          </div>

          <div class="kj-summary-row kj-grand">
            <span class="kj-label">Grand Total</span>
            <span class="kj-value" id="summary-total">Rp0</span>
          </div>

          @if(isset($cartItems) && $cartItems->count() > 0)
            <form id="form-checkout" action="{{ route('checkout.pilih') }}" method="POST">
              @csrf
              <div id="selected-items-inputs"></div>
              <button type="button" class="kj-btn-checkout kj-disabled" id="btn-checkout" onclick="submitCheckout()">
                Proceed to Payment
              </button>
            </form>
          @else
            <button class="kj-btn-checkout kj-disabled" disabled>Proceed to Payment</button>
          @endif

          <p class="kj-note-selected" id="note-selected">Select items to see the total</p>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  /* ── Highlight card saat checkbox berubah ── */
  function updateCardSelected(cb) {
    const card = cb.closest('.kj-item-card');
    if (!card) return;
    card.classList.toggle('is-selected', cb.checked);
  }

  /* ── Pilih semua / batal pilih semua ── */
  function toggleAll(master) {
    document.querySelectorAll('.item-checkbox').forEach(cb => {
      cb.checked = master.checked;
      updateCardSelected(cb);
    });
    updateSummary();
  }

  /* ── Sinkronkan checkbox master ── */
  function syncMaster() {
    const all   = document.querySelectorAll('.item-checkbox');
    const chkd  = document.querySelectorAll('.item-checkbox:checked');
    const master = document.getElementById('checkAll');
    if (!master) return;
    master.checked       = all.length > 0 && chkd.length === all.length;
    master.indeterminate = chkd.length > 0 && chkd.length < all.length;
  }

  /* ── Update ringkasan berdasarkan item yang diceklis ── */
  function updateSummary() {
    syncMaster();

    let totalQty   = 0;
    let totalPrice = 0;

    document.querySelectorAll('.kj-item-card').forEach(card => {
      const cb = card.querySelector('.item-checkbox');
      if (!cb || !cb.checked) return;

      const price = parseFloat(card.dataset.price) || 0;
      const qty   = parseInt(card.dataset.qty)   || 1;

      totalQty   += qty;
      totalPrice += price * qty;
    });

    const fmt = (n) => 'Rp' + n.toLocaleString('id-ID');

    const elCount    = document.getElementById('summary-count');
    const elSubtotal = document.getElementById('summary-subtotal');
    const elTotal    = document.getElementById('summary-total');
    const elNote     = document.getElementById('note-selected');
    const elCheckout = document.getElementById('btn-checkout');

    if (elCount)    elCount.textContent    = totalQty;
    if (elSubtotal) elSubtotal.textContent = fmt(totalPrice);
    if (elTotal)    elTotal.textContent    = fmt(totalPrice);

    // Note text
    if (elNote) {
      elNote.textContent = totalQty > 0
        ? totalQty + ' items selected'
        : 'Select items to see the total';
    }

    // Enable / disable checkout button
    if (elCheckout) {
      if (totalQty > 0) {
        elCheckout.classList.remove('kj-disabled');
        elCheckout.removeAttribute('disabled');
      } else {
        elCheckout.classList.add('kj-disabled');
        elCheckout.setAttribute('disabled', 'disabled');
      }
    }

    // Update hidden inputs dengan ID item yang dicentang
    const inputContainer = document.getElementById('selected-items-inputs');
    if (inputContainer) {
      inputContainer.innerHTML = '';
      document.querySelectorAll('.kj-item-card').forEach(card => {
        const cb = card.querySelector('.item-checkbox');
        if (cb && cb.checked) {
          const input = document.createElement('input');
          input.type  = 'hidden';
          input.name  = 'selected_ids[]';
          input.value = card.dataset.id;
          inputContainer.appendChild(input);
        }
      });
    }
  }

  /* ── Submit checkout hanya item yang diceklis ── */
  function submitCheckout() {
    const checked = document.querySelectorAll('.item-checkbox:checked');
    if (checked.length === 0) {
      alert('Pilih minimal satu produk untuk checkout.');
      return;
    }
    document.getElementById('form-checkout').submit();
  }

  /* ── Ubah qty ── */
  function changeQty(btn, delta, itemId) {
    const qtyEl     = document.getElementById('qty-' + itemId);
    const subtotalEl = document.getElementById('subtotal-' + itemId);
    const minusBtn  = document.getElementById('minus-' + itemId);
    if (!qtyEl) return;

    const card  = btn.closest('.kj-item-card');
    const price = parseFloat(card ? card.dataset.price : 0) || 0;

    let current = parseInt(qtyEl.textContent) || 1;
    current = Math.max(1, current + delta);
    qtyEl.textContent = current;

    // Update data-qty pada card
    if (card) card.dataset.qty = current;

    // Update subtotal label
    if (subtotalEl) {
      subtotalEl.textContent = 'Rp' + (price * current).toLocaleString('id-ID');
    }

    // Disable minus saat qty = 1
    if (minusBtn) minusBtn.disabled = (current <= 1);

    updateSummary();
  }

  /* ── Init ── */
  document.addEventListener('DOMContentLoaded', () => {
    // Set disabled state awal tombol minus jika qty = 1
    document.querySelectorAll('.kj-item-card').forEach(card => {
      const id  = card.dataset.id;
      const qty = parseInt(card.dataset.qty) || 1;
      const minusBtn = document.getElementById('minus-' + id);
      if (minusBtn && qty <= 1) minusBtn.disabled = true;
    });

    updateSummary(); // reset summary ke 0 dulu (belum ada yang diceklis)
  });
</script>
@endpush
