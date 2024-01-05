@extends('layouts.home')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <form method="post" action="{{route('my.balance.update')}}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="user_name" value="{{auth()->user()->name}}">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Input Addon</h3>
                    </div>
                    <div class="card-body">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{auth()->user()->email}}">
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₽</span>
                            </div>
                            <input type="number" class="form-control" name="deposit">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
