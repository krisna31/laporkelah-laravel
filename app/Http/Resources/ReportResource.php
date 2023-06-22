<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
            'foto' => $this->foto,
            'created_by' => $this->user->name,
            'created_by_email' => $this->user->email,
            // 'user' => new UserResource($this->whenLoaded('user')),
            // 'company' => new CompanyResource($this->whenLoaded('company')),
            'comments' => $this->mergeWhen($request->comments, CommentResources::collection($this->comments)),
            'updated_by' => $this->when(!$this->status, $this->updatedBy->name ?? 'default'),
            'alasan_close' => $this->when(!$this->status, $this->alasan_close),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
