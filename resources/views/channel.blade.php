@extends('layouts.app')

@section('content')
    @foreach($discussions as $d)
        <div class="card" style="margin-bottom: 30px">
            <div class="card-header">
                <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
                <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>

                <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-secondary btn-sm" style="float: right; margin-left: 9px;">view</a>
                @if($d->hasBestAnswer())
                    <span class="btn float-right btn-success btn-sm">closed</span>
                @else
                    <span class="btn float-right btn-danger btn-sm">open</span>
                @endif

            </div>

            <div class="card-body">
                <h4 class="text-center">
                    {{ $d->title }}
                </h4>
                <p class="text-center">
                    {{ str_limit($d->content, 50) }}
                </p>
            </div>
            <div class="card-footer">
                <span>
                    {{ $d->replies->count() }} Replies
                </span>
                <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="text-right btn float-right btn-sm btn-light">{{ $d->channel->title }}</a>
            </div>
        </div>
    @endforeach

    <div class="text-justify text-center">
        {{ $discussions->links() }}
    </div>
@endsection
