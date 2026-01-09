@extends('layouts.scholarships.scholarships')
@section('title', $page['hero']['title'] ?? 'Scholarships')
@section('content')
  @sectionVisible($hero ?? [])
    @include('partials.scholarships.hero')
@endif
  @sectionVisible($content ?? [])
    @include('partials.scholarships.content')
@endif
  @sectionVisible($leaders ?? [])
    @include('partials.consultation.leaders')
@endif
@endsection
