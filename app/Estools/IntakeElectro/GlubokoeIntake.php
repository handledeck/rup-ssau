<?php namespace Est\Intake;

class GlubokoeRows extends RupTable{

    function __construct($name='Глубокские ЭС',$date=null){
        $this->name=$name;
        $this->date=$date;
        $this->FillObjects();
    }

    function FillObjects(){
        /*план*/
        $irup=new EstRequest("rup-plan",array(152206),false,true);
        /*константы генирации*/
        $const=new EstRequest("const-gen",array(175048),false,true);

        $pol_glub=new EstRequest('ВЛ-110кВ Полоцк-Глубокое 1,2',array(
            /*№1 + -*/170014,170020,
            /*№2 + -*/169942,169948
        ),true);

        $bps_disna=new EstRequest('ВЛ-110кВ на БПС Дисна',array(
            169810,169816
        ),true);

        $glub_oev=new EstRequest('ОЭВ-110 кВ',array(
            169978,169984
        ),true);

        $iaes_vidzy=new EstRequest('ВЛ-110кВ на БПС Дисна',array(
            164818,164824
        ),true);

        $miory_verdvinsk=new EstRequest('ВЛ-110кВ на БПС Дисна',array(
            177677,177683
        ),true,false,false);

        $lyntupy_shvench=new EstRequest('ВЛ-110кВ на БПС Дисна',array(
            177677,177683
        ),true);

        $komy_kupa=new EstRequest('ВЛ-110кВ на БПС Дисна',array(
            164722,164728
        ),true);

        $begoml_zestyan=new EstRequest('ВЛ-110кВ на БПС Дисна',array(
            164926  ,164932
        ),true);

        $drisvaty_v1=new EstRequest('ВЛ-110кВ на БПС Дисна',array(
            170266,170272
        ),true);

        $constOevGlub=new EstRequest("const-oev-glub",array(175162,175166,175170),false,true);

        $pol_disna=new EstRequest("ВЛ-110кВ",array(
            /*Дисна*/169810,169816),true);

        $iaes_opsa=new EstRequest("ВЛ-110кВ",array(
            164866,164872),true);

        /*константы перетоков*/
        $constPer=new EstRequest("const-peretok",array(175064),true);

        $mGen=array($irup,$const,$pol_glub,$bps_disna,$glub_oev,$constOevGlub,$iaes_vidzy,$iaes_opsa,
            $miory_verdvinsk,$lyntupy_shvench,$komy_kupa,$begoml_zestyan,$drisvaty_v1,$constPer);

        //GetObjectEstData($mGen,new DateTime('now'));
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
            $row = null;
            foreach ($irup->data as $key => $item) {
                $row = new \stdClass();
                $row->datetime = $key;
                $row->plan = isset($irup->data[$key])?$irup->data[$key][$irup->items[0]]['VAL']:0;
                $row->constPes = isset($const->data[$key])?$const->data[$key]['175048']['VAL']:0;
                $row->pol_glub_1_o = $this->setCheckedValue($pol_glub,$key,'170014');
                $row->pol_glub_1_p = $this->setCheckedValue($pol_glub,$key,'170020');
                $row->pol_glub_2_o = $this->setCheckedValue($pol_glub,$key,'169942');
                $row->pol_glub_2_p = $this->setCheckedValue($pol_glub,$key,'169948');
                $row->pol_glub_sum_o = $row->pol_glub_1_o + $row->pol_glub_2_o;
                $row->pol_glub_sum_p = $row->pol_glub_1_p + $row->pol_glub_2_p;

                $row->bps_disna_o = $this->setCheckedValue($bps_disna,$key,'169810');
                $row->bps_disna_p = $this->setCheckedValue($bps_disna,$key,'169816');

                $row->glub_oev_o = $this->setCheckedValue($glub_oev,$key,'169978');
                $row->glub_oev_p = $this->setCheckedValue($glub_oev,$key,'169984');

                $val1 = $this->setCheckedValue($constOevGlub,$key,'175162','VAL');
                $val2 = $this->setCheckedValue($constOevGlub,$key,'175166','VAL');
                $val3 = $this->setCheckedValue($constOevGlub,$key,'175170','VAL');


                $row->glub_oev_1_o = $row->glub_oev_o * $val1;
                $row->glub_oev_2_o = $row->glub_oev_o * $val2;
                $row->disna_oev_o = $row->glub_oev_o * $val3;
                $row->glub_oev_1_p = $row->glub_oev_p * $val1;
                $row->glub_oev_2_p = $row->glub_oev_p * $val2;
                $row->disna_oev_p = $row->glub_oev_o * $val3;

                $row->iaes_vidzy_p = $this->setCheckedValue($iaes_vidzy,$key,'164824','IVAL');
                $row->iaes_vidzy_o = $this->setCheckedValue($iaes_vidzy,$key,'164818','IVAL');

                $row->iaes_opsa_p = $this->setCheckedValue($iaes_opsa,$key,'164872','IVAL');
                $row->iaes_opsa_o = $this->setCheckedValue($iaes_opsa,$key,'164866','IVAL');

                $row->miory_verdvinsk_o = round($this->setCheckedValue($miory_verdvinsk,$key,'177677','IVAL') * 66, 1);
                $row->miory_verdvinsk_p = round($this->setCheckedValue($miory_verdvinsk,$key,'177683','IVAL') * 66, 1);;

                $row->lyntupy_shvench_o = $this->setCheckedValue($lyntupy_shvench,$key,'177677','IVAL');
                $row->lyntupy_shvench_p = $this->setCheckedValue($lyntupy_shvench,$key,'177683','IVAL');

                $row->komy_kupa_o = $this->setCheckedValue($komy_kupa,$key,'164722','IVAL');
                $row->komy_kupa_p = $this->setCheckedValue($komy_kupa,$key,'164728','IVAL');

                $row->begoml_zestyan_o = $this->setCheckedValue($begoml_zestyan,$key,'164926','IVAL');
                $row->begoml_zestyan_p = $this->setCheckedValue($begoml_zestyan,$key,'164932','IVAL');

                $row->drisvaty_v1_o = $this->setCheckedValue($drisvaty_v1,$key,'170266','IVAL');
                $row->drisvaty_v1_p = $this->setCheckedValue($drisvaty_v1,$key,'170272','IVAL');

                $row->cost_per = $this->setCheckedValue($constPer,$key,'175064','VAL');
                $this->calcPotr(null, $row);
                $recordIntake = new \stdClass();
                $recordIntake->datetime = $row->datetime;
                $recordIntake->plan = $row->plan;
                $recordIntake->fact = $row->fact;
                $recordIntake->deviation = $row->otcl;
                $recordIntake->percent = $row->percent;
                $this->add($row, $recordIntake);
            }
        }
    function calcPotr($summ,$row){
        $summ=$row->pol_glub_1_o-
            $row->pol_glub_1_p;
        $summ+=$row->pol_glub_2_o;
        $summ-=$row->pol_glub_2_p;
        $summ+=$row->bps_disna_o;
        $summ-=$row->bps_disna_p;
        $summ+=$row->glub_oev_1_o;
        $summ-=$row->glub_oev_1_p;
        $summ+=$row->glub_oev_2_o;
        $summ-=$row->glub_oev_2_p;//+
        $summ+=$row->disna_oev_o;//-
        $summ-=$row->disna_oev_p;//-
        $summ-=$row->iaes_vidzy_o;//+
        $summ+=$row->iaes_vidzy_p;//-
        $summ-=$row->iaes_opsa_o;//+
        $summ+=$row->iaes_opsa_p;//-
        $summ-=$row->miory_verdvinsk_o;//+
        $summ+=$row->miory_verdvinsk_p;//-
        $summ-=$row->lyntupy_shvench_o;//+
        $summ+=$row->lyntupy_shvench_o;//-
        $summ-=$row->komy_kupa_o;//+
        $summ+=$row->komy_kupa_p;//-
        $summ-=$row->begoml_zestyan_o;//+
        $summ+=$row->begoml_zestyan_p;//+
        $summ+=$row->drisvaty_v1_o;//-
        $summ-=$row->drisvaty_v1_p;//+
        $summ+=$row->cost_per;

        $row->fact=round($summ,1);
        $row->otcl=round(($row->fact-$row->plan),1);
        $row->percent=$row->plan>0 ? round((($row->fact*100)/$row->plan)-100,1):null;
    }
}