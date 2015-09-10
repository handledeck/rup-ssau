@extends('app')
@section('content')
@if(isset($station))
    <link rel="stylesheet" href="{{ asset('css/lib/css-spinners-master/css/spinners.css')}}"/>
<link rel="stylesheet" href="{{ asset('css/lib/easy-ui/themes/bootstrap/datagrid.css')}}">
<link rel="stylesheet" href="{{ asset('css/lib/easy-ui/themes/bootstrap/dialog.css')}}">
<link rel="stylesheet" href="{{ asset('css/lib/easy-ui/themes/bootstrap/window.css')}}">
<link rel="stylesheet" href="{{ asset('css/lib/css-spinners-master/css/spinners.css')}}"/>
<link rel="stylesheet" href="{{ asset('css/lib/daterangepicker/bootstrap-datetimepicker.min.css')}}"/>
<link rel="stylesheet" href="{{ asset('css/lib/daterangepicker/daterangepicker-bs3.css')}}"/>
<link rel="stylesheet" href="{{ asset('css/lib/bootstrap-toggle/bootstrap-toggle.min.css')}}"/>
@endif
<style>
    .multi-column-dropdown {
        list-style: none;
        padding-bottom: 10px;
        margin-top: 15px;
        margin-left: -20px;
    }

    .multi-column-dropdown li a {
        display: block;
        clear: both;
        line-height: 1.428571429;
        color: #7c7c7c;
        white-space: normal;
    }

    .multi-column-dropdown li a:hover {
        text-decoration: none;
        color: #ff6a00;
        /* background-color: #f5f5f5;*/
    }

    .table th {
        color: #000000;
        border-bottom: 1px solid #ccc;
        font-weight: normal;
    }

    .table tbody {
        font-size: 14px;
    }

    .table tbody tr td {
        padding: 5px;
    }

    .panel .panel-plain {
        padding-bottom: 2px;
    }

    .navbar-text {
    height: 15px;
    padding: 0px 0px 0px 0px;
    margin:10px 10px 0px 5px;
}

</style>
   
 <div class="modal fade" id="basicModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ url('settings') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Запрос данных по счетчикам</h4>
            </div>
            <div class="modal-body">
                <p>Энергия</p>
                <?php 
                    $sett=Auth::user()->getAttribute('settings');

                    if($sett==null)
                        {
                            $sett=new stdClass();
                            $sett->ap=1;
                            $sett->am=1;
                            $sett->rp=0;
                            $sett->rm=0;
                            $sett->interval=0;
                            $json=json_encode($sett);
                            Auth::user()->setAttribute('settings',$json);
                            Auth::user()->save();
                        }
                        else
                        $sett=json_decode($sett);

                ?>
                <input type="checkbox" name="AP"<?php if($sett->ap==1) echo ' checked ' ?>  data-toggle="toggle" data-on="A+" data-off="A+">
                <input type="checkbox" name="AM" <?php if($sett->am==1) echo ' checked ' ?> data-toggle="toggle" data-on="A-" data-off="A-">
                <input type="checkbox" name="RP" <?php if($sett->rp==1) echo ' checked ' ?> data-toggle="toggle" data-on="R+" data-off="R+" >
                <input type="checkbox" name="RM" <?php if($sett->rm==1) echo ' checked ' ?> data-toggle="toggle" data-on="R-" data-off="R-">
                
                <p>&nbsp</p>
                <p>Интервал</p>
                    <input type="checkbox" name="interval" <?php if($sett->interval==1) echo ' checked ' ?>  data-toggle="toggle"
                        data-width="100" data-onstyle="success" data-offstyle="success" data-on="сутки" data-off="30 мин">
            </div>
                          
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            </form>
        </div>
    </div>
</div>

<form id="fsub" role="form" method="POST" action="{{ url('test') }}">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input id="rm"  name="RM"  type="hidden" value="">
</form>   

<div class="container-fluid container-padded dash-controls">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-plain">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        @include('region\tab-balance',array('data'=>$data))
                    </ul>
                    <div class="panel panel-default">
                        <div class="panel-body easyui-layout">
                            @if(isset($station))
                          <div class="navbar-default" style="padding-right:30px;padding-left:30px">
                                <ul class="nav navbar-nav navbar-left">
                                    <li>
                                        <span class="navbar-text"><?php echo str_replace('\\','&nbsp-&nbsp',$station['station']);?></span>
                                    </li>
                                </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                     <span onclick="javascript: window.location.replace('test')" class="bar-report navbar-text">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                </li>
                                <li class="dropdown">

                                    <span  class="bar-report navbar-text" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-files-o"></i>
                                    </span>
                                    <ul class="dropdown-menu" role="menu">
                                        
                                        <li>
                                            
                                            <a href="<?php echo 'region?station='.$station["id"].'&date=&'?>">Баланс</a></li>
                                         <li role="presentation" class="divider"></li>
                                        <li><a href="<?php echo 'region?station='.$station["id"].'&date=&counter=1'?>">Счетчики</a></li>
                                         <li><a data-toggle="modal" data-target="#basicModal" href="#">Установка запроса</a></li>
                                    </ul>
                                </li>
                               <!-- <li>
                                     <span id="btn-refresh" class="bar-report navbar-text">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                </li>-->
                                 <li>
                                     <span class="bar-report navbar-text">
                                        &nbsp
                                    </span>
                                </li>
                                <li>
                                    <span class="bar-report navbar-text">
                                        <span id="reportrange">
                                            <? $dt = new DateTime('now'); echo $dt->format('Y-m-d 00:00'); ?>
                                        </span>
                                         <i style="margin-left:1px" class="fa fa-calendar"></i>
                                     </span>
                                </li>
                            </ul>
                              
                        </div>
                            <div class="col-md-12 page-title" id="sandbox-container">
                                <h4></h4>
                                @if(isset($station['counter']))
                                    @include('region\slines',array('station'=>$station,'act_tab'=>$act_tab))
                                @else
                                    @include('region\station',array('station'=>$station,'act_tab'=>$act_tab))
                               @endif
                            </div>
                            @else
                            @include('region\balance',array('data'=>$data,'act_tab=>$act_tab'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>  
<style>
 





</style>


    <script src="js/lib/momentjs/moment.min.js"></script>
    <script src="js/lib/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    @if(isset($station))
    
    <script src="js/lib/easy-ui/jquery.easyui.min.js"></script>
<script src="js/lib/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    @endif

    <?php
    if(isset($station))
        echo '<script src="js/lib/localhost/loctable.js" type="text/javascript"></script>'; 
    ?>
    <script>
        /*var tblData = null;
        function test() {
            var columns = {};
            columns['frozen'] = $('#tbl').datagrid('options').frozenColumns;
            columns['columns'] = $('#tbl').datagrid('options').columns;
            columns['data'] = tblData;
            document.getElementById('rm').value =JSON.stringify(columns);
            $('#fsub').submit();
        }*/
        $(document).ready(function () {
            
            /*$('#tbl').datagrid({
                onLoadSuccess: function (data) {
                    tblData = data;
                }
            })*/
           /* $('#tbl').datagrid({
                onHeaderContextMenu: function (a, b) {
                    var x = 0;
                }
            });*/
            <?php
                if(isset($station)) {
                    for ($i = 0; $i < 4; $i++){
                       echo '$("#tab_id_'.$i.'").on("click", function () {
                                window.location.replace("region?act_tab='.$i.'")});';
                       $counter='';
                       $url='regstat';
                       if(isset($station['counter'])){
                           $counter='counter=1';
                           $url='statdata';
                       }
                       echo 'var ng=new navgrid("'.$url.'?station='.$station['id'].'&'.$counter.'&date='.'");';
                    }
                    //echo  '$(\'#basicModal\').on(\'shown.bs.modal\', function () { $(\'#dg\').datagrid({ url: \'statdata?station=' 
                    //    echo urlencode($station[\'station\']); })';
                    //echo '$(\'#dg\').datagrid(\'reload\');})'; 
                }
                //if(!isset($station))
                 //echo '$("#tab_id_'.($act_tab-1).'").addClass("active");';
            ?>
           
        
        });
    </script>
    @endsection