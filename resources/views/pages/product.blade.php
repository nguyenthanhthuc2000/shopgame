@extends('layouts.app')

@section('title', 'Sản Phẩm')

<div class="product-section mt-80 mb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Danh sách Accounts</h3>
                </div>
            </div>
        </div>
        {{-- search --}}

        <div class="row mb-4">
            @include('components.search-product')
        </div>
        <div class="row">
            @foreach ($accounts as $account)
                <div class="col-lg-3 col-md-6 text-center">
                    @include('components.product-card', $account)
                </div>
            @endforeach
        </div>
    </div>
</div>
