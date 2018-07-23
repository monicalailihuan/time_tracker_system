@if (count($card_textures) > 0)
    <?php $alphabert = ""; ?>
    @foreach ($card_textures as $card_texture)
        @if(substr(strtoupper($card_texture->name), 0, 1) != $alphabert)
            <div class="section_title col-md-12">
                {{ $alphabert = substr(strtoupper($card_texture->name), 0, 1) }}
            </div>
        @endif 
        <div class="underline col-md-12">
            <div class="row">
                <div class="col-md-4">
                    {{ $card_texture->name }}
                </div>
                <div class="col-md-4">
                    Status: {{ trans('job/index.status'.$card_texture->status) }}
                </div>

                <div class="col-md-4">
                    <div class="pull-right">
                        <form method="POST" action="/card_texture/{{ $card_texture->id }}/block">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="form-group">
                                <button class="btn btn-primary">{{ $card_texture->status == 'A' ? 'Block' : 'Activate' }}</button>
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
            No card_texture yet.
        </li>
    </div>
@endif