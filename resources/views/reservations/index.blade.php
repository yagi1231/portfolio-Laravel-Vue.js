@extends('layouts.app')

@section('content')
    <h1><予約画面></h1>
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
@foreach($reservation as $a)
    </tbody>
    <tr scope="row">
        <td><a href="reservations/edit/{{ $a->id }}">{{ $a->name }}</a></td>
        <td>{{ $a->address }}</td>
        <td>{{ $a->tel }}</td>
        <td>{{ $a->status }}</td>
        <td>{{ $a->time}}</td>
    </tr>
    </tbody>
        @endforeach
    </table>

    {{ $reservation->links() }}
@endsection

@endextends