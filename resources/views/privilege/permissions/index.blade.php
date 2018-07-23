
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Permission</h3>
                @if (count($permissions) > 0)

                    @foreach ($permissions as $permission)
                        <div class="row underline">
                            <div class="col-md-6">
                                <span>{{ $permission->name }}</span>
                            </div>
                            <div class="col-md-6">
                                <form action="/permission/{{ $permission->id }}/status" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}

                                    {{ trans('job/index.status'.$permission->status) }}
                                    <button class="btn btn-primary pull-right">{{ $permission->status == 'A' ? 'Block' : 'Activate' }}</button>
                                </form>    
                            </div>
                            
                        </div>
                        
                    @endforeach
                @else
                    <div class="row underline">
                        No permission yet.
                    </div>
                @endif

            {{ $permissions->links() }} 

        </div>

        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item"><a href="/staff">Staff</a></li>
                <li class="list-group-item"><a href="/role">Role</a></li>
            </ul>

            @include('privilege/permissions.add-permission')

        </div>
        
    </div>
@stop
