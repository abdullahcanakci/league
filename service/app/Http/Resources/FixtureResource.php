<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FixtureResource extends JsonResource
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
            'week' => $this->week,
            'homeTeam' => TeamResource::make($this->whenLoaded('homeTeam')),
            'awayTeam' => TeamResource::make($this->whenLoaded('awayTeam')),
            'home_goals' => $this->home_goals,
            'away_goals' => $this->away_goals
        ];
    }
}
