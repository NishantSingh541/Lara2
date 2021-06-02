@extends('layout.app')



@section('content')
<h1>Contact Page</h1>

@if(count($people))
<ul>
@foreach($people as $person)
<li>{{$person}}</li>
@endforeach 
</ul>
@endif





@section('footer')


<script>alert('hey mf');</script>

@stop