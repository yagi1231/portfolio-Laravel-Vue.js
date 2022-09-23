@extends('layouts.app')

@section('content')
    <h1>編集</h1>
    @foreach ($errors->all() as $error)
      <ul>
        <li>{{$error}}</li>
      </ul>
    @endforeach
    <form method="post" action="{{ route('customer/update', ['id' => $customer->id]) }}">
        @csrf
        <table>
          <tr>
            <th>名前</th>
            <td><input type="text" name="name" value="{{ $customer['name'] }}"></td>
          </tr> 
  
          <tr>
            <th>住所</th>
            <td><input type="text" name="address" value="{{ $customer['address'] }}"></td>
          </tr>
  
          <tr>
            <th>電話</th>
            <td><input type="text" name="tel" value="{{ $customer['tel'] }}"></td>
          </tr> 
  
          <tr>
            <th>備考欄</th>
            <td><input type="text" name="remarks" value="{{ $customer['emarks'] }}"></td>
          </tr>
        </table>

        <button>完了</button>
    </form>
@endsection

@endextends