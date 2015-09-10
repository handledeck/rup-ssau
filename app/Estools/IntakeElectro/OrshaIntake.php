<?php namespace Est\Intake;

class OrshaRows extends RupTable{

    
    function __construct($name=null,$date=null){
        $this->date=$date;
        $this->FillObjects();
        $this->name=$name;    
    }
    
    protected function FillObjects(){
        
     
        /*план*/
        $irup=new EstRequest("rup-plan",array(152202),false,true);
        
        /*Vitebsk tec*/

        $orsha_tec=new EstRequest("",array(165496,165352,165400,165448),true);
        $belgres=new EstRequest("",array(166558,166606),true);
        $baran=new EstRequest("",array(209613),true);
        /*константы генирации*/
        $const=new EstRequest("const-gen",array(175044),false,true);

        $line337=new EstRequest("",array(170954,170960),true);
        $luk_senno=new EstRequest("",array(170546,170552),true);
        $luk_oev_110=new EstRequest("",array(170582,170588),true);
        $oev_110_senno=new EstRequest("",array(175182),false,true);
        $orsha_mogilev=new EstRequest("",array(165118,165124),true);
        $to_belgres=new EstRequest("",array(169666,169672),true);
        $to_moshkany=new EstRequest("",array(169594,169600),true);
        $vit_oev=new EstRequest("",array(169630,169636),true);
        $vit_oev_belgres_mosh=new EstRequest("",array(175174,175178),false,true);
        $slavnoe_bobr=new EstRequest("",array(165022,165028),true);
        $selishe_shklov=new EstRequest("",array(170402,170408),true);
        $shklov_selishe=new EstRequest("",array(177348,177352),true);
        $tolochin_krugloe=new EstRequest("",array(165070,165076),true);
        $litvyaki_obchuga=new EstRequest("",array(164974,164980),true);
        /*константы перетоков*/
        $constPer=new EstRequest("const-peretok",array(175060),true);

        $mGen=array($irup,$const,$orsha_tec,$belgres,$baran,$line337,$luk_senno,$luk_oev_110,$oev_110_senno,
            $orsha_mogilev,$to_moshkany,$to_belgres,$vit_oev,$slavnoe_bobr,$selishe_shklov,$shklov_selishe,
            $tolochin_krugloe,$litvyaki_obchuga,$constPer);
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
            $row->orsha_tec=isset($orsha_tec->data[$key])?$orsha_tec->data[$key]['ISUM']:0;
            $row->belgres=isset($belgres->data[$key])?$belgres->data[$key]['ISUM']:0;
            $row->baran=isset($baran->data[$key])?$baran->data[$key]['ISUM']:0;
            $row->constOes=isset($const->data[$key])?$const->data[$key]['175044']['VAL']:0;
            $summ+=$row->orsha_tec+$row->belgres+$row->baran+$row->constOes;

            $row->line337_o=$this->setCheckedValue($line337,$key,'170954');
            $row->line337_p=$this->setCheckedValue($line337,$key,'170960');

            $summ+=($row->line337_o-$row->line337_p);

            $row->luk_senno_o=$this->setCheckedValue($luk_senno,$key,'170546');
            $row->luk_senno_p=$this->setCheckedValue($luk_senno,$key,'170552');
            $summ+=($row->luk_senno_o-$row->luk_senno_p);

            $row->luk_oev_110_o=$this->setCheckedValue($luk_oev_110,$key,'170582');
            $row->luk_oev_110_p=$this->setCheckedValue($luk_oev_110,$key,'170588');

            $val1=$oev_110_senno->data[$key]['175182']['VAL'];
            $row->oev_110_senno_o=$row->luk_oev_110_o*$val1;
            $row->oev_110_senno_p=$row->luk_oev_110_p*$val1;

            $summ+=($row->oev_110_senno_o-$row->oev_110_senno_p);

            $row->orsha_mogilev_o=$this->setCheckedValue($orsha_mogilev,$key,'165118');
            $row->orsha_mogilev_p=$this->setCheckedValue($orsha_mogilev,$key,'165124');

            $summ+=($row->orsha_mogilev_p-$row->orsha_mogilev_o);

            $row->to_belgres_o=$this->setCheckedValue($to_belgres,$key,'169666');
            $row->to_belgres_p=$this->setCheckedValue($to_belgres,$key,'169672');

            $summ+=($row->to_belgres_o-$row->to_belgres_p);

            $row->to_moshkany_o=$this->setCheckedValue($to_moshkany,$key,'169594');
            $row->to_moshkany_p=$this->setCheckedValue($to_moshkany,$key,'169600');

            $summ+=($row->to_moshkany_o-$row->to_moshkany_p);

            $row->vit_oev_o=$this->setCheckedValue($vit_oev,$key,'169630');
            $row->vit_oev_p=$this->setCheckedValue($vit_oev,$key,'169636');

            $val1=$vit_oev_belgres_mosh->data[$key]['175174']['VAL'];
            $val2=$vit_oev_belgres_mosh->data[$key]['175178']['VAL'];

            $row->vit_oev_belgres_o=$row->vit_oev_o*$val1;
            $row->vit_oev_belgres_p=$row->vit_oev_p*$val1;

            $summ+=($row->vit_oev_belgres_o-$row->vit_oev_belgres_p);

            $row->vit_oev_moshkany_o=$row->vit_oev_o*$val2;
            $row->vit_oev_moshkany_p=$row->vit_oev_p*$val2;

            $summ+=($row->vit_oev_moshkany_o-$row->vit_oev_moshkany_p);

            $row->slavnoe_bobr_o=$this->setCheckedValue($slavnoe_bobr,$key,'165022');
            $row->slavnoe_bobr_p=$this->setCheckedValue($slavnoe_bobr,$key,'165028');
            $summ+=($row->slavnoe_bobr_p-$row->slavnoe_bobr_o);

            $row->selishe_shklov_o=$this->setCheckedValue($selishe_shklov,$key,'170402');
            $row->selishe_shklov_p=$this->setCheckedValue($selishe_shklov,$key,'170408');
            //$summ+=($row->selishe_shklov_o-$row->selishe_shklov_p);

            $row->shklov_selishe_o=$this->setCheckedValue($shklov_selishe,$key,'177348');
            $row->shklov_selishe_p=$this->setCheckedValue($shklov_selishe,$key,'177352');
            $summ+=($row->shklov_selishe_o-$row->shklov_selishe_p);

            $row->tolochin_krugloe_o=$this->setCheckedValue($tolochin_krugloe,$key,'165070');
            $row->tolochin_krugloe_p=$this->setCheckedValue($tolochin_krugloe,$key,'165076');
            $summ+=($row->tolochin_krugloe_p-$row->tolochin_krugloe_o);

            $row->litvyaki_obchuga_o=$this->setCheckedValue($litvyaki_obchuga,$key,'164974');
            $row->litvyaki_obchuga_p=$this->setCheckedValue($litvyaki_obchuga,$key,'164980');

            $summ+=($row->litvyaki_obchuga_p-$row->litvyaki_obchuga_o);

            $row->cost_per=isset($constPer->data[$key])?$constPer->data[$key]['175060']['VAL']:0;
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
        $r=round($summ,3);
        $row->fact=round($summ,3);
        $row->otcl=round($row->fact-$row->plan,3);
        $row->percent=$row->plan>0 ? round((($row->fact*100)/$row->plan)-100,3):null;
    }
}