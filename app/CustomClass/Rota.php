<?php
namespace App\CustomClass;
use Illuminate\Support\Facades\DB;

class Rota
{
    /**
     * get rota by Id
     * 
     * @param integer $rotaId
     * 
     * @return Illuminate\Support\Collection
     */
    public static function getRotaById($rotaId)
    {
        return DB::table('rotas')->find($rotaId);
    }
}