<?php

namespace App\Http\Controllers;

use App\Http\Resources\JeloResurs;
use App\Models\Jelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JeloController extends Controller
{
    public function index()
    {
        $jela = Jelo::all();
        return response()->json([
            'uspesno' => true,
            'podaci' => JeloResurs::collection($jela),
            'poruka' => 'Uspesno vracena jela'
        ], 200);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nazivJela' => 'required',
            'cena' => 'required',
            'porekloId' => 'required',
            'kategorijaId' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'uspesno' => false,
                'podaci' => $validator->errors(),
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $jelo = Jelo::create($input);

        return response()->json([
            'uspesno' => true,
            'podaci' => new JeloResurs($jelo),
            'poruka' => 'Uspesno sacuvano jelo'
        ], 200);
    }


    public function show($id)
    {
        $jelo = Jelo::find($id);
        if (is_null($jelo)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }
        return response()->json([
            'uspesno' => true,
            'podaci' => new JeloResurs($jelo),
            'poruka' => 'Uspesno vraceno jelo za zadati Id'
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $jelo = Jelo::find($id);
        if (is_null($jelo)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'nazivJela' => 'required',
            'cena' => 'required',
            'porekloId' => 'required',
            'kategorijaId' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'uspesno' => false,
                'podaci' => $validator->errors(),
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $jelo->nazivJela = $input['nazivJela'];
        $jelo->cena = $input['cena'];
        $jelo->porekloId = $input['porekloId'];
        $jelo->kategorijaId = $input['kategorijaId'];
        $jelo->save();

        return response()->json([
            'uspesno' => true,
            'podaci' => new JeloResurs($jelo),
            'poruka' => 'Uspesno promenjeno jelo'
        ], 200);
    }

    public function destroy($id)
    {
        $jelo = Jelo::find($id);
        if (is_null($jelo)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }
        $jelo->delete();

        return response()->json([
            'uspesno' => true,
            'podaci' => new JeloResurs($jelo),
            'poruka' => 'Uspesno izbrisano poreklo jela'
        ], 200);
    }
}
