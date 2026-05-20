@extends('layouts.admin')
@section('title','Kelola Transaksi')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-credit-card-fill" style="color:var(--accent);margin-right:8px;"></i>Kelola Transaksi</h1>
        <p>Verifikasi dan kelola pembayaran</p>
    </div>
</div>

<div class="table-container">
    <table>
        <thead><tr><th>#ID</th><th>Customer</th><th>Pesanan</th><th>Total</th><th>Metode</th><th>Status</th><th style="text-align:right;">Aksi</th></tr></thead>
        <tbody>
            @forelse($transaksi as $t)
            <tr>
                <td><span style="font-weight:600;color:var(--text-muted);">#{{ $t->id }}</span></td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent-light));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:0.75rem;">{{ strtoupper(substr($t->user->name,0,1)) }}</div>
                        <span style="font-weight:500;">{{ $t->user->name }}</span>
                    </div>
                </td>
                <td><span class="badge badge-neutral">#{{ $t->pesanan_id }}</span></td>
                <td style="font-weight:600;">Rp{{ number_format($t->total,0,',','.') }}</td>
                <td>{{ $t->metode_pembayaran ?? '-' }}</td>
                <td>
                    @if($t->status === 'lunas')
                        <span class="badge badge-success"><i class="bi bi-check-circle-fill"></i> Lunas</span>
                    @elseif($t->status === 'ditolak')
                        <span class="badge badge-danger"><i class="bi bi-x-circle-fill"></i> Ditolak</span>
                    @else
                        <span class="badge badge-warning"><i class="bi bi-clock-fill"></i> Pending</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    @if($t->status === 'pending')
                    <div style="display:flex;gap:6px;justify-content:flex-end;">
                        <form action="{{ route('admin.transaksi.verifikasi', $t->id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="lunas">
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Verifikasi pembayaran?')"><i class="bi bi-check-lg"></i> Lunas</button>
                        </form>
                        <form action="{{ route('admin.transaksi.verifikasi', $t->id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="ditolak">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak pembayaran?')"><i class="bi bi-x-lg"></i> Tolak</button>
                        </form>
                    </div>
                    @else
                        <span style="font-size:0.82rem;color:var(--text-muted);">—</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state"><i class="bi bi-credit-card" style="display:block;"></i><p>Belum ada transaksi.</p></div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
