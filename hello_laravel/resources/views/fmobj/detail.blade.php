
@extends('layout')
@section('title', '動画詳細')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h2>{{ $fmobj->title }}</h2>
    <span>作成日：{{ $fmobj->created_at}}</span>
    <span>更新日：{{ $fmobj->updated_at}}</span>
    <p>{{ $fmobj->content }}</p>
  </div>
</div>
@endsection