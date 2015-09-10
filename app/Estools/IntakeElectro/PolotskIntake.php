<?php namespace Est\Intake;


class PolotskRows extends RupTable {

    function __construct($name=null,$date=null){
        $this->date=$date;
        $this->FillObjects();
        $this->name=$name;    
    }

    function FillObjects(){

        /*план*/
        $irup=new EstRequest("rup-plan",array(152194),false,true);
        /*Лукомль генираторы А+ 30 мин.*/
        $luk=new EstRequest("luk-gen",array(166078,166126,166174,166222,166270,166318,166366,166414),true);
        /*Новополоцкая ТЭЦ*/
        $nov=new EstRequest("nov-gen",array(165544,165592,171716,171764,171812,171860,171956),true);
        /*ПГУ 400*/
        $pgu400=new EstRequest("luc-pgu-gen",array(184717,184789),true);
        /*ДГУ*/
        $dgu=new EstRequest("luc-dgu-gen",array(166462,166510),true);

        /*КГТУ Нафтан*/
        $kgtu=new EstRequest("kgtu-gen",array(165640,165688),true);
        /*Полоцкая ТЭЦ*/
        $polgen=new EstRequest("pol-gen",array(165310,172634),true);
        /*константы генирации*/
        $const=new EstRequest("const-gen",array(175040,175044,175036,175048),false,true);
        /*330кВт*/
        /*345,350*/
        $line=new EstRequest("line",array(

            /*line 345 + -*/164242,164248,
            /*line 450 + -*/164146,164152,
            /*line 348 + -*/170498,170504,
            /*line 337 + -*/170954,170960,
            /*line 432 + -*/165784,165796,
            /*line 335 + -*/165886,165892,
            /*line 428 + -*/165838,165844,
            /*line 336 + -*/165736,198539,

        ),true);
        $luk_krup=new EstRequest('ВЛ-110 кВ Крупки 1,2,3',array(
            /*№1 + -*/165934,165940,
            /*№2 + -*/165982,165988,
            /*№2 + -*/166030,166036,
        ),true);

        $luk_senno=new EstRequest('ВЛ-110кВ Лукомль-Сенно',array(
            170546,170552
        ),true);

        $luk_oev=new EstRequest('ОЭВ-110 кВ',array(
            170582,170588,/*на сенно ОЭС*/175182,
        ),true);

        $constLukKrup=new EstRequest("const-luk-krup",array(175186,175190,175194,175182),false,true);

        $pol_glub=new EstRequest("ВЛ-110кВ Полоцк-Глубокое",array(170014,170020,169942,169948),true);

        $pol_disna=new EstRequest("ВЛ-110кВ",array(
            /*Дисна*/169810,169816),true);

        $pol_ovv=new EstRequest("ОЭВ-110кВ",array(
            169978,169984),true);

        $pol_110=new EstRequest("Гравийная,Новолукомль,Мясокомбинат,Миоры,Чашники",array(
            /*Гравийная 1,2*/164434,164440,164338,164344,
            /*ПС - 110 кВ "Новолукомль"*/164596,164602,164530,164536
        ),true);

        $pol_cacl=new EstRequest("Мясокомбинат,Миоры,Чашники",array(
            /*ПС-110 кВ "Мясокомбинат"*/178725,178731,
            /*ПС-110 кВ "Миоры"*/177677,177683,
            /*Чашники*/210864,210870),true,false,false);


        $constOvvGlub=new EstRequest("ОЭВ-110кВ на Глубокое",array(175162,175166,175170),false,true);

        /*константы перетоков*/
        $constPer=new EstRequest("const-peretok",array(175056),true);
        $mGen=array($irup,$luk,$pgu400,$dgu,$kgtu,$nov,$polgen,$const,$line,$luk_krup,$luk_senno,$luk_oev,$constLukKrup,$pol_glub,
            $pol_disna,$pol_ovv,$constOvvGlub,$pol_110,$pol_cacl,$constPer);
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
            $row->lucgen=isset($luk->data[$key])?$luk->data[$key]['ISUM']:0;
            $row->novgen=isset($nov->data[$key])?$nov->data[$key]['ISUM']:0;
            $row->pgugen=isset($pgu400->data[$key])?$pgu400->data[$key]['ISUM']:0;
            $row->dgugen=isset($dgu->data[$key])?$dgu->data[$key]['ISUM']:0;
            $row->kgtugen=isset($kgtu->data[$key])?$kgtu->data[$key]['ISUM']:0;
            $row->polgen=isset($polgen->data[$key])?$polgen->data[$key]['ISUM']:0;
            $row->sumgen=$row->lucgen+$row->novgen+$row->pgugen+$row->dgugen+
                $row->kgtugen+$row->polgen;
            $row->constPes=$this->setCheckedValue($const,$key,'175040','VAL');
            $summ=$row->sumgen+$row->constPes;
            $row->line345O=$this->setCheckedValue($line,$key,'164242');
            $row->line345P=$this->setCheckedValue($line,$key,'164248');
            $summ+=($row->line345P-$row->line345O);
            $row->line348O=$this->setCheckedValue($line,$key,'170498');
            $row->line348P=$this->setCheckedValue($line,$key,'170504');
            $summ+=($row->line348P-$row->line348O);
            $row->line450O=$this->setCheckedValue($line,$key,'164146');
            $row->line450P=$this->setCheckedValue($line,$key,'164152');
            $summ+=($row->line450P-$row->line450O);
            $row->line337O=$this->setCheckedValue($line,$key,'170954');
            $row->line337P=$this->setCheckedValue($line,$key,'170960');
            $summ+=($row->line337P-$row->line337O);
            $row->line432O=$this->setCheckedValue($line,$key,'165784');
            $row->line432P=$this->setCheckedValue($line,$key,'165796');
            $summ+=($row->line432P-$row->line432O);
            $row->line335O=$this->setCheckedValue($line,$key,'165886');
            $row->line335P=$this->setCheckedValue($line,$key,'165892');
            $summ+=($row->line335P-$row->line335O);
            $row->line428O=$this->setCheckedValue($line,$key,'165838');
            $row->line428P=$this->setCheckedValue($line,$key,'165844');
            $summ+=($row->line428P-$row->line428O);
            $row->line336O=$this->setCheckedValue($line,$key,'165736');
            $row->line336P=$this->setCheckedValue($line,$key,'198539');
            $summ+=($row->line336P-$row->line336O);
            $row->luk_krup_1O=$this->setCheckedValue($luk_krup,$key,'165934');
            $row->luk_krup_1p=$this->setCheckedValue($luk_krup,$key,'165940');

            $row->luk_krup_2O=$this->setCheckedValue($luk_krup,$key,'165982');
            $row->luk_krup_2p=$this->setCheckedValue($luk_krup,$key,'165988');

            $row->luk_krup_3O=$this->setCheckedValue($luk_krup,$key,'166030');
            $row->luk_krup_3p=$this->setCheckedValue($luk_krup,$key,'166036');
            $row->luk_krup_sum_O=$row->luk_krup_1O+$row->luk_krup_2O+$row->luk_krup_3O;
            $row->luk_krup_sum_p=$row->luk_krup_1p+$row->luk_krup_2p+$row->luk_krup_3p;
            $summ+=($row->luk_krup_sum_p-$row->luk_krup_sum_O);

            $row->luk_senno_O=$this->setCheckedValue($luk_senno,$key,'170546');
            $row->luk_senno_p=$this->setCheckedValue($luk_senno,$key,'170552');
            $summ+=($row->luk_senno_p-$row->luk_senno_O);

            $row->luc_oev_O=$this->setCheckedValue($luk_oev,$key,'170582');
            $row->luc_oev_p=$this->setCheckedValue($luk_oev,$key,'170588');

            $val1=$this->setCheckedValue($constLukKrup,$key,'175186','VAL');
            $val2=$this->setCheckedValue($constLukKrup,$key,'175190','VAL');
            $val3=$this->setCheckedValue($constLukKrup,$key,'175194','VAL');
            $val4=$this->setCheckedValue($constLukKrup,$key,'175182','VAL');

            $row->luc_oev_krup_1_O=$row->luc_oev_O*$val1;
            $row->luc_oev_krup_2_O=$row->luc_oev_O*$val2;
            $row->luc_oev_krup_3_O=$row->luc_oev_O*$val3;
            $row->luc_oev_senno_O=$row->luc_oev_O*$val4;
            $row->luc_oev_krup_1_p=$row->luc_oev_p*$val1;
            $row->luc_oev_krup_2_p=$row->luc_oev_p*$val2;
            $row->luc_oev_krup_3_p=$row->luc_oev_p*$val3;
            $row->luc_oev_senno_p=$row->luc_oev_p*$val4;

            $summ+=($row->luc_oev_krup_1_p-$row->luc_oev_krup_1_O);
            $summ+=($row->luc_oev_krup_2_p-$row->luc_oev_krup_2_O);
            $summ+=($row->luc_oev_krup_3_p-$row->luc_oev_krup_3_O);
            $summ+=($row->luc_oev_senno_p-$row->luc_oev_senno_O);

            $row->pol_glub_1_O=$this->setCheckedValue($pol_glub,$key,'170014');
            $row->pol_glub_1_p=$this->setCheckedValue($pol_glub,$key,'170020');
            $row->pol_glub_2_O=$this->setCheckedValue($pol_glub,$key,'169942');
            $row->pol_glub_2_p=$this->setCheckedValue($pol_glub,$key,'169948');
            $row->pol_glub_sum_O=$row->pol_glub_1_O+$row->pol_glub_2_O;
            $row->pol_glub_sum_p=$row->pol_glub_1_p+$row->pol_glub_2_p;

            $summ+=($row->pol_glub_sum_p-$row->pol_glub_sum_O);

            $row->pol_disna_O=$this->setCheckedValue($pol_disna,$key,'169810');
            $row->pol_disna_p=$this->setCheckedValue($pol_disna,$key,'169816');

            $summ+=($row->pol_disna_p-$row->pol_disna_O);

            $row->pol_ovv_O=$this->setCheckedValue($pol_ovv,$key,'169978');
            $row->pol_ovv_p=$this->setCheckedValue($pol_ovv,$key,'169984');

            $val1=$this->setCheckedValue($constLukKrup,$key,'175162','VAL');
            $val2=$this->setCheckedValue($constLukKrup,$key,'175166','VAL');
            $val3=$this->setCheckedValue($constLukKrup,$key,'175170','VAL');
            $row->pol_ovv_glub_1_O=$row->pol_ovv_O*$val1;
            $row->pol_ovv_glub_1_p=$row->pol_ovv_p*$val1;
            $row->pol_ovv_glub_2_O=$row->pol_ovv_O*$val2;
            $row->pol_ovv_glub_2_p=$row->pol_ovv_p*$val2;
            $row->pol_ovv_disna_O=$row->pol_ovv_O*$val2;
            $row->pol_ovv_disna_p=$row->pol_ovv_p*$val2;

            $summ+=($row->pol_ovv_glub_1_p-$row->pol_ovv_glub_1_O);
            $summ+=($row->pol_ovv_glub_2_p-$row->pol_ovv_glub_2_O);
            $summ+=($row->pol_ovv_disna_p-$row->pol_ovv_disna_O);

            $row->pol_grav_v1_O=$this->setCheckedValue($pol_110,$key,'164434');
            $row->pol_grav_v1_p=$this->setCheckedValue($pol_110,$key,'164440');
            $row->pol_grav_v2_O=$this->setCheckedValue($pol_110,$key,'164338');
            $row->pol_grav_v2_p=$this->setCheckedValue($pol_110,$key,'164344');

            $summ+=($row->pol_grav_v1_O-$row->pol_grav_v1_p);
            $summ+=($row->pol_grav_v2_O-$row->pol_grav_v2_p);

            $row->pol_novol_v1_O=$this->setCheckedValue($pol_110,$key,'164596');
            $row->pol_novol_v1_p=$this->setCheckedValue($pol_110,$key,'164602');
            $row->pol_novol_v2_O=$this->setCheckedValue($pol_110,$key,'164530');
            $row->pol_novol_v2_p=$this->setCheckedValue($pol_110,$key,'164536');

            $summ+=($row->pol_novol_v1_O-$row->pol_novol_v1_p);
            $summ+=($row->pol_novol_v2_O-$row->pol_novol_v2_p);

            $row->pol_myso_O=round($this->setCheckedValue($pol_cacl,$key,'178725')/1000,1);
            $row->pol_myso_p=round($this->setCheckedValue($pol_cacl,$key,'178731')/1000,1);

            $summ+=($row->pol_myso_p-$row->pol_myso_O);

            $row->pol_chashniki_O=round($this->setCheckedValue($pol_cacl,$key,'210864')/1000,1);
            $row->pol_chashniki_p=round($this->setCheckedValue($pol_cacl,$key,'210870')/1000,1);

            $summ+=($row->pol_chashniki_p-$row->pol_chashniki_O);

            $row->pol_miory_O=round($this->setCheckedValue($pol_cacl,$key,'177677')*66,1);
            $row->pol_miory_p=round($this->setCheckedValue($pol_cacl,$key,'177683')*66,1);
            $summ+=($row->pol_miory_O-$row->pol_miory_p);

            $row->const_per_pes=$this->setCheckedValue($constPer,$key,'175056','VAL');
            $summ+=$row->const_per_pes;

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