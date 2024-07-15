<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家計簿アプリ</title>
     <!-- bootstrap cdn -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <!-- custom css -->
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
                        @foreach($homeBudgets as $homeBudget)
                            <tr>
                                <td>{{$homeBudget->date}}</td>
                                <td>{{$homeBudget->category->name}}</td>
                                <td>{{$homeBudget->price}}</td>
                                <td class="button-td">
                                <form action="{{route('homebudget.edit', ['homeBudget' => $homeBudget->id])}}" method="get">
                                    <input type="hidden" name="page" value="{{request()->input('page')}}">
                                    @csrf
                                    <input type="submit" class="edit-button" value="更新" style="margin-right: 20px;">
                                </form>

                                    <form action="{{route('homebudget.destroy', ['homeBudget' => $homeBudget->id])}}" method="post">
                                        <input type="hidden" name="page" value="{{request()->input('page')}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="delete-button" value="削除"
                                        onclick="return confirm('削除しますか？');">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {!!$homeBudgets->links('pagination::bootstrap-5')!!}
            </div>
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