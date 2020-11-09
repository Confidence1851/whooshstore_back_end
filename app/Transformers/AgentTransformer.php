<?php


namespace App\Transformers;

use App\Models\Agent;

class AgentTransformer
{
    public function transform(Agent $agent)
    {

        $agent->avatar = $agent->user->avatar ?? '';
        if(empty($agent->avatar)){
            $agent->avatar = 'https://cdn.pixabay.com/photo/2015/03/04/22/35/head-659651_960_720.png' ;
        }

        return [
            'id' => $agent->id,
            'avatar' => $agent->avatar,
            'name' => $agent->display_name ?? $agent->user->name ?? 'N/A',
            'email' => $agent->email,
            'phone_no' => $agent->phone_no,
            'whatsapp_no' => $agent->whatsapp_no,
            'department' => $agent->department,
            'whatsapp_url' => 'https://wa.me/'.$agent->whatsapp_no,
        ];
    }

    public function collect($collection)
    {
        $transformer = new AgentTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
    

}
