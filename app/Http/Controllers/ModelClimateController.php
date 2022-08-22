<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClimate;
use App\Models\Current;
use App\Models\Location;
use App\Models\ModelClimate;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;

class ModelClimateController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
        //
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClimate $request )
    {
        $current = Current::create($request->all());
        $location = $current->locations()->create( $request->all() );
        $climate = ModelClimate::create($request->all());
        $climate->location()->associate($location)->save();

        return response()->json($location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelClimate  $modelClimate
     * @return \Illuminate\Http\Response
     */
    public function show( $query=null )
    {
        function httpClient ($reques){
            $client = new Client([
                'base_uri'=>env('WEATHERSTACKk_URL').'?access_key='.env('WEATHERSTACKk_API_kEY').'&query='.$reques,
            ]);
            $response = $client->request('GET', '')->getBody()->getContents();
            $response = json_decode($response, true);
            return response( $response);
        }

        function logica ($reques){

            try {
                $response = ModelClimate::with('location')->where('query', 'like', '%'.$reques.'%')->first()
                ->loadMorph('location',[Location::class => ['locationable'] ]);
            } catch (\Throwable $th) {
                //No existe dicha conuslta, asi que redirijo a buscar en api y crear
                $response = httpClient($reques);
                return redirect()->route('update',[ModelClimateController::class, 'update']);
            }

            //manejo de si paso el tiempo suficiente para consultar a api
            $timeDB = $response->location->locationable->updated_at;
            $date = Carbon::now();
            if ($date->diffInMinutes($timeDB) >= 60) {
                //respuesta mayor a 60 minutos realizo un edit
                $response = httpClient($reques);;
                return redirect()->route('store',[ModelClimateController::class, 'store']);
            }
            else return response()->json($response);

        }

        if ( isset($_GET['query']) ) {

            //consulto a la base da datos toda la info
            $query = $_GET['query'];
            $response = logica($query);

            return response()->json($response->original);
        }else{
            $response = logica($query);
            return response()->json($response->original);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelClimate  $modelClimate
     * @return \Illuminate\Http\Response

*    public function edit(ModelClimate $modelClimate)
 *   {

  *  }
*/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelClimate  $modelClimate
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClimate $request, ModelClimate $modelClimate)
    {
        ModelClimate::where('query', 'like', '%'.$request['query'].'%')->first()->update($request->all());
        Location::whereHas('climate', function (Builder $query) {$query->where('query', 'like', '%New York%');})->first()->update($request->all());
        Current::with('locations')
        ->whereHas('locations', function (Builder $query) {$query->whereHas('climate', function (Builder $query) {$query->where('query', 'like', '%New York%');});})->first()
        ->update($request->all());

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelClimate  $modelClimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelClimate $modelClimate)
    {
        //
    }
}
