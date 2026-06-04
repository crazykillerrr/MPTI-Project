@extends('layouts.customer')
@section('title','Checkout — PerabotiQ')
@section('content')

@php
    $user = Auth::user();
    $ongkir = 100000; // Rp 100.000 default ongkir
    $grandTotal = $total + $ongkir;
@endphp

<div style="max-width:900px;margin:40px auto;padding:0 20px 80px;">

    <h2 style="font-size:1.5rem;font-weight:700;margin-bottom:28px;color:#1a1a1a;">Check Out</h2>

    <div style="display:grid;grid-template-columns:1fr 380px;gap:24px;align-items:start;">

        {{-- LEFT COLUMN --}}
        <div>

            {{-- Customer Address Info --}}
            <div style="background:#fff;border:1px solid #e8e5e0;border-radius:14px;padding:24px;margin-bottom:20px;">
                <div style="display:flex;align-items:flex-start;gap:14px;">
                    <div style="width:38px;height:38px;background:#e8f5e9;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="18" height="18" fill="#2e7d32" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>
                    <div>
                        <p style="font-weight:700;font-size:0.97rem;margin:0 0 2px;color:#1a1a1a;">{{ $user->name }}</p>
                        @if($user->phone)
                        <p style="font-size:0.84rem;color:#666;margin:0 0 2px;">(+62) {{ ltrim($user->phone, '+62') }}</p>
                        @endif
                        <p style="font-size:0.84rem;color:#666;margin:0;">
                            {{ $user->address ?: 'Alamat belum diisi' }}
                            @if($user->post_code) {{ $user->post_code }} @endif
                        </p>
                        <span style="display:inline-block;margin-top:6px;font-size:0.72rem;padding:2px 10px;background:#e8f5e9;color:#2e7d32;border-radius:20px;font-weight:600;">Rumah</span>
                    </div>
                </div>
            </div>

            {{-- Products --}}
            <div style="background:#fff;border:1px solid #e8e5e0;border-radius:14px;padding:24px;margin-bottom:20px;">
                <h3 style="font-size:0.95rem;font-weight:700;margin:0 0 16px;color:#1a1a1a;">Detail Produk</h3>
                @foreach($items as $item)
                <div style="display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid #f0eeeb;">
                    <img src="{{ asset($item->produk->image) }}"
                         alt="{{ $item->produk->nama }}"
                         style="width:64px;height:64px;object-fit:cover;border-radius:10px;border:1px solid #f0eeeb;flex-shrink:0;"
                         onerror="this.onerror=null;this.src='https://placehold.co/64x64/f5f3f0/aaa?text=Foto'">
                    <div style="flex:1;">
                        <p style="font-weight:600;font-size:0.9rem;margin:0 0 4px;color:#1a1a1a;">{{ $item->produk->nama }}</p>
                        <p style="font-size:0.82rem;color:#888;margin:0;">Qty: {{ $item->qty }}</p>
                    </div>
                    <span style="font-weight:600;font-size:0.9rem;color:#1a1a1a;">
                        Rp.{{ number_format($item->produk->harga * $item->qty,0,',','.') }}
                    </span>
                </div>
                @endforeach
            </div>

            {{-- Shipping Method --}}
            <div style="background:#fff;border:1px solid #e8e5e0;border-radius:14px;padding:24px;margin-bottom:20px;">
                <h3 style="font-size:0.95rem;font-weight:700;margin:0 0 16px;color:#1a1a1a;">Metode Pengiriman</h3>

                <label style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border:2px solid #2e7d32;border-radius:10px;cursor:pointer;background:#f1f8e9;margin-bottom:10px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <input type="radio" name="pengiriman" value="reguler" checked style="accent-color:#2e7d32;width:16px;height:16px;">
                        <div>
                            <p style="font-weight:600;font-size:0.88rem;margin:0 0 2px;color:#1a1a1a;">PBQ Express (Regular)</p>
                            <p style="font-size:0.78rem;color:#888;margin:0;">Estimasi tiba 3–5 Hari Kerja</p>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span style="font-weight:600;font-size:0.88rem;color:#2e7d32;">Rp.100.000</span>
                        <svg width="28" height="20" fill="#2e7d32" viewBox="0 0 24 24"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
                    </div>
                </label>

                <label style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border:1px solid #e8e5e0;border-radius:10px;cursor:pointer;background:#fff;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <input type="radio" name="pengiriman" value="express" style="accent-color:#2e7d32;width:16px;height:16px;">
                        <div>
                            <p style="font-weight:600;font-size:0.88rem;margin:0 0 2px;color:#1a1a1a;">PBQ Express (Next Day)</p>
                            <p style="font-size:0.78rem;color:#888;margin:0;">Estimasi tiba Besok</p>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span style="font-weight:600;font-size:0.88rem;color:#1a1a1a;">Rp.150.000</span>
                        <svg width="28" height="20" fill="#999" viewBox="0 0 24 24"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
                    </div>
                </label>
            </div>

            {{-- Payment Method --}}
            <div style="background:#fff;border:1px solid #e8e5e0;border-radius:14px;padding:24px;">
                <h3 style="font-size:0.95rem;font-weight:700;margin:0 0 16px;color:#1a1a1a;">Metode Pembayaran</h3>

                {{-- Transfer Bank --}}
                <label id="lbl-transfer" style="display:flex;align-items:center;gap:14px;padding:14px 16px;border:2px solid #2e7d32;border-radius:10px;cursor:pointer;background:#f1f8e9;margin-bottom:10px;transition:all 0.2s;">
                    <input type="radio" name="metode_pembayaran_ui" value="transfer" checked
                           style="accent-color:#2e7d32;width:16px;height:16px;" onchange="togglePayment(this)">
                    <div style="display:flex;align-items:center;gap:10px;flex:1;">
                        <div style="width:36px;height:36px;background:#1565c0;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M4 10h12v2H4zm0 4h8v2H4zm11 4h2v-2h2v-2h-2v-2h-2v2h-2v2h2z"/><path d="M2 6h20v2H2zm0 14V8H2v12h20v-2H4v-2H2z"/></svg>
                        </div>
                        <div>
                            <p style="font-weight:600;font-size:0.88rem;margin:0;color:#1a1a1a;">Transfer Bank</p>
                            <p style="font-size:0.76rem;color:#888;margin:0;">BRI, BCA, Mandiri, BNI, dll</p>
                        </div>
                    </div>
                </label>

                {{-- QRIS --}}
                <label id="lbl-qris" style="display:flex;align-items:center;gap:14px;padding:14px 16px;border:1px solid #e8e5e0;border-radius:10px;cursor:pointer;background:#fff;margin-bottom:10px;transition:all 0.2s;">
                    <input type="radio" name="metode_pembayaran_ui" value="qris"
                           style="accent-color:#2e7d32;width:16px;height:16px;" onchange="togglePayment(this)">
                    <div style="display:flex;align-items:center;gap:10px;flex:1;">
                        <div style="width:36px;height:36px;background:#e91e63;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M3 3h7v7H3zm2 2v3h3V5zm9-2h7v7h-7zm2 2v3h3V5zM3 14h7v7H3zm2 2v3h3v-3zm11 1h2v2h-2zm-2-2h2v2h-2zm4 0h2v2h-2zm-4 4h2v2h-2zm2-2h2v2h-2zm2 2h2v2h-2z"/></svg>
                        </div>
                        <div>
                            <p style="font-weight:600;font-size:0.88rem;margin:0;color:#1a1a1a;">QRIS</p>
                            <p style="font-size:0.76rem;color:#888;margin:0;">Scan QR code untuk bayar</p>
                        </div>
                    </div>
                </label>

                {{-- COD --}}
                <label id="lbl-cod" style="display:flex;align-items:center;gap:14px;padding:14px 16px;border:1px solid #e8e5e0;border-radius:10px;cursor:pointer;background:#fff;transition:all 0.2s;">
                    <input type="radio" name="metode_pembayaran_ui" value="cod"
                           style="accent-color:#2e7d32;width:16px;height:16px;" onchange="togglePayment(this)">
                    <div style="display:flex;align-items:center;gap:10px;flex:1;">
                        <div style="width:36px;height:36px;background:#f57f17;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                        </div>
                        <div>
                            <p style="font-weight:600;font-size:0.88rem;margin:0;color:#1a1a1a;">COD (Bayar di Tempat)</p>
                            <p style="font-size:0.76rem;color:#888;margin:0;">Bayar saat barang tiba</p>
                        </div>
                    </div>
                </label>

                {{-- Bank list (shown for transfer) --}}
                <div id="bank-list" style="margin-top:14px;display:grid;grid-template-columns:repeat(3,1fr);gap:8px;">
                    @foreach(['Bank BRI Virtual Account','Bank BCA Virtual Account','Bank Mandiri Virtual Account','Bank BNI Virtual Account','Bank Permata (BRImo)','Bank Rakyat Indo (BRI)','Bank Tabungan Negara (BTN)'] as $bank)
                    <label style="display:flex;align-items:center;gap:8px;padding:10px 12px;border:1px solid #e8e5e0;border-radius:8px;cursor:pointer;font-size:0.78rem;background:#fafaf9;">
                        <input type="radio" name="bank_tujuan" value="{{ $bank }}" {{ $loop->first ? 'checked' : '' }}
                               style="accent-color:#2e7d32;">
                        {{ $bank }}
                    </label>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN: Order Summary + Submit --}}
        <div style="position:sticky;top:80px;">
            <form action="{{ route('checkout.konfirmasi') }}" method="POST"
                  style="background:#fff;border:1px solid #e8e5e0;border-radius:14px;padding:24px;" id="checkoutForm">
                @csrf
                <input type="hidden" name="metode_pembayaran" id="hidden_metode" value="Transfer Bank">

                <h3 style="font-size:0.95rem;font-weight:700;margin:0 0 16px;color:#1a1a1a;">Ringkasan Pesanan</h3>

                @foreach($items as $item)
                <div style="display:flex;justify-content:space-between;font-size:0.82rem;color:#666;margin-bottom:6px;">
                    <span>{{ $item->produk->nama }} × {{ $item->qty }}</span>
                    <span>Rp.{{ number_format($item->produk->harga * $item->qty,0,',','.') }}</span>
                </div>
                @endforeach

                <hr style="border:none;border-top:1px dashed #e8e5e0;margin:14px 0;">

                <div style="display:flex;justify-content:space-between;font-size:0.84rem;color:#666;margin-bottom:6px;">
                    <span>Subtotal</span>
                    <span>Rp.{{ number_format($total,0,',','.') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:0.84rem;color:#666;margin-bottom:16px;">
                    <span>Ongkos Kirim</span>
                    <span>Rp.100.000</span>
                </div>

                <div style="background:#f9f8f6;border-radius:10px;padding:14px;margin-bottom:18px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:700;font-size:1rem;color:#1a1a1a;">Total</span>
                        <span style="font-weight:700;font-size:1.1rem;color:#2e7d32;">Rp.{{ number_format($grandTotal,0,',','.') }}</span>
                    </div>
                    <p style="font-size:0.72rem;color:#aaa;margin:4px 0 0;">Sudah termasuk PPN</p>
                </div>

                <div style="margin-bottom:14px;">
                    <label style="display:flex;align-items:flex-start;gap:10px;font-size:0.8rem;color:#666;cursor:pointer;">
                        <input type="checkbox" required style="margin-top:2px;accent-color:#2e7d32;">
                        Saya menyetujui <a href="#" style="color:#2e7d32;margin-left:4px;">Syarat &amp; Ketentuan</a>
                    </label>
                </div>

                <button type="submit"
                        style="width:100%;padding:14px;background:linear-gradient(135deg,#2e7d32,#43a047);color:#fff;border:none;border-radius:24px;font-size:0.95rem;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:opacity 0.2s;"
                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                    Bayar Rp.{{ number_format($grandTotal,0,',','.') }}
                </button>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
@media(max-width:768px){
    div[style*="grid-template-columns:1fr 380px"]{
        grid-template-columns:1fr !important;
    }
    div[style*="grid-template-columns:repeat(3,1fr)"]{
        grid-template-columns:1fr 1fr !important;
    }
    div[style*="position:sticky"]{
        position:static !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
const labelMap = {
    'transfer': { id: 'lbl-transfer', hidden: 'Transfer Bank' },
    'qris':     { id: 'lbl-qris',     hidden: 'QRIS' },
    'cod':      { id: 'lbl-cod',      hidden: 'COD (Bayar di Tempat)' },
};

function togglePayment(radio) {
    // Reset all borders
    Object.values(labelMap).forEach(m => {
        const el = document.getElementById(m.id);
        if (el) { el.style.border = '1px solid #e8e5e0'; el.style.background = '#fff'; }
    });
    // Highlight selected
    const sel = labelMap[radio.value];
    if (sel) {
        const el = document.getElementById(sel.id);
        if (el) { el.style.border = '2px solid #2e7d32'; el.style.background = '#f1f8e9'; }
    }
    // Show/hide bank list
    document.getElementById('bank-list').style.display = radio.value === 'transfer' ? 'grid' : 'none';
    // Update hidden input
    document.getElementById('hidden_metode').value = sel ? sel.hidden : radio.value;
}
</script>
@endpush

@endsection
