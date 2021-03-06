<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'year' => $this->year,
            'week' => $this->week,
            'concluded' => $this->concluded,
            'standings' => SeasonStandingResource::collection($this->whenLoaded('standings')),
            'fixtures' => FixtureResource::collection($this->whenLoaded('fixtures'))
        ];
    }
}
