@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- 1. Stats Cards Section -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
    
    <!-- Existing: Total Produk -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center">
        <div class="rounded-full p-4 bg-green-50 text-green-600 mr-4 flex-shrink-0">
            <span class="text-2xl">🍽️</span>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
            <p class="text-gray-400 text-xs font-medium">Total Produk</p>
        </div>
    </div>

    <!-- Existing: Total Testimoni -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center">
        <div class="rounded-full p-4 bg-yellow-50 text-yellow-500 mr-4 flex-shrink-0">
            <span class="text-2xl">⭐</span>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalTestimoni }}</h3>
            <p class="text-gray-400 text-xs font-medium">Total Testimoni</p>
        </div>
    </div>

    <!-- Existing: Pesan Baru -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center">
        <div class="rounded-full p-4 bg-blue-50 text-blue-500 mr-4 flex-shrink-0">
            <span class="text-2xl">📧</span>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalMessages }}</h3>
            <p class="text-gray-400 text-xs font-medium">Pesan Baru</p>
        </div>
    </div>

    <!-- NEW: Total Orders (Placeholder) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center">
        <div class="rounded-full p-4 bg-red-50 text-red-500 mr-4 flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-gray-800">0</h3>
            <p class="text-gray-400 text-xs font-medium">Total Orders</p>
        </div>
    </div>

    <!-- NEW: Total Revenue (Placeholder) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center">
        <div class="rounded-full p-4 bg-indigo-50 text-indigo-500 mr-4 flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Rp 0</h3>
            <p class="text-gray-400 text-xs font-medium">Total Revenue</p>
        </div>
    </div>
</div>

<!-- 2. Charts Row 1: Pie Chart & Chart Order -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    
    <!-- Pie Chart (Radial Bar style per image) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm lg:col-span-1">
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-gray-800">Pie Chart</h4>
            <div class="flex gap-2">
                <span class="text-xs text-gray-400 flex items-center"><span class="w-2 h-2 rounded-full bg-red-500 mr-1"></span> Chart</span>
                <span class="text-xs text-gray-400 flex items-center"><span class="w-2 h-2 rounded-full bg-green-500 mr-1"></span> Value</span>
            </div>
        </div>
        <div id="pieChart"></div>
        <div class="flex justify-between text-center mt-4 text-xs text-gray-500">
            <div>
                <p class="font-bold text-gray-800">Total Order</p>
            </div>
            <div>
                <p class="font-bold text-gray-800">Customer Growth</p>
            </div>
            <div>
                <p class="font-bold text-gray-800">Total Revenue</p>
            </div>
        </div>
    </div>

    <!-- Chart Order (Line Chart) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm lg:col-span-2">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h4 class="font-bold text-gray-800">Chart Order</h4>
                <p class="text-xs text-gray-400">Statistik pesanan harian</p>
            </div>
            <button class="text-green-600 border border-green-600 px-3 py-1 rounded-lg text-xs hover:bg-green-50">
                ⬇ Save Report
            </button>
        </div>
        <div id="orderChart"></div>
    </div>
</div>

<!-- 3. Charts Row 2: Total Revenue & Customer Map -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    
    <!-- Total Revenue Graph -->
    <div class="bg-white rounded-2xl p-6 shadow-sm lg:col-span-2">
        <div class="flex justify-between items-center mb-6">
            <h4 class="font-bold text-gray-800">Total Revenue</h4>
            <div class="flex gap-4">
                <span class="flex items-center text-xs text-gray-500"><span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span> 2023</span>
                <span class="flex items-center text-xs text-gray-500"><span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> 2024</span>
            </div>
        </div>
        <div id="revenueChart"></div>
    </div>

    <!-- Customer Map (Bar Chart style per image) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm lg:col-span-1">
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-gray-800">Customer Map</h4>
            <button class="text-xs border px-2 py-1 rounded flex items-center gap-1">
                Weekly <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
        <div id="customerMapChart"></div>
    </div>
</div>

<!-- 4. Customer Review Section -->
<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-800 mb-2">Customer Review</h3>
    <p class="text-gray-500 text-sm mb-6">Ulasan terbaru dari pelanggan</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Review Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm flex gap-4">
            <img src="https://ui-avatars.com/api/?name=Jons+Sena&background=random" alt="User" class="w-12 h-12 rounded-full">
            <div class="flex-1">
                <h5 class="font-bold text-gray-800 text-sm">Jons Sena</h5>
                <p class="text-xs text-gray-400 mb-2">2 days ago</p>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">
                    "Soto vokasi rasanya mantap banget! Kuahnya segar dan dagingnya empuk. Pengiriman juga cepat."
                </p>
                <div class="flex text-yellow-400 text-xs">★★★★☆ <span class="text-gray-400 ml-2">4.5</span></div>
            </div>
            <div class="w-20 h-20 rounded-full bg-gray-100 overflow-hidden flex-shrink-0">
                <!-- Placeholder Image Food -->
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://source.unsplash.com/random/100x100/?soup');"></div>
            </div>
        </div>

        <!-- Review Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm flex gap-4">
            <img src="https://ui-avatars.com/api/?name=Sofia&background=random" alt="User" class="w-12 h-12 rounded-full">
            <div class="flex-1">
                <h5 class="font-bold text-gray-800 text-sm">Sofia</h5>
                <p class="text-xs text-gray-400 mb-2">2 days ago</p>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">
                    "Pelayanan ramah adminnya, harga mahasiswa banget. Recommended buat anak kos!"
                </p>
                <div class="flex text-yellow-400 text-xs">★★★★☆ <span class="text-gray-400 ml-2">4.0</span></div>
            </div>
            <div class="w-20 h-20 rounded-full bg-gray-100 overflow-hidden flex-shrink-0">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://source.unsplash.com/random/100x100/?food');"></div>
            </div>
        </div>

        <!-- Review Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm flex gap-4">
            <img src="https://ui-avatars.com/api/?name=Anandreansyah&background=random" alt="User" class="w-12 h-12 rounded-full">
            <div class="flex-1">
                <h5 class="font-bold text-gray-800 text-sm">Anandreansyah</h5>
                <p class="text-xs text-gray-400 mb-2">2 days ago</p>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">
                    "Varian sotonya lengkap, packaging rapi dan aman sampai tujuan. Sukses terus!"
                </p>
                <div class="flex text-yellow-400 text-xs">★★★★★ <span class="text-gray-400 ml-2">5.0</span></div>
            </div>
            <div class="w-20 h-20 rounded-full bg-gray-100 overflow-hidden flex-shrink-0">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://source.unsplash.com/random/100x100/?lunch');"></div>
            </div>
        </div>
    </div>
</div>

<!-- Load ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Pie Chart (Radial Bar)
        var pieOptions = {
            series: [81, 22, 62],
            chart: { height: 250, type: 'radialBar' },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: { fontSize: '22px' },
                        value: { fontSize: '16px' },
                        total: {
                            show: false,
                            label: 'Total',
                            formatter: function (w) { return 249 }
                        }
                    }
                }
            },
            labels: ['Total Order', 'Customer Growth', 'Total Revenue'],
            colors: ['#FF5B5B', '#00B074', '#2D9CDB']
        };
        new ApexCharts(document.querySelector("#pieChart"), pieOptions).render();

        // 2. Chart Order (Spline Area)
        var orderOptions = {
            series: [{
                name: 'Orders',
                data: [31, 40, 28, 51, 42, 109, 100]
            }],
            chart: { height: 250, type: 'area', toolbar: { show: false } },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            xaxis: {
                categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                labels: { style: { fontSize: '12px', colors: '#A0AEC0' } }
            },
            tooltip: { x: { format: 'dd/MM/yy HH:mm' } },
            colors: ['#2D9CDB'],
            fill: {
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.1, stops: [0, 90, 100] }
            }
        };
        new ApexCharts(document.querySelector("#orderChart"), orderOptions).render();

        // 3. Total Revenue Chart (Spline Line)
        var revenueOptions = {
            series: [
                { name: "2023", data: [10, 41, 35, 51, 49, 62, 69, 91, 148] },
                { name: "2024", data: [20, 50, 40, 60, 55, 70, 75, 100, 160] }
            ],
            chart: { height: 300, type: 'line', zoom: { enabled: false }, toolbar: { show: false } },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            colors: ['#2D9CDB', '#FF5B5B'],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                labels: { style: { colors: '#A0AEC0' } }
            },
            yaxis: { labels: { style: { colors: '#A0AEC0' } } },
            grid: { borderColor: '#f1f1f1' }
        };
        new ApexCharts(document.querySelector("#revenueChart"), revenueOptions).render();

        // 4. Customer Map (Bar Chart)
        var mapOptions = {
            series: [{ name: 'Visitors', data: [44, 55, 41, 67, 22, 43, 21] }],
            chart: { type: 'bar', height: 250, toolbar: { show: false } },
            plotOptions: {
                bar: { borderRadius: 4, columnWidth: '40%', distributed: true }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            xaxis: {
                categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                labels: { style: { fontSize: '10px' } }
            },
            colors: ['#FF5B5B', '#FFD700', '#FF5B5B', '#FFD700', '#FF5B5B', '#FFD700', '#FF5B5B']
        };
        new ApexCharts(document.querySelector("#customerMapChart"), mapOptions).render();
    });
</script>
@endsection