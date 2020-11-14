<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$post->title}}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">
    <div class="post-wrap">
        <div class="post-title">
            {!! $post->title !!}
        </div>

        <div class="post" data-id="{{ $post->id }}">
            {!! $post->body !!}
        </div>
    </div>

    <div class="comments-wrap">
        <div class="comments-title">Комментарии</div>

        <div class="sort">
            <div class="sort-item active" data-sort="popular">Популярные</div>
            <div class="sort-item" data-sort="new">Новые</div>
            <div class="sort-item" data-sort="old">Старые</div>
        </div>
    </div>

    <div class="comments">
        @include('comments', ['comments' => $comments])
    </div>
    @include('reply_form')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous">
</script>

<script>
    var CSRF_TOKEN = "{{ csrf_token() }}";
</script>
<script src="/app.js"></script>
</body>
</html>
