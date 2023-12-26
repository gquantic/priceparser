@extends('layouts.home')

@section('title')
    Мой тариф
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning" style="background:rgba(255,193,7, .05);">Внимание! Не меняйте тариф при действующем другом тарифе, так как он обнулится.</div>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger" style="background:rgba(255,7,7,0.05);color:#000;">{{ \Illuminate\Support\Facades\Session::get('error') }}</div>
            </div>
        </div>
    @endif
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
                        <li class="no">Выгрузка каталога</li>
                        <li class="no">Выгрузка цен</li>
                        <li class="no">Парсер-Конструктор</li>
                        <li>Лимит запросов: 50 в день</li>
                        <li>Лимит выгрузки: 3 мб.</li>
                        <li>Лимит изображений: 5</li>
                        <li>Линия поддержки</li>
                        <li class="no">Прямая линия поддержки</li>
                        <li class="no">Доработка по требованию</li>
                        <li class="no">Разработка уникальных шаблонов</li>
                        <li class="no">Штат разработчиков</li>
                    </ul>
                    @if(\Illuminate\Support\Facades\Auth::user()->plan == 'free' || \Illuminate\Support\Facades\Auth::user()->plan == '')
                        <button type="button" class="w-100 btn btn-lg btn-outline-primary" disabled>Вы на этом тарифе</button>
                        <p class="mt-1 mb-0">Активен до {{ \Illuminate\Support\Facades\Auth::user()->active_to }}</p>
                    @else
                        <a href="javascript:confirmPay('/my/plan/upgrade/free');" type="button" class="w-100 btn btn-lg btn-primary border-0" style="opacity: 1;">Подключить</a>
                    @endif
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
                        <li>Парсер услуг</li>
                        <li>Выгрузка каталога</li>
                        <li>Выгрузка цен</li>
                        <li>Парсер-Конструктор</li>
                        <li>Лимит запросов: 100 в день</li>
                        <li>Лимит выгрузки: 3 мб.</li>
                        <li>Лимит изображений: 30</li>
                        <li>Линия поддержки</li>
                        <li class="no">Прямая линия поддержки</li>
                        <li class="no">Доработка по требованию</li>
                        <li class="no">Разработка уникальных шаблонов</li>
                        <li class="no">Штат разработчиков</li>
                    </ul>
                    @if(\Illuminate\Support\Facades\Auth::user()->plan == 'pro')
                        <button type="button" class="w-100 btn btn-lg btn-outline-primary" disabled>Вы на этом тарифе</button>
                        <p class="mt-1 mb-0">Активен до {{ \Illuminate\Support\Facades\Auth::user()->active_to }}</p>
                    @else
                        <a href="javascript:confirmPay('/my/plan/upgrade/pro');" onclick="" type="button" class="w-100 btn btn-lg btn-primary border-0" style="opacity: 1;">Подключить</a>
                    @endif
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
                        <li>Парсер услуг</li>
                        <li>Выгрузка каталога</li>
                        <li>Выгрузка цен</li>
                        <li>Парсер-Конструктор</li>
                        <li>Лимит запросов: 1 000 в день</li>
                        <li>Лимит выгрузки: Без лимита</li>
                        <li>Лимит изображений: Без лимита</li>
                        <li>Линия поддержки</li>
                        <li>Прямая линия поддержки</li>
                        <li>Доработка по требованию</li>
                        <li>Разработка уникальных шаблонов</li>
                        <li>Штат разработчиков</li>
                    </ul>
                    @if(\Illuminate\Support\Facades\Auth::user()->plan == 'business')
                        <button type="button" class="w-100 btn btn-lg btn-outline-primary" disabled>Вы на этом тарифе</button>
                        <p class="mt-1 mb-0">Активен до {{ \Illuminate\Support\Facades\Auth::user()->active_to }}</p>
                    @else
                        <a href="javascript:confirmPay('/my/plan/upgrade/business');" type="button" class="w-100 btn btn-lg btn-primary border-0" style="opacity: 1;">Подключить</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        .col li {
            position: relative;
            text-align: left;
            margin-left: 35px;
            font-size: 18px;
        }

        .col li:before {
            content: "✅";
            position: absolute;
            margin-left: -25px;
            font-size: 13px;
            margin-top: 5px;
        }

        .col li.no:before {
            content: "🚫";
            position: absolute;
            margin-left: -25px;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>

    <script>
        function confirmPay(url) {
            if (confirm("Вы точно подтверждаете переход на новый тариф?\nПроизойдёт списание за тариф. Предыдущий тариф перестанет действовать прямо сейчас.")) {
                window.location.href = url;
            }
        }
    </script>
@endpush
