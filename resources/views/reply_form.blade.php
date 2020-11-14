<form class="reply-form">
    @csrf
    <div class="reply-form__title">
        @if(isset($form_title))
            {{$form_title}}
        @else
            Оставить комментарий
        @endif
    </div>
    <input name="user_nickname" type="text" class="reply-form__name" placeholder="Имя">
    <textarea name="body" class="reply-form__comment" placeholder="Комментарий"></textarea>
    <button class="reply-form__send">Ответить</button>
</form>
