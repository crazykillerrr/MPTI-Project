@extends('layouts.customer')
@section('title', 'Profil Saya — PerabotiQ')
@section('content')

<div style="max-width:700px;margin:50px auto;padding:0 20px 60px;">

    {{-- Page Header --}}
    <div style="margin-bottom:30px;">
        <a href="{{ route('customer.dashboard') }}" style="font-size:0.85rem;color:#888;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
            &#8592; Kembali ke Beranda
        </a>
        <h2 style="font-size:1.6rem;font-weight:700;margin-top:12px;color:#1a1a1a;">Profil Saya</h2>
        <p style="font-size:0.88rem;color:#aaa;margin-top:4px;">Informasi akun yang terdaftar di PerabotiQ</p>
    </div>

    {{-- Profile Card --}}
    <div style="background:#fff;border:1px solid #e8e5e0;border-radius:16px;overflow:hidden;box-shadow:0 2px 16px rgba(0,0,0,0.06);">

        {{-- Avatar Banner --}}
        <div style="background:linear-gradient(135deg,#2e7d32 0%,#66bb6a 100%);padding:36px 36px 60px;position:relative;">
            <div style="width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;border:3px solid #fff;position:absolute;bottom:-40px;left:36px;">
                <span style="font-size:2.2rem;font-weight:700;color:#fff;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
            </div>
        </div>

        {{-- Name below avatar --}}
        <div style="padding:52px 36px 0;">
            <h3 style="font-size:1.25rem;font-weight:700;margin:0;color:#1a1a1a;">{{ $user->name }}</h3>
            <span style="display:inline-block;margin-top:4px;font-size:0.75rem;padding:3px 12px;border-radius:20px;background:#e8f5e9;color:#2e7d32;font-weight:600;">Customer</span>
        </div>

        <hr style="margin:24px 36px 0;border:none;border-top:1px solid #f0eeeb;">

        {{-- Info Grid --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;padding:0 36px 36px;">

            {{-- Full Name --}}
            <div style="padding:20px 20px 20px 0;border-bottom:1px solid #f0eeeb;">
                <p style="font-size:0.75rem;color:#aaa;text-transform:uppercase;letter-spacing:0.08em;font-weight:600;margin:0 0 6px;">Nama Lengkap</p>
                <p style="font-size:0.95rem;font-weight:500;color:#1a1a1a;margin:0;">{{ $user->name }}</p>
            </div>

            {{-- Email --}}
            <div style="padding:20px 0 20px 20px;border-bottom:1px solid #f0eeeb;border-left:1px solid #f0eeeb;">
                <p style="font-size:0.75rem;color:#aaa;text-transform:uppercase;letter-spacing:0.08em;font-weight:600;margin:0 0 6px;">Email</p>
                <p style="font-size:0.95rem;font-weight:500;color:#1a1a1a;margin:0;word-break:break-all;">{{ $user->email }}</p>
            </div>

            {{-- Phone --}}
            <div style="padding:20px 20px 20px 0;border-bottom:1px solid #f0eeeb;">
                <p style="font-size:0.75rem;color:#aaa;text-transform:uppercase;letter-spacing:0.08em;font-weight:600;margin:0 0 6px;">Nomor Telepon</p>
                <p style="font-size:0.95rem;font-weight:500;color:#1a1a1a;margin:0;">
                    {{ $user->phone ?: '—' }}
                </p>
            </div>

            {{-- Post Code --}}
            <div style="padding:20px 0 20px 20px;border-bottom:1px solid #f0eeeb;border-left:1px solid #f0eeeb;">
                <p style="font-size:0.75rem;color:#aaa;text-transform:uppercase;letter-spacing:0.08em;font-weight:600;margin:0 0 6px;">Kode Pos</p>
                <p style="font-size:0.95rem;font-weight:500;color:#1a1a1a;margin:0;">
                    {{ $user->post_code ?: '—' }}
                </p>
            </div>

            {{-- Address (full width) --}}
            <div style="grid-column:1/-1;padding:20px 0 0;">
                <p style="font-size:0.75rem;color:#aaa;text-transform:uppercase;letter-spacing:0.08em;font-weight:600;margin:0 0 6px;">Alamat</p>
                <p style="font-size:0.95rem;font-weight:500;color:#1a1a1a;margin:0;line-height:1.6;">
                    {{ $user->address ?: '—' }}
                    @if($user->post_code)
                        <span style="color:#888;font-size:0.88rem;"> &nbsp;{{ $user->post_code }}</span>
                    @endif
                </p>
            </div>

        </div>
    </div>

    {{-- Quick Actions --}}
    <div style="display:flex;gap:12px;margin-top:20px;">
        <a href="{{ route('customer.pesanan') }}"
           style="flex:1;text-align:center;padding:14px;background:#fff;border:1.5px solid #e8e5e0;border-radius:12px;text-decoration:none;color:#1a1a1a;font-size:0.88rem;font-weight:500;transition:all 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;">
            &#128230; Pesanan Saya
        </a>
        <a href="{{ route('keranjang') }}"
           style="flex:1;text-align:center;padding:14px;background:#fff;border:1.5px solid #e8e5e0;border-radius:12px;text-decoration:none;color:#1a1a1a;font-size:0.88rem;font-weight:500;transition:all 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;">
            &#128722; Keranjang
        </a>
        <form action="{{ route('logout') }}" method="POST" style="flex:1;">
            @csrf
            <button type="submit"
                    style="width:100%;padding:14px;background:#fff;border:1.5px solid #fce4ec;border-radius:12px;color:#c62828;font-size:0.88rem;font-weight:500;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;">
                &#x1F6AA; Logout
            </button>
        </form>
    </div>

</div>

@push('styles')
<style>
@media(max-width:576px){
    div[style*="grid-template-columns:1fr 1fr"]{
        grid-template-columns:1fr !important;
    }
    div[style*="grid-column:1/-1"]{
        grid-column:1 !important;
    }
    div[style*="padding:20px 0 20px 20px"]{
        border-left:none !important;
        padding-left:0 !important;
        border-top:1px solid #f0eeeb;
    }
}
</style>
@endpush
@endsection
