@extends('layouts.app')

@section('content')
 <div class="flex">

    <div class="w-3/12 mt-6"> 
     <x-navigation :user="$user" />
  
    </div>
    <div class="w-7/12 border-2 border-gray-800 border-t-0 border-b-0">
        <app-timeline /></div>
    
 </div>
@endsection
