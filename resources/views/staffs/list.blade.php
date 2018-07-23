<ul class="list-group">
    @if (count($staffs) > 0)

        <?php $alphabert = ""; ?>
        @foreach ($staffs as $staff)
            <div class="row underline">
                @if(substr(strtoupper($staff->name), 0, 1) != $alphabert)
                    <div class="section_title col-md-12">
                        {{ $alphabert = substr(strtoupper($staff->name), 0, 1) }}
                    </div>
                @endif 
                <div class="col-md-10">
                    <a href="staff/{{ $staff->id }} ">{{ $staff->name }} </a>
                </div>
                
                <div class="col-md-2">
                    {{ $staff->status }}
                </div>
            </div>
        @endforeach
      
    @else
        <li class="Links__link">
            No staff yet.
        </li>
    @endif
</ul>