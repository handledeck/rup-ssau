<style>
    li.dropdown:hover a.dropdown-toggle{
        border-bottom:3px solid #ff6a00;!important;
        background-color:transparent;
        cursor:pointer;
        color:#ff6a00;
    }
    li.dropdown:active a.dropdown-toggle{
        border-bottom:3px solid #ff6a00;!important;
        background-color:transparent;
        
    }
   
</style>
<?php
$numb=0;
function GetResName($res){
    if($res=='ВЭС')
        return 'Витебские ЭС';
    else if($res=='ОЭС')
        return 'Оршанские ЭС';
    else if($res=='ПЭС')
        return 'Полоцкие ЭС';
    else if($res=='ГЭС')
        return 'Глубокские ЭС';
}
?>

@foreach($data as $res=>$val)
<li class="dropdown <?php if(isset($act_tab))
                              if($numb==$act_tab)
                                  echo ' active' ?>">
    <a class="dropdown-toggle" id="<?php echo'tab_id_'.$numb?>" href="#tab_<?php echo $numb++ ?>" data-toggle="tab" style="float:right"><?php echo GetResName($res)?></a>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="float:right;z-index: 2">
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" style="min-width:700px">
        <?php $i = 0; ?>
        @foreach($data[$res] as $key=>$item)
        <?php if ($i == 0) echo '<div class="row">' ?>
        <div class="col-sm-4">
            <ul class="multi-column-dropdown">
                <span>{{$key}}</span>
                <li class="divider"></li>
                @foreach($item as $value)
                <li><a style="font-size:13px" href="region?station={{$value->id}}&date=&act_tab={{($numb-1)}}">{{$value->title}}</a></li>
                @endforeach
            </ul>
        </div>
        <?php if ($i == 2) {
            echo '</div>';
            $i = 0;
        } else $i++ ?>
        @endforeach
    </ul>
</li>
@endforeach