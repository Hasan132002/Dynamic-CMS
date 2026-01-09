@extends('layouts.financial-aid.financial-aid')
@section('title', $page['hero']['title'] ?? 'Financial Aid')
@section('content')
  @sectionVisible($hero ?? [])
    @include('partials.financial-aid.hero')
@endif
  @sectionVisible($content ?? [])
    @include('partials.financial-aid.content')
@endif
@endsection
