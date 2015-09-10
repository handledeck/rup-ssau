<?php
/*
 * SELECT t1.name AS lev1, t2.name as lev2, t3.name as lev3, t4.name as lev4
FROM menu AS t1
LEFT JOIN menu AS t2 ON t2.parent = t1.id
LEFT JOIN menu AS t3 ON t3.parent = t2.id
LEFT JOIN menu AS t4 ON t4.parent = t3.id
WHERE t1.name = 'Root';
 * */
return [
    'menu' =>
        [
            [
                'header' => 'Электроэнергия',
                'items' => [
                    [
                        'name' => 'Потребление',
                        'id' => 0,
                        'class' => 'io ion-speedometer',
                        'menu' =>
                            [
                                ['name' => 'Витебскэнерго', 'url' => 'rup', 'id' => 1],
                                ['name' => 'Витебские ЭС', 'url' => 'vitebsk', 'id' => 2],
                                ['name' => 'Полоцкие ЭС', 'url' => 'polotsk', 'id' => 3],
                                ['name' => 'Оршанские ЭС', 'url' => 'orsha', 'id' => 4],
                                ['name' => 'Глубокские ЭС', 'url' => 'glubokoe', 'id' => 5],
                            ],
                    ],
                    [
                        'name' => 'АСКУЭ регион',
                        'id' => 1,
                        'class' => 'io ion-settings',
                        'menu' =>
                            [
                                 ['name' => 'Небаланс', 'url' => 'region?act_tab=0', 'id' => 6]
                            ],
                    ],
                ]
            ],
            /*[
                'header' => 'Газ',
                'items' => [
                    [
                        'name' => 'Объекты',
                        'id' => 2,
                        'class' => 'ion ion-wrench',
                        'menu' =>
                            [['name' => 'Лукомльская ГРЭС', 'url' => 'ss', 'id' => 7],
                                ['name' => 'Оршанская ТЭЦ', 'url' => 'ss', 'id' => 8],
                                ['name' => 'Новополоцкая ТЭЦ', 'url' => 'gas-novopolotsk', 'id' => 9]
                            ],
                    ]
                ],
            ],*/
             [
                'header' => 'Оборудование',
                'items' => [
                    [
                        'name' => 'Сервера',
                        'id' => 3,
                        'class' => 'ion ion-wrench',
                        'menu' =>
                            [['name' => 'TechSrv', 'url' => 'equip?srv=techsrv', 'id' => 10],
                                ['name' => 'DbSrvSau', 'url' => 'equip?srv=dbsrvsau', 'id' => 11],
                                ['name' => 'DocSrv', 'url' => 'equip?srv=docsrv', 'id' => 12]
                            ],
                    ]
                ],
            ]
        ]
];