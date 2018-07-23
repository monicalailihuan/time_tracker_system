@if (count($magstripes) > 0)
    <?php $alphabert = ""; ?>
    @foreach ($magstripes as $magstripe)
        @if(substr(strtoupper($magstripe->name), 0, 1) != $alphabert)
            <div class="section_title col-md-12">
                {{ $alphabert = substr(strtoupper($magstripe->name), 0, 1) }}
            </div>
        @endif 
        <div class="underline col-md-12">
            <div class="row">
                <div class="col-md-4">
                    {{ $magstripe->name }}
                </div>
                <div class="col-md-4">
                    Status: {{ trans('job/index.status'.$magstripe->status) }}
                </div>

                <div class="col-md-4">
                    <div class="pull-right">
                        <form method="POST" action="/magstripe/{{ $magstripe->id }}/block">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="form-group">
                                <button class="btn btn-primary">{{ $magstripe->status == 'A' ? 'Block' : 'Activate' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12">
        <li class="Links__link">
            No magnetic stripe yet.
        </li>
    </div>
@endif