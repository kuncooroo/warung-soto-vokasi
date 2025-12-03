@extends('layouts.public')

@section('title', 'Menu Kami')

@section('content')

    <section class="pt-20 pb-10 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-gray-900 mb-4">Menu Kami</h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed">
                Nikmati racikan bumbu warisan dalam semangkuk soto hangat yang kami siapkan khusus untuk Anda.
            </p>
        </div>
    </section>

    <section class="pb-12 bg-white sticky top-24 z-40 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form id="filter-form" action="{{ url()->current() }}" method="GET" class="flex flex-col items-center gap-6">

                <div class="relative w-full max-w-md">
                    <input type="text" id="search-input" name="search" value="{{ request('search') }}"
                        placeholder="Cari menu favoritmu..." autocomplete="off"
                        class="w-full pl-12 pr-12 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent shadow-sm text-gray-700 placeholder-gray-400 transition-all">

                    <button type="submit"
                        class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 hover:text-[#A9333A]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <div id="loading-spinner" class="absolute inset-y-0 right-0 pr-4 hidden">

                        <div class="h-full flex items-center">

                            <svg class="animate-spin h-5 w-5 text-[#A9333A]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center gap-4">
                    <input type="hidden" name="category" id="category-input" value="{{ request('category') }}">

                    <button type="button" onclick="selectCategory('')"
                        class="category-btn px-8 py-2 rounded-full font-medium transition-all duration-300 border 
                        {{ request('category') == '' ? 'bg-[#A9333A] text-white shadow-md' : 'bg-white text-gray-600 border-gray-300 hover:border-[#A9333A] hover:text-[#A9333A]' }}">
                        Semua
                    </button>

                    @foreach ($categories as $category)
                        <button type="button" onclick="selectCategory('{{ $category->id }}')"
                            class="category-btn px-8 py-2 rounded-full font-medium transition-all duration-300 border
                            {{ request('category') == $category->id ? 'bg-[#A9333A] text-white shadow-md' : 'bg-white text-gray-600 border-gray-300 hover:border-[#A9333A] hover:text-[#A9333A]' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
    </section>

    <section class="py-16 bg-white min-h-screen mb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div id="dynamic-content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="products-container">
                    @forelse($products as $product)
                        <div
                            class="product-card bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group shadow-sm relative">

                            <div class="relative h-64 w-full overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                @else
                                    <div class="w-full h-full bg-gray-50 flex items-center justify-center text-6xl">
                                        🍜
                                    </div>
                                @endif

                                <div
                                    class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg shadow-sm">
                                    <span class="text-[#D32F2F] font-bold text-sm">
                                        {{ \App\Helpers\Helper::formatRupiah($product->price) }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-[#D32F2F] transition-colors">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                                    {{ $product->description }}
                                </p>

                                <!-- Area Tombol Action (Dimodifikasi) -->
                                <div class="product-action-container" data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}" data-price="{{ $product->price }}">

                                    <button onclick="addToCart({{ $product->id }})"
                                        class="btn-initial w-full py-2.5 rounded-xl bg-gray-50 text-gray-800 font-semibold text-sm hover:bg-[#D32F2F] hover:text-white transition-colors duration-300 flex items-center justify-center gap-2">
                                        <span>Pesan Sekarang</span>
                                    </button>

                                    <div class="qty-control hidden w-full">

                                        <div
                                            class="flex items-center justify-between bg-white border-2 border-[#A9333A] rounded-xl overflow-hidden">

                                            <button onclick="updateQty({{ $product->id }}, -1)"
                                                class="px-4 py-2 text-[#A9333A] hover:bg-gray-100 font-bold transition-colors">
                                                -
                                            </button>

                                            <span class="font-bold text-gray-900 w-full text-center qty-display">1</span>

                                            <button onclick="updateQty({{ $product->id }}, 1)"
                                                class="px-4 py-2 text-white bg-[#A9333A] hover:bg-[#8E2B32] font-bold transition-colors">
                                                +
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20">
                            <div class="text-6xl mb-4">🍽️</div>
                            <h3 class="text-xl font-bold text-gray-800">Menu tidak ditemukan</h3>
                            <p class="text-gray-500 mt-2">Coba kata kunci lain atau ganti kategori.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </section>

    <div id="bottom-cart-bar"
        class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] transform translate-y-full transition-transform duration-300 z-50 border-t border-gray-100 pb-4 md:pb-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col justify-center overflow-hidden mr-4">
                    <div class="flex items-baseline gap-2 mb-0.5">
                        <span id="total-items" class="font-bold text-gray-900 whitespace-nowrap">0 Item</span>
                        <span class="text-gray-300">|</span>
                        <span id="total-price" class="font-bold text-[#A9333A] text-lg whitespace-nowrap">Rp 0</span>
                    </div>
                    <span id="cart-item-names"
                        class="text-xs text-gray-500 truncate w-full max-w-[200px] sm:max-w-md block">
                        Belum ada pesanan
                    </span>
                </div>

                <form id="checkout-form" action="{{ route('checkout') }}" method="GET" class="flex-shrink-0">
                    <input type="hidden" name="cart_data" id="cart-data-input">

                    <button type="submit"
                        class="bg-[#A9333A] text-white px-6 md:px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-[#8E2B32] hover:shadow-xl transition-all flex items-center gap-2 transform active:scale-95">
                        <span>Checkout</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let cart = {};
        let productsData = {};

        function initProductsData() {
            document.querySelectorAll('.product-action-container').forEach(el => {
                const id = el.dataset.id;
                productsData[id] = {
                    price: parseInt(el.dataset.price),
                    name: el.dataset.name
                };
            });
        }

        function addToCart(productId) {
            if (!cart[productId]) {
                cart[productId] = 1;
            }
            updateUI();
        }

        function updateQty(productId, change) {
            if (cart[productId]) {
                cart[productId] += change;
                if (cart[productId] <= 0) {
                    delete cart[productId];
                }
            }
            updateUI();
        }

        function updateUI() {
            let totalItems = 0;
            let totalPrice = 0;
            let itemNames = [];
            const cartDataForBackend = [];

            document.querySelectorAll('.product-action-container').forEach(container => {
                const id = parseInt(container.dataset.id);
                const btnInitial = container.querySelector('.btn-initial');
                const qtyControl = container.querySelector('.qty-control');
                const qtyDisplay = container.querySelector('.qty-display');

                if (cart[id]) {
                    btnInitial.classList.add('hidden');
                    qtyControl.classList.remove('hidden');
                    qtyDisplay.textContent = cart[id];

                    if (productsData[id]) {
                        totalItems += cart[id];
                        totalPrice += cart[id] * productsData[id].price;
                        itemNames.push(`${productsData[id].name} (${cart[id]}x)`);

                        cartDataForBackend.push({
                            id: id,
                            qty: cart[id]
                        });
                    }
                } else {
                    btnInitial.classList.remove('hidden');
                    qtyControl.classList.add('hidden');
                }
            });


            const bottomBar = document.getElementById('bottom-cart-bar');
            const totalItemsEl = document.getElementById('total-items');
            const totalPriceEl = document.getElementById('total-price');
            const itemNamesEl = document.getElementById('cart-item-names');
            const cartDataInput = document.getElementById('cart-data-input');

            if (totalItems > 0) {
                bottomBar.classList.remove('translate-y-full');
                totalItemsEl.textContent = `${totalItems} Item`;
                totalPriceEl.textContent = formatRupiah(totalPrice);

                itemNamesEl.textContent = itemNames.join(', ');

                cartDataInput.value = JSON.stringify(cartDataForBackend);
            } else {
                bottomBar.classList.add('translate-y-full');
            }
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function selectCategory(categoryId) {
            document.getElementById('category-input').value = categoryId;
            fetchData();
        }

        const searchInput = document.getElementById('search-input');
        const spinner = document.getElementById('loading-spinner');
        let timeout = null;

        searchInput.addEventListener('input', function() {
            spinner.classList.remove('hidden');
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetchData();
            }, 500);
        });

        function fetchData() {
            const form = document.getElementById('filter-form');
            const url = new URL(form.action);
            const params = new URLSearchParams(new FormData(form));

            url.search = params.toString();
            window.history.pushState({}, '', url);

            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const newContent = doc.getElementById('dynamic-content').innerHTML;
                    document.getElementById('dynamic-content').innerHTML = newContent;

                    const newButtons = doc.querySelector('.flex-wrap').innerHTML;
                    document.querySelector('.flex-wrap').innerHTML = newButtons;

                    spinner.classList.add('hidden');

                    initProductsData();
                    updateUI();
                })
                .catch(error => {
                    console.error('Error:', error);
                    spinner.classList.add('hidden');
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            initProductsData();
            updateUI();
        });
    </script>

@endsection
