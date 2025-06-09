@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-menu">
    <div class="register-header">
        <h3 class="register-header__title">商品登録</h3>
    </div>

    <form class="product_register" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="register-menu__content">
            <div class="register-menu__name">
                <div class="register-menu__name-label">商品名</div>
                <div class="register-menu__required">必須</div>
            </div>
            <input class="register_name" type="text" name="name" placeholder="商品名を入力" />
            <div class="error">
                @error('name')
                {{ $message }}
                @enderror
            </div>

            <div class="register-menu__price">
                <div class="register-menu__price-label">値段</div>
                <div class="register-menu__required">必須</div>
            </div>
            <input class="register_price" type="text" name="price" placeholder="値段を入力" />
            <div class="error">
                @error('price')
                {{ $message }}
                @enderror
            </div>

            <div class="register-menu__image">
                <div class="register-menu__image-label">商品画像</div>
                <div class="register-menu__required">必須</div>
            </div>
            <input class="register_image" type="file" name="image">
            <div class="error">
                @error('image')
                {{ $message }}
                @enderror
            </div>

            <div class="register-menu__season">
                <div class="register-menu__season_label">季節</div>
                <div class="register-menu__required">必須</div>
                <div class="register-menu__required-season">複数選択可</div>
            </div>
            <div class="season-group">
                @foreach($seasons as $season)
                    <label class="season-item">
                    <input class="register_season" type="checkbox" name="seasons[]" value="{{ $season->id }}">                            <span class="season-label">{{ $season->name }}</span>
                    </label>
                @endforeach
            </div>
            <div class="error">
                @error('seasons')
                {{ $message }}
                @enderror
            </div>

            <div class="register-menu__description">
                <div class="register-menu__description_label">商品説明</div>
                <div class="register-menu__required">必須</div>
            </div>
            <input class="register_description" type="text" name="description" placeholder="商品の説明を入力" />
            <div class="error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="register-button">
            <a href="{{ route('products.index') }}" class="register-button__home">戻る</a>
            <input class="register-button__submit" type="submit">
        </div>
    </form>
</div>
@endsection