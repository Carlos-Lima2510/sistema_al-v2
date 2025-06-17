<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAsignarRolResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'message' => 'Rol asignado correctamente',
            'user' => [
                'id' => $this->id, 
                'name' => $this->name, 
                'email' => $this->email,
                'roles' => $this->getRoleNames()->toArray(), 
            ],
        ];
    }
}
