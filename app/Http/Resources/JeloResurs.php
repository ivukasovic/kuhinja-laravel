<?php

namespace App\Http\Resources;

use App\Models\Kategorija;
use App\Models\Poreklo;
use Illuminate\Http\Resources\Json\JsonResource;

class JeloResurs extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $kategorija = Kategorija::find($this->kategorijaId);
        $poreklo = Poreklo::find($this->porekloId);

        return [
            'id' => $this->id,
            'nazivJela' => $this->nazivJela,
            'cena' => $this->cena,
            'kategorija' => $kategorija->kategorijaNaziv,
            'zemljaPorekla' => $poreklo->zemljaPorekla
        ];
    }
}
