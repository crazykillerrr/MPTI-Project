@extends('layouts.admin')
@section('title','Sales Report')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-bar-chart-line-fill" style="color:var(--accent);margin-right:8px;"></i>Sales Report</h1>
        <p>Store revenue and sales summary</p>
    </div>
</div>

<div class="card-grid" style="grid-template-columns:repeat(2,1fr);max-width:520px;">
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Revenue</div>
            <div class="card-icon green"><i class="bi bi-wallet2"></i></div>
        </div>
        <div class="value" style="font-size:1.2rem;">Rp{{ number_format($pendapatan,0,',','.') }}</div>
    </div>
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Items Sold</div>
            <div class="card-icon orange"><i class="bi bi-bag-check-fill"></i></div>
        </div>
        <div class="value">{{ $terjual }}</div>
    </div>
</div>

<!-- Chart Section -->
<div style="background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius-lg);padding:28px;margin-bottom:28px;box-shadow:var(--shadow-sm);">
    <h3 style="font-size:0.95rem;font-weight:600;margin-bottom:20px;color:var(--text-secondary);">
        <i class="bi bi-graph-up" style="margin-right:6px;color:var(--accent);"></i>Monthly Revenue Chart
    </h3>
    <canvas id="revenueChart" height="100"></canvas>
</div>

<!-- Table Section -->
<h2 style="font-size:1rem;font-weight:600;margin:0 0 16px;color:var(--text-secondary);">
    <i class="bi bi-table" style="margin-right:6px;"></i>Monthly Breakdown
</h2>
<div class="table-container" style="max-width:520px;">
    <table>
        <thead><tr><th>Month</th><th style="text-align:right;">Revenue</th></tr></thead>
        <tbody>
            @forelse($perBulan as $b)
            <tr>
                <td style="font-weight:500;">{{ DateTime::createFromFormat('!m', $b->bulan)->format('F') }}</td>
                <td style="text-align:right;font-weight:600;">Rp{{ number_format($b->total,0,',','.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">
                    <div class="empty-state" style="padding:30px;">
                        <i class="bi bi-graph-down" style="display:block;"></i>
                        <p>No sales data available.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const months = @json($perBulan->map(fn($b) => DateTime::createFromFormat('!m', $b->bulan)->format('M')));
    const totals = @json($perBulan->pluck('total'));

    if (document.getElementById('revenueChart') && months.length > 0) {
        new Chart(document.getElementById('revenueChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Revenue (Rp)',
                    data: totals,
                    backgroundColor: 'rgba(239, 102, 3, 0.2)',
                    borderColor: '#ef6603',
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(239, 102, 3, 0.4)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f0eeeb' },
                        ticks: {
                            callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'jt',
                            font: { family: 'Poppins', size: 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Poppins', size: 12 } }
                    }
                }
            }
        });
    }
</script>
@endpush
@endsection
