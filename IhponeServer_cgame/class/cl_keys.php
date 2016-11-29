<?php
/*
 * 秘钥类
 */

class cl_keys{
    private static $bool=array('q'=>'u','w'=>'3','e'=>'(','r'=>'r','t'=>'7','y'=>'m','u'=>'s','i'=>'r','o'=>'c','p'=>'0','a'=>'d','s'=>'l','d'=>'F','f'=>'c','g'=>'l','h'=>'6','j'=>'2','k'=>'c','l'=>';','z'=>'$','x'=>'(','c'=>'@','v'=>'s','b'=>'"','n'=>'d','m'=>'^',
        '1'=>'Q','2'=>'R','3'=>'9','4'=>'#','5'=>'l','6'=>'.','7'=>'w','8'=>';','9'=>'w','0'=>'v',
        'Q'=>'U','W'=>'%','E'=>'2','R'=>'$','T'=>'c','Y'=>'S','U'=>'i','I'=>'7','O'=>'e','P'=>'2','A'=>'L','S'=>'s','D'=>'*','F'=>'T','G'=>'4','H'=>'O','J'=>'c','K'=>'w','L'=>'c','Z'=>'e','X'=>'8','C'=>'Y','V'=>':','B'=>'K','N'=>'!','M'=>'a');
    public static function start($parameter){
        $parameter_0=$parameter['0'];
        @$parameter_1=$parameter['1']?$parameter['1']:'';
        $par_str= $parameter_0. $parameter_1;
        $new_par_str=null;
        for($i=0;$i<strlen($par_str);$i++) {
            $new_par_str.=self::$bool[$par_str[$i]];
        }
        $ress=md5($new_par_str);
        if(count($parameter)>=3){
            unset($parameter['0'],$parameter['1']);
            $end_str=null;
            foreach($parameter as $vv){
                $end_str.=$vv;
            }
            $ress.='-'.substr(md5($end_str),0,15);
        }
        return $ress;
    }
    public static function isequal($parame,$keystring){
        $keystring_a=explode('-',$keystring);
        $keystring_len=count($keystring_a);
        if($keystring_len>1){
            $parame_len=count($parame);
            if($parame_len>=3){
                $par_str=$parame['0'].$parame['1'];
                $new_par_str=null;
                for($i=0;$i<strlen($par_str);$i++){
                    $new_par_str.=self::$bool[$par_str[$i]];
                }
                if(md5($new_par_str)==$keystring_a[0]){
                    unset($parame['0'],$parame['1']);
                    $end_str=null;
                    foreach($parame as $vv){
                        $end_str.=$vv;
                    }
                    $myress=substr(md5($end_str),0,15);
                    if($myress==$keystring_a[1]){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            $parameter_0=$parame['0'];
            @$parameter_1=$parame['1']?$parame['1']:'';
            $par_str= $parameter_0. $parameter_1;
            $new_par_str=null;
            for($i=0;$i<strlen($par_str);$i++){
                $new_par_str.=self::$bool[$par_str[$i]];
            }
            if(md5($new_par_str)==$keystring_a[0]){
                return true;
            }else{
                return false;
            }
        }
    }
}
?>