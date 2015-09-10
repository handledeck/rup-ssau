<?php namespace Est\Intake;


class VitebskRows extends RupTable{

    function __construct($name=null,$date=null){
        $this->name=$name;
        $this->date=$date;
        $this->FillObjects();
    }

    function FillObjects(){

        /*план*/
        $irup=new EstRequest("rup-plan",array(152198),false,true);

        /*Vitebsk tec*/

        $vittec=new EstRequest("vit-tec-gen",array(165190,165226),true);
        $vostec=new EstRequest("voctec-gen",array(201362),true);
        /*константы генирации*/
        $const=new EstRequest("const-gen",array(175036),false,true);

        $line348=new EstRequest("",array(170498,170504),true);
        $line349=new EstRequest("",array(163954,163960),true);
        $line_belgres=new EstRequest("",array(169666,169672),true);
        $line_moshkany=new EstRequest("",array(169594,169600),true);
        $oev_110=new EstRequest("",array(169630,169636),true);
        $constOev=new EstRequest("const-oev-glub",array(175174,175178),false,true);
        $liozno_rudya=new EstRequest("",array(164050,164056),true);
        $myaso_shumilino=new EstRequest("",array(178725,178731),true,false,false);
        $chashniki_svatovka=new EstRequest("",array(210864,210870),true,false,false);

        /*константы перетоков*/
        $constPer=new EstRequest("const-peretok",array(175052),true);

        $mGen=array($irup,$const,$vittec,$vostec,$line348,$line349,$line_belgres,$line_moshkany,
            $oev_110,$constOev,$liozno_rudya,$myaso_shumilino,$chashniki_svatovka,$constPer);
        if(!isset($this->date))
            EstDataRequest::GetObjectEstData($mGen,new \DateTime('now'));
        else{
            $reqdt=date('Y-m-d',$this->date/1000);
            $tmreq=new \DateTime($reqdt);
            $tmnow=new \DateTime('now');
            $arreq=getdate($this->date/1000);
            $arrnow=getdate($tmnow->getTimestamp());
            if($arreq['mday']!=$arrnow['mday'] || $arreq['mon']!=$arreq['mon'])
                EstDataRequest::GetObjectEstData($mGen,$tmreq);
            else
                EstDataRequest::GetObjectEstData($mGen,$tmnow);
        }
        $row=null;
        foreach($irup->data as $key=>$item){
            $row=new \stdClass();
            $row->datetime=$key;
            $summ=0;
            $row->plan=isset($irup->data[$key])?$irup->data[$key][$irup->items[0]]['VAL']:0;
            $row->vit_tec=isset($vittec->data[$key])? $vittec->data[$key]['ISUM']:0;
            $row->vost_tec=isset($vostec->data[$key])?$vostec->data[$key]['ISUM']:0;
            $row->constVes=$this->setCheckedValue($const,$key,'175036','VAL');
            $summ+=$row->vit_tec+$row->vost_tec+$row->constVes;
            $row->line348_o=$this->setCheckedValue($line348,$key,'170498');
            $row->line348_p=$this->setCheckedValue($line348,$key,'170504');

            $summ+=($row->line348_o-$row->line348_p);
            $row->line349_o=$this->setCheckedValue($line349,$key,'163954');
            $row->line349_p=$this->setCheckedValue($line349,$key,'163960');
            $summ+=($row->line349_p-$row->line349_o);
            $row->line_belgres_o=$this->setCheckedValue($line_belgres,$key,'169666');
            $row->line_belgres_p=$this->setCheckedValue($line_belgres,$key,'169672');
            $summ+=($row->line_belgres_p-$row->line_belgres_o);
            $row->line_moshkany_o=$this->setCheckedValue($line_moshkany,$key,'169594');
            $row->line_moshkany_p=$this->setCheckedValue($line_moshkany,$key,'169600');
            $summ+=($row->line_moshkany_p-$row->line_moshkany_o);
            $row->oev_110_o=$this->setCheckedValue($oev_110,$key,'169630');
            $row->oev_110_p=$this->setCheckedValue($oev_110,$key,'169636');

            $val1=$this->setCheckedValue($constOev,$key,'175174','VAL');
            $val2=$this->setCheckedValue($constOev,$key,'175178','VAL');

            $row->oev_110_belgress_o=$row->oev_110_o*$val1;
            $row->oev_110_belgress_p=$row->oev_110_p*$val1;
            $row->oev_110_moshkany_o=$row->oev_110_o*$val2;
            $row->oev_110_moshkany_p=$row->oev_110_p*$val2;
            $summ+=($row->oev_110_belgress_p-$row->oev_110_belgress_o);
            $summ+=($row->oev_110_moshkany_p-$row->oev_110_moshkany_o);

            $row->liozno_rudya_o=$this->setCheckedValue($liozno_rudya,$key,'164050');
            $row->liozno_rudya_p=$this->setCheckedValue($liozno_rudya,$key,'164056');
            $summ+=($row->liozno_rudya_p-$row->liozno_rudya_o);

            $row->myaso_shumilino_o=round(($this->setCheckedValue($myaso_shumilino,$key,'178725')/1000),1);
            $row->myaso_shumilino_p=round(($this->setCheckedValue($myaso_shumilino,$key,'178731')/1000),1);
            $summ+=($row->myaso_shumilino_o-$row->myaso_shumilino_p);

            $row->chashniki_svatovka_o=round(($this->setCheckedValue($chashniki_svatovka,$key,'210864')/1000),1);
            $row->chashniki_svatovka_p=round(($this->setCheckedValue($chashniki_svatovka,$key,'210870')/1000),1);
            $summ+=($row->chashniki_svatovka_o-$row->chashniki_svatovka_p);
            $row->cost_per=$this->setCheckedValue($constPer,$key,'175052','VAL');
            $summ+=$row->cost_per;

            $this->calcPotr($summ,$row);
            $recordIntake=new \stdClass();
            $recordIntake->datetime=$row->datetime;
            $recordIntake->plan=$row->plan;
            $recordIntake->fact=$row->fact;
            $recordIntake->deviation=$row->otcl;
            $recordIntake->percent=$row->percent;
            $this->add($row,$recordIntake);
        }
    }

    protected function calcPotr($summ,$row){
        $row->fact=round($summ,3);
        $row->otcl=round($row->fact-$row->plan,3);
        $row->percent=$row->plan>0 ? round((($row->fact*100)/$row->plan)-100,3):null;
    }
}