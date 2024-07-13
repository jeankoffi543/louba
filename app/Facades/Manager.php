<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Manager extends Facade
{
   /* 
   * @method static ?\Illuminate\Database\Eloquent\Collection getDemandeByHabilete(?User $user, ?string $status=null)
   * @see \App\Providers\WorkFlowManger
   */
   protected static function getFacadeAccessor()
   {
      return \App\Providers\WorkFlowManger::class;
   }
}