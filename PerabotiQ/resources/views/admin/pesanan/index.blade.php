@extends('layouts.admin')
@section('title','Kelola Pesanan')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-receipt" style="color:var(--accent);margin-right:8px;"></i>Kelola Pesanan</h1>
        <p>Pantau dan kelola semua pesanan masuk</p>
    </div>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th style="text-align:right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanan as $p)
            <tr>
                <td><span style="font-weight:600;color:var(--text-muted);">#{{ $p->id }}</span></td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg, var(--accent), var(--accent-light));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:0.75rem;">
                            {{ strtoupper(substr($p->user->name, 0, 1)) }}
                        </div>
                        <span style="font-weight:500;">{{ $p->user->name }}</span>
                    </div>
                </td>
                <td style="font-weight:600;">Rp{{ number_format($p->total,0,',','.') }}</td>
                <td>
                    @php
                        $statusMap = [
                            'menunggu_pembayaran' => ['badge-warning', 'bi-clock'],
                            'diproses' => ['badge-info', 'bi-gear'],
                            'dikemas' => ['badge-info', 'bi-box-seam'],
                            'siap_kirim' => ['badge-info', 'bi-truck'],
                            'dalam_pengiriman' => ['badge-warning', 'bi-send'],
                            'terkirim' => ['badge-success', 'bi-check-circle'],
                        ];
                        $st = $statusMap[$p->status] ?? ['badge-neutral', 'bi-circle'];
                    @endphp
                    <span class="badge {{ $st[0] }}">
                        <i class="bi {{ $st[1] }}"></i> {{ str_replace('_',' ',ucfirst($p->status)) }}
                    </span>
                </td>
                <td style="color:var(--text-muted);">{{ $p->created_at->format('d M Y') }}</td>
                <td style="text-align:right;">
                    <a href="{{ route('admin.pesanan.detail', $p->id) }}" class="btn btn-sm">
                        <i class="bi bi-eye"></i> Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <i class="bi bi-receipt" style="display:block;"></i>
                        <p>Belum ada pesanan masuk.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
