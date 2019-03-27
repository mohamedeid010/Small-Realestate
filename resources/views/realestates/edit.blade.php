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

          <div class="form-group price-container">
            <label for="price"><a href="#" class="addrepeat">اضافة موسم</a></label>
            <div class="price-div">
              @foreach($realestate->seasons as $season)
            <div class="row repeater">
              <div class="col-md-12"><a href="{{$season->id}}" class="remove-season remove-active btn btn-danger">حذف</a></div>
              <div class="col-md-6"><span>السعر : </span><input type="text" name="price[]" value="{{$season->price}}"/></div>
                <div class="col-md-6"><span >الموسم : </span><input type="text" name="seasonname[]" value="{{$season->name}}"/></div>
                <div class="col-md-6"><span class="from">الي : </span><input type="date" name="to[]" value="{{$season->dateto}}"/></div>
                <div class="col-md-6"><span class="from">من  : </span><input type="date" name="from[]" value="{{$season->datefrom}}"/></div>
            </div>
            @endforeach
          </div>
        </div>

          <button type="submit" class="btn btn-primary">حفظ</button>
      </form>
    </div>
</div>
@stop
