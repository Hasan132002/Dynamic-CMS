@extends('layouts.department.department')

@section('title', 'Department')

@section('content')

  @sectionVisible($hero ?? [])
    @include('partials.department.hero')
@endif
  @sectionVisible($featured_section ?? [])
    @include('partials.department.featured-section')
@endif
  @sectionVisible($about_section ?? [])
    @include('partials.department.about-section')
@endif
  @sectionVisible($stats ?? [])
    @include('partials.department.stats')
@endif
  @sectionVisible($ranking ?? [])
    @include('partials.department.ranking')
@endif
  @sectionVisible($unlock ?? [])
    @include('partials.department.unlock')
@endif

@endsection
