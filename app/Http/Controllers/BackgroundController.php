<?php

namespace Soundboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Integer;
use Soundboard\Background;
use Soundboard\activeBackground;

class BackgroundController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeBackground = activeBackground::getActiveID();
        $backgrounds = Background::all();
        $unusedBackgroundImages = \Storage::files('backgrounds');

        foreach ($unusedBackgroundImages as $key => $background) {
            if(!empty(Background::where('filename' , substr($background,12))->first())) {
                unset($unusedBackgroundImages[$key]);
            }
        }

        return view('Backgrounds.manage', compact('backgrounds', 'activeBackground', 'unusedBackgroundImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backgrounds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'backgroundFile' => 'required|file|max:4096|mimes:png',
            'backgroundName' => 'required',
        ]);
        $enabled = 0;

        if(request('isEnabled') == 'on')
        {
            $enabled = 1;
        }

        $prefix = "b_";
        $fileName = uniqid($prefix).$request->backgroundFile->getClientOriginalName();
        $fileName = str_replace(' ', '_', $fileName);


        Background::create([
            'filename' => $fileName,
            'name' => request('backgroundName'),
            'enabled' => $enabled
        ]);

        $request->backgroundFile->storeAs('backgrounds', $fileName);

        if(Background::count() == 1)
        {
            $this->setActiveBackground(Background::first()->id);
        }

        return redirect('/home');
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
            $background = Background::find($id);
            return view('Backgrounds.edit', compact('background'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_numeric($id))
        {
            $this->validate($request, [
                'backgroundName' => 'required',
            ]);

            $background = Background::findOrFail($id);

            $enabled = 0;

            if(request('isEnabled') == 'on')
            {
                $enabled = 1;
            }

            $background->name = $request->backgroundName;
            $background->enabled = $enabled;
            $background->save();

            \Session::flash('message', 'Background successfully edited!');
            \Session::flash('alert-class', 'alert-success');

            return back();
        }
        else
        {
            abort(404);
        }
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
        $BackGroundToDelete = Background::find($id);
        if(activeBackground::getActiveID() == $id)
        {
            if(Background::count()>1)
            {
                $this->setActiveBackground(Background::where('id', '!=', $id)->first()->id);
            }
            else
            {
                $this->setActiveBackground(-1);
            }
        }
        \Storage::delete('backgrounds\\'.$BackGroundToDelete->filename);

        $BackGroundToDelete->delete();

        return redirect(route('ManageBackground'));
    }


    /**
     * Updates the active Background.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCurrent(Request $request)
    {
        $id = \Crypt::decrypt($request->id);

        $this->setActiveBackground($id);

        \Session::flash('message', 'Background successfully changed!');
        \Session::flash('alert-class', 'alert-success');

        return back();
    }

    /**
     * Sets the active Background
     * @param Integer $id
     */
    private function setActiveBackground($id)
    {
        if(activeBackground::all()->count() == 0)
        {
            activeBackground::create([
                'background_id' => $id
            ]);
        }
        else
        {
            $aB = activeBackground::getActive();
            $aB->background_id = $id;
            $aB->save();
        }

    }

    public function manageUnused(Request $request)
    {
        Background::create([
            'filename' => substr(\Crypt::decrypt($request->id) , 12),
            'name' => substr(\Crypt::decrypt($request->id),27),
            'enabled' => 1
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
             \Session::flash('message', 'Background deleted!');
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
