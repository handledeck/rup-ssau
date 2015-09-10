<?php namespace Est\Intake;

class RupRows extends RupTable{

    function __construct($name=null,$date=null){
        $this->name=$name;
        $this->date=$date;
        $this->FillObjects();
    }

    function FillObjects(){
        /*руп план*/
        $irup=new EstRequest("rup-plan",array(152189),false,true);
        /*Лукомль генираторы А+ 30 мин.*/
        $luk=new EstRequest("luk-gen",array(166078,166126,166174,166222,166270,166318,166366,166414),true);
        /*Новополоцкая ТЭЦ*/
        $nov=new EstRequest("nov-gen",array(165544,165592,171716,171764,171812,171860,171956),true);
        /*ПГУ 400*/
        $pgu400=new EstRequest("luc-pgu-gen",array(184717,184789),true);
        /*ДГУ*/
        $dgu=new EstRequest("luc-dgu-gen",array(166462,166510),true);
        /*Витебская ТЭЦ*/
        $vittec=new EstRequest("vit-tec-gen",array(165190,165226),true);
        /*Орша ТЭЦ*/
        $orshatec=new EstRequest("orsha-tec-gen",array(165352,165400,165448,165496),true);
        /*БелГРЭС*/
        $belgres=new EstRequest("belgres-gen",array(166558,166606),true);
        /*Мини ТЭЦ Барань*/
        $baran=new EstRequest("baran-gen",array(209613),true);
        /*КГТУ Нафтан*/
        $kgtu=new EstRequest("kgtu-gen",array(165640,165688),true);
        /*Восточная мини ТЭЦ*/
        $vostec=new EstRequest("voctec-gen",array(201362),true);
        /*Полоцкая ТЭЦ*/
        $poltec=new EstRequest("pol-gen",array(165310,172634),true);
        /*константы генирации*/
        $const=new EstRequest("const-gen",array(175040,175044,175036,175048),false,true);
        /*330кВт*/
        /*345,350*/
        $line=new EstRequest("line",array(164242,164248,164146,164152,163954,163960,170354,170360,165886,165892,165736,165742,165838,165844,165784,165796,
            164818,164824,164866,164872,164050,164056,165022,165028,177348,177352,165934,165940,165982,165988,166030,166036,
            164434,164440,164338,164344,
            164596,164602,164530,164536,
            165070,165076,
            164974,164980,
            164674,164680,
            164722,164728,
            164926,164932,
            170266,170272,
            170582,170588),true);
        /*константы перетоков*/
        $constPer=new EstRequest("const-peretok",array(175056,175060,175052,175064),true,true);
        $constLukKrup=new EstRequest("const-luk-krup",array(175186,175190,175194),false,true);
        $oevluc=new EstRequest("oev-luc",array(170582,170588),true);

        $mGen=array($irup,$luk,$nov,$pgu400,$dgu,$vittec,$orshatec,$belgres,$baran,$kgtu,$vostec,$poltec,$const,$line,$constPer,$constLukKrup,$oevluc);

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
        $vitRow=new VitebskRows($name=null,$this->date);
        $orshaRow=new OrshaRows($name=null,$this->date);
        $polRow=new PolotskRows($name=null,$this->date);
        $glbRow=new GlubokoeRows($name=null,$this->date);
        $row=null;
        foreach($irup->data as $key=>$item){
            try{
            $row=new \stdClass();
            $vitfact=$vitRow->GetItemByTime($key);
            $polfact=$polRow->GetItemByTime($key);
            $orrshafact=$orshaRow->GetItemByTime($key);
            $glubfact=$glbRow->GetItemByTime($key);

            $row->fact=$vitfact+$polfact+$orrshafact+$glubfact;

            $row->datetime=$key;
            $row->plan=$irup->data[$key][$irup->items[0]]['VAL'];
            $row->lucgen=array_key_exists($key,$luk->data)?$luk->data[$key]['ISUM']:0;
            $row->novgen=array_key_exists($key,$nov->data)?$nov->data[$key]['ISUM']:0;
            $row->pgugen=array_key_exists($key,$pgu400->data)?$pgu400->data[$key]['ISUM']:0;
            $row->dgugen=array_key_exists($key,$pgu400->data)?$dgu->data[$key]['ISUM']:0;
            $row->vitecgen=array_key_exists($key,$vittec->data)?$vittec->data[$key]['ISUM']:0;
            $row->orshgen=array_key_exists($key,$orshatec->data)?$orshatec->data[$key]['ISUM']:0;
            $row->belgres=array_key_exists($key,$belgres->data)?$belgres->data[$key]['ISUM']:0;
            $row->barangen=array_key_exists($key,$baran->data)?$baran->data[$key]['ISUM']:0;
            $row->kgtugen=array_key_exists($key,$kgtu->data)?$kgtu->data[$key]['ISUM']:0;
            $row->vostgen=array_key_exists($key,$vostec->data)?$vostec->data[$key]['ISUM']:0;
            $row->polgen=array_key_exists($key,$poltec->data)?$poltec->data[$key]['ISUM']:0;
            $row->constPes=$this->setCheckedValue($const,$key,'175040','VAL');
            $row->constOes=$this->setCheckedValue($const,$key,'175044','VAL');
            $row->constVes=$this->setCheckedValue($const,$key,'175036','VAL');
            $row->constGes=$this->setCheckedValue($const,$key,'175048','VAL');
            $row->sumgen=$row->lucgen+$row->novgen+$row->pgugen+$row->dgugen+$row->vitecgen+$row->orshgen+
                $row->belgres+$row->barangen+$row->kgtugen+$row->vostgen+$row->polgen+
                $row->constPes+$row->constOes+$row->constVes+$row->constGes;
            $row->line345O=$this->setCheckedValue($line,$key,'164242','IVAL');
            $row->line345P=$this->setCheckedValue($line,$key,'164248','IVAL');
            $row->line450O=$this->setCheckedValue($line,$key,'164146','IVAL');
            $row->line450P=$this->setCheckedValue($line,$key,'164152','IVAL');
            $row->line349O=$this->setCheckedValue($line,$key,'163954','IVAL');
            $row->line349P=$this->setCheckedValue($line,$key,'163960','IVAL');
            $row->line347O=$this->setCheckedValue($line,$key,'170354','IVAL');
            $row->line347P=$this->setCheckedValue($line,$key,'170360','IVAL');
            $row->line335O=$this->setCheckedValue($line,$key,'165886','IVAL');
            $row->line335P=$this->setCheckedValue($line,$key,'165892','IVAL');
            $row->line336O=$this->setCheckedValue($line,$key,'165736','IVAL');
            $row->line336P=$this->setCheckedValue($line,$key,'165742','IVAL');
            $row->line428O=$this->setCheckedValue($line,$key,'165838','IVAL');
            $row->line428P=$this->setCheckedValue($line,$key,'165844','IVAL');
            $row->line432O=$this->setCheckedValue($line,$key,'165784','IVAL');
            $row->line432P=$this->setCheckedValue($line,$key,'165796','IVAL');
            $row->iaes_vidzi_o=$this->setCheckedValue($line,$key,'164818','IVAL');
            $row->iaes_vidzi_p=$this->setCheckedValue($line,$key,'164824','IVAL');
            $row->iaes_opsa_o=$this->setCheckedValue($line,$key,'164866','IVAL');
            $row->iaes_opsa_p=$this->setCheckedValue($line,$key,'164872','IVAL');
            $row->liozno_rudnya_o=$this->setCheckedValue($line,$key,'164050','IVAL');
            $row->liozno_rudnya_p=$this->setCheckedValue($line,$key,'164056','IVAL');
            $row->bobr_slavn_o=$this->setCheckedValue($line,$key,'165022','IVAL');
            $row->bobr_slavn_p=$this->setCheckedValue($line,$key,'165028','IVAL');
            $row->shklov_selise_o=$this->setCheckedValue($line,$key,'177348','IVAL');
            $row->shklov_selise_p=$this->setCheckedValue($line,$key,'177352','IVAL');
            $row->krupki_3_o=$this->setCheckedValue($line,$key,'166030','IVAL');
            $row->krupki_3_p=$this->setCheckedValue($line,$key,'166036','IVAL');
            $row->krupki_2_o=$this->setCheckedValue($line,$key,'165982','IVAL');
            $row->krupki_2_p=$this->setCheckedValue($line,$key,'165988','IVAL');
            $row->krupki_1_o=$this->setCheckedValue($line,$key,'165934','IVAL');
            $row->krupki_1_p=$this->setCheckedValue($line,$key,'165940','IVAL');
            $row->grav_v1_o=$this->setCheckedValue($line,$key,'164434','IVAL');
            $row->grav_v1_p=$this->setCheckedValue($line,$key,'164440','IVAL');
            $row->grav_v2_o=$this->setCheckedValue($line,$key,'164338','IVAL');
            $row->grav_v2_p=$this->setCheckedValue($line,$key,'164344','IVAL');
            $row->novluc_v1_o=$this->setCheckedValue($line,$key,'164596','IVAL');
            $row->novluc_v1_p=$this->setCheckedValue($line,$key,'164602','IVAL');
            $row->novluc_v2_o=$this->setCheckedValue($line,$key,'164530','IVAL');
            $row->novluc_v2_p=$this->setCheckedValue($line,$key,'164536','IVAL');
            $row->toloch_o=$this->setCheckedValue($line,$key,'165070','IVAL');
            $row->toloch_p=$this->setCheckedValue($line,$key,'165076','IVAL');
            $row->litvyaki_o=$this->setCheckedValue($line,$key,'164974','IVAL');
            $row->litvyaki_p=$this->setCheckedValue($line,$key,'164980','IVAL');
            $row->lintupi_o=$this->setCheckedValue($line,$key,'164674','IVAL');
            $row->lintupi_p=$this->setCheckedValue($line,$key,'164680','IVAL');
            $row->komai_o=$this->setCheckedValue($line,$key,'164722','IVAL');
            $row->komai_p=$this->setCheckedValue($line,$key,'164728','IVAL');
            $row->begoml_o=$this->setCheckedValue($line,$key,'164926','IVAL');
            $row->begoml_p=$this->setCheckedValue($line,$key,'164932','IVAL');
            $row->drisvyati_o=$this->setCheckedValue($line,$key,'170266','IVAL');
            $row->drisvyati_p=$this->setCheckedValue($line,$key,'170272','IVAL');
            $row->constPerPes=$this->setCheckedValue($constPer,$key,'175056','VAL');
            $row->constPerOes=$this->setCheckedValue($constPer,$key,'175060','VAL');
            $row->constPerVes=$this->setCheckedValue($constPer,$key,'175052','VAL');
            $row->constPerGes=$this->setCheckedValue($constPer,$key,'175064','VAL');
            /*ОЭВ 110 лукомль*/
            $val1=$this->setCheckedValue($constLukKrup,$key,'175186','VAL');
            $val2=$this->setCheckedValue($constLukKrup,$key,'175190','VAL');
            $val3=$this->setCheckedValue($constLukKrup,$key,'175194','VAL');
            $row->oevLuk_krup_1_o=$this->setCheckedValue($oevluc,$key,'170582','IVAL')*$val1;
            $row->oevLuk_krup_1_p=$this->setCheckedValue($oevluc,$key,'170588','IVAL')*$val1;
            $row->oevLuk_krup_2_o=$this->setCheckedValue($oevluc,$key,'170582','IVAL')*$val2;
            $row->oevLuk_krup_2_p=$this->setCheckedValue($oevluc,$key,'170588','IVAL')*$val2;
            $row->oevLuk_krup_3_o=$this->setCheckedValue($oevluc,$key,'170582','IVAL')*$val3;
            $row->oevLuk_krup_3_p=$this->setCheckedValue($oevluc,$key,'170588','IVAL')*$val3;
            $row->otcl=round($row->fact-$row->plan,1);
            $row->percent=$row->plan>0 ? round((($row->fact*100)/$row->plan)-100,1):null;
            $recordIntake=new \stdClass();
            $recordIntake->datetime=$row->datetime;
            $recordIntake->plan=$row->plan;
            $recordIntake->fact=$row->fact;
            $recordIntake->deviation=$row->otcl;
            $recordIntake->percent=$row->percent;
            $this->add($row,$recordIntake);
            }
            catch(\Exception $e){
                continue;
            }
        }
    }
    
    public function GetGenirate(){
        if($this->total>0){
            $last_row=$this->rows[$this->total-1];
            $summ=$last_row->sumgen;
            return array(
               'lucgen'  =>$this->CalcPercent($last_row->lucgen,   $summ),
               'novgen'  =>$this->CalcPercent($last_row->novgen,   $summ),
               'pgugen'  =>$this->CalcPercent($last_row->pgugen,   $summ),
               'dgugen'  =>$this->CalcPercent($last_row->dgugen,   $summ),
               'vitecgen'=>$this->CalcPercent($last_row->vitecgen, $summ),
               'orshgen' =>$this->CalcPercent($last_row->orshgen,  $summ),
               'belgres' =>$this->CalcPercent($last_row->belgres,  $summ),
               'barangen'=>$this->CalcPercent($last_row->barangen, $summ),
               'kgtugen' =>$this->CalcPercent($last_row->kgtugen,  $summ),
               'vostgen' =>$this->CalcPercent($last_row->vostgen,  $summ),
               'polgen'  =>$this->CalcPercent($last_row->polgen,    $summ)
            );
        }
        else return null;
    }
    
    function CalcPercent($gen,$summ){
        $per=($gen*100)/$summ;
        return array($gen,(int)$per);
    }
    
    function calcPotr($summ,$row){
        //$this->fact=round($summ,3);
        $this->otcl=round($this->fact-$this->plan,1);
        $this->percent=$this->plan>0 ? round((($this->fact*100)/$this->plan)-100,1):null;
    }

}