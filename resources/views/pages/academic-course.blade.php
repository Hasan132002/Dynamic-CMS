@extends('layouts.academic-course.academic-course')

@section('title', $course['title'] . ' - Academic Course')

@section('content')
  @include('partials.academic-course.hero')
  @include('partials.academic-course.content')
@endsection
