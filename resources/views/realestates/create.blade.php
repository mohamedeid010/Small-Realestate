@extends('master')

@section('content')
<div class="card">
    <div class="card-header">انشاء عقار</div>

    <div class="card-body">
      @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-warning" role="alert">
          {{$error}}
        </div>
        @endforeach
      @endif
      <form method="post" action="{{route('realestate.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="form-group">
            <label for="category-name">اسم العقار</label>
            <input type="text" class="form-control" id="category-name"  placeholder="ادخل اسم العقار" name="name">
          </div>
          <div class="form-group">
            <label for="featured">الصورة</label>
            <input type="file" class="form-control" id="featured"  name="image">
          </div>
          <div class="form-group">
            @if($details->count() > 0)
            @foreach($details as $detail)
            <div class="checkbox">
                <label><input type="checkbox" value="{{$detail->id}}" name="details[]"><span class="checktext">{{$detail->name}}</span></label>
            </div>
            @endforeach
            @endif
          </div>
          <div class="form-group price-container">
            <label for="price"><a href="#" class="addrepeat">اضافة موسم</a></label>
            <div class="price-div">
            <div class="row repeater">
              <div class="col-md-6"><span>السعر : </span><input type="text" name="price[]"/></div>
                <div class="col-md-6"><span>الموسم : </span><input type="text" name="seasonname[]"/></div>
                <div class="col-md-6"><span class="from">الي : </span><input type="date" name="to[]"/></div>
                <div class="col-md-6"><span class="from">من  : </span><input type="date" name="from[]"/></div>
            </div>
          </div>
        </div>
          <button type="submit" class="btn btn-primary">حفظ</button>
      </form>
    </div>
</div>
@stop
