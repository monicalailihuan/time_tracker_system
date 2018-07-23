
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Role List</h3>
            <ul class="list-group">
                @if (count($roles) > 0)
                    @foreach ($roles as $role)
                        <li class="list-group-item">
                            <a href="/role/{{ $role->id }}">{{ $role->name }}</a>
                        </li>
                    @endforeach
                @else
                    <li class="Links__link">
                        No role yet.
                    </li>
                @endif
            </ul>   

            {{ $roles->links() }} 

        </div>
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item"><a href="/staff">Staff</a></li>
                <li class="list-group-item"><a href="/permission">Permission</a></li>
            </ul>

            @include('privilege/role.add-roles')

        </div>
        
    </div>
@stop
