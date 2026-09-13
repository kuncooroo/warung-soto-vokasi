@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <x-admin-page-header title="Dashboard" />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">

        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-purple-50 text-purple-600 mr-4 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</h3>
                <p class="text-gray-400 text-xs font-medium">Total User</p>
            </div>
        </div>

        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-green-50 text-green-600 mr-4 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $todayOrders }}</h3>
                <p class="text-gray-400 text-xs font-medium">Order Hari Ini</p>
            </div>
        </div>

        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-yellow-50 text-yellow-500 mr-4 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $pendingPayments }}</h3>
                <p class="text-gray-400 text-xs font-medium">Pending</p>
            </div>
        </div>

        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-red-50 text-red-500 mr-4 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</h3>
                <p class="text-gray-400 text-xs font-medium">Total Order</p>
            </div>
        </div>

        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-indigo-50 text-indigo-500 mr-4 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p class="text-gray-400 text-xs font-medium">Pendapatan</p>
            </div>
        </div>
        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-green-50 text-green-600 mr-4 flex-shrink-0">
                <span class="text-2xl">🍽️</span>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
                <p class="text-gray-400 text-xs font-medium">Total Produk</p>
            </div>
        </div>

        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-yellow-50 text-yellow-500 mr-4 flex-shrink-0">
                <span class="text-2xl">⭐</span>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalTestimoni }}</h3>
                <p class="text-gray-400 text-xs font-medium">Total Testimoni</p>
            </div>
        </div>

        <div class="admin-card flex items-center">
            <div class="rounded-full p-4 bg-blue-50 text-blue-500 mr-4 flex-shrink-0">
                <span class="text-2xl">📧</span>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalMessages }}</h3>
                <p class="text-gray-400 text-xs font-medium">Pesan Baru</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

        <x-admin-form-card>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h4 class="font-bold text-gray-800">Order 7 Hari Terakhir</h4>
                    <p class="text-xs text-gray-400">Statistik pesanan harian</p>
                </div>
            </div>
            <div id="dailyOrdersChart"></div>
        </x-admin-form-card>

        <x-admin-form-card>
            <div class="flex justify-between items-center mb-6">
                <h4 class="font-bold text-gray-800">Pendapatan Bulanan</h4>
            </div>
            <div id="revenueChart"></div>
        </x-admin-form-card>
    </div>

    <x-admin-form-card>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Transaksi Terbaru</h3>
        <p class="text-gray-500 text-sm mb-6">Daftar transaksi yang baru masuk</p>

        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($latestTransactions as $trx)
                        <tr class="border-b border-gray-50">
                            <td class="text-gray-700 font-medium">{{ $trx->order_number }}</td>
                            <td class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                    {{ substr($trx->customer_name ?? 'G', 0, 1) }}
                                </div>
                                <span class="text-gray-600">{{ $trx->customer_name ?? 'Guest' }}</span>
                            </td>
                            <td class="text-gray-600 font-bold">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                            </td>
                            <td>
                                <x-status-badge :value="$trx->payment_status" :variant="$trx->payment_status" />
                            </td>
                            <td class="text-gray-500">{{ $trx->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-admin-form-card>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var dailyLabels = {!! json_encode(array_keys($dailyOrders->toArray())) !!};
            var dailyData = {!! json_encode(array_values($dailyOrders->toArray())) !!};

            var dailyOptions = {
                series: [{
                    name: 'Orders',
                    data: dailyData
                }],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    categories: dailyLabels,
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: '#A0AEC0'
                        }
                    }
                },
                colors: ['#2D9CDB'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                grid: {
                    borderColor: '#f1f1f1'
                }
            };
            new ApexCharts(document.querySelector("#dailyOrdersChart"), dailyOptions).render();

            var revenueLabels = {!! json_encode(array_keys($monthlyRevenue->toArray())) !!};
            var revenueData = {!! json_encode(array_values($monthlyRevenue->toArray())) !!};

            var revenueOptions = {
                series: [{
                    name: "Pendapatan",
                    data: revenueData
                }],
                chart: {
                    height: 300,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#FF5B5B'],
                xaxis: {
                    categories: revenueLabels,
                    labels: {
                        style: {
                            colors: '#A0AEC0'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#A0AEC0'
                        },
                        formatter: function(value) {
                            return "Rp " + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f1f1'
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return "Rp " + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            };
            new ApexCharts(document.querySelector("#revenueChart"), revenueOptions).render();
        });
    </script>
@endsection
