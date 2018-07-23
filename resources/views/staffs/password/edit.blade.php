@extends('layouts.app')

@section('content')
  <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-unlock-alt"></i>
                {{ trans('auth.password') }}
            </div>
            <div class="panel-body">

                <form class="form-horizontal" action="/password" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}


                    <div class="form-group{{ count($errors->old_password) > 0 ? ' has-error' : '' }} dashed-underline">
                        <label for="old_password" class="col-md-4 control-label">{{ trans('auth.current_pass') }}</label>

                        <div class="col-md-6">
                            <input id="old_password" type="password" class="form-control" name="old_password" required placeholder="******" autocomplete="false">

                            @if (count($errors->old_password) > 0)
                                <span class="help-block">
                                    <strong>{{ $errors->old_password }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">{{ trans('auth.new_pass') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="{{ trans('auth.new_pass') }}" autocomplete="false">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">{{ trans('auth.repeat_new_pass') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ trans('auth.repeat_new_pass') }}" autocomplete="false">
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