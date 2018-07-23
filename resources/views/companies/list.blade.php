@if (count($companies) > 0)
    <?php $alphabert = ""; ?>
    @foreach ($companies as $company)
        @if(substr(strtoupper($company->name), 0, 1) != $alphabert)
            <div class="section_title col-md-12">
                {{ $alphabert = substr(strtoupper($company->name), 0, 1) }}
            </div>
        @endif 
        <div class="underline col-md-12">
            <a href="company/{{ $company->name }}">{{ $company->name }} </a>
            {{-- <a href="job/?company={{ $company->name }}" class="pull-right" data-toggle="tooltip" title="Job">
                {{ $company->jobs->count() }} 
                <i class="fa fa-folder"></i>
            </a> --}}
        </div>
    @endforeach
@else
    <div class="col-md-12">
        <li class="Links__link">
            No company yet.
        </li>
    </div>
@endif


{{-- {{ $companies->links() }}  --}}