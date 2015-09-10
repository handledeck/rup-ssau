@extends('app')
@section('content')

   <link rel="stylesheet" href="{{ asset('css/lib/easy-ui/themes/bootstrap/datagrid.css')}}">
   <link rel="stylesheet" href="{{ asset('css/lib/easy-ui/themes/bootstrap/dialog.css')}}">
   <link rel="stylesheet" href="{{ asset('css/lib/easy-ui/themes/bootstrap/window.css')}}">
   <link rel="stylesheet" href="{{ asset('css/lib/css-spinners-master/css/spinners.css')}}"/>
   <link rel="stylesheet" href="{{ asset('css/lib/daterangepicker/bootstrap-datetimepicker.min.css')}}"/>
   <link rel="stylesheet" href="{{ asset('css/lib/daterangepicker/daterangepicker-bs3.css')}}"/>
           {{--<div class="modal fade in" id="waitid" style="display:block">--}}
             {{--<div class="modal-dialog" style="width:150px;padding-top:400px">--}}
               {{--<div class="modal-content">--}}
                 {{--<div class="modal-body">--}}
                   {{--<span class="refreshing"></span><span>Загрузка</span>--}}
                 {{--</div>--}}
               {{--</div>--}}
             {{--</div>--}}
           {{--</div>--}}
           <style>
           .panel-body{
              padding:5px;!important
              }
            </style>
<div class="container-fluid container-padded dash-controls">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 page-title" id="sandbox-container">
                <h2>{{$object['title']}}</h2>
                    <p class="text-dark">Потребление электроэнергии с начала текущих суток нарастающим итогом (МВт*ч)
                        <span  style="float:right">
                         <span id="btn-refresh" class="bar-report" title="обновить">
                            
                            <i class="fa fa-refresh"></i>
                         </span>
                         <span style="margin-left: 10px;text-shadow: 0 1px #ffffff"></span>
                            <span id="reportrange">
                             <?php
                                $dt= new DateTime('now');
                                echo $dt->format('Y-m-d 00:00');
                             ?>
                              <i style="margin-left:1px" class="fa fa-calendar"></i>
                             </span> 

                        </span>
                    </p>
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <section>
        <div class="container-fluid container-padded">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easyui-layout">
                        <table id="tbl" class="easyui-datagrid" style="height:800px;display:none" data-options=" loadMsg:'Загрузка данных...',rownumbers:true,singleSelect:true,fitColumn:true,striped:true,
                                    url:'<?php $dt= new DateTime('now');echo $object['url'].($dt->getTimestamp()*1000)  ?>',method:'get',
                                    onLoadError:function(e){alert('Ошибка зарузки данных');}
                                    ">
                        <?php

                           echo $object['blade']->render();
                        ?>
                        </table>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>
<script src="js/lib/easy-ui/jquery.easyui.min.js"></script>
<script src="js/lib/momentjs/moment.min.js"></script>
<script src="js/lib/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="js/lib/localhost/loctable.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        var ng = new navgrid("<?php echo $object['url']?>");
    });
</script>
@endsection