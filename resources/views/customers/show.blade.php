@extends('layouts.app')

@section('content')
    <h1>詳細</h1>

    <tr>
        <th>注文回数</th>
        <td>{{ $orderCount }}</td>
        <th>最終注文日</th>
        <td>{{ $latOrderDay }}</td>
    </tr> 

    <form method="post" action="{{ route('reservation/create') }}">
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

          <tr>
            <td><input type="hidden" name="id" value="{{ $customer['id'] }}"></td>
          </tr>
        </table>

        <button>完了</button>
    </form>
@endsection

@endextends