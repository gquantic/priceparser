@extends('layouts.home')

@section('title')
    Мой тариф
@endsection

@section('content')
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Бесплатный</h4>
                </div>
                <div class="card-body">
                    <h3 class="text-center">0 <small class="text-muted fw-light" style="font-size: 15px;margin-right: -30px;">/ месяц</small></h3>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Парсер товаров</li>
                        <li>Парсер услуг</li>
                        <li>Парсер-Конструктор</li>
                        <li>Лимит запросов: 50 в день</li>
                        <li>Лимит выгрузки: 3 мб.</li>
                        <li>Линия поддержки</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-outline-primary">Вы на этом тарифе</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">PRO</h4>
                </div>
                <div class="card-body">
                    <h3 class="text-center">200 <small class="text-muted fw-light" style="font-size: 15px;margin-right: -30px;">/ месяц</small></h3>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Парсер товаров</li>
                        <li>Выгрузка каталога</li>
                        <li>Выгрузка цен</li>
                        <li>Парсер-Конструктор</li>
                        <li>Лимит запросов: 100 в день</li>
                        <li>Лимит выгрузки: 3 мб.</li>
                        <li>Линия поддержки</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-primary border-0">Подключить</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
                <div class="card-header py-3 text-white bg-black border-primary">
                    <h4 class="my-0 fw-normal">Бизнес</h4>
                </div>
                <div class="card-body">
                    <h3 class="text-center">3 000 <small class="text-muted fw-light" style="font-size: 15px;margin-right: -30px;">/ месяц</small></h3>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Парсер товаров</li>
                        <li>Выгрузка каталога</li>
                        <li>Выгрузка цен</li>
                        <li>Парсер-Конструктор</li>
                        <li>Лимит запросов: 1 000 в день</li>
                        <li>Лимит выгрузки: Без лимита</li>
                        <li>Линия поддержки</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-primary border-0">Подключить</button>
                </div>
            </div>
        </div>
    </div>
@endsection
