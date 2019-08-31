<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosAlerts extends Model
{
    //
    protected $fillable = [
        'title',
        'line_1',
        'line_2',
        'line_single',
        'action_text',
        'action_link',
        'action_tab',
        'status',
        'created_at',
        'updated_at'
    ];
    public function getAlertsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_alerts")
         ->select("vestidos_alerts.id as id","vestidos_alerts.title as col_1","vestidos_alerts.line_1 as col_2",
          "status.name as col_3")
         ->join("vestidos_statuses as status","status.id","vestidos_alerts.status")
         ->whereIn('vestidos_alerts.id',$id_list)
         ->groupBy("vestidos_alerts.id")
         ->get();
         return $products;
     }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
