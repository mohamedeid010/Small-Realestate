@extends('master')

@section('content')
<div class="card">
    <div class="card-header">العقارات</div>

    <div class="card-body">
    <div class="row">
      @if(count($realestates) !=0)
      @foreach($realestates as $realestate)
      <div class="col-md-6 text-center">
          <img src="{{asset('/uploads/'.$realestate->image)}}"/><br/>
          <a href="{{route('realestate.show',['id'=>$realestate->id])}}">{{$realestate->name}}</a>
      </div>
      @endforeach
      @endif
    </div>


    </div>
</div>
@stop
