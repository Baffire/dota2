@php
    $sortedComments = App\Models\Comment::sort_comments(
      $comments, isset($sort) ? $sort : 'popular');
@endphp
@foreach ($sortedComments as $comment)
    <div class="comment-wrap">
        <div class="comment" data-id="{{ $comment->id }}">
            <div class="comment__image"></div>
            <div class="comment__content">
                <div class="comment__top">
                    <div class="comment-meta">
                        <div class="comment__user-name">{{ $comment->user_nickname }}</div>
                        <div class="comment__date">{{ $comment->created_at }}</div>
                        @if(\App\Models\Comment::get_comment_chain($comment) < 4)
                            <a href="#" class="comment__reply">Ответить</a>
                        @endif
                    </div>

                    <div class="comment__rating">
                        <a href="#" class="comment__like">👍</a>
                        <a href="#" class="comment__dislike">👎</a>
                        <div class="comment__score">{{ $comment->rating }}</div>
                    </div>
                </div>
                <div class="comment__body">
                    {{ $comment->body }}
                </div>
            </div>
        </div>

        @include('reply_form', ['form_title' => 'Ответить'])
    </div>

    @php
        $children = $comment->children()->get();
    @endphp

    <div class="children-comments">
        @if($children->count())
            @include('comments', ['comments' => $children])
        @endif
    </div>
@endforeach
