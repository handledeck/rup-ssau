    <thead data-options="frozen:true">
    <tr>
        <th data-options="field:'datetime',width:125,align:'center',resizable:false,styler:function dateStyler(value,row,index){return 'font-weight:normal;';}">Дата, время</th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th colspan="4">Потребление</th>
        <th colspan="4">Генерация</th>
        <th colspan="8">Лукомльская ГРЭС</th>
        <th colspan="2">ПС-330кВ "Оршанская"</th>
        <th colspan="10">ПС-330кВ "Витебская"</th>
        <th colspan="2">ПС-110кВ "Славное"</th>
        <th colspan="2">ПС-110кВ "Селище"</th>
        <th colspan="2">ПС-110кВ "Шклов"</th>
        <th colspan="2">ПС-110кВ "Толочин"</th>
        <th colspan="2">ПС-35 кВ "Литвяки"</th>
        <th data-options="field:'cost_per',width:100,align:'center',resizable:false" rowspan="4">Константа<br>перетоков<br>ОЭС</th>
    </tr>
    <tr>
        <th data-options="field:'plan',width:70,align:'center',resizable:false" rowspan="4">План</th>
        <th data-options="field:'fact',width:70,align:'center',resizable:false" rowspan="4">Факт</th>
        <th data-options="field:'otcl',width:80,align:'center',resizable:false" rowspan="4">Отклонение</th>
        <th data-options="field:'percent',width:70,align:'center',resizable:false" rowspan="4">%</th>
        <th data-options="field:'orsha_tec',width:100,align:'center',resizable:false" rowspan="4">Оршанская<br>ТЭЦ</th>
        <th data-options="field:'belgres',width:100,align:'center',resizable:false" rowspan="4">БелГРЭС</th>
        <th data-options="field:'baran',width:100,align:'center',resizable:false" rowspan="4">мТЭЦ "Барань"</th>
        <th data-options="field:'constOes',width:100,align:'center',resizable:false" rowspan="4">Константа<br>генерации<br>ОЭС</th>
        <th colspan="2">ВЛ-330кВ №337 Лукомль-Орша</th>
        <th colspan="2">ВЛ-110кВ Лукомль-Сенно</th>
        <th colspan="2">ОЭВ-110 кВ</th>
        <th colspan="2">ОЭВ-110 кВ на Сенно (ОЭС)</th>
        <th colspan="2">ВЛ-330кВ №347 Орша-Могилев</th>
        <th colspan="2">ВЛ-110кВ на БелГРЭС (ОЭС)</th>
        <th colspan="2">ВЛ-110кВ на Мошканы (ОЭС)</th>
        <th colspan="2">ОЭВ-110 кВ</th>
        <th colspan="2">ОЭВ-110 кВ на БелГРЭС</th>
        <th colspan="2">ОЭВ-110 кВ на Мошканы</th>

        <th colspan="2">ВЛ-110кВ Славное-Бобр</th>
        <th colspan="2">ВЛ-110кВ Селище-Шклов</th>
        <th colspan="2">ВЛ-110кВ Шклов-Селище</th>
        <th colspan="2">ВЛ-110кВ Толочин-Круглое</th>
        <th colspan="2">ВЛ-110кВ Литвяки-Обчуга</th>
    </tr>
    <tr>

        <th data-options="field:'line337_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'line337_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'luk_senno_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'luk_senno_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'luk_oev_110_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'luk_oev_110_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'oev_110_senno_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'oev_110_senno_o',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'orsha_mogilev_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'orsha_mogilev_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'to_belgres_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'to_belgres_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'to_moshkany_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'to_moshkany_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'vit_oev_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'vit_oev_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'vit_oev_belgres_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'vit_oev_belgres_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'vit_oev_moshkany_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'vit_oev_moshkany_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'slavnoe_bobr_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'slavnoe_bobr_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'selishe_shklov_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'selishe_shklov_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'shklov_selishe_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'shklov_selishe_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'tolochin_krugloe_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'tolochin_krugloe_p',width:110,align:'center',resizable:false">прием</th>
        <th data-options="field:'litvyaki_obchuga_o',width:110,align:'center',resizable:false">отдача</th>
        <th data-options="field:'litvyaki_obchuga_p',width:110,align:'center',resizable:false">прием</th>

    </tr>
    </thead>