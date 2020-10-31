@if ($paginator->hasPages())
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-wrp py-2 mr-3">
        {{--  <a href="#" class="btn btn-icon btn-sm btn-light-success mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>  --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="btn btn-icon btn-sm btn-light-success mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light-success mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
        @endif

        {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1">{{ $element }}</a>
                    {{--  <li class="disabled"><span>{{ $element }}</span></li>  --}}
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-success active mr-2 my-1">{{ convertToFa($page) }}</a>
                        @else
                            <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1">{{ convertToFa($page) }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light-success mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
                
            @else
                <a href="#" class="btn btn-icon btn-sm btn-light-success mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            @endif
    </div>

    <div class="d-flex align-items-center py-3">
        <select class="form-control form-control-sm text-success font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;" onchange="redirector('{{$_GET['page'] ?? 0}}', this.value)"">
            <option {{ isset($_GET['perpage']) && $_GET['perpage'] == 5 ? 'selected' : '' }} value="5">۵</option>
            <option {{ empty($_GET['perpage']) || $_GET['perpage'] == 10 ? 'selected' : '' }} value="10">۱۰</option>
            <option {{ isset($_GET['perpage']) && $_GET['perpage'] == 25 ? 'selected' : '' }} value="25">۲۵</option>
            <option {{ isset($_GET['perpage']) && $_GET['perpage'] == 50 ? 'selected' : '' }} value="50">۵۰</option>
            <option {{ isset($_GET['perpage']) && $_GET['perpage'] == 100 ? 'selected' : '' }} value="100">۱۰۰</option>
        </select>
        <span class="text-muted">
            نمایش {{convertToFa($paginator ->count())}} از {{convertToFa($paginator->total())}} رکورد
        </span>
    </div>
</div>
@endif