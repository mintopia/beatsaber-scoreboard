@if ($page->total() > $page->count())
    <div class="card-footer pb-0">
        <p class="float-left pt-2 mb-0">
            Showing {{ $page->firstItem() }} to {{ $page->lastItem() }} of {{ $page->total() }} {{ isset($name) ? $name : 'entries' }}
        </p>
        <div class="ml-auto float-right">
            {{ $page->links() }}
        </div>
    </div>
@endif
