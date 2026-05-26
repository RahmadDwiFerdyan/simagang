@extends('layouts.app')

@section('content')
@php
    $statusRows = [
        [
            'label' => 'Pending',
            'total' => $totalPending,
            'class' => 'bg-yellow-100 text-yellow-800',
        ],
        [
            'label' => 'Approved',
            'total' => $totalApproved,
            'class' => 'bg-green-100 text-green-800',
        ],
        [
            'label' => 'Rejected',
            'total' => $totalRejected,
            'class' => 'bg-red-100 text-red-800',
        ],
    ];
@endphp

<h2 class="text-2xl font-bold mb-4">Report Status Pendaftaran</h2>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Grafik Status Pendaftaran</h3>
        <div class="h-72">
            <canvas id="statusPendaftarChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Tabel Status Pendaftaran</h3>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-start">Status</th>
                    <th class="p-3 text-start">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statusRows as $row)
                    <tr class="border-t">
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm font-semibold {{ $row['class'] }}">
                                {{ $row['label'] }}
                            </span>
                        </td>
                        <td class="p-3">{{ $row['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-t font-bold">
                    <td class="p-3">Total Pendaftar</td>
                    <td class="p-3">{{ $totalPendaftar }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="mt-6">
    <h2 class="text-2xl font-bold mb-4">Summary Jumlah Pendaftar per Departemen</h2>

    <div class="">
        <div class="bg-white p-5 rounded shadow overflow-x-auto">
            <h3 class="text-lg font-bold mb-4">Tabel Summary Departemen</h3>
            <table class="w-full min-w-[720px]">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 text-start">Departemen</th>
                        <th class="p-3 text-start">Total Kuota</th>
                        <th class="p-3 text-start">Pending</th>
                        <th class="p-3 text-start">Diterima</th>
                        <th class="p-3 text-start">Ditolak</th>
                        <th class="p-3 text-start">Sisa Kuota</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($summaryDepartemen as $row)
                        <tr class="border-t">
                            <td class="p-3 font-semibold">{{ $row->departemen }}</td>
                            <td class="p-3">{{ $row->total_quota }}</td>
                            <td class="p-3">{{ $row->pending }}</td>
                            <td class="p-3">{{ $row->diterima }}</td>
                            <td class="p-3">{{ $row->ditolak }}</td>
                            <td class="p-3">{{ $row->sisa_quota }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">
                                Belum ada data departemen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartTextColor = '#374151';
    const chartGridColor = '#e5e7eb';
    const summaryDepartemen = @json($summaryDepartemen);

    const statusPendaftarData = {
        labels: ['Pending', 'Approved', 'Rejected'],
        datasets: [{
            data: [{{ $totalPending }}, {{ $totalApproved }}, {{ $totalRejected }}],
            backgroundColor: ['#f59e0b', '#22c55e', '#ef4444'],
            borderColor: '#ffffff',
            borderWidth: 2,
        }],
    };

    new Chart(document.getElementById('statusPendaftarChart'), {
        type: 'doughnut',
        data: statusPendaftarData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: chartTextColor,
                    },
                },
            },
        },
    });
</script>
@endsection
