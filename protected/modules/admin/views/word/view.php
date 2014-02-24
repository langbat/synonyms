<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
        <small><?php echo Yii::t('global', 'Word'); ?> <?php echo $model->word; ?></small></h1>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Word'); ?> <?php echo $model->word; ?></small></h1>
            <ul class="buttons">
                <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
            </ul> 
        </div> 
        <ul class="rows" id="yw0">
            <!--<li class=""><div class="title"><?php /*echo Yii::t('global','ID') */?></div><div class="text">#<?php /*echo $model->id; */?></div></li>-->
            <li class=""><div class="title"><?php echo Yii::t('global','Word') ?></div><div class="text"><?php echo $model->word; ?></div></li>
            <li class=""><div class="title"><?php echo Yii::t('global','Meaning') ?></div><div class="text"><?php echo $model->getMeaning($model->id); ?></div></li>
            <li class=""><div class="title"><?php echo Yii::t('global','Definition') ?></div><div class="text fix-null"><?php echo $model->getDefinition($model->id); ?></div></li>
            <li class=""><div class="title"><?php echo Yii::t('global','Antonyms') ?></div><div class="text fix-null"><?php echo $model->getAntonym($model->id_antonyms); ?></div></li>
        </ul>
    </div>
</div>