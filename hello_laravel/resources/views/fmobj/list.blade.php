
@extends('layout')
@section('title', '動画一覧')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h2>動画一覧</h2>
    @if (session('err_msg'))
      <p class="text-danger">
        {{ session('err_msg') }}
      </p>
    @endif
    <table class="table table-striped">
        <tr>
            <th>動画ID</th>
            <th>タイトル</th>
            <th>日付</th>
        </tr>
        @foreach($fmobjs as $fmobj)
        <tr>
            <td>{{$fmobj->id}}</td>
            <td><a href="/fmobj/{{$fmobj->id}}">{{$fmobj->title}}</a></td>
            <td>{{$fmobj->updated_at}}</td>
        </tr>
        @endforeach
    </table>
  </div>
</div>
@endsection