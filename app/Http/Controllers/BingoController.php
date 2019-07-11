<?php

namespace Soundboard\Http\Controllers;

use Soundboard\BingoPhrase;
use Illuminate\Http\Request;

class BingoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Manage View Goes here";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Create View Goes here";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Soundboard\BingoPhrase  $bingoPhrase
     * @return \Illuminate\Http\Response
     */
    public function show(BingoPhrase $bingoPhrase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Soundboard\BingoPhrase  $bingoPhrase
     * @return \Illuminate\Http\Response
     */
    public function edit(BingoPhrase $bingoPhrase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Soundboard\BingoPhrase  $bingoPhrase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BingoPhrase $bingoPhrase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Soundboard\BingoPhrase  $bingoPhrase
     * @return \Illuminate\Http\Response
     */
    public function destroy(BingoPhrase $bingoPhrase)
    {
        //
    }
}
