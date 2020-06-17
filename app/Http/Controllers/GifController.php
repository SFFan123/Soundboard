<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bottomgif;

class GifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifs = bottomgif::all();
        $unusedGifs = \Storage::files('gifs');

        foreach ($unusedGifs as $key => $unusedGif) {
            if(!empty(bottomgif::where('filename' , substr($unusedGif, 5))->first())) {
                unset($unusedGifs[$key]);
            }
        }
        return view('Gifs.manage', compact('gifs', 'unusedGifs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Gifs.create');
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

            'gifFile' => 'required|file|max:4096|mimes:gif',
            'gifName' => 'required',
            'gifPlacement' => array(
                'required',
                'regex:/(left)|(right)/u'
            )
        ]);

        $enabled = 0;

        if(request('isEnabled') == 'on')
        {
            $enabled = 1;
        }

        $name = preg_replace("/[^a-z0-9\_\-\.]/i",'', $request->gifName);
        $name = str_replace(' ', '_', $name);
        $fileName = 'g_'.$name.'.gif';


        bottomgif::create([
            'filename' => $fileName,
            'GifName' => request('gifName'),
            'placement' => request('gifPlacement'),
            'enabled' => $enabled
        ]);

        $request->gifFile->storeAs('gifs', $fileName);

        \Session::flash('message', 'Gif successfully added!');
        \Session::flash('alert-class', 'alert-success');

        return redirect('/gifs/manage');
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
        //not supported yet
        if(is_numeric($id))
        {
            $gif = bottomgif::find($id);
            return view('Gifs.edit', compact('gif'));
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

        $this->validate($request, [
            'GifName' => 'required',
            'gifPlacement' => array(
                'required',
                'regex:/(left)|(right)/u'
            )
        ]);
        $gif = bottomgif::findOrFail($id);
        $enabled = 0;

        if(request('isEnabled') == 'on')
        {
            $enabled = 1;
        }


        $gif->GifName = request('GifName');
        $gif->placement = request('gifPlacement');
        $gif->enabled = $enabled;

        $gif->save();

        \Session::flash('message', 'Gif successfully edited!');
        \Session::flash('alert-class', 'alert-success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = \Crypt::decrypt($request->id);
        $gifToDelete = bottomgif::findOrFail($id);

        \Storage::delete('gifs\\'.$gifToDelete->filename);

        $gifToDelete->delete();

        return redirect('/gifs/manage');
    }


    public function manageUnused(Request $request)
    {
        bottomgif::create([
            'GifName' => substr(\Crypt::decrypt($request->id) , 5),
            'filename' => substr(\Crypt::decrypt($request->id) , 5),
            'enabled' => 0,
            'placement' => 'left'
        ]);

        \Session::flash('message', 'Background successfully added!');
        \Session::flash('alert-class', 'alert-success');

        return back();
    }

    public function deleteUnused(Request $request)
    {
        $fullPath = \Crypt::decrypt($request->id);
        $success = Storage::delete($fullPath);
        if($success)
        {
            \Session::flash('message', 'Gif deleted!');
            \Session::flash('alert-class', 'alert-success');
        }
        else
        {
            \Session::flash('message', 'Error while deleting!');
            \Session::flash('alert-class', 'alert-danger');
        }

        return back();
    }
}
