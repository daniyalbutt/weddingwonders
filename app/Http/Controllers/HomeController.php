<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Event;
use App\Models\Item;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $item_count = DB::table('items')->where('status', 0)->count();
        $user_count = User::where('status', 0)->with("roles")->whereHas("roles", function($q) {
            $q->whereIn("name", ["employee"]);
        })->count();
        $event_count = DB::table('events')->count();
        $portfolio_count = DB::table('portfolios')->where('status', 0)->count();
        $item_list = Item::orderBy('updated_at', 'desc')->get();
        $event_list = Event::orderBy('updated_at', 'desc')->get();
        return view('home', compact('item_count', 'user_count', 'event_count', 'portfolio_count', 'item_list', 'event_list'));
    }
}
