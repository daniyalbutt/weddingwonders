<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioImages;
use Illuminate\Http\Request;
use Auth;
use File;

class PortfolioController extends Controller
{

    function __construct(){
        $this->middleware('permission:portfolio|create portfolio|edit portfolio|delete portfolio', ['only' => ['index','show']]);
        $this->middleware('permission:create portfolio', ['only' => ['create','store']]);
        $this->middleware('permission:edit portfolio', ['only' => ['edit','update']]);
        $this->middleware('permission:delete portfolio', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Portfolio::where('status', 0)->get();
        return view('portfolio.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'event_date' => 'required',
            'theme' => 'required',
            'venue' => 'required',
            'image' => 'required',
        ]);
        $data = new Portfolio();
        $data->name = $request->name;
        $data->event_date = $request->event_date;
        $data->theme = $request->theme;
        $data->venue = $request->venue;
        $data->user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/portfolio'), $imageName);
            $data->image = 'images/portfolio/'.$imageName;
        }
        $data->save();
        if($request->hasFile('images')){
            if($request->images != null){
                $images = $request->images;
                foreach($images as $key => $value){
                    $imageName = time().'-'.($key+1).'-gallery.'.$value->extension();
                    $value->move(public_path('images/portfolio'), $imageName);
                    $portfolio_images = new PortfolioImages();
                    $portfolio_images->slug = 'image';
                    $portfolio_images->image = 'images/portfolio/'.$imageName;
                    $portfolio_images->portfolio_id = $data->id;
                    $portfolio_images->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Portfolio Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Portfolio::find($id);
        return view('portfolio.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'event_date' => 'required',
            'theme' => 'required',
            'venue' => 'required',
        ]);
        $data = Portfolio::find($id);
        $data->name = $request->name;
        $data->event_date = $request->event_date;
        $data->theme = $request->theme;
        $data->venue = $request->venue;
        $data->user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/portfolio'), $imageName);
            $data->image = 'images/portfolio/'.$imageName;
        }
        
        if($request->hasFile('images')){
            if($request->images != null){
                $images = $request->images;
                foreach($images as $key => $value){
                    $imageName = time().'-'.($key+1).'-gallery.'.$value->extension();
                    $value->move(public_path('images/portfolio'), $imageName);
                    $portfolio_images = new PortfolioImages();
                    $portfolio_images->slug = 'image';
                    $portfolio_images->image = 'images/portfolio/'.$imageName;
                    $portfolio_images->portfolio_id = $id;
                    $portfolio_images->save();
                }
            }
        }

        $data->save();
        return redirect()->back()->with('success', 'Portfolio Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Portfolio::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Portfolio Deleted Successfully');
    }

    public function deleteImage(Request $request){
        $id = $request->key;
        $data = PortfolioImages::find($id);
        $image_path = $data->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $data->delete();
        return response()->json(['status' => 'success', 'data' =>[],  'message' => 'Image Deleted Successfully!'], 200);
    }
}
