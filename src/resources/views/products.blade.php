@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content__header">
        <div class="content__title">
            商品一覧
        </div>
        <a class="product-button" href="{{ route('products.create') }}">
            +商品を追加
        </a>
    </div>

    <aside class="search__side">
        <form class="search-form">
            <div class="search-form__item">
                <input class="search-form__item-input">
            </div>
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
            </div>
            <div class="search-form__price">
                <div class="search-form__type">
                    価格順で表示
                </div>
                <!--並び替えフォーム（総品部分-->
                <form class="sort__price">
                    <select class="sort__price-content">
                        <option class="sort__price-detail" value="">並び替え</option>
                        <option class="sort__price-detail" value="">価格が安い順</option>
                        <option class="sort__price-detail" value="">価格が高い順</option>
                    </select>
                </form>
                <!--商品一覧の表示-->
                <div class="product-list">
                    <div class="product-card">
                        <img src="" alt="">
                    </div>
                </div>
                <!--ソート条件がある場合にタグを表示-->
                <div class="sort-tag">
                    <span></span>
                    <a href=""></a>
                </div>
            </div>
        </form>
    </aside>

    <div class="product-list">
        @foreach($products as $product)
            @if(!empty($product->image) && !empty($product->name) && !empty($product->price))
            <div class="product-card">
                <a class="product-card__link" href="{{ route('products.show' , ['product' => $product->id]) }}">
                    <img class="product-card__image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="product-card__design">
                            <p class="product-card__name">{{ $product->name }}</p>
                            <p class="product-card__price">¥{{ $product->price }}</p>
                        </div>
                </a>
            </div>
            @endif
        @endforeach
    </div>
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>



@endsection