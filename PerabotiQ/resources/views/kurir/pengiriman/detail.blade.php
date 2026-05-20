@extends('layouts.kurir')
@section('title', 'Update Delivery Status')
@section('content')

{{-- Header --}}
<div class="card" style="margin-bottom:18px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <div class="page-title">Update Delivery</div>
        <div class="page-sub">Order #{{ $pesanan->id }} — {{ $pesanan->user->name }}</div>
    </div>
    <a href="{{ route('kurir.pengiriman') }}" class="btn btn-outline">Back</a>
</div>

{{-- Form --}}
<div class="card" style="max-width:480px;">
    <div class="section-title" style="margin-bottom:18px;">Delivery Outcome</div>
    <form action="{{ route('kurir.pengiriman.status', $pesanan->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Delivery Status</label>
            <select name="status" class="form-control" required>
                <option value="terkirim">Delivered Successfully</option>
                <option value="gagal_kirim">Failed Delivery</option>
            </select>
        </div>
        <div style="display:flex; gap:10px; margin-top:6px;">
            <button type="submit" class="btn btn-solid">Save Status</button>
            <a href="{{ route('kurir.pengiriman') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

@endsection
