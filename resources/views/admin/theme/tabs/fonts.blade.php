<h3>Global Fonts</h3>

@php
$availableFonts = [
  'Euclid Circular A',
  'Fredoka',
  'Poppins',
  'Inter',
  'Roboto',
  'Montserrat',
  'Chiller'
];
@endphp

<label>
  Primary Font
  <select name="fonts[primary_font]">
    @foreach($availableFonts as $font)
      <option value="{{ $font }}"
        {{ ($fonts['default']['primary'] ?? '') === $font ? 'selected' : '' }}>
        {{ $font }}
      </option>
    @endforeach
  </select>
</label>

<label>
  Secondary Font
  <select name="fonts[secondary_font]">
    @foreach($availableFonts as $font)
      <option value="{{ $font }}"
        {{ ($fonts['default']['secondary'] ?? '') === $font ? 'selected' : '' }}>
        {{ $font }}
      </option>
    @endforeach
  </select>
</label>
