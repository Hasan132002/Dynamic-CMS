@extends('layouts.credit-transfer.credit-transfer')
@section('title', $page['hero']['title'] ?? 'Credit Transfer')
@section('content')
  @sectionVisible($hero ?? [])
    @include('partials.credit-transfer.hero')
@endif
  @sectionVisible($content ?? [])
    @include('partials.credit-transfer.content')
@endif
  @sectionVisible($leaders ?? [])
    @include('partials.consultation.leaders')
@endif
@endsection
