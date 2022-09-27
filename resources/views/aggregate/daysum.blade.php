@extends('layouts.app')

@section('content')
<h1>集計</h1>
<form method="get" action="{{ route('aggregate/daysum') }}"> 
    <input type="date" name="begin" value="begin">
    <input type="date" name="end" value="begin">
    <button>検索</button>
</form>
@foreach($serachAggregate as $serach)
<table class="table">
    <thead>
        <tr>
          <th>日付</th>
          <th>売上合計</th>
          <th>1件平均</th>
          <th>件数</th>
        </tr>
    </thead> 

     <tbody>
        <tr>
          <td>{{ date('y/m/d', strtotime($serach->time))  }}</td>
          <td>{{ $serach->day_sum }}</td>
          <td>{{ floor($serach->day_avg) }}</td>
          <td>{{ $serach->total_count }}</td>
        </tr>
     </tbody>
</table>
@endforeach
{{  $serachAggregate->links() }}
@endsection

@endextends