{{--
  _rekomendasi.blade.php
  Partial: Product Recommendations section
  Variables:
    $produkRekomendasi  — Collection<Produk>
    $checkoutUrl        — string, URL for "Lihat Semua"
    $isGuest            — bool
--}}
@php
  $rekAll      = isset($produkRekomendasi) ? $produkRekomendasi->values() : collect();
  $rekTotal    = $rekAll->count();
  $heroProduk  = $rekAll->get(0);
  $dot1Produk  = $rekAll->get(1);
  $side1       = $rekAll->get(2);
  $side2       = $rekAll->get(3);
  $gridItems   = $rekTotal > 4 ? $rekAll->slice(4) : collect();
  $isGuest     = $isGuest ?? false;
@endphp

<section id="recommendations" class="section" style="background:#f5f4f2; padding:48px 0 56px;">
  <div class="container" style="max-width:1160px;">

    {{-- ── Header ── --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
      <div>
        <p style="font-family:'Poppins',sans-serif;font-size:10.5px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#d66428;margin:0 0 4px;">Pilihan Untukmu</p>
        <h2 style="font-family:'Poppins',sans-serif;font-size:1.55rem;font-weight:700;color:#1a1a1a;margin:0;line-height:1.15;">Product Recomendations</h2>
      </div>
      <a href="{{ $checkoutUrl ?? '#' }}"
         style="font-family:'Poppins',sans-serif;font-size:0.78rem;font-weight:600;color:#666;text-decoration:none;border:1.5px solid #ccc;border-radius:20px;padding:6px 18px;transition:all .18s;white-space:nowrap;"
         onmouseover="this.style.borderColor='#1a1a1a';this.style.color='#1a1a1a';"
         onmouseout="this.style.borderColor='#ccc';this.style.color='#666';">
        Lihat Semua &rarr;
      </a>
    </div>

    @if($rekTotal > 0)

      {{-- ═══════════════════════════════════════
           BARIS 1: Hero + Side cards
           ═══════════════════════════════════════ --}}
      <div class="rek-layout">

        {{-- ── HERO CARD (kiri besar) ── --}}
        @if($heroProduk)
        <div class="rek-hero">

          @if($isGuest)
          <a href="/login" class="rek-hero-link">
          @else
          <a href="{{ route('produk.detail', $heroProduk->id) }}" class="rek-hero-link">
          @endif
            <img
              src="{{ asset($heroProduk->gambar) }}"
              alt="{{ $heroProduk->nama }}"
              class="rek-hero-img"
              onerror="this.src='https://placehold.co/680x380/e8e4df/aaa?text=Produk'"
            >
            <div class="rek-hero-bar">
              <p class="hero-name">{{ $heroProduk->nama }}</p>
              <p class="hero-price">Rp{{ number_format($heroProduk->harga, 0, ',', '.') }}</p>
            </div>
          </a>

          {{-- Hotspot dot 1 — hero produk (kiri bawah) --}}
          <div class="rek-dot" style="left:28%;bottom:40%;">
            <div class="rek-dot-ring">
              <div class="rek-dot-inner"></div>
            </div>
            <div class="rek-price-tag">
              <p class="rek-tag-name">{{ $heroProduk->nama }}</p>
              <p class="rek-tag-cat">{{ ucwords(str_replace('-', ' ', $heroProduk->kategori)) }}</p>
              <p class="rek-tag-price">Rp. {{ number_format($heroProduk->harga, 0, ',', '.') }}</p>
            </div>
          </div>

          {{-- Hotspot dot 2 — produk ke-2 (kanan atas) --}}
          @if($dot1Produk)
          <div class="rek-dot dot-flip" style="right:22%;top:30%;">
            <div class="rek-dot-ring">
              <div class="rek-dot-inner"></div>
            </div>
            <div class="rek-price-tag">
              <p class="rek-tag-name">{{ $dot1Produk->nama }}</p>
              <p class="rek-tag-cat">{{ ucwords(str_replace('-', ' ', $dot1Produk->kategori)) }}</p>
              <p class="rek-tag-price">Rp. {{ number_format($dot1Produk->harga, 0, ',', '.') }}</p>
            </div>
          </div>
          @endif

        </div>
        @endif

        {{-- ── SIDE CARDS (kanan, 2 stacked) ── --}}
        <div class="rek-side-stack">

          {{-- Side card 1 --}}
          @if($side1)
            @if($isGuest)
            <a href="/login" class="rek-side-card">
            @else
            <a href="{{ route('produk.detail', $side1->id) }}" class="rek-side-card">
            @endif
              <div class="rek-side-img-wrap">
                <img
                  src="{{ asset($side1->gambar) }}"
                  alt="{{ $side1->nama }}"
                  class="rek-side-img"
                  onerror="this.src='https://placehold.co/380x220/f0eeeb/aaa?text=Produk'"
                >
                <div class="rek-side-badge">
                  @if($isGuest)
                    <i class="bi bi-lock-fill me-1"></i> Login untuk beli
                  @else
                    <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                  @endif
                </div>
              </div>
              <div class="rek-side-info">
                <p class="rek-side-price">Rp.{{ number_format($side1->harga, 0, ',', '.') }}</p>
                <p class="rek-side-name">{{ $side1->nama }}</p>
              </div>
            </a>
          @else
            <div class="rek-side-card" style="background:#ece9e4;border:none;align-items:center;justify-content:center;">
              <p style="font-family:'Poppins',sans-serif;color:#bbb;font-size:0.75rem;padding:20px;text-align:center;">Produk segera hadir</p>
            </div>
          @endif

          {{-- Side card 2 --}}
          @if($side2)
            @if($isGuest)
            <a href="/login" class="rek-side-card">
            @else
            <a href="{{ route('produk.detail', $side2->id) }}" class="rek-side-card">
            @endif
              <div class="rek-side-img-wrap">
                <img
                  src="{{ asset($side2->gambar) }}"
                  alt="{{ $side2->nama }}"
                  class="rek-side-img"
                  onerror="this.src='https://placehold.co/380x220/f0eeeb/aaa?text=Produk'"
                >
                <div class="rek-side-badge">
                  @if($isGuest)
                    <i class="bi bi-lock-fill me-1"></i> Login untuk beli
                  @else
                    <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                  @endif
                </div>
              </div>
              <div class="rek-side-info">
                <p class="rek-side-price">Rp.{{ number_format($side2->harga, 0, ',', '.') }}</p>
                <p class="rek-side-name">{{ $side2->nama }}</p>
              </div>
            </a>
          @else
            <div class="rek-side-card" style="background:#ece9e4;border:none;align-items:center;justify-content:center;">
              <p style="font-family:'Poppins',sans-serif;color:#bbb;font-size:0.75rem;padding:20px;text-align:center;">Produk segera hadir</p>
            </div>
          @endif

        </div>{{-- /rek-side-stack --}}

      </div>{{-- /rek-layout --}}

      {{-- ═══════════════════════════════════════
           BARIS 2: Grid kecil di bawah
           ═══════════════════════════════════════ --}}
      @if($gridItems->count() > 0)
      <div class="rek-grid">
        @foreach($gridItems as $gp)
          @if($isGuest)
          <a href="/login" class="rek-grid-card">
          @else
          <a href="{{ route('produk.detail', $gp->id) }}" class="rek-grid-card">
          @endif
            <div class="rek-grid-img-wrap">
              <img
                src="{{ asset($gp->gambar) }}"
                alt="{{ $gp->nama }}"
                class="rek-grid-img"
                onerror="this.src='https://placehold.co/200x150/f0eeeb/aaa?text=Produk'"
              >
              <div class="rek-grid-overlay">
                @if($isGuest)
                  <span><i class="bi bi-lock me-1"></i> Login untuk beli</span>
                @else
                  <span><i class="bi bi-eye me-1"></i> Lihat Detail</span>
                @endif
              </div>
            </div>
            <div class="rek-grid-info">
              <p class="rek-grid-name">{{ $gp->nama }}</p>
              <p class="rek-grid-price">Rp{{ number_format($gp->harga, 0, ',', '.') }}</p>
              <span class="rek-grid-cat">{{ ucwords(str_replace('-', ' ', $gp->kategori)) }}</span>
            </div>
          </a>
        @endforeach
      </div>
      @endif

    @else
      <div class="rek-empty">
        <i class="bi bi-bag-x" style="font-size:2.2rem;display:block;margin-bottom:10px;color:#ccc;"></i>
        Belum ada produk rekomendasi saat ini.
      </div>
    @endif

  </div>
</section>
