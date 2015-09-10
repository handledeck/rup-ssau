<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Est\Emax;
use Exception;
use Illuminate\Http\Request;
use Input;
use View;
use Excel;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class RegionController extends Controller {
    
    public function __construct(){
        $this->middleware('auth');
    }

    
    public function GetStationLines(){
        $station=Input::get('station');
        $date=Input::get('date');
        $emax=new \Est\Emax("http://10.32.18.32:8181","admin","admin");
        $dat=$emax->GetChannelByPartName($station,0,1000);
        return view('region\slines')->with(array('station'=>$dat->Values,'path'=>$station));
    }
    
    function GetArchive(){
        $sett=\Auth::user()->getAttribute('settings');

        if($sett==null)
        {
            $sett=new \stdClass();
            $sett->ap=1;
            $sett->am=1;
            $sett->rp=0;
            $sett->rm=0;
            $sett->interval=0;
            $json=json_encode($sett);
            \Auth::user()->setAttribute('settings',$json);
            \Auth::user()->save();
        }
        else
            $sett=json_decode($sett);
        $emax=new \Est\Emax("http://10.32.18.32:8181","admin","admin");
        $object=Input::get('station');
        $object=$this->GetStationById($object);
        $dt=Input::get('date');
        if($dt==null)
            $dt=getdate();
        else{
            $dt=getdate($dt/1000);
        }
        $year=$dt['year'];
        $month=$dt['mon']-1;
        $date=$dt['mday'];
        $mode=null;
        $dat=$emax->GetChannelByPartName($object,0,1000);
        $arrayId=array();
        $dtformat='Y-m-d';
        foreach($dat->Values as $item)
        {
            $names=explode('\\',$item->DisplayName);
            array_push($arrayId,$item->Id->IdInt);
        }
        $reqDateFrom=null;
        $reqDateTo=null;
        $reqCount=47;
        if($sett->interval==0)
            $mode=1;
        else if($sett->interval==1)
            $mode=2;
        if($mode==1){
            $reqDateFrom=array($year,$month,$date,/*$_GET['year'],$_GET['month'],$_GET['date'],*/0,30,0);
            $reqDateTo= array($year,$month,$date,/*$_GET['year'],$_GET['month'],$_GET['date'],*/23,30,0);
            $dtformat="Y-m-d H:i";
        }
        else if($mode==2)
        {
            $dtr=cal_days_in_month(CAL_GREGORIAN,$dt['mon'],$dt['year']);
            $reqDateFrom=array($year,$month,1,/*$_GET['year'],$_GET['month'],$_GET['date'],*/0,0,0);
            $reqDateTo= array($year,$month,$dtr,/*$_GET['year'],$_GET['month'],$_GET['date'],*/0,0,0);
            $reqCount=$dtr;
        }
        else if($mode==3)
        {
            $reqDateFrom=array($year,0,1,/*$_GET['year'],$_GET['month'],$_GET['date'],*/0,0,0);
            $reqDateTo= array($year,$month,1,/*$_GET['year'],$_GET['month'],$_GET['date'],*/0,0,0);
            $reqCount=12;
        }
       
        $energy=array();
        if($sett->ap==1)
            array_push($energy,0);
        if($sett->am==1)
            array_push($energy,1);
        if($sett->rp==1)
            array_push($energy,2);
        if($sett->rm==1)
            array_push($energy,3);
        $val=$emax->ReadDataChannel($arrayId,$reqDateFrom,$reqDateTo,
            /*array($year,$month,$date,/*$_GET['year'],$_GET['month'],$_GET['date'],0,30,0),*/
            /*array($year,$month,$date,/*$_GET['year'],$_GET['month'],$_GET['date'],23,30,0),*/
            $reqCount,$energy,$mode);
        $row=0;
        $col=0;
        $arrayRows=array();
        $ret=new \stdClass();
        $ret->total=$reqCount;
        for($i=0;$i<$reqCount;$i++){
            $locrow=new \stdClass();    
            foreach($val as $datas){
                for ($z = 0; $z < count($energy); $z++)
                {
                
                $itdatAp=$datas[$z]->Values[$i];
                
                if($row==0){
                    $dtr=new \DateTime();
                    
                    $dtr->setDate($itdatAp->T->T[0],$itdatAp->T->T[1]+1,$itdatAp->T->T[2]);
                    $dtr->setTime($itdatAp->T->T[3],$itdatAp->T->T[4]);
                    $locrow->datetime=$dtr->format($dtformat);
                    $row++;
                }
                $coln='col_'.$col;
                $locrow->$coln=$itdatAp->Qua>=128 ? '<span style="color:#ccc">'.round($itdatAp->Val->Val,3).'</span>': round($itdatAp->Val->Val,3);
                $col++;
                }
            }
            array_push($arrayRows,$locrow);
            $col=0;
            $row=0;
           
           
        }
        $ret->rows=$arrayRows;
        $cc=json_encode($ret);
        return $cc;
    }

    public function test(){
        $emax=new \Est\Emax("http://10.32.18.32:8181","admin","admin");
        $code=$emax->GetInstantValues();
    }
    
    public function Settings(){
        $ap=Input::get("AP");
        $am=Input::get("AM");
        $rp=Input::get("RP");
        $rm=Input::get("RM");
        $interval=Input::get("interval");
        $sett=new \stdClass();
        $sett->ap=isset($ap) ? 1: 0;
        $sett->am=isset($am) ? 1: 0;
        $sett->rp=isset($rp) ? 1: 0;
        $sett->rm=isset($rm) ? 1: 0;
        $sett->interval=$interval;
        if(!isset($sett->interval))
            $sett->interval=0;
        else
            $sett->interval=1;
        $json=json_encode($sett);
        \Auth::user()->setAttribute('settings',$json);
        \Auth::user()->save();
        return \Redirect::back();
    }
   
    
    
    public function region(){
        $active_tab=Input::get('act_tab');
        $ids=array('navid'=>1,'act'=>6);
        $id=null;
        View::share('ids',$ids);
        $station=Input::get('station');
        
        if(isset($station))
        {
            $id=$station;
            $station=$this->GetStationById($station);
        }
        $counter=Input::get('counter');
        $date=Input::get('date');
        $objs=array();
        $con_menu=DB::connection("station");
        if (!$con_menu)
            throw new Exception("error connect to est database");
        $conn = DB::connection("balance");
        if (!$conn)
            throw new Exception("error connect to est database");
          $result = $conn->select("Select* from station");
               
            foreach ($result as $row)
            {
                $exrow=explode('\\',$row->station);
                if(count($exrow)==3){
                    $sob=new \stdClass();
                    $sob->name=$exrow[2];
                    $sob->id=$row->id;
                    $sob->full=$row->station;
                    $res_stat = $con_menu->select("Select* from q3qkj_menu where note like '%".$sob->name."'");
                    if(count($res_stat)>0)
                        $sob->title=$res_stat[0]->title;
                    else
                        $sob->title=$sob->name;
                    if(!isset($station)){
                    $dtD=new \DateTime('now');
                    $dtreq=$dtD->format('Y-m-d 00:00:00');
                    $d_res = $conn->select('select * from balanceDay where id='.$row->id.' and datetime="'.$dtreq.'"');
                        $sob->d_value=isset($d_res[0])?$d_res[0]->percent:0;
                       $sob->d_percent=isset($d_res[0])?$d_res[0]->value:0;
                       $sob->d_quality=isset($d_res[0])?$d_res[0]->quality:0;
                       
                       $dtreq=$dtD->format('Y-m-01 00:00:00');
                       $m_res = $conn->select('select * from balanceMonth where id='.$row->id.' and datetime="'.$dtreq.'"');
                       $sob->m_value=isset($m_res[0])?$m_res[0]->percent:0;
                       $sob->m_percent=isset($m_res[0])?$m_res[0]->value:0;
                       $sob->m_quality=isset($m_res[0])?$m_res[0]->quality:0;
                    }
                       
                if(!array_key_exists($exrow[0],$objs)){
                    $objs[$exrow[0]]=array();
                    $objs[$exrow[0]][$exrow[1]]=array();
                    array_push($objs[$exrow[0]][$exrow[1]],$sob);
                }
                else
                {
                    if(!array_key_exists($exrow[1],$objs[$exrow[0]]))
                    {
                        $objs[$exrow[0]][$exrow[1]]=array();
                    }
                    array_push( $objs[$exrow[0]][$exrow[1]],$sob);
                   
                }
                }
                else{
                    $x=0;
                }
                
            }
            $conn->disconnect();
        
       $ret_val=array();
        foreach ($objs as $key=>$value)
        {
            uasort($value,function($a,$b){
                return count($b)-count($a);
            });
           $ret_val[$key]=$value;
        }
        
        if(isset($station))
        {
            if(isset($counter))
                return view('region\main')->with(array('data'=>$ret_val,'act_tab'=>$active_tab,'station'=>array('station'=>$station,'date'=>$date,'counter'=>1,'id'=>$id)));
            else
            return view('region\main')->with(array('data'=>$ret_val,'act_tab'=>$active_tab,'station'=>array('station'=>$station,'date'=>$date,'id'=>$id)));
        }
        else
            return view('region\main')->with(array('data'=>$ret_val,'act_tab'=>$active_tab));
    }
    
    public function GetStationById($id){
        $conn = DB::connection("balance");
        if (!$conn)
            throw new Exception("error connect to est database");
        $result = $conn->select("Select* from station where id=".$id);
        $conn->disconnect();
        if($result)
            return $result[0]->station;
        else throw new Exception("error connect to est database");;
    }
    
    public function GetStationData(){
        
        $id=Input::get('station');
        $station=$this->GetStationById($id);
        $date=Input::get('date');
        $data=new \stdClass();
        $rows=array();
        if(!isset($station))
            return json_encode($data);
        $dt=$this->GetFormatDate($date);
        $emax=new \Est\Emax("http://10.32.18.32:8181","admin","admin");
        $res=$emax->GetTableData(urldecode($station),
            $dt);
        $data->total=count($res->Values); 
        //$data->balance=$res->balance;
        foreach ($res->Values as $value)
        {
            $row=new \stdClass();
            $row->section="--";
            $name=explode('\\',$value->Name);
            $row->name=$name[count($name)-1];
            $row->sn=isset($value->SN->Val->Val)?$value->SN->Val->Val:'--';
            $row->ki=$value->KI;
            $row->ku=$value->KU;
            $time=$value->Plus->MaxPow->T->T;
            $row->p_maxpow_date=sprintf("%d-%02d-%02d %02d:%02d:%02d",$time[0],$time[1],$time[2],
                $time[3],$time[4],$time[5]);
            $row->p_maxpow=$this->CheckQualityData($value->Plus->MaxPow);
            $row->p_EnargyPrevMonth=$this->CheckQualityData($value->Plus->EnargyPrevMonth);
            $row->p_CounterFromStartMonth=$this->CheckQualityData($value->Plus->CounterFromStartMonth);
            $row->p_EnergyFromStartMonth=$this->CheckQualityData($value->Plus->EnergyFromStartMonth);
            $row->p_EnergyByLastDay=$this->CheckQualityData($value->Plus->EnergyByLastDay);
            $row->p_CounterFromStartDay=$this->CheckQualityData($value->Plus->CounterFromStartDay);
            $time=$value->Minus->MaxPow->T->T;
            $row->m_maxpow_date=sprintf("%d-%02d-%02d %02d:%02d:%02d",$time[0],$time[1],$time[2],
                $time[3],$time[4],$time[5]);
            $row->m_maxpow=$this->CheckQualityData($value->Minus->MaxPow);
            $row->m_EnargyPrevMonth=$this->CheckQualityData($value->Minus->EnargyPrevMonth);
            $row->m_CounterFromStartMonth=$this->CheckQualityData($value->Minus->CounterFromStartMonth);
            $row->m_EnergyFromStartMonth=$this->CheckQualityData($value->Minus->EnergyFromStartMonth);
            $row->m_EnergyByLastDay=$this->CheckQualityData($value->Minus->EnergyByLastDay);
            $row->m_CounterFromStartDay=$this->CheckQualityData($value->Minus->CounterFromStartDay);
            array_push($rows,$row);
            
        }
        $data->rows=$rows;
        $data->balance=$res->Balance;
        $cc=json_encode($data);
        return $cc;
    }
    
    function CheckQualityData($value){
        if($value->Qua>=128)
            return '<span style="color:#ccc">'.round($value->Val->Val,3).'</span>';
                else
            return round($value->Val->Val,3);
    }
    
    protected function GetFormatDate($date=null){
         $dtn=null;
         if(!isset($date)|| $date==''){
             $dtn=getDate();
            }
        else{
            $dtn=getdate($date/1000);
            //$dtn=date('Y-m-d',$date/1000);
        }
        return array($dtn['year'],$dtn['mon']-1,$dtn['mday'],0,0,0);
    }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
