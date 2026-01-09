<h3>Global Colors</h3>

<div class="grid">
  <label>
    Accent Color
    <input type="color" name="colors[accent]"
           value="{{ $colors['base']['accent'] ?? '#ff9b24' }}">
  </label>

  <label>
    Heading Color
    <input type="color" name="colors[heading]"
           value="{{ $colors['base']['heading'] ?? '#00001b' }}">
  </label>

  <label>
    Body Text Color
    <input type="color" name="colors[body]"
           value="{{ $colors['base']['body'] ?? '#555555' }}">
  </label>

  <label>
    Gray Background
    <input type="color" name="colors[gray]"
           value="{{ $colors['base']['gray'] ?? '#f4f3ef' }}">
  </label>
</div>
