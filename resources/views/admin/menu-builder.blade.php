<ul id="menuTree" class="menu-tree">
@foreach($items as $item)
  @if($item->parent_id === null)
    @include('admin.menu-item', ['item' => $item])
  @endif
@endforeach
</ul>

<button onclick="saveMenu()">Save Menu</button>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
function initSortable(el) {
  new Sortable(el, {
    group: 'nested',
    animation: 150,
    fallbackOnBody: true,
    swapThreshold: 0.65
  });

  el.querySelectorAll('ul').forEach(initSortable);
}

initSortable(document.getElementById('menuTree'));
function serializeTree(root, parentId = null, acc = []) {
  [...root.children].forEach((li, index) => {
    acc.push({
      id: li.dataset.id,
      parent_id: parentId,
      sort_order: index,
      type: li.dataset.type,
      column_title: li.dataset.column || null
    });

    const childUl = li.querySelector(':scope > ul');
    if (childUl) {
      serializeTree(childUl, li.dataset.id, acc);
    }
  });

  return acc;
}


function saveMenu() {
  const tree = serializeTree(document.getElementById('menuTree'));

  fetch('/admin/menu-builder/save', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ tree })
  })
  .then(res => res.json())
  .then(() => alert('Menu saved'));
}
</script>
