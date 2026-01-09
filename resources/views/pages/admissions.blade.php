@extends('layouts.admissions.admissions')

@section('title', $page['hero']['title'] ?? 'Admissions')

@section('content')
  @sectionVisible($hero ?? [])
    @include('partials.admissions.hero')
@endif
  @sectionVisible($programs ?? [])
    @include('partials.admissions.programs')
@endif
  @sectionVisible($steps ?? [])
    @include('partials.admissions.steps')
@endif
  @sectionVisible($cta ?? [])
    @include('partials.admissions.cta')
@endif
  @sectionVisible($excellence ?? [])
    @include('partials.admissions.excellence')
@endif
  @sectionVisible($stats ?? [])
    @include('partials.admissions.stats')
@endif
@endsection
