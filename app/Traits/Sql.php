<?php

namespace  App\Traits;

use Illuminate\Support\Facades\DB;

trait Sql {
    protected static  $table_name;
    public function getQey($table =null){
        if(!self::$table_name){
            self::$table_name=(($table)?$table:$this->getTable());
        }
        if(!$table){
            $table= self::$table_name;
        }
      return  DB::select('select * from INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = SCHEMA()  AND REFERENCED_TABLE_NAME IS NOT NULL AND  TABLE_NAME = "'.$table.'"');
    }
}
