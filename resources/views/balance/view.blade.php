@extends('layouts.home')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{auth()->user()->email}}</h3>
                    <h5 class="widget-user-desc">{{auth()->user()->name}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Тариф</h5>
                                <span class="description-text">{{$plan}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Действует до</h5>
                                <span class="description-text">{{$expire_date}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">Запросов осталось</h5>
                                <span class="description-text">{{$limit['left']}}/{{$limit['total']}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{auth()->user()->balance}}</h3>

                    <p>Баланс</p>
                </div>
                <div class="icon">
                    <i class="fas fa-coins"></i>
                </div>
                <a href="{{route('my.balance.edit')}}" class="small-box-footer">Пополнить баланс <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
