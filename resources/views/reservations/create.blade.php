@extends('layouts.app')

@section('content')
    <h1>新規登録</h1>
    @foreach ($errors->all() as $error)
      <ul>
        <li>{{$error}}</li>
      </ul>
    @endforeach
    <form method="post" action="store">
        @csrf
        <table>
          <tr>
            <th>名前</th>
            <td><input type="text" name="name" value="{{ old('name', $customerName) }}"></td>
          </tr> 
  
          <tr>
            <th>住所</th>
            <td><input type="text" name="address" value="{{ old('address', $customerAddress) }}"></td>
         </tr>
  
         <tr>
            <th>電話</th>
            <td><input type="text" name="tel" value="{{ old('tel', $customerTel) }}"></td>
         </tr> 
  
         <tr>
            <th>注文内容</th>
            <td><input type="text" name="order" value="{{ old('order') }}"></td>
         </tr>
  
         <tr>
            <th>ステータス</th>
            <td><input type="text" name="status" value="{{ old('status') }}"></td>
         </tr>
  
        <tr>
            <th>合計金額</th>
            <td><input type="text" name="sumprice" value="{{ old('sumprice') }}"></td>
        </tr>
  
        <tr>
            <th>時間</th>
            <td><input type="date" name="time" value="{{ old('time') }}"></td>
        </tr>

        <tr>
            <th>備考欄</th>
            <td><input type="text" name="remarks" value="{{ old('remarks', $customerRemarks) }}"></td>
        </tr>

        <td><input type="hidden" name="customer_id" value="{{ old('customer_id', $customerId) }}"></td>
        </table>

        <button>完了</button>
    </form>
@endsection

@endextends