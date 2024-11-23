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
        <div class="row mb-4">
            <!-- Search by Name -->
            <div class="col-md-4">
                <input type="text" id="searchBox" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm...">
                </imput>
            </div>
            <div class="col-md-4">
                <select id="filterPriceRange" class="form-control">
                    <option value="">Lọc theo giá</option>
                    <option value="50000">50.000đ</option>
                    <option value="100000">100.000đ</option>
                    <option value="200000">200.000đ</option>
                </select>
            </div>

            <div class="col-md-4">
                <select id="filterCustomOption" class="form-control">
                    <option value="">Lọc theo tùy chọn</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>
            </form>
        </div>
        <div class="row">
            @foreach ($productList as $product)
                <div class="col-lg-3 col-md-6 text-center">
                    @include('components.product-list', $product)
                </div>
            @endforeach
        </div>
    </div>
</div>
