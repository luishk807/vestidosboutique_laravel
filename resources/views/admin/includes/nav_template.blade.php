@if(isset($main_items))
<div class="row">
    <div class="col">
        <div class="shoplist-nav">
            <ul>
                @if(!empty($main_items->previousPageUrl()))
                <li><a href="{{ $main_items->previousPageUrl()}}">&lt; Back</a></li>
                @endif
                <li>{{ $main_items->currentPage()}} {{ __('pagination.of') }} {{ $main_items->count() }}</li>
                @if($main_items->nextPageUrl())
                <li><a href="{{ $main_items->nextPageUrl() }}">Next &gt;</a></li>
                @endif
            </ul>
        </div><!--end of nav container-->
    </div>
</div>
@endif