@extends('master')

@section('content')
<div class="card">
    <div class="card-header">انشاء خاصية</div>

    <div class="card-body">
      @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-warning" role="alert">
          {{$error}}
        </div>
        @endforeach
      @endif
      <form method="post" action="{{route('details.store')}}">
        {{csrf_field()}}
          <div class="form-group">
            <label for="category-name">اسم الخاصية</label>
            <input type="text" class="form-control" id="category-name"  placeholder="ادخل اسم الخاصية" name="name">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
</div>
@stop
