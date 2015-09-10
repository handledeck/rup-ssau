@extends('app')
@section('content')

  <div class="container-fluid container-padded dash-controls">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 page-title" id="sandbox-container">
                <h3>Потребление РУП Витебскэнерго и филиалов (МВт*ч)</h3>
                <br />
                   <div class="row">

                       <div class="col-xs-6 col-sm-6 col-md-3">
<div class="panel panel-default">
<div class="panel-body panel-body-gray panel-body-top-br">
<div class="stat">
<p class="stat-title">РУП Витебскэнерго</p>
<h3 id="rupsum" class="stat-value">0.0</h3>
</div>
</div>
<hr class="small">
</div>
</div>


<div class="col-xs-6 col-sm-6 col-md-2">
<div class="panel panel-default">
<div class="panel-body panel-body-gray panel-body-top-br">
<div class="stat">
<p class="stat-title">Витебские ЭС</p>
<h3 id="B175293" class="stat-value">0.0</h3>
</div>
</div>
<hr class="small">
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-2">
<div class="panel panel-default">
<div class="panel-body panel-body-gray panel-body-top-br">
<div class="stat">
<p class="stat-title">Полоцкие ЭС</p>
<h3 id="B175284" class="stat-value">0.0</h3>
</div>
</div>
<hr class="small">
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-2">
<div class="panel panel-default">
<div class="panel-body panel-body-gray panel-body-top-br">
<div class="stat">
<p class="stat-title">Оршанские ЭС</p>
<h3 id="B175280" class="stat-value">0.0</h3>
</div>
</div>
<hr class="small">
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-2">
<div class="panel panel-default">
<div class="panel-body panel-body-gray panel-body-top-br">
<div class="stat">
<p class="stat-title">Глубокские ЭС</p>
<h3 id="B175269" class="stat-value">0.0</h3>
</div>
</div>
<hr class="small">
</div>
</div>
</div> 
            </div>
        </div>
        </div>
      </div>

        <div class="container-fluid container-padded dash-controls">
    <div class="row">
        <div class="col-md-5">
            <div class="col-md-12 page-title">
                   <div class="row">
                       <div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Генерация, МВт*ч</h3>
</div>
<div class="panel-body">
<div class="flip-scroll">
<table class="table table-bordered table-striped table-scroll">
<thead class="table-scroll">
<tr>

<th>Наименование</th>
<th class="text-right">Выработка за сутки</th>
<th class="text-right">С учетом СН генераторов</th>

</tr>
</thead>
<tbody>
<tr>

<td>Лукомльская ГРЭС</td>
<td class="text-right">$1.38</td>
<td class="text-right">-0.01</td>


</tr>
<tr>

<td>ПГУ Лукомльской ГРЭС</td>
<td class="text-right">$1.15</td>
<td class="text-right"> +0.02</td>

</tr>
<tr>

<td>AUSENCO LIMITED</td>
<td class="text-right">$4.00</td>
<td class="text-right">-0.04</td>

</tr>
<tr>

<td>ADELAIDE BRIGHTON LIMITED</td>
<td class="text-right">$3.00</td>
<td class="text-right"> +0.06</td>

</tr>
<tr>

<td>ABACUS PROPERTY GROUP</td>
<td class="text-right">$1.91</td>
<td class="text-right">0.00</td>

</tr>
<tr>

<td>ADITYA BIRLA MINERALS LIMITED</td>
<td class="text-right">$0.77</td>
<td class="text-right"> +0.02</td>

</tr>
<tr>

<td>ACRUX LIMITED</td>
<td class="text-right">$3.71</td>
<td class="text-right"> +0.01</td>

</tr>
<tr>

<td>ADAMUS RESOURCES LIMITED</td>
<td class="text-right">$0.72</td>
<td class="text-right">0.00</td>

</tr>
<tr>

<td>ANGLOGOLD ASHANTI LIMITED</td>
<td class="text-right">$7.81</td>
<td class="text-right">-0.22</td>

</tr>
<tr>

<td>AGL ENERGY LIMITED</td>
<td class="text-right">$13.82</td>
<td class="text-right"> +0.02</td>

</tr>
<tr>

<td>ATLAS IRON LIMITED</td>
<td class="text-right">$3.17</td>
<td class="text-right">-0.02</td>

</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
                       </div>
                   </div>
    </div>
        <div class ="col-md-7">
             <div class="col-md-12 page-title">
                   <div class="row">
                       <div class="col-md-12">
                        <div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Перетоки по межгосударственным и межсистемным ВЛ, МВт*ч</h3>
</div>
                           <div class="panel-body">
                                <div class="flip-scroll">
                                <table class="table table-bordered table-striped table-scroll">
                                    <thead class="table-scroll">
                                        <tr>
                                            <th rowspan="2">
                                                Смежная энергосистема
                                            </th >
                                            <th rowspan="2">
                                                Наименование линии
                                            </th>
                                            <th colspan="2">
                                                Предыдущие сутки
                                            </th>
                                            

                                        </tr>
                                        <tr>
                                            <th>прием</th>
                                            <th>отдача</th>
                                        </tr>

                                        </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="13" style="text-align:center;vertical-align:middle">
                                                Минскэнерго
                                            </td>
                                            <td>ВЛ-330 кВ №335  Лукомль-Минск Северная</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                            <tr>
                                                <td>ВЛ-330 кВ №428  Лукомль-Борисов</td>
                                                <td>2</td>
                                                <td>2</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-110 кВ №1 КС Крупки </td>
                                                <td>3</td>
                                                <td>3</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-110 кВ №2 КС Крупки</td>
                                                <td>4</td>
                                                <td>4</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-110 кВ №3 КС Крупки</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ОВВ Лукомльской ГРЭС на КС Крупки</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ПС Новолукомль Т-1</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ПС Новолукомль Т-2</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ПС Гравийная Т-1</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-110 кВ Славное-Бобр</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-35 кВ Литвяки-Обчуга</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-35 кВ Бегомль-Жестинное</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-35 кВ Комаи-Купа</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                            <td rowspan="5" style="text-align:center;vertical-align:middle">
                                                Могилевэнерго
                                            </td>
                                            <td>ВЛ-330 кВ №336  Лукомль-Могилев Северная</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                         <tr>
                                                <td>ВЛ-330 кВ №432  Лукомль-Мирадино</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-330 кВ №347 Орша-Могилев</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-110 кВ Шклов-Селище</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-35 кВ Толочин-Круглое</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                        <td rowspan="5" style="text-align:center;vertical-align:middle">
                                                Lietuvos energija	
                                           </td>
                                            <td>ВЛ-330 кВ №450 Полоцк-ИАЭС</td>
                                            <td>1</td>
                                            <td>1</td>
                                         </tr>
                                            <tr>
                                                <td>ВЛ-110 кВ ИАЭС-Опса</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-110 кВ ИАЭС-Видзы</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-35 кВ Лынтупы-Швенчёнис</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                        <tr>
                                                <td>ВЛ-110 кВ Диджасалис</td>
                                                <td>5</td>
                                                <td>5</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                    </div>
                               </div>
    </div>
                           </div>
                       </div>
                 </div>
            
        </div>
</div>
            </div>
<script>

    function ss() {

        $.ajax({
            type: 'GET',
            url: 'http://10.178.0.244:5555/crq?req=current&type=b&n1=175269,175280,175284,175293&json=1',

            dataType: 'jsonp',
            timeout: 10000,
            success: function (json) {
                var x = JSON.parse(json);
                var rupsum = 0.0;
                var good = true;
                for (var i = 0; i < x.length; i++) {
                
                    var el = x[i].name;
                    el = "#" + el;
                    if (x[i].sate != 0) {
                        good = false;
                        $(el).css('color', '#cecece');
                    }
                    else {
                        $(el).text(formatNumber2(x[i].value / 1000));
                        $(el).css('color', '#black');
                    }
                    rupsum += (x[i].value/1000);
                    $(el).text(formatNumber2(x[i].value / 1000));
                }
                $("#rupsum").text(formatNumber2(rupsum));
            },
            error: function () {
                alert('error')
            }
        });
    }

    function formatNumber2(number) {
        return Math.max(0, number).toFixed(0).replace(/(?=(?:\d{3})+$)(?!^)/g, ' ');
    }

    $(this).ready(function () {
        ss();
    });
    setInterval(ss, 20000);
</script>

@endsection