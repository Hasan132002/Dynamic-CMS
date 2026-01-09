<li data-id="{{ $item->id }}"
    data-type="{{ $item->type }}"
    data-column="{{ $item->column_title ?? '' }}">

  {{ $item->label }} ({{ $item->type }})

  <ul>
    @foreach($items as $child)
      @if($child->parent_id === $item->id)
        @include('admin.menu-item', ['item' => $child])
      @endif
    @endforeach
  </ul>

</li>
