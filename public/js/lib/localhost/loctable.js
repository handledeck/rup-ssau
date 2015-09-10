var curDate = new Date();
var navgrid = function (url) {
            var el = document.querySelector('.toggle-btn');
            var observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    $("#tbl").datagrid({ width: $('#mainid').width });
                });
            });
            observer.observe(el, {
                attributes: true
            });
            $('#reportrange').daterangepicker({
                singleDatePicker: true,
                locale: {
                    daysOfWeek: ['Вск', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                    firstDay: 1
                }
            }, function (start, end, label) {
                var date = new Date(start);
                curDate = date;
                $('#reportrange').text(('0' + date.getDate()).slice(-2) + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear() + " 00:00");
                $("#tbl").datagrid({url: url + (curDate.getTime())});
                $('#tbl').datagrid('reload');
            });

            window.onresize = function () {
                $("#tbl").datagrid({ width: $('#mainid').width });
            }
            $('#btn-refresh').on('click', function () {
                $('#tbl').datagrid('reload');
            });
        };