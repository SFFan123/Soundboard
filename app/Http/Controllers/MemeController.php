<?php

namespace Soundboard\Http\Controllers;

use Illuminate\Http\Request;
use Soundboard\meme;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memes = meme::all();
        return view('Memes.manage', compact('memes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Memes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [

            'memeName' => 'required|min:5|max:190',
            'memeHTML' => 'required|min:5',
            'memeClipboard' => 'required|min:5',
        ]);

        $memeHTML = htmlentities(request('memeHTML'));

        $enabled = 0;
        if(request('isEnabled') == 'on')
        {
            $enabled = 1;
        }

        meme::create([
            'memeName' => request('memeName'),
            'memeText' => $memeHTML,
            'clipboardText' => request('memeClipboard'),
            'enabled' => $enabled
        ]);

        \Session::flash('message', 'Sample successfully added!');
        \Session::flash('alert-class', 'alert-success');

        return redirect('/memes/manage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_numeric($id))
        {
            $meme = meme::findOrFail($id);
            return view('Memes.edit', compact('meme'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_numeric($id))
        {
            $this->validate($request, [
                'memeName' => 'required',
                'memeHTML' => 'required',
                'memeClipboard' => 'required'
            ]);

            $meme = meme::findOrFail($id);

            $enabled = 0;

            if(request('isEnabled') == 'on')
            {
                $enabled = 1;
            }

            $meme->memeName = request('memeName');
            $meme->memeText = htmlentities(request('memeHTML'));
            $meme->clipboardText = request('memeClipboard');
            $meme->enabled = $enabled;

            $meme->save();

            \Session::flash('message', 'Meme successfully edited!');
            \Session::flash('alert-class', 'alert-success');

            return redirect()->back();
        }
        else
        {
            abort(404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = \Crypt::decrypt($request->id);
        $memeToDelete = meme::findOrFail($id);

        $memeToDelete->delete();



        return redirect('/memes/manage');

    }
}
