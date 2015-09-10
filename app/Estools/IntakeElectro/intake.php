<?php namespace Est\Intake;

use DateInterval;
use DateTime;
use DateTimeZone;
use DB;
use Exception;
use stdClass;


class RupTable{
    protected $total=0;
    protected $rows=array();
    protected $rowsIntake=array();
    protected $planGraph=array();
    protected $factGraph=array();
    public $name;
    
    protected function add($record,$intakeRecord){
        array_push($this->rows,$record);
        $this->total++;
        array_push($this->rowsIntake,$intakeRecord);
        $dt=new DateTime($intakeRecord->datetime);
        $dts=$dt->getTimestamp()*1000;
        array_push($this->planGraph,array($dts,$intakeRecord->plan));
        array_push($this->factGraph,array($dts,$intakeRecord->fact));
    }
   
    
    public function intakeSerialize(){
        $intake=new stdClass();
        $intake->total=$this->total;
        $intake->rows=$this->rowsIntake;
        $full=new \stdClass();
        $full->total=$this->total;
        $full->rows=$this->rows;
        $c=count($this->rows)-1;
        $last_value=array('plan'=>$this->rows[$c]->plan,'fact'=>$this->rows[$c]->fact,
            'otcl'=>$this->rows[$c]->otcl,'percent'=>$this->rows[$c]->percent);
        return array(
            'name'=>$this->name,
            'table'=>json_encode($intake),
            'full'=>json_encode($full),
            'plan'=>json_encode($this->planGraph),
            'fact'=>json_encode($this->factGraph),
            'last_intake'=>$last_value);
    }
    
    public function serialize(){
        $all=new \stdClass();
        $all->total=$this->total;
        $all->rows=$this->rows;
        return json_encode($all);
    }

    protected function GetItemByTime($datetime){
        foreach($this->rows as $value){
            if($value->datetime==$datetime)
                return $value->fact;
        }
        return null;
    }

    protected function setCheckedValue(EstRequest $estRequest,$key,$id,$ival=null){
        if(isset($estRequest->data[$key]))
        {
            if(isset($estRequest->data[$key][$id]))
                return $estRequest->data[$key][$id][$ival==null?'IVAL':$ival];
            else return 0;
        }
        else return 0;

    }
}

class EstRequest{

    public $name;
    public $items;
    public $increment;
    public $data;
    public $step;
   

    function __construct($name,array $items,$increment=false,$step=false,$round=true){
        $this->name=$name;
        $this->items=$items;
        $this->increment=$increment;
        $this->step=$step;
        $this->round=$round;
    }
}

class EstDataRequest{
    
    
    
    public static function GetObjectEstData(array $estRequest,$datetimeRequest){
        foreach($estRequest as $item){
            $item->data= EstDataRequest::getEstData($item->items,$datetimeRequest,$item->increment,$item->step,$item->round);
        }
    }
    
    protected static function GetConstValueFromTime($value){
        try{
            if($value!=null){
                $time=explode(":",date("H:i",$value['DATETIME']->getTimestamp()));
                if((double)$time[1]>=30)
                    return $value['VAL']*((double)($time[0])+0.5);
                else return $value['VAL']*(double)$time[0];
            }
            else return null;
        }
        catch(Exception $e){
            
        }
    }

    protected static function getEstData(array $idItems,$datetimeRequest,$increment=false,$step=false,$round=3){
        
        $arID=array();
        try{
            $conn=DB::connection("estools");
            if(!$conn)
                throw new Exception("error connect to est database");
            $query=EstDataRequest::createIntervalQuery($idItems,$datetimeRequest,$step);
            $result=$conn->select($query);
            if(!$result)
                return new Exception("error query from est database");
            $conn->disconnect();
            $i=0;
            foreach ($result as $row)
            {
                $tm=$row->TIME_WRITE;
                $dtu=new DateTime($tm,new \DateTimeZone('UTC'));
                $dtl=$dtu->setTimezone(new \DateTimeZone(\Config::get('app.timezone')));
                $dtlf= $dtl->format("Y-m-d H:i");
                if(!array_key_exists($dtlf,$arID)){
                    $arID[$dtlf]=array();
                }
                $dval=$row->DATA;
                if($dval==null)
                    $dval=0;
                else{
                    if($round)	
                        $dval=round($dval/1000,1);
                }
                    $arID[$dtlf][$row->ID_OWN]=array("VAL"=>$dval,"QUALITY"=>$row->QUALITY,"DATETIME"=>$tm);
                    $i++;
              }
            
            if($increment)
                EstDataRequest::CaculateIncrement($arID);
            return $arID;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

    protected static function CaculateIncrement(array &$arItems){
        $i=0;
        foreach ($arItems as &$item) {
            $isum=0;
            $sum=0;
            if($i==0){
                foreach($item as $key=>$iobj){
                    $item[$key]["IVAL"]=$iobj["VAL"];
                    $isum+=$iobj["VAL"];
                }
                $item["SUM"]=$isum;
                $item["ISUM"]=$isum;
                $prevKey=$item;
                $i++;
                continue;
            }
            else
            {
                foreach($item as $key=>$iobj){
                    $dat=$iobj["VAL"]+$prevKey[$key]["IVAL"];
                    $item[$key]["IVAL"]=$dat;//$item[$col]["VAL"]+$prevKey[$col]["VAL"];
                    $isum+=$dat;
                    $sum+=$iobj["VAL"];
                }
                $item["ISUM"]=$isum;
                $item["SUM"]=$sum;
                $prevKey=$item;
            }
        }
    }

    protected static function GetIntervalQuery(\DateTime $dt){
        $now=new DateTime('now');
        $dts=new DateTime($dt->format('Y-m-d H:i:s'));
        $dts->setTime(0,30);
        $dte=new DateTime($dt->format('Y-m-d H:i:s'));
        if($dt->format('d')==$now->format('d')){
            $dte->setTime($dt->format('H'),$dt->format('i')>30?30:0);
        }
        else{
            $dte->setTime(0,0);
            $dte->add(new DateInterval('P1D'));
        }
        if($dte)
            $dte->setTimezone(new DateTimeZone('UTC'));
        if($dts)
            $dts->setTimezone(new DateTimeZone('UTC'));
        return array('start'=>$dts,'end'=>$dte);
    }

    private static function createIntervalQuery($idItems,$datetimeRequest,$step=false){
        $query="SELECT [ID_OWN],[DATA],[TIME_WRITE],[QUALITY] FROM [DBSRVSAU].[est].[dbo].[BSS_DATA_DOUBLE] where (";
        for ($i=0;$i<count($idItems);$i++) {
            $query.=" id_own=".$idItems[$i];
            if($i!=count($idItems)-1)
                $query.=" or";
        }
        $query.=")";
        $date=EstDataRequest::GetIntervalQuery($datetimeRequest);
        $query.=" and TIME_WRITE BETWEEN '".$date['start']->format("Y-d-m H:i:s.000")."' and '".
            $date['end']->format("Y-d-m H:i:s.000")."' ";
        if($step)
            $query.="and (DATEPART(mi,TIME_WRITE)=30 or DATEPART(mi,TIME_WRITE)=00) ";
        $query.="order by ID_OWN";
        return $query;
    }
}