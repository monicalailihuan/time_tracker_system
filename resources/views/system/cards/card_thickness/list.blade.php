@if (count($card_thickness) > 0)
    <div class="row underline section_title">
        <div class="col-xs-1"></div>
        <div class="col-xs-3">Start Thickness (mm)</div>
        <div class="col-xs-3">End Thickness (mm)</div>
        <div class="col-xs-3">Status</div>
        <div class="col-xs-2"> </div>
    </div>
    @foreach ($card_thickness as $thickness)
        <div class="row underline">
            <div class="col-xs-1">{{ $loop->iteration }}</div>
            <div class="col-xs-3">{{ $thickness->start_thickness }}</div>
            <div class="col-xs-3">{{ $thickness->end_thickness }}</div>
            <div class="col-xs-3">{{ trans('job/index.status'.$thickness->status) }}</div>
            <div class="col-xs-2">
                <div class="pull-right">
                    <form method="POST" action="card_thickness/{{ $thickness->id }}/block">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        
                        <div class="form-group">
                            <button class="btn btn-primary">{{ $thickness->status == 'A' ? 'Block' : 'Activate' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12">
        <li class="Links__link">
            No card thickness yet.
        </li>
    </div>
@endif