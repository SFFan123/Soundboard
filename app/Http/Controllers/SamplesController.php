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

    public function apiSample()
    {
        return $samples = sample::where('enabled', true)->get()->toJson();
    }

	public function manageIndex()
    {
        $samples = sample::all();
        $unusedSamples = \Storage::files('samples');
        foreach ($unusedSamples as $key => $unusedSample) {
            if(!empty(sample::where('filename' , substr($unusedSample,8))->first())) {
                unset($unusedSamples[$key]);
            }
        }
        return view('Samples.manage', compact('samples', 'unusedSamples'));
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
    		'sampleName' => 'required|unique:samples,name',

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

        $name = preg_replace("/[^a-z0-9\_\-\.]/i",'', $request->sampleName);
        $name = str_replace(' ', '_', $name);
    	$fileName = 's_'.$name.'.mp3';


    	sample::create([
    		'filename' => $fileName,
    		'name' => request('sampleName'),
            'display' => htmlentities($sampleHTML),
            'subsound' => $subsound,
            'enabled' => $enabled
    	]);

        $request->sampleFile->storeAs('samples', $fileName);

        \Session::flash('message', 'Sample successfully added!');
        \Session::flash('alert-class', 'alert-success');

    	return redirect('/samples/manage');
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
        $filename = substr(\Crypt::decrypt($request->id) , 12);
        $name = substr( $filename , 11 , strrpos ($filename, '.mp3') );
        if( !empty( sample::where('name', $name)->first() ))
        {
            $name = $name.uniqid();
        }
        sample::create([
            'filename' => $filename,
            'name' => $name,
            'display' => $name,
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
