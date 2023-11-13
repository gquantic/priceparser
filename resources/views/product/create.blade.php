@extends('templates.main')

@section('content')
    <div class="flex justify-content-between items-center">
        <h1>Импорт нового товара</h1>
    </div>
    <div class="div mt-2">
        @csrf
        <label for="" class="mt-2">Название товара</label>
        <input type="text" name="title" class="form-control mt-1 shadow hover:no-shadow" placeholder="Телевизор LED">
        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-2" style="">Поиск по товарам</button>
        </div>
    </div>
@endsection

<script>

</script>
