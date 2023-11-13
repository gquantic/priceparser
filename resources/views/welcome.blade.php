@extends('templates.main')

@section('content')
    <div class="flex justify-content-between items-center">
        <h1>Поиск по товарам</h1>
        <a href="{{ route('product.create') }}">Добавить новый товар</a>
    </div>
    <div class="grouped-form mt-2">
        <input type="text" name="title" class="form-control shadow hover:no-shadow">
        <button type="submit" class="btn btn-primary shadow">Поиск</button>
    </div>
@endsection
