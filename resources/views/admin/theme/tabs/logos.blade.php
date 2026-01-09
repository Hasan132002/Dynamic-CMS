<h3>Logos</h3>

<div class="logo-grid">

  <div>
    <p>Header Logo (v1)</p>
    <img src="{{ asset($logos['header']['v1'] ?? '') }}"
         style="height:60px; background:#f5f5f5;">
    <input type="file" name="logos[v1]">
  </div>

  <div>
    <p>Header Default</p>
    <img src="{{ asset($logos['header']['default'] ?? '') }}"
         style="height:60px; background:#f5f5f5;">
    <input type="file" name="logos[default]">
  </div>

</div>
