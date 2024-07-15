<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家計簿アプリ</title>
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    
    <header>
        <h1>収支編集</h1>
    </header>

        <div class="edit-page">
            <div class="form-balance edit-balance">
            <form action="{{route('homebudget.update', ['homeBudget' => $homeBudget->id])}}" method="post">
                <input type="hidden" name="page" value="{{request()->input('page')}}">
                @csrf
                @method('PUT')
                    <label for="date">日付</label>
                    <input type="date" name="date" value="{{$homeBudget->date}}" id="date">
                      @if($errors->has('date'))  
                        <span class="error">{{$errors->first('date')}}</span>
                      @endif
                    <label for="category_id">カテゴリ</label>
                    <select name="category" id="category_id">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}"{{$category->id == $homeBudget->category_id? 'selected' : ''}}>
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>

                    <label for="price">金額</label>
                    <input type="text" name="price" id="price" value="{{$homeBudget->price}}">
                        @if($errors->has('price'))
                            <span class="error">{{$errors->first('price')}}</span>
                        @endif
                    <div class="button-container">
                        <div class="flex-btn">
                            <button type="submit" class="edit-button">更新</button>
                            <a href="{{url('/')}}?page={{request()->input('page')}}" class="back-button" style=" background: #f2f2f2;
                            text-decoration:none;">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>