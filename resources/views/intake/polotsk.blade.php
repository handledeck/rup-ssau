    <thead data-options="frozen:true">
    <tr>
         <th data-options="field:'datetime',width:125,align:'center',resizable:false,styler:function dateStyler(value,row,index){return 'font-weight:normal;';}">Дата, время</th>
    </tr>
    </thead>
      <thead>
      <tr>
          <th colspan="4">Потребление</th>
          <th colspan="7">Генерация</th>
          <th colspan="4">ПС-330кВ "Полоцкая"</th>
          <th colspan="32">Лукомльская ГРЭС</th>
          <th colspan="16">ПС-330кВ  "Полоцкая"</th>
          <th colspan="4">ПС-110кВ "Гравийная"</th>
          <th colspan="4">ПС-110кВ "Новолукомль"</th>
          <th colspan="2">ПС-110кВ  "Мясокомбинат"</th>
          <th colspan="2">ПС-110кВ "Миоры"</th>
          <th colspan="2">ПС-110кВ  "Чашники"</th>

          <th data-options="field:'const_per_pes',width:100,align:'center',resizable:false" rowspan="4">Константа<br>перетоков<br>ПЭС</th>
      </tr>
      <tr>
          <th data-options="field:'plan',width:70,align:'center',resizable:false" rowspan="4">План</th>
          <th data-options="field:'fact',width:70,align:'center',resizable:false" rowspan="4">Факт</th>
          <th data-options="field:'otcl',width:80,align:'center',resizable:false" rowspan="4">Отклонение</th>
          <th data-options="field:'percent',width:70,align:'center',resizable:false" rowspan="4">%</th>
          <th data-options="field:'lucgen',width:100,align:'center',resizable:false" rowspan="4">Лукомльская<br>ГРЭС</th>
          <th data-options="field:'pgugen',width:100,align:'center',resizable:false" rowspan="4">ПГУ<br> Лукомльской<br> ГРЭС</th>
          <th data-options="field:'dgugen',width:100,align:'center',resizable:false" rowspan="4">ДГУ<br> Лукомльской<br> ГРЭС</th>
          <th data-options="field:'novgen',width:100,align:'center',resizable:false" rowspan="4">Новополоцкая<br> ТЭЦ</th>
          <th data-options="field:'kgtugen',width:100,align:'center',resizable:false" rowspan="4">КГТУ<br>ОАО "Нафтан"</th>
          <th data-options="field:'polgen',width:100,align:'center',resizable:false" rowspan="4">Полоцкая<br>ТЭЦ</th>
          <th data-options="field:'constPes',width:100,align:'center',resizable:false" rowspan="4">Константа<br>генерации<br>ПЭС</th>

          <!--ПС-330кВ "Полоцкая"-->
          <th colspan="2">ВЛ-330кВ №345 Полоцк-Новосокольники</th>
          <th colspan="2">ВЛ-330кВ №450 Полоцк-ИАЭС</th>
          <!--Лукомльская ГРЭС-->
          <th colspan="2">ВЛ-330кВ №348 Лукомль-Витебск</th>
          <th colspan="2">ВЛ-330кВ №337 Лукомль-Орша</th>
          <th colspan="2">ВЛ-330кВ №432 Лукомль-Мирадино</th>
          <th colspan="2">ВЛ-330кВ №335 Лукомль-Минск Северная</th>
          <th colspan="2">ВЛ-330кВ №428 Лукомль-Борисов</th>
          <th colspan="2">ВЛ-330кВ №336 Лукомль-Могилев</th>

          <th colspan="8">ВЛ-110кВ Крупки</th>
          <th colspan="2">ВЛ-110кВ Лукомль-Сенно</th>
          <th colspan="2">ОЭВ-110кВ</th>
          <th colspan="2">ОЭВ-110кВ на Крупки №1</th>
          <th colspan="2">ОЭВ-110кВ на Крупки №2</th>
          <th colspan="2">ОЭВ-110кВ на Крупки №3</th>
          <th colspan="2">ОЭВ-110кВ на Крупки (Сенно)</th>
          <th colspan="6">ВЛ-110кВ Полоцк-Глубокое</th>
          <th colspan="2">ВЛ-110кВ на БПС Дисна</th>
          <th colspan="2">ОЭВ-110кВ</th>
          <th colspan="2">ОЭВ-110кВ на Глубокое №1</th>
          <th colspan="2">ОЭВ-110кВ на Глубокое №2</th>
          <th colspan="2">ОЭВ-110кВ на БПС Дисна</th>

          <th colspan="2">Ввод №1 СШ 10 кВ</th>
          <th colspan="2">Ввод №2 СШ 10 кВ</th>
          <th colspan="2">Ввод №1 СШ 10 кВ</th>
          <th colspan="2">Ввод №2 СШ 10 кВ</th>

          <th colspan="2">ВЛ-110кВ Мясокомбинат-Шумилино</th>
          <th colspan="2">ВЛ-110кВ Миоры-Верхнедвинск</th>
          <th colspan="2">ВЛ-110кВ Чашники-Сватовка</th>

      </tr>
      <tr>
      <!--№345 Полоцк-Новосокольники-->
          <th data-options="field:'line345O',width:120,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line345P',width:120,align:'center',resizable:false">прием</th>
          <!--№450 Полоцк-ИАЭС-->
          <th data-options="field:'line450O',width:100,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line450P',width:100,align:'center',resizable:false">прием</th>
          <!--№348 Лукомль-Витебск-->
          <th data-options="field:'line348O',width:100,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line348P',width:100,align:'center',resizable:false">прием</th>
          <!--№337 Лукомль-Орша-->
          <th data-options="field:'line337O',width:100,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line337P',width:100,align:'center',resizable:false">прием</th>
          <!--№432 Лукомль-Мирадино-->
          <th data-options="field:'line432O',width:110,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line432P',width:110,align:'center',resizable:false">прием</th>
          <!--№335 Лукомль-Минск Северная-->
          <th data-options="field:'line335O',width:130,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line335P',width:130,align:'center',resizable:false">прием</th>
          <!--№428 Лукомль-Борисов-->
          <th data-options="field:'line428O',width:100,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line428P',width:100,align:'center',resizable:false">прием</th>
          <!--№336 Лукомль-Могилев-->
          <th data-options="field:'line336O',width:100,align:'center',resizable:false">отдача</th>
          <th data-options="field:'line336P',width:100,align:'center',resizable:false">прием</th>

          <!--ВЛ-110 кВ Крупки-->
          <th data-options="field:'luk_krup_1O',width:90,align:'center',resizable:false">№1 отдача</th>
          <th data-options="field:'luk_krup_1p',width:90,align:'center',resizable:false">№1 прием</th>
          <th data-options="field:'luk_krup_2O',width:90,align:'center',resizable:false">№2 отдача</th>
          <th data-options="field:'luk_krup_2p',width:90,align:'center',resizable:false">№2 прием</th>
          <th data-options="field:'luk_krup_3O',width:90,align:'center',resizable:false">№3 отдача</th>
          <th data-options="field:'luk_krup_3p',width:90,align:'center',resizable:false">№3 прием</th>
          <th data-options="field:'luk_krup_sum_O',width:90,align:'center',resizable:false">отдача<br> сумма</th>
          <th data-options="field:'luk_krup_sum_p',width:90,align:'center',resizable:false">прием<br>сумма</th>

          <!--ВЛ-110кВ Лукомль-Сенно-->
          <th data-options="field:'luk_senno_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'luk_senno_p',width:90,align:'center',resizable:false">прием</th>
          <!--ОЭВ-110 кВ-->
          <th data-options="field:'luc_oev_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'luc_oev_p',width:90,align:'center',resizable:false">прием</th>
          <!--ОЭВ на Крупки №1,2,3-->
          <th data-options="field:'luc_oev_krup_1_O',width:90,align:'center',resizable:false">№1 отдача</th>
          <th data-options="field:'luc_oev_krup_1_p',width:90,align:'center',resizable:false">№1 прием</th>
          <th data-options="field:'luc_oev_krup_2_O',width:90,align:'center',resizable:false">№2 отдача</th>
          <th data-options="field:'luc_oev_krup_2_p',width:90,align:'center',resizable:false">№2 прием</th>
          <th data-options="field:'luc_oev_krup_3_O',width:90,align:'center',resizable:false">№3 отдача</th>
          <th data-options="field:'luc_oev_krup_3_p',width:90,align:'center',resizable:false">№3 прием</th>
          <!--ОЭВ на Крупки (Сенно)-->
          <th data-options="field:'luc_oev_senno_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'luc_oev_senno_p',width:90,align:'center',resizable:false">прием</th>
          <!--ВЛ-110кВ Полоцк-Глубокое-->
          <th data-options="field:'pol_glub_1_O',width:90,align:'center',resizable:false">№1 отдача</th>
          <th data-options="field:'pol_glub_1_p',width:90,align:'center',resizable:false">№1 прием</th>
          <th data-options="field:'pol_glub_2_O',width:90,align:'center',resizable:false">№2 отдача</th>
          <th data-options="field:'pol_glub_2_p',width:90,align:'center',resizable:false">№2 прием</th>
          <th data-options="field:'pol_glub_sum_O',width:90,align:'center',resizable:false">отдача<br> сумма</th>
          <th data-options="field:'pol_glub_sum_p',width:90,align:'center',resizable:false">прием<br>сумма</th>
          <!--ВЛ-110кВ на БПС Дисна-->
          <th data-options="field:'pol_disna_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_disna_p',width:90,align:'center',resizable:false">прием</th>
          <!--ОЭВ-110кВ-->
          <th data-options="field:'pol_ovv_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_ovv_p',width:90,align:'center',resizable:false">прием</th>
          <!--ОЭВ-110кВ на Глубокое №1-->
          <th data-options="field:'pol_ovv_glub_1_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_ovv_glub_1_p',width:90,align:'center',resizable:false">прием</th>
          <!--ОЭВ-110кВ на Глубокое №2-->
          <th data-options="field:'pol_ovv_glub_2_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_ovv_glub_2_p',width:90,align:'center',resizable:false">прием</th>
          <!--ОЭВ-110кВ на БПС Дисна-->
          <th data-options="field:'pol_ovv_disna_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_ovv_disna_p',width:90,align:'center',resizable:false">прием</th>
          <!--Ввод №1 СШ 10 кВ-->
          <th data-options="field:'pol_grav_v1_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_grav_v1_p',width:90,align:'center',resizable:false">прием</th>
          <!--ПС - 110 кВ "Гравийная" Ввод №1,2 СШ 10 кВ-->
          <th data-options="field:'pol_grav_v2_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_grav_v2_p',width:90,align:'center',resizable:false">прием</th>
          <!--ПС - 110 кВ "Новолукомль" Ввод №1,2 СШ 10 кВ-->
          <th data-options="field:'pol_novol_v1_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_novol_v1_p',width:90,align:'center',resizable:false">прием</th>
          <!--Мясокомбинат-Шумилино-->
          <th data-options="field:'pol_novol_v2_O',width:90,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_novol_v2_p',width:90,align:'center',resizable:false">прием</th>
          <!--Миоры-Верхнедвинск-->
          <th data-options="field:'pol_myso_O',width:110,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_myso_p',width:110,align:'center',resizable:false">прием</th>
          <!--Чашники-Сватовка-->
          <th data-options="field:'pol_miory_O',width:110,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_miory_p',width:110,align:'center',resizable:false">прием</th>

          <th data-options="field:'pol_chashniki_O',width:110,align:'center',resizable:false">отдача</th>
          <th data-options="field:'pol_chashniki_p',width:110,align:'center',resizable:false">прием</th>



      </tr>
      </thead>