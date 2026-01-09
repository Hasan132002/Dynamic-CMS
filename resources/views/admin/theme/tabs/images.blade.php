<h3>Global Images</h3>

<textarea name="images_json" rows="18" style="width:100%;">{{ json_encode($images, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) }}</textarea>

<hr>

<p>Optional: upload and bind into JSON using dot keys.</p>

<div style="display:flex; gap:15px; flex-wrap:wrap;">
  <div>
    <label>Example: hero image</label><br>
    <input type="file" name="image_files[home.hero.image]">
  </div>
</div>
