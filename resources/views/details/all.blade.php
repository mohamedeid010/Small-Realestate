@extends('master')

@section('content')
<div class="card">
    <div class="card-header">الخصائص</div>

    <div class="card-body">
      <a href="{{route('details.create')}}" class="btn btn-primary">اضافة خاصية</a>
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
          @if($details->count() > 0)
          @foreach($details as $detail)
          <tr>
            <td scope="row">{{$detail->id}}</td>
            <td>{{$detail->name}}</td>
            <td>

                <a href="{{route('detail.edit',['id'=>$detail->id])}}" class="btn btn-primary">تعديل</a>
                @if(count($detail->realestates) == 0)
                <a href="{{route('detail.delete',['id'=>$detail->id])}}" class="btn btn-danger">حذف</a>
                @endif
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
