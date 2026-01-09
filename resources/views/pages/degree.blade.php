@extends('layouts.degree.degree')

@section('title', $program['title'] . ' - ' . $program['degree_type'])

@section('content')

  @include('partials.degree.hero')
  @include('partials.degree.content')

@endsection
