<?php namespace EstTools;

use Est\Intake\GlubokoeRows;
use Est\Intake\OrshaRows;
use Est\Intake\PolotskRows;
use Est\Intake\RupRows;
use Est\Intake\VitebskRows;

class Est{

    
    function __construct(){
        set_error_handler(function($e,$ms){
            throw new \Exception($ms,$e);
        });
    }
    
    public function GetIntake($part,$date=null){
        if($part=='orsha')
            return new OrshaRows('Оршанские ЭС',$date);
        else  if($part=='polotsk')
            return new PolotskRows('Полоцкие ЭС',$date);
        else  if($part=='vitebsk')
            return new VitebskRows('Витебские ЭС',$date);
        else  if($part=='glubokoe')
            return new GlubokoeRows("Полоцкие ЭС",$date);
        else  if($part=='rup')
            return new RupRows('РУП Витебскэнерго',$date);
        else return null;
    }
    
    public static function GetEstCurrentData($ipaddress,$port,array $ids){
        $sid='';
        for ($i = 0; $i < count($ids); $i++)
        {
        	$sid+=$ids[$i].',';
        }
        $url='http://'.$ipaddress.':'.$port.'/crq?req=current&type=b&n1='.$sid.'&json=1';
        $code=\Est\Emax::RequestToUrl('GET',$url);
    }
}
