@extends('layouts.app')

@section('content')
  <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user-circle"></i>
                {{ trans('auth.general_detail') }}
            </div>
            <div class="panel-body">

                <form class="form-horizontal" action="/profile/update" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">{{ trans('auth.name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required placeholder="{{ trans('auth.name') }}" autocomplete="false" value="{{ Auth::user()->name }}">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email2') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">{{ trans('auth.email') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="email" class="form-control" name="email2" placeholder="{{ trans('auth.email') }}" autocomplete="false" value="{{ Auth::user()->email2 }}">
                        </div>
                    </div>

                    <div class="col-md-6 col-md-offset-4">
                        <button class="btn btn-primary">{{ trans('job/index.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @include('staffs.setting_list')
    </div>


@stop