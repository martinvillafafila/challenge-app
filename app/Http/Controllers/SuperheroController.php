<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Superhero;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SuperheroController extends Controller
{

    public function all(Request $request)
    {

    $request->validate([
        'sortOrder'=> Rule::in(['asc','desc'])
    ],[
        'sortOrder' => "the 'sortOrder' parameter must by 'asc' ord 'desc' value"
    ]);
    

        $SuperHeroes = Superhero::query()
        ->when( $request->get('strengthFrom'),function ( $query,$strengthFrom){
            $query->where('strength', '>=',(int)$strengthFrom);
        })
        ->when( $request->get('strengthTo'),function ( $query,$strengthTo){
            $query->where('strength', '<=',(int)$strengthTo);
        })
        ->when( $request->get('speedFrom'),function ( $query,$speedFrom){
            $query->where('speed', '>=',(int)$speedFrom);
        })
        ->when( $request->get('speedTo'),function ( $query,$speedTo){
            $query->where('speed', '<=',(int)$speedTo);
        })
         ->when( $request->get('durabilityFrom'),function ( $query,$durabilityFrom){
            $query->where('durability', '>=',(int)$durabilityFrom);
        })
        ->when( $request->get('durabilityTo'),function ( $query,$durabilityTo){
            $query->where('durability', '<=',(int)$durabilityTo);
        })
        ->when( $request->get('powerFrom'),function ( $query,$powerFrom){
            $query->where('power', '>=',(int)$powerFrom);
        })
        ->when( $request->get('powerTo'),function ( $query,$powerTo){
            $query->where('power', '<=',(int)$powerTo);
        })
        ->when( $request->get('combatFrom'),function ( $query,$combatFrom){
            $query->where('combat', '>=',(int)$combatFrom);
        })
        ->when( $request->get('combatTo'),function ( $query,$combatTo){
            $query->where('combat', '<=',(int)$combatTo);
        })
        ->when( $request->get('RaceContains'),function ( $query,$RaceContains){
            $query->where('race', 'LIKE',$RaceContains.'%');
        })

        ->when( $request->get('sortBy') && $request->get('sortOrder') ,function ( $query)use ($request){
            $query->orderby($request->sortBy, $request->sortOrder);
        })


        ->paginate($request->pagination);

        return response()->json(($SuperHeroes));
    }
}
