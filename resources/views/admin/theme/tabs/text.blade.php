<h3>Global Text</h3>

<label>
  Header CTA Button Label
  <input type="text"
         name="text[cta_label]"
         value="{{ $text['header']['cta_button']['label'] ?? 'Apply Now' }}">
</label>

<label>
  Footer Copyright
  <input type="text"
         name="text[copyright]"
         value="{{ $text['footer']['bottom']['copyright'] ?? '' }}">
</label>
