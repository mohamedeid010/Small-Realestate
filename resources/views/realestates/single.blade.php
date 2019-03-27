@extends('master')

@section('content')
<div class="card">
    <div class="card-header"><h1>{{$realestate->name}}</h1></div>

    <div class="card-body">
    <div class="row">
      @if($realestate))
      <div class="col-md-12">
          <img src="{{asset('/uploads/'.$realestate->image)}}"/><br/>
      </div>
      <div class="col-md-12">
      <h3>  الخصائص</h3>
          @foreach($realestate->details as $detail)
            {{$detail->name}} -
          @endforeach
      </div>
      <div class="col-md-12">
      <h3>  السعر</h3>
          @foreach($realestate->seasons as $season)
            {{$season->name}} <br/> {{$season->datefrom}} - {{$season->dateto}} <br/> {{$season->price}}
          @endforeach
      </div>

      @endif
    </div>


    </div>
</div>
@stop
