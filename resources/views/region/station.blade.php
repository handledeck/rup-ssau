

<style>
    .panel-body{
        padding:5px;!important
    }
    .col-md-12 .page-title{
        padding-left:5px;
        padding-right: 5px;
    }
</style>
<div class="panel panel-default">
  <div class="panel-body">
    <p id="balance" style="color:#777;padding-left:20px;margin:0 0 5px 5px">
        небаланс, кВт*ч(%):&nbsp&nbsp пред. месяц:&nbsp<span style="color:#0498fa" id="balmonth"></span>&nbsp(<span style="color:#ff6a00" id="balmonthper"></span>)
          &nbsp&nbsp пред. день:&nbsp<span style="color:#0498fa" id="balday"></span>&nbsp(<span style="color:#ff6a00" id="baldayper"></span>)
    </p> 
<table id="tbl" class="easyui-datagrid" style="height:800px;display:none"
       data-options="loadMsg:'Загрузка данных...',rownumbers:true,singleSelect:true,fitColumn:true,striped:true,
    url:'regstat?station={{$station['id']}}&date=',method:'get', onLoadError:function(e){alert('Ошибка зарузки данных');},
    onLoadSuccess:function(e){
        $('#balmonth').text(e['balance']['MonthValueString']);
        $('#balmonthper').text(e['balance']['PercentMonth']);
        $('#balday').text(e['balance']['DayValueString']);
        $('#baldayper').text(e['balance']['PercentDay']);
    }
    ">
    <thead data-options="frozen:true">
    <tr>
        {{--<th data-options="field:'section',width:30,align:'center',resizable:false">СШ</th>--}}
        <th data-options="field:'name',width:180,align:'left'">Присоединение</th>
        <th data-options="field:'sn',width:80,align:'center',resizable:false">S/N</th>
        <th data-options="field:'ki',width:40,align:'center',resizable:false">Ki</th>
        <th data-options="field:'ku',width:40,align:'center',resizable:false">KU</th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th colspan="7" >E+,кВт*ч</th>
        <th colspan="7" >E-,кВт*ч</th>
    </tr>
    <tr>
        <th data-options="width:200,align:'center',resizable:false" colspan="2">Максимальная мощность</br> в текущ. месяце</th>

        <th data-options="field:'p_EnargyPrevMonth',width:80,align:'center',resizable:false" rowspan="2">Энергия,</br> пред.</br> месяц</th>
        <th data-options="field:'p_CounterFromStartMonth',width:80,align:'center',resizable:false" rowspan="2">Показания</br> энергии</br> на начало</br> месяца</th>
        <th data-options="field:'p_EnergyFromStartMonth',width:80,align:'center',resizable:false" rowspan="2">Энергия</br> с начала</br> месяца</th>
        <th data-options="field:'p_EnergyByLastDay',width:80,align:'center',resizable:false" rowspan="2">Энергия,</br> пред.</br> сутки</th>
        <th data-options="field:'p_CounterFromStartDay',width:80,align:'center',resizable:false" rowspan="2">Показания</br> энергии</br> на начало</br> суток</th>

        <th data-options="width:200,align:'center',resizable:false" colspan="2">Максимальная мощность</br> в текущ. месяце</th>
        <th data-options="field:'m_EnargyPrevMonth',width:80,align:'center',resizable:false" rowspan="2">Энергия</br> за пред.</br> месяц</th>
        <th data-options="field:'m_CounterFromStartMonth',width:80,align:'center',resizable:false" rowspan="2">Показания</br> энергии</br> на начало</br> месяца</th>
        <th data-options="field:'m_EnergyFromStartMonth',width:80,align:'center',resizable:false" rowspan="2">Энергия</br> с начала</br> месяца</th>
        <th data-options="field:'m_EnergyByLastDay',width:80,align:'center',resizable:false" rowspan="2">Энергия</br> за пред.</br> сутки</th>
        <th data-options="field:'m_CounterFromStartDay',width:80,align:'center',resizable:false" rowspan="2">Показания</br> энергии</br> на начало</br> суток</th>

    </tr>


    <tr>
        <th data-options="field:'p_maxpow_date',width:120,align:'center',resizable:false">дата и время</th>
        <th data-options="field:'p_maxpow',width:70,align:'center',resizable:false">значение,</br> кВт</th>
        <th data-options="field:'m_maxpow_date',width:120,align:'center',resizable:false">дата и время</th>
        <th data-options="field:'m_maxpow',width:70,align:'center',resizable:false">значение,</br> кВт</th>
    </tr>
    </thead>
</table>
</div>
</div>

