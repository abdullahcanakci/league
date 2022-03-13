<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonStandingResource extends JsonResource
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
            'team' => TeamResource::make($this->whenLoaded('team')),
            'points' => $this->points,
            'plays' => $this->plays,
            'wins' => $this->wins,
            'draws' => $this->draws,
            'loses' => $this->loses,
            'goals' => $this->goals,
            'goals_conceded' => $this->goals_conceded,
            'chance' => $this->chance
        ];
    }
}
