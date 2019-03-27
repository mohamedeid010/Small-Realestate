@extends('master')

@section('content')
<div class="card">
    <div class="card-header">تعديل عقار</div>

    <div class="card-body">
      @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-warning" role="alert">
          {{$error}}
        </div>
        @endforeach
      @endif
      <form method="post" action="{{route('realestate.update',['id'=>$realestate->id])}}">
        {{csrf_field()}}
          <div class="form-group">
            <label for="category-name">اسم العقار</label>
            <input type="text" class="form-control" id="realestate-name" name="name" value="{{$realestate->name}}">
          </div>
          <div class="form-group">
            <label for="image">الصورة</label>
            <input type="file" class="form-control" id="image"  name="image">
          </div>
          <div class="form-group">
            @if($details->count() > 0)
            @foreach($details as $detail)
            <div class="checkbox">
                  <label><input type="checkbox" value="{{$detail->id}}" name="details[]"
                    @foreach($realestate->details as $real_detail)
                      @if($real_detail->id == $detail->id)

                      checked
                      @endif
                    @endforeach
                    ><span class="checktext">{{$detail->name}}</span></label>
            </div>
            @endforeach
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
</div>
@stop
