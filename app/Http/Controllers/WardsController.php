<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

use App\Ward;
use App\County;
use App\SubCounty;

use Response;

class WardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request){
      switch($request->input('filter'){
        case 'county':
          return self::searchFromCounty($request);
        break;
        case 'subcounty':
          return self::searchFromSubCounty($request);
        break;
      }
    }

    public function searchFromCounty(Request $request)
    {
      $wards = Ward::with('county')->county($request->input('county'))->pluck('name');
      return Response::json($wards);
    }

    public function searchFromSubCounty(Request $request)
    {
      $wards = Ward::with('subcounty')->subcounty($request->input('subcounty'))->pluck('name');
      return Response::json($wards);
    }

    public function scrape()
    {

      $client = new Client();

      $crawler = $client->request('GET', 'http://kenyaelectiondatabase.co.ke/?page_id=1010');

      $crawler->filter('table#tablepress-13 tbody tr')->each(function ($node) {
        $ward = new Ward();
        $node->filter('td')->each(function($column,$index) use ($ward){

          switch($index){
            case 0:
              $ward->name = ucwords($column->text());
            break;
            case 1:
              $ward->sub_county_id = (SubCounty::where('name',$column->text())->first())?SubCounty::where('name',$column->text())->first()->id:0;
            break;
            case 2:
              $ward->county_id = (County::where('name',$column->text())->first())?County::where('name',$column->text())->first()->id:0;
            break;
          }

        });

        $ward->save();

      });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
