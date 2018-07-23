@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-language"></i>
                Language / 语言
            </div>
            <div class="panel-body">

                <form class="form-horizontal" action="/language" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="col-md-6">
                        <select name="language" id="language" class="form-control">
                            <option value="en">English</option>
                            <option value="zh-cn" {{ Auth::user()->language == "zh-cn" ? 'selected': '' }}>中文简体</option>
                        </select>
                    </div>
                    <div class="col-md-6">
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