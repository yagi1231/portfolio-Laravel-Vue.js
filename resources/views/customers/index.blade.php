@extends('layouts.app')

@section('content')
    <h1><予約画面></h1>
    <form method="get" action="{{ route('customer/index') }}"> 
    <input type="text" name="name">
    <input type="text" name="address">
    <input type="text" name="tel">
    <button>検索</button>
</form>
    <table class="table">
<thead>
    <tr>
        <th scope="col">名前</th>
        <th scope="col">住所</th>
        <th scope="col">電話番号</th>
        <th scope="col">ステータス</th>
        <th scope="col">時間</th>
    </tr>
</thead>
@foreach($customers as $a)
    </tbody>
    <tr scope="row">
        <td><a href="customers/edit/{{ $a->id }}">{{ $a->name }}</a></td>
        <td>{{ $a->address }}</td>
        <td>{{ $a->tel }}</td>
    </tr>
    </tbody>
        @endforeach
    </table>

    <CustomerIndex
    :reservations='@json($customers)'
    endpoint="{{  route('customer/index') }"
    />

    {{ $customers->links() }}
@endsection

@endextends