<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Superhero;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

class SuperheroController extends Controller
{

    public function all(Request $request)
    {
        try {

            $authorization = $request->header('Authorization');
            if (empty($authorization) || $authorization != env('TOKEN'))
                return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);


            $validator = $this->validator($request->all());
            if ($validator->fails())
                return response()->json(['status' => 'error', 'response' => $validator->messages()->all()], 400);


            $SuperHeroes = Superhero::query()
                ->when($request->get('strengthFrom'), function ($query, $strengthFrom) {
                    $query->where('strength', '>=', (int)$strengthFrom);
                })
                ->when($request->get('strengthTo'), function ($query, $strengthTo) {
                    $query->where('strength', '<=', (int)$strengthTo);
                })
                ->when($request->get('speedFrom'), function ($query, $speedFrom) {
                    $query->where('speed', '>=', (int)$speedFrom);
                })
                ->when($request->get('speedTo'), function ($query, $speedTo) {
                    $query->where('speed', '<=', (int)$speedTo);
                })
                ->when($request->get('durabilityFrom'), function ($query, $durabilityFrom) {
                    $query->where('durability', '>=', (int)$durabilityFrom);
                })
                ->when($request->get('durabilityTo'), function ($query, $durabilityTo) {
                    $query->where('durability', '<=', (int)$durabilityTo);
                })
                ->when($request->get('powerFrom'), function ($query, $powerFrom) {
                    $query->where('power', '>=', (int)$powerFrom);
                })
                ->when($request->get('powerTo'), function ($query, $powerTo) {
                    $query->where('power', '<=', (int)$powerTo);
                })
                ->when($request->get('combatFrom'), function ($query, $combatFrom) {
                    $query->where('combat', '>=', (int)$combatFrom);
                })
                ->when($request->get('combatTo'), function ($query, $combatTo) {
                    $query->where('combat', '<=', (int)$combatTo);
                })
                ->when($request->get('raceContains'), function ($query, $raceContains) {
                    $query->where('race', 'LIKE', $raceContains . '%');
                })
                ->when($request->get('raceContains'), function ($query, $raceContains) {
                    $query->where('race', 'LIKE', '%' . $raceContains . '%');
                })
                ->when($request->get('nameContains'), function ($query, $nameContains) {
                    $query->where('name', 'LIKE', '%' . $nameContains . '%');
                })
                ->when($request->get('fullNameContains'), function ($query, $fullNameContains) {
                    $query->where('fullName', 'LIKE', '%' . $fullNameContains . '%');
                })
                ->when($request->get('eyeColorContains'), function ($query, $eyeColorContains) {
                    $query->where('eyeColor', 'LIKE', '%' . $eyeColorContains . '%');
                })
                ->when($request->get('hairColorContains'), function ($query, $hairColorContains) {
                    $query->where('hairColor', 'LIKE', '%' . $hairColorContains . '%');
                })
                ->when($request->get('publisherContains'), function ($query, $publisherContains) {
                    $query->where('publisher', 'LIKE', '%' . $publisherContains . '%');
                })
                ->when($request->get('sortBy') && $request->get('sortOrder'), function ($query) use ($request) {
                    $query->orderby($request->sortBy, $request->sortOrder);
                })
                ->paginate($request->pagination);


            return response()->json(['status' => 'ok', 'response' => $SuperHeroes]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' =>   $e->getMessage()], 500);
        }
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'strengthFrom' => 'integer',
            'strengthTo' => 'integer',
            'speedFrom' => 'integer',
            'speedTo' => 'integer',
            'durabilityFrom' => 'integer',
            'durabilityTo' => 'integer',
            'powerFrom' => 'integer',
            'powerTo' => 'integer',
            'combatFrom' => 'integer',
            'combatTo' => 'integer',
            'raceContains' => 'String',
            'nameContains' => 'String',
            'fullnameContains' => 'String',
            'eyeColorContains' => 'String',
            'hairColorContains' => 'String',
            'publisherContains' => 'String',
            'sortBy' => ValidationRule::in(['id', 'name', 'fullName', 'strength', 'speed', 'durability', 'power', 'combat', 'race', 'height/0', 'height/1', 'weight/0', 'weight/1', 'eyeColor', 'hairColor', 'publisher',]),
            'sortOrder' => ValidationRule::in(['asc', 'desc']),
            'pagination' => 'integer',
            'page' => 'integer',
        ], [
            'sortBy' => "the sortBy parameter must by one of this options 'name','fullName','strength','speed','durability','power','combat','race','height/0','height/1','weight/0','weight/1','eyeColor','hairColor','publisher'",
            'sortOrder' => "the sortOrder parameter must by 'asc' or 'desc' value"
        ]);
    }
}
