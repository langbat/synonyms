<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Words'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Words'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('word/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Word'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php
    $columns=array();

    $columns[]=array(
        'name'=>'word',
        'value'=>'ucfirst($data->word)'
    );
    $columns[]=array(
        'name'=>'meaning',
        'value'=>'$data->getMeaning($data->id)'
    );
    $columns[]=array(
        'name'=>'id_antonyms',
        'value'=>'$data->getAntonym($data->id_antonyms)'
    );
    $allLang = Languages::model()->findAll();
    foreach( $allLang as $key => $value ){
        $columns[]  = array(
            'header' => '<div align="center"><img src="/uploads/flag/'.$value['icon'].'" /></div>',
            'value' => '$data->languageButton($data->alias,"'.$value['id'].'","'.$value['region_code'].'")' ,
            'type' => 'raw',
            'htmlOptions'=>array( 'style'=>'text-align: center' )
        );
    }
    $columns[] = array(
        'class'=>'CButtonColumn',
        'template'=>'{delete}',
    );
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'word-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=> $columns
    ));
    ?>
</div>
</div></div>