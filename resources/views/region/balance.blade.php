<?php
$numtab = 0;
?>
<div class="tab-content">
@foreach($data as $res=>$val)
<?php $x = 0; ?>
<div class="tab-pane <?php if(isset($act_tab))
                              if($numtab==$act_tab)
                                  echo 'active' ?>"
                     id="tab_<?php echo $numtab?>">
    @foreach($val as $key=>$item)
    <?php if ($x == 2) echo '<div class="row">' ?>
    <div class="col-md-4">
        <div class="panel panel-plain">
            <div class="panel-heading">
                <h3 class="panel-title">{{$key}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-no-border">
                    <thead>
                    <tr>
                        <th>
                            Подстанция
                        </th>
                        <th>
                            Пред. день
                        </th>
                        <th>
                            Пред. месяц
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($item as $value)
                    <tr>
                        <td>{{ $value->name}}</td>
                        <td style="color:#006bff;">{{$value->d_value}}
                             <span style="color:<?php if (round(abs($value->m_percent)) > 5) echo 'red'; else echo '#ff6a00'; ?>">({{$value->d_percent}}%)</span>
                        </td>
                        <td style="color:#006bff"><?php echo $value->m_value ?>
                            <span style="color:<?php if (round(abs($value->m_percent)) > 5) echo 'red'; else echo '#ff6a00'; ?>">({{$value->m_percent}}%)</span>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if ($x == 2) {
        echo '</div>';
        $x = 0;
    } else $x++ ?>
    @endforeach
</div>
<?php $numtab++ ?>
@endforeach
</div>