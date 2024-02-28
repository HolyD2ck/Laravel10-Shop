@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row flex-nowrap overflow-auto">
        @foreach($products as $product)
        <div class="col-4 mb-3">
            <div class="card h-100 d-flex flex-column">
                <img class="card-img-top product-image mx-auto d-block" src="{{ $product->Фото }}" alt="{{ $product->Название }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mt-auto">{{ $product->Название }}</h5>
                    <h5 class="card-title mt-auto">{{ $product->Цена }} Рублей</h5>
                    <p class="card-text text-truncate" title="{{ $product->Описание }}">{{ $product->Описание }}</p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
