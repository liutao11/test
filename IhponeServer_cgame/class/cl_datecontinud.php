<?php
/**
 * 判断连个日期是否是相邻的两天
 */
class cl_datecontinud {
    public static function isdatecontinud($after_date,$now_date){
        $after_date_a=explode("-",$after_date);
        $now_date_a=explode('-',$now_date);
        if($after_date_a[0]==$now_date_a[0]){
            if($after_date_a[1]==$now_date_a[1]){
                if($after_date_a[2]+1==$now_date_a[2]){return true;}else{return false;}
            }else {
                $d_month=array(1,3,5,7,8,10,12);
                    if(in_array($after_date_a[1],$d_month)){
                        if($after_date_a[1]+1==$now_date_a[1] && $after_date_a[2]==31 && $now_date_a[2]==1){return true;}else{return false;}
                    }else{
                        if($after_date_a[1]==2){
                            if($after_date_a[0]%4==0){
                                if($after_date_a[1]+1==$now_date_a[1] && $after_date_a[2]==29 && $now_date_a[2]==1){return true;}else{return false;}
                            }else{
                                if($after_date_a[1]+1==$now_date_a[1] && $after_date_a[2]==28 && $now_date_a[2]==1){return true;}else{return false;}
                            }
                        }else{
                            if($after_date_a[1]+1==$now_date_a[1] && $after_date_a[2]==30 && $now_date_a[2]==1){return true;}else{return false;}
                        }
                    }
            }

        }else{
           if($after_date_a[0]+1==$now_date_a[0] && $after_date_a[1]==12 && $after_date_a[2]=31 && $now_date_a[1]==1 && $now_date_a[2]==1){
               return true;
           } else{
               return false;
           }
        }
   }
}
?>