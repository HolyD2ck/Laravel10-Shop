@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="t">О нас</h1>

    <h2>Основные сведения:</h2>
    <p>Полное наименование: Интернет-магазин "WildDucks"</p>
    <p>Сокращенное наименование: "WildDucks"</p>
    <p>Основано 1 августа 1947 года</p>

    <h2>История создания нашего Интернет-магазина:</h2>
    <div class="co">
        <div>
            <p class="t">Говард Утка Старк открывает первый магазин:</p>
            <img class="ab" src="{{ asset('img/site/IronDuck2.jpg') }}">
        </div>
    </div>
    <h2 class="t">Товары и услуги, предоставляемые нашим магазином:</h2>

    <div class="about">
        <div>
            <img class="about" src="{{ asset('img/site/DuckWork1.jpg') }}">
            <p>Широкий ассортимент утиной продукции</p>
        </div>
        <div>
            <img class="about" src="{{ asset('img/site/DuckWork2.jpg') }}">
            <p>Помощь в выборе товара</p>
        </div>
        <div>
            <img class="about" src="{{ asset('img/site/DuckWork3.jpg') }}">
            <p>Обучение по уходу за утками</p>
        </div>
        <div>
            <img class="about" src="{{ asset('img/site/DuckWork4.jpg') }}">
            <p>Информация о новинках и акциях</p>
        </div>
    </div>

    <h2>Новости и события</h2>
    <p>Здесь мы будем публиковать последние новости о наших товарах и предстоящих акциях.</p>
</div>
@endsection
