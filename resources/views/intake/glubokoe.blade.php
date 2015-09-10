    <thead data-options="frozen:true">
    <tr>
         <th data-options="field:'datetime',width:125,align:'center',resizable:false,styler:function dateStyler(value,row,index){return 'font-weight:normal;';}">Дата, время</th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th colspan="4">Потребление</th>
        <th data-options="field:'constPes',width:70,align:'center',resizable:false" rowspan="4">Константа<br>генерации<br>ГЭС</th>
        <th colspan="16">ПС-330кВ "Полоцкая"</th>
        <th colspan="2">ПС-110кВ "Видзы"</th>
        <th colspan="2">ПС-110кВ "Опса"</th>
        <th colspan="2">ПС-110кВ "Миоры"</th>
        <th colspan="2">ПС-35кВ "Лынтупы"</th>
        <th colspan="2">ПС-35кВ "Комаи"</th>
        <th colspan="2">ПС-110/35кВ "Бегомль"</th>
        <th colspan="2">ПС-110кВ "Дрисвяты"</th>

        <th data-options="field:'cost_per',width:100,align:'center',resizable:false" rowspan="4">Константа<br>перетоков<br>ГЭС</th>
    </tr>
    <tr>
        <th data-options="field:'plan',width:70,align:'center',resizable:false" rowspan="4">План</th>
        <th data-options="field:'fact',width:70,align:'center',resizable:false" rowspan="4">Факт</th>
        <th data-options="field:'otcl',width:80,align:'center',resizable:false" rowspan="4">Отклонение</th>
        <th data-options="field:'percent',width:70,align:'center',resizable:false" rowspan="4">%</th>


        <!--ПС-330кВ "Полоцкая"-->
        <th colspan="6">ВЛ-110кВ Полоцк-Глубокое</th>
        <th colspan="2">ВЛ-110кВ на БПС Дисна</th>
        <th colspan="2">ОЭВ-110кВ</th>
        <th colspan="2">ОЭВ-110кВ на Глубокое №1</th>
        <th colspan="2">ОЭВ-110кВ на Глубокое №2</th>
        <th colspan="2">ОЭВ-110кВ на БПС Дисна</th>
        <th colspan="2">ВЛ-110кВ ИАЭС-Видзы</th>
        <th colspan="2">ВЛ-110кВ ИАЭС-Опса</th>
        <th colspan="2">ВЛ-110кВ Миоры-Верхнедвинск</th>

        <th colspan="2">ВЛ-35кВ Лынтупы-Швенченис</th>
        <th colspan="2">ВЛ-35кВ Комаи-Купа</th>
        <th colspan="2">ВЛ-35кВ Бегомль-Жестинное</th>
        <th colspan="2">Ввод №1</th>

    </tr>
    <tr>

        <th data-options="field:'pol_glub_1_o',width:80,align:'center',resizable:false">№1 отдача</th>
        <th data-options="field:'pol_glub_1_p',width:80,align:'center',resizable:false">№1 прием</th>

        <th data-options="field:'pol_glub_2_o',width:80,align:'center',resizable:false">№2 отдача</th>
        <th data-options="field:'pol_glub_2_p',width:80,align:'center',resizable:false">№2 прием</th>

        <th data-options="field:'pol_glub_sum_o',width:90,align:'center',resizable:false">отдача сумма</th>
        <th data-options="field:'pol_glub_sum_p',width:90,align:'center',resizable:false">прием сумма</th>

        <th data-options="field:'bps_disna_o',width:75,align:'center',resizable:false">отдача</th>
        <th data-options="field:'bps_disna_p',width:75,align:'center',resizable:false">прием</th>
        <!--№432 Лукомль-Мирадино-->
        <th data-options="field:'glub_oev_o',width:75,align:'center',resizable:false">отдача</th>
        <th data-options="field:'glub_oev_p',width:75,align:'center',resizable:false">прием</th>
        <!--№335 Лукомль-Минск Северная-->
        <th data-options="field:'glub_oev_1_o',width:85,align:'center',resizable:false">отдача</th>
        <th data-options="field:'glub_oev_1_p',width:85,align:'center',resizable:false">прием</th>
        <!--№428 Лукомль-Борисов-->
        <th data-options="field:'glub_oev_2_o',width:85,align:'center',resizable:false">отдача</th>
        <th data-options="field:'glub_oev_2_p',width:85,align:'center',resizable:false">прием</th>
        <!--№336 Лукомль-Могилев-->
        <th data-options="field:'disna_oev_o',width:90,align:'center',resizable:false">отдача</th>
        <th data-options="field:'disna_oev_p',width:90,align:'center',resizable:false">прием</th>


        <th data-options="field:'iaes_vidzy_o',width:85,align:'center',resizable:false">отдача</th>
        <th data-options="field:'iaes_vidzy_p',width:85,align:'center',resizable:false">прием</th>
        <th data-options="field:'iaes_opsa_o',width:85,align:'center',resizable:false">отдача</th>
        <th data-options="field:'iaes_opsa_p',width:85,align:'center',resizable:false">прием</th>
        <th data-options="field:'miory_verdvinsk_o',width:100,align:'center',resizable:false">отдача</th>
        <th data-options="field:'miory_verdvinsk_p',width:100,align:'center',resizable:false">прием</th>
        <th data-options="field:'lyntupy_shvench_o',width:90,align:'center',resizable:false">отдача</th>
        <th data-options="field:'lyntupy_shvench_p',width:90,align:'center',resizable:false">прием</th>
        <th data-options="field:'komy_kupa_o',width:80,align:'center',resizable:false">отдача</th>
        <th data-options="field:'komy_kupa_p',width:80,align:'center',resizable:false">прием</th>

        <!--ВЛ-110кВ Лукомль-Сенно-->
        <th data-options="field:'begoml_zestyan_o',width:90,align:'center',resizable:false">отдача</th>
        <th data-options="field:'begoml_zestyan_p',width:90,align:'center',resizable:false">прием</th>
        <!--ОЭВ-110 кВ-->
        <th data-options="field:'drisvaty_v1_o',width:80,align:'center',resizable:false">отдача</th>
        <th data-options="field:'drisvaty_v1_p',width:80,align:'center',resizable:false">прием</th>

    </tr>
    </thead>

</table>