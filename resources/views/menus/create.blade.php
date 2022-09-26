@extends('layouts.app')

@section('content')
    <h1>新規登録</h1>
    @foreach ($errors->all() as $error)
      <ul>
        <li>{{$error}}</li>
      </ul>
    @endforeach
    <form method="post" action="store" enctype="multipart/form-data">
        @csrf
        <table>
          <tr>
            <th>名前</th>
            <td><input type="text" name="name" value="{{ old('name') }}"></td>
          </tr> 
  
          <tr>
            <th>金額</th>
            <td><input type="text" name="price" value="{{ old('price') }}"></td>
         </tr>
  
         <tr>
            <th>アレルギー</th>
            <td><input type="text" name="allergy" value="{{ old('allergy') }}"></td>
         </tr> 
  
         <tr>
            <th>写真(複数可能)</th>
            <td><input type="file" name="image"></td>
         </tr>
        </table>

        <button>完了</button>
    </form>
@endsection

@endextends