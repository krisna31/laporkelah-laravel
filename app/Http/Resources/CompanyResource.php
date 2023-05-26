<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nama_perusahaan" => $this->nama,
            "logo_perusahaan" => $this->logo,
            "is_public" => $this->is_public,
            'reports' => $this->mergeWhen($request->reports, ReportResource::collection($this->reports)),
        ];
    }
}
