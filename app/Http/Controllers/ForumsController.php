<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    public function index()
    {

        switch (\request('filter')) {
            case 'me':
                $results = Discussion::where('user_id', Auth::id())
                    ->paginate(3);
                break;
            case 'solved':
                $answered = [];

                foreach (Discussion::all() as $d)
                    if ($d->hasBestAnswer())
                        array_push($answered, $d);

                $results = new Paginator($answered, 3);
                break;
            case 'unsolved':
                $unanswered = [];

                foreach (Discussion::all() as $d)
                    if (!$d->hasBestAnswer())
                        array_push($unanswered, $d);

                $results = new Paginator($unanswered, 3);
                break;
            default:
                $results = Discussion::orderBy('created_at', 'desc')
                    ->paginate(3);
        }

        return view('forum', [
            'discussions' => $results
        ]);
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)
            ->first();

        return view('channel', [
            'discussions' => $channel->discussions()->paginate(5)
        ]);
    }
}
