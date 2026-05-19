@extends('layouts.kurir')
@section('title','Dashboard Kurir')
@section('content')
<h1>Dashboard Kurir</h1>
<div class="card-grid" style="max-width:400px;">
    <div class="card"><div class="label">Siap Diambil</div><div class="value">{{ $siapKirim }}</div></div>
    <div class="card"><div class="label">Sedang Dikirim</div><div class="value">{{ $dalamKirim }}</div></div>
</div>
@endsection
