<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded;

    protected $appends = ['picUrl'];

    public function getPicUrlAttribute() {
        $url = $this->img ? asset('uploads/img/' . $this->img) : "https://storage.prompt-hunt.workers.dev/cleztv3zb000ak309v7z21p6m_1";
        return $url;
    }
}
