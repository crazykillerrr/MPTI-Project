@extends('layouts.admin')
@section('title','Kelola Transaksi')
@section('content')
<h1>Kelola Transaksi</h1>
<table>
    <thead><tr><th>#</th><th>Customer</th><th>Pesanan</th><th>Total</th><th>Metode</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
        @forelse($transaksi as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->user->name }}</td>
            <td>#{{ $t->pesanan_id }}</td>
            <td>Rp.{{ number_format($t->total,0,',','.') }}</td>
            <td>{{ $t->metode_pembayaran ?? '-' }}</td>
            <td>
                @if($t->status === 'lunas')
                    <span style="padding:3px 10px;border-radius:12px;background:#e8f5e9;color:#2e7d32;font-size:0.78rem;">Lunas</span>
                @elseif($t->status === 'ditolak')
                    <span style="padding:3px 10px;border-radius:12px;background:#fce4ec;color:#c62828;font-size:0.78rem;">Ditolak</span>
                @else
                    <span style="padding:3px 10px;border-radius:12px;background:#fff3e0;color:#e65100;font-size:0.78rem;">Pending</span>
                @endif
            </td>
            <td>
                @if($t->status === 'pending')
                <div style="display:flex;gap:6px;">
                    <form action="{{ route('admin.transaksi.verifikasi', $t->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="lunas">
                        <button type="submit" class="btn" onclick="return confirm('Verifikasi pembayaran?')">✓ Lunas</button>
                    </form>
                    <form action="{{ route('admin.transaksi.verifikasi', $t->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak pembayaran?')">✗ Tolak</button>
                    </form>
                </div>
                @else
                    <span style="font-size:0.82rem;color:#888;">—</span>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;color:#aaa;padding:30px;">Belum ada transaksi.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
