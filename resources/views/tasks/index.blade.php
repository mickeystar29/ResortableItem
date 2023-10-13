@extends('layouts.app')
@section('content')
<task-list :tasks="{{$tasks}}" :projects="{{$projects}}" />
@endsection
