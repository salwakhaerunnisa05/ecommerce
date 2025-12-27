{{-- resources/views/checkout/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-4">

            {{-- Form Alamat --}}
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Informasi Pengiriman</h5>

                        <div class="mb-3">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="card shadow-sm position-sticky" style="top: 1rem;">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Ringkasan Pesanan</h5>

                        <div class="mb-3" style="max-height: 240px; overflow-y: auto;">
                            {{-- Gunakan $cart_items yang sudah kita compact dari controller --}}
                            @foreach($cart_items as $item)
                            <div class="d-flex justify-content-between small mb-2">
                                <span>{{ $item->product->name ?? 'Produk' }} x {{ $item->quantity }}</span>
                                <span class="fw-medium">
                                    {{-- Gunakan kalkulasi manual atau properti subtotal jika ada di model --}}
                                    Rp {{ number_format(($item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span>
                                {{-- Gunakan variabel $subtotal yang sudah dihitung di controller --}}
                                Rp {{ number_format($subtotal + $shippingCost, 0, ',', '.') }}
                            </span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mt-4 fw-semibold">
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection