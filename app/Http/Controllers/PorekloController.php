<?php

namespace App\Http\Controllers;

use App\Http\Resources\PorekloResurs;
use App\Models\Poreklo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PorekloController extends Controller
{
    public function index()
    {
        $porekla = Poreklo::all();
        return response()->json([
            'uspesno' => true,
            'podaci' => PorekloResurs::collection($porekla),
            'poruka' => 'Uspesno vracena porekla jela'
        ], 200);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'zemljaPorekla' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'uspesno' => false,
                'podaci' => $validator->errors(),
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $poreklo = Poreklo::create($input);

        return response()->json([
            'uspesno' => true,
            'podaci' => new PorekloResurs($poreklo),
            'poruka' => 'Uspesno sacuvano poreklo jela'
        ], 200);
    }


    public function show($id)
    {
        $poreklo = Poreklo::find($id);
        if (is_null($poreklo)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }
        return response()->json([
            'uspesno' => true,
            'podaci' => new PorekloResurs($poreklo),
            'poruka' => 'Uspesno vraceno poreklo jela za zadati Id'
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $poreklo = Poreklo::find($id);
        if (is_null($poreklo)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'zemljaPorekla' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'uspesno' => false,
                'podaci' => $validator->errors(),
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $poreklo->zemljaPorekla = $input['zemljaPorekla'];
        $poreklo->save();

        return response()->json([
            'uspesno' => true,
            'podaci' => new PorekloResurs($poreklo),
            'poruka' => 'Uspesno promenjeno poreklo jela'
        ], 200);
    }

    public function destroy($id)
    {
        $poreklo = Poreklo::find($id);
        if (is_null($poreklo)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }
        $poreklo->delete();

        return response()->json([
            'uspesno' => true,
            'podaci' => new PorekloResurs($poreklo),
            'poruka' => 'Uspesno izbrisano poreklo jela'
        ], 200);
    }
}
