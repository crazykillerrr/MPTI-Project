@extends('layouts.kurir')
@section('title', 'Delivery Issues')
@section('content')

@php
    $issueHistory = \App\Models\Kendala::with(['pesanan.user'])
                        ->where('kurir_id', auth()->id())
                        ->latest()->get();
@endphp

{{-- Header --}}
<div class="card" style="margin-bottom:18px;">
    <div class="page-title">Delivery Issues</div>
    <div class="page-sub">Report and manage delivery issues</div>
</div>

{{-- Issue history --}}
<div class="card" style="margin-bottom:18px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
        <div class="section-title" style="margin-bottom:0;">Issue History</div>
        <button onclick="document.getElementById('report-form').scrollIntoView({behavior:'smooth'})" class="btn btn-accent" style="font-size:0.8rem; padding:6px 14px;">
            + Report Issue
        </button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Issue ID</th>
                <th>Package ID</th>
                <th>Recipient</th>
                <th>Issue Type</th>
                <th>Status</th>
                <th>Reported At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($issueHistory as $k)
            <tr>
                <td style="font-weight:600; font-size:0.82rem; color:#6B6560;">#{{ $k->id }}</td>
                <td style="color:#6B6560;">#{{ $k->pesanan_id }}</td>
                <td>{{ $k->pesanan->user->name ?? '-' }}</td>
                <td>{{ $k->jenis }}</td>
                <td>
                    @if(($k->pesanan->status ?? '') === 'dalam_pengiriman')
                        <span class="badge badge-blue">For Delivery</span>
                    @else
                        <span class="badge badge-yellow">In Progress</span>
                    @endif
                </td>
                <td style="color:#8C877F; font-size:0.8rem;">{{ $k->created_at->format('d M Y, H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#ADA8A0; padding:32px; font-size:0.85rem;">No issues reported yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Report form --}}
<div class="card" id="report-form">
    <div class="section-title" style="margin-bottom:18px;">Report New Issue</div>
    <form action="{{ route('kurir.kendala.simpan') }}" method="POST" style="max-width:520px;">
        @csrf
        <div class="form-group">
            <label class="form-label">Select Order</label>
            <select name="pesanan_id" class="form-control" required>
                <option value="">Select an order</option>
                @foreach($pesananAktif as $p)
                    <option value="{{ $p->id }}">Order #{{ $p->id }}{{ $p->user ? ' — '.$p->user->name : '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Issue Type</label>
            <select name="jenis" class="form-control" required>
                <option value="Alamat Tidak Ditemukan">Address Not Found</option>
                <option value="Penerima Tidak Ada">Recipient Unavailable</option>
                <option value="Akses Lokasi Sulit">Difficult Location Access</option>
                <option value="Lainnya">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="deskripsi" rows="4" class="form-control" placeholder="Describe the issue encountered..." required></textarea>
        </div>
        <button type="submit" class="btn btn-solid">Submit Report</button>
    </form>
</div>

@endsection
