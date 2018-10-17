<?php

namespace Soundboard\Http\Controllers;

use Illuminate\Http\Request;
use Soundboard\sample;
use Soundboard\meme;
use Soundboard\bottomgif;

class SamplesController extends Controller
{
	public function index()
	{
	}


	public function manageIndex()
    {
        $samples = sample::all();
        return view('Samples.manage', compact('samples'));
    }


    public function manageSample()
    {
        $samples = sample::all();
        return view('Samples.edit', compact('samples'));
    }

    public function show(Sample $sample)
    {
    	return view('Samples.Detail', compact('sample'));	
    }


    public function getCount()
    {
    	return sample::count();
    }

    public function create()
    {
        return view('Samples.create');
    }

    public function edit($id)
    {
        if(is_numeric($id))
        {
            $sample = sample::find($id);
            return view('Samples.edit', compact('sample'));
        }
        else
        {
            abort(404);
        }

    }

    public function patch(Request $request, $id)
    {
        if(is_numeric($id))
        {
            $this->validate($request, [
                'sampleHTML' => 'required',
                'sampleName' => 'required'
            ]);

            $sample = sample::findOrFail($id);

            $enabled = 0;
            $subsound = 0;
            if(request('isEnabled') == 'on')
            {
                $enabled = 1;
            }

            if(request('subCheck') == 'on')
            {
                $subsound = 1;
            }


            $sample->name = $request->sampleName;
            $sample->display = htmlentities($request->sampleHTML);
            $sample->subsound = $subsound;
            $sample->enabled = $enabled;

            $sample->save();

            \Session::flash('message', 'Sample successfully edited!');
            \Session::flash('alert-class', 'alert-success');

            return back();
        }
        else
        {
            abort(404);
        }

    }


    public function store(Request $request)
    {
        //dd($request);
    	$this->validate($request, [

    		'sampleFile' => 'required|file|max:4096|mimes:mpga',
            'sampleHTML' => 'required',
    		'sampleName' => 'required',

    	]);

        $sampleHTML = htmlentities(request('sampleHTML'));

    	$enabled = 0;
    	$subsound = 0;
    	if(request('isEnabled') == 'on')
        {
            $enabled = 1;
        }

        if(request('subCheck') == 'on')
        {
            $subsound = 1;
        }

        $prefix = "s_";
    	$fileName = uniqid($prefix).$request->sampleFile->getClientOriginalName();


    	sample::create([
    		'filename' => $fileName,
    		'name' => request('sampleName'),
            'display' => htmlentities($sampleHTML),
            'subsound' => $subsound,
            'enabled' => $enabled
    	]);

        $request->sampleFile->storeAs('samples', $fileName);


    	return redirect('/home');
    }


    public function destroy(Request $request)
    {
        $id = \Crypt::decrypt($request->id);
        $SampleToDelete = sample::find($id);

        \Storage::delete('samples\\'.$SampleToDelete->filename);

        $SampleToDelete->delete();

        return redirect('/samples/manage');
    }


    public function manageUnused(Request $request)
    {
        sample::create([
            'filename' => substr(\Crypt::decrypt($request->id) , 12),
            'name' => substr(\Crypt::decrypt($request->id) , 27),
            'display' => substr(\Crypt::decrypt($request->id) , 27),
            'subsound' => 0,
            'enabled' => 0
        ]);

        \Session::flash('message', 'Sample successfully added!');
        \Session::flash('alert-class', 'alert-success');

        return back();
    }

    public function deleteUnused(Request $request)
    {
        $fullPath = \Crypt::decrypt($request->id);
        $success = Storage::delete($fullPath);
        if($success)
        {
            \Session::flash('message', 'Sample deleted!');
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
