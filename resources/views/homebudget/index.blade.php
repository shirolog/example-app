<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家計簿アプリ</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <header>
        <h1>家計簿アプリ</h1>
    </header>

    <section class="container">
        <div class="balance">
            <h3>収支一覧</h3>
            @if($message = Session::get('success'))
                <div class="flash_message">
                    {{$message}}
                </div>
            @endif

            @if($message = Session::get('error'))
                <div class="flash_message">
                    {{$message}}
                </div>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>カテゴリ</th>
                        <th>金額</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 収支データのループ処理 -->
                        @foreach($categories as $category)
                            <p>{}</p>
                        @endforeach
                </tbody>
            </table>
        </div>

        <div class="add-balance">
            <h3>収支の追加</h3>
            <form action="{{route('store')}}" method="post">
                @csrf
                <label for="date">日付:</label>
                <input type="date" name="date" id="date">
                    @if($errors->has('date'))
                        <span class="error">{{$errors->first('date')}}</span>
                    @endif
                <label for="category">カテゴリ:</label>
                <select name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                    @if($errors->has('category'))
                        <span class="error">{{$errors->first('category')}}</span>
                    @endif
                <label for="price">金額:</label>
                <input type="text" name="price" id="price">
                    @if($errors->has('price'))
                        <span class="error">{{$errors->first('price')}}</span>
                    @endif
                <button type="submit">追加</button>
            </form>
        </div>
    </section>
</body>
</html>