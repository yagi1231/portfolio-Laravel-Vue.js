@extends('layouts.app')

@section('content')
    <h1><予約画面></h1>
    <table class="table">
<thead>
    <tr>
        <th scope="col">商品画像</th>
        <th scope="col">名前</th>
        <th scope="col">住所</th>
        <th scope="col">アレルギー</th>
    </tr>
</thead>
@foreach($menus as $a)
    </tbody>
    <tr scope="row">
        <td><img src="{{ Storage::url($a->image) }}" width="25%"></td>
        <td><a href="customers/edit/{{ $a->id }}">{{ $a->name }}</a></td>
        <td>{{ $a->price }}</td>
        <td>{{ $a->allergy }}</td>
    </tr>
    </tbody>
        @endforeach
    </table>

    {{ $menus->links() }}
@endsection

@endextends