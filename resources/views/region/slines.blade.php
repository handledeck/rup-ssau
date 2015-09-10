<style>
    .panel-body{
        padding:5px;!important
    }
    .col-md-12 .page-title{
        padding-left:5px;
        padding-right: 5px;
    }
</style>
<table id="tbl" class="easyui-datagrid" style="height:800px;display:none"
       data-options="showFooter: true,loadMsg:'Загрузка данных...',rownumbers:true,singleSelect:true,fitColumn:true,striped:true,
    url:'statdata?station={{$station['id']}}&date=',method:'get', onLoadError:function(e){alert('Ошибка зарузки данных');}">
    <thead data-options="frozen:true">
    <tr>
        <th data-options="field:'datetime',width:125,align:'center',resizable:false,styler:function dateStyler(value,row,index){return 'font-weight:normal;';}">Дата, время</th>
    </tr>
    </thead>
    <thead>
    <tr>
        
        <?php
        $en=array();
        if($sett->ap==1)
            array_push($en,'A+');
        if($sett->am==1)
            array_push($en,'A-');
        if($sett->rp==1)
            array_push($en,'R+');
        if($sett->rm==1)
            array_push($en,'R-');
        $emax=new \Est\Emax("http://10.32.18.32:8181","admin","admin");
        $dat=$emax->GetChannelByPartName($station['station'],0,1000);
            foreach ($dat->Values as $item)
            {
                $names=explode('\\',$item->DisplayName);
                $name=str_replace('_',' ',$names[count($names)-1]);
                echo '<th colspan="'.count($en).'">'.$name.'</th>';
            }
         ?>
    </tr>
    <tr>
        <?php 
        
          
            $x=0;
            foreach ($dat->Values as $item){
            for ($i = 0; $i < count($en); $i++)
                {
                    echo '<th data-options="field:\'col_'.$x.'\',width:80,resizable:false,align:\'center\'">'.$en[$i].'</th>';	
                    $x++;
                }
            
            }
        ?>
    </tr>
</thead>
</table>


