<?php

namespace App\Http\Controllers;

use App\Http\Resources\KategorijaResurs;
use App\Models\Kategorija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategorijaController extends Controller
{
    public function index()
    {
        $kategorije = Kategorija::all();
        return response()->json([
            'uspesno' => true,
            'podaci' => KategorijaResurs::collection($kategorije),
            'poruka' => 'Uspesno vracene kategorije jela'
        ], 200);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'kategorijaNaziv' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'uspesno' => false,
                'podaci' => $validator->errors(),
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $kategorija = Kategorija::create($input);

        return response()->json([
            'uspesno' => true,
            'podaci' => new KategorijaResurs($kategorija),
            'poruka' => 'Uspesno sacuvana kategorija'
    ], 200);
    }


    public function show($id)
    {
        $kategorija = Kategorija::find($id);
        if (is_null($kategorija)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }
        return response()->json([
            'uspesno' => true,
            'podaci' => new KategorijaResurs($kategorija),
            'poruka' => 'Uspesno vracena kategorija za zadati Id'
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $kategorija = Kategorija::find($id);
        if (is_null($kategorija)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'kategorijaNaziv' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'uspesno' => false,
                'podaci' => $validator->errors(),
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }

        $kategorija->kategorijaNaziv = $input['kategorijaNaziv'];
        $kategorija->save();

        return response()->json([
            'uspesno' => true,
            'podaci' => new KategorijaResurs($kategorija),
            'poruka' => 'Uspesno promenjena] kategorija'
        ], 200);
    }

    public function destroy($id)
    {
        $kategorija = Kategorija::find($id);
        if (is_null($kategorija)) {
            return response()->json([
                'uspesno' => false,
                'poruka' => 'Doslo je do greske prilikom validacije'
            ], 401);
        }
        $kategorija->delete();

        return response()->json([
            'uspesno' => true,
            'podaci' => new KategorijaResurs($kategorija),
            'poruka' => 'Uspesno izbrisana kategorija'
        ], 200);
    }
}
