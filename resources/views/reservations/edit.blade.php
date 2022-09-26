@extends('layouts.app')

@section('content')
    <h1>編集</h1>
    @foreach ($errors->all() as $error)
      <ul>
        <li>{{$error}}</li>
      </ul>
    @endforeach
    <tr>
        <th>最終更新者</th>
        <td>{{ $staffName }}</td>
    </tr> 
    <form method="post" action="{{ route('reservation/update', ['id' => $reservation->id]) }}">
        @csrf
        <table>
          <tr>
            <th>名前</th>
            <td><input type="text" name="name" value="{{ $reservation['name'] }}"></td>
          </tr> 
  
          <tr>
            <th>住所</th>
            <td><input type="text" name="address" value="{{ $reservation['address'] }}"></td>
         </tr>
  
         <tr>
            <th>電話</th>
            <td><input type="text" name="tel" value="{{ $reservation['tel'] }}"></td>
         </tr> 
  
         <tr>
            <th>注文内容</th>
            <td><input type="text" name="order" value="{{ $reservation['order'] }}"></td>
         </tr>
  
         <tr>
            <th>ステータス</th>
            <td><input type="text" name="status" value="{{ $reservation['status'] }}"></td>
         </tr>
  
        <tr>
            <th>合計金額</th>
            <td><input type="text" name="sumprice" value="{{ $reservation['sumprice'] }}"></td>
        </tr>
  
        <tr>
            <th>時間</th>
            <td><input type="date" name="time" value="{{ $reservation['time'] }}"></td>
        </tr>

        <tr>
            <th>備考欄</th>
            <td><input type="text" name="remarks" value="{{ $reservation['remarks'] }}"></td>
        </tr>

        <td><input type="hidden" name="customer_id" value="{{ $reservation['customer_id'] }}"></td>
        </table>

        <button>完了</button>
    </form>
@endsection

@endextends