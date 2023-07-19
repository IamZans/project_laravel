@extends('dashboard.layouts.main')


@section('container')
<section class="content-header">
  <h1>Wellcome Back, {{ auth()->user()->name }}</h1>
@endsection