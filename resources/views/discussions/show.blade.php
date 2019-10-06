@extends('layouts.app')

@section('content')
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
            <span>{{ $d->user->name }} <b>( {{ $d->user->points }} pts )</b></span>
            @if($d->hasBestAnswer())
                <span class="btn float-right btn-success btn-sm">closed</span>
            @else
                <span class="btn float-right btn-danger btn-sm">open</span>
            @endif

            @if(Auth::id() == $d->user_id && !$d->hasBestAnswer())
                <a href="{{ route('discussion.edit', ['slug' => $d->slug]) }}" class="btn btn-info btn-sm" style="float: right; margin-right: 8px;">Edit</a>
            @endif

            @if($d->is_being_watched_by_auth_user())
                <a href="{{ route('discussion.unwatch', ['id' => $d->id]) }}" class="btn btn-secondary btn-sm" style="float: right; margin-right: 8px;">unwatch</a>
            @else
                <a href="{{ route('discussion.watch', ['id' => $d->id]) }}" class="btn btn-secondary btn-sm" style="float: right; margin-right: 8px;">watch</a>
            @endif
        </div>

        <div class="card-body">
            <h4 class="text-center">
                {{ $d->title }}
            </h4>
            <hr>
            <p class="text-center">
                {!! Markdown::convertToHtml($d->content) !!}
            </p>

            <hr>

            @if($best_answer)
                <div class="text-center" style="padding: 40px">
                    <h3 class="text-center">Best Answer</h3>
                    <div class="card">
                        <div class="card-header bg-success">
                            <img src="{{ $best_answer->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
                            <span>{{ $best_answer->user->name }} <b>( {{ $best_answer->user->points }} pts )</b></span>
                        </div>
                        <div class="card-body">
                            {!! Markdown::convertToHtml($best_answer->content) !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer">
                <span>
                    {{ $d->replies->count() }} Replies
                </span>
            <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="text-right btn float-right btn-sm btn-light">{{ $d->channel->title }}</a>
        </div>
    </div>

    @foreach($d->replies as $r)
        <div class="card" style="margin-bottom: 30px">
            <div class="card-header">
                <img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
                <span>{{ $r->user->name }} <b>( {{ $r->user->points }} pts )</b></span>

                @if(!$best_answer && Auth::id()== $d->user->id)
                    <a href="{{ route('discussion.best.answer', ['id' => $r->id ]) }}" class="btn btn-sm btn-primary float-right" style="margin-left: 8px;">Mark as best answer</a>
                @endif

                @if(Auth::id() == $r->user_id && !$r->best_answer)
                    <a href="{{ route('reply.edit', ['id' => $r->id ]) }}" class="btn btn-sm btn-info float-right">Edit</a>
                @endif
            </div>

            <div class="card-body">
                <p class="float-left">
                    {!! Markdown::convertToHtml($r->content) !!}
                </p>
            </div>
            <div class="card-footer">
                @if($r->is_liked_by_auth_user())
                    <a href="{{ route('reply.unlike', [ 'id' => $r->id ]) }}" class="btn btn-danger btn-sm">Unlike <span class="badge">{{ $r->likes->count() }}</span></a>
                @else
                    <a href="{{ route('reply.like', [ 'id' => $r->id ]) }}" class="btn btn-success btn-sm">Like <span class="badge">{{ $r->likes->count() }}</span></a>
                @endif
            </div>
        </div>
    @endforeach

    <div class="card">
        <div class="card-body">
            @if(Auth::check())
                <form action="{{ route('discussion.reply', ['id' => $d->id]) }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="content">Leave a reply...</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn text-center">Leave a reply</button>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <h2>Sign in to leave a reply</h2>
                </div>
            @endif
        </div>
        <div class="card-footer">
            <p>
                Like
            </p>
        </div>
    </div>
@endsection
