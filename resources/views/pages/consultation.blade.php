@extends('layouts.consultation.consultation')

@section('title', $page['hero']['title'] ?? 'Consultation')

@section('content')
  @sectionVisible($hero ?? [])
    @include('partials.consultation.hero')
@endif
  @sectionVisible($content ?? [])
    @include('partials.consultation.content')
@endif
  @sectionVisible($excellence ?? [])
    @include('partials.consultation.excellence')
@endif
  @sectionVisible($stats ?? [])
    @include('partials.consultation.stats')
@endif
  @sectionVisible($leaders ?? [])
    @include('partials.consultation.leaders')
@endif
@endsection
