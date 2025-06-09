@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-list">
    <div class="product-list__header">
        <a href="{{ route('products.index')}}" class="product-list__header__link">商品一覧</a>
        <span>></span>
        <div class="product-list__name">{{ $product->name }}</div>
    </div>

    <div class="product-list__detail">
        <form class="product-list__detail__update" action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="product-list__detail-image">
                <input class="detail__image" type="file" name="image">
                @if($product->image)
                    <img class="detail__image-img" src="{{ asset('storage/' . $product->image) }}" >
                @endif
                <div class="detail_error">
                @error('image')
                {{ $message }}
                @enderror
                </div>
            </div>

            <div class="product-list__detail-top">
                <div class="product-list__detail-name">
                    <div class="product-list__detail-name__label">商品名</div>
                    <input class="detail__name" type="text" name="name" value="{{ old('name', $product->name) }}">
                    <div class="detail_error">
                    @error('name')
                    {{ $message }}
                    @enderror
                    </div>
                </div>

                <div class="product-list__detail-price">
                    <div class="product-list__detail-price__label">値段</div>
                    <input class="detail__price" type="text" name="price" value="{{ old('price', $product->price) }}">
                    <div class="detail_error">
                    @error('price')
                    {{ $message }}
                    @enderror
                    </div>
                </div>

                <div class="product-list__detail-season">
                    <div class="product-list__detail-season__label">季節</div>
                    <div class="season-group">
                        @foreach($seasons as $season)
                            <label class="season">
                                <input class="detail__season" type="checkbox" name="seasons[]" value="{{ $season->id }}"{{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                    <div class="detail_error">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="product-list__detail-description">
                <div class="product-list__detail-description__label">商品説明</div>
                <input class="detail_description" type="text" name="description" value="{{ old('description', $product->description )}}">
                <div class="detail_error">
                @error('description')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>
        <div class="product-list__button">
            <a href="{{ route('products.index') }}" class="products-list__redirect">戻る</a>
            <input class="product-list__upload" type="submit" value="変更を保存">
        </div>
    </form>
    <form class="product-list__delete" action="{{ route('products.delete', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="product-list__delete-button" type="submit">
            <img class="product-list__delete-icon" src="{{ asset('images/TiTrash.png') }}">
        </button>
    </form>
</div>
@endsection