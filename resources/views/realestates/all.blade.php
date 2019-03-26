@extends('master')

@section('content')
<div class="card">
    <div class="card-header">العقارات</div>

    <div class="card-body">
      <a href="{{route('realestate.create')}}" class="btn btn-primary">اضافة عقار</a>
      <br/>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <td scope="col">#</td>
            <td scope="col">الاسم</td>
            <td scope="col">التحكم</td>
          </tr>
        </thead>
        <tbody>
          @if($realestates->count() > 0)
          @foreach($realestates as $realestate)
          <tr>
            <td scope="row">{{$realestate->id}}</td>
            <td>{{$realestate->name}}</td>
            <td>
                <a href="{{route('realestate.edit',['id'=>$realestate->id])}}" class="btn btn-primary">تعديل</a>
                <a href="{{route('realestate.delete',['id'=>$realestate->id])}}" class="btn btn-danger">حذف</a>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
              <td colspan="3">no data founded</td>
          </tr>
          @endif
        </tbody>
</table>

    </div>
</div>
@stop
