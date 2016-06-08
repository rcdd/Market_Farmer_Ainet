<li>
    {{ $comment->comment }}
    @if (count($comment->children) > 0)
        <ul>
        	{{--@each('advertisements.comments_replay', $comment->children, 'comment')--}}
        </ul>
    @endif
</li>