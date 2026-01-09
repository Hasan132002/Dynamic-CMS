
<div class="container" style="max-width: 1200px; padding: 20px;">
  <h2>Appearance / Customize</h2>

  @if(session('success'))
    <div style="padding:10px; background:#d1fae5; margin: 10px 0;">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('admin.appearance.update') }}" enctype="multipart/form-data">
    @csrf

    <div style="display:flex; gap:10px; margin: 15px 0;">
      <button type="button" onclick="showTab('colors')">Colors</button>
      <button type="button" onclick="showTab('fonts')">Fonts</button>
      <button type="button" onclick="showTab('logos')">Logos</button>
      <button type="button" onclick="showTab('images')">Images</button>
      <button type="button" onclick="showTab('text')">Text</button>
    </div>

    <div id="tab-colors" class="tab">
      @include('admin.theme.tabs.colors')
    </div>

    <div id="tab-fonts" class="tab" style="display:none;">
      @include('admin.theme.tabs.fonts')
    </div>

    <div id="tab-logos" class="tab" style="display:none;">
      @include('admin.theme.tabs.logos')
    </div>

    <div id="tab-images" class="tab" style="display:none;">
      @include('admin.theme.tabs.images')
    </div>

    <div id="tab-text" class="tab" style="display:none;">
      @include('admin.theme.tabs.text')
    </div>

    <div style="margin-top: 20px;">
      <button type="submit">Save Changes</button>
    </div>
  </form>
</div>

<script>
function showTab(name) {
  document.querySelectorAll('.tab').forEach(t => t.style.display = 'none');
  document.getElementById('tab-' + name).style.display = 'block';
}
</script>
