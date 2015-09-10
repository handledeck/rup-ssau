<?php
    $classnavact="menu-list nav-active";
    $classnav="menu-list";
    $menuact="class=active";
    $act=null;
    $act=View::getShared();
 ?>

    
<ul class="nav nav-pills nav-stacked custom-nav">
    <?php $data=Config::get('menu.menu');?>
    @foreach($data as $value)
       @if (isset($value['header']))
          <li class="nav-header">{{$value['header']}}</li>
       @endif
       @foreach($value['items'] as $item)
        <li class="@if($item['id']==$act['ids']['navid']){{$classnavact}}@else{{$classnav}}@endif" id="{{$item['id']}}">
        <a href="#">
            <i class="@if(isset($item['class'])){{$item['class']}}@endif"></i>
            <span>{{$item['name']}}</span>
             <i class="ion ion-ios7-arrow-down pull-right"></i>
         </a>
         <ul class="sub-menu-list">
         @foreach($item['menu'] as $subvalue)
            <li @if($subvalue['id']==$act['ids']['act']){{$menuact}}@endif id="{{$subvalue['name']}} "><a href="{{$subvalue['url']}}">{{$subvalue['name']}}</a></li>
         @endforeach
         </ul>
     </li>
     @endforeach
    @endforeach
</ul>
                       

