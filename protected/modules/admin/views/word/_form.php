
<div class="block-fluid">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'word-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php
    echo $form->errorSummary($model);
    $meanings = Meaning::model()->getMeaning();
    ?>

    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model, 'word'); ?>
        </div>
        <div class="span9">
<?php echo $form->textField($model, 'word', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($model, 'word'); ?>
        </div>
    </div>
    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model, 'meaning'); ?>
        </div>
        <div class="span9">
<?php $currentMean = ($model->id) ? WordMeanings::model()->getMeanById($model->id) : '' ?>
            <input name="Word[meaning]" id="mySingleField" value="<?php echo implode("#", ($currentMean) ? $currentMean : '' ); ?>" type="hidden">
            <ul id="allowSpacesTags"></ul>

        </div>
    </div>
    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model, 'definition'); ?>
        </div>
        <div class="span9">
<?php $currentDef = ($model->id) ? Definition::model()->getDefinitionById($model->id) : ''; ?>
            <input name="Word[definition]" id="definition" value="<?php echo implode("#", ($currentDef) ? $currentDef : '' ); ?>" type="hidden">
            <ul id="definitionWrite"></ul>

        </div>
    </div>

    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model, 'antonyms'); ?>
        </div>
        <div class="span9">
            <?php
            $criteria  = new CDbCriteria();
            if($model->id){
                $criteria->condition='id  NOT IN ('.$model->id.') ';
            }
            $antonyms = Word::model()->findAll($criteria);

            foreach ($antonyms as $item){
                $wordAnt[$item['id']]=$item['word'];
            }
            ?>

            <?php echo $form->dropDownList($model,'id_antonyms',$wordAnt,array('prompt'=>Yii::t('global','Select antonyms'))); ?>

        </div>
    </div>
    <div class="footer tar">
    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global', 'Create') : Yii::t('global', 'Save'), array('class' => 'btn')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(function() {

        var meaning = [<?php echo "'" . implode("','", ($meanings) ? $meanings : array(0) ) . "'" ?>];


        $('#allowSpacesTags').tagit({
            availableTags: meaning,
            allowSpaces: true,
            singleField: true,
            singleFieldNode: $('#mySingleField')
        });

        $('#definitionWrite').tagit({
            allowSpaces: true,
            singleField: true,
            singleFieldNode: $('#definition')
        });
        $('#removeConfirmationTags').tagit({
            availableTags: meaning,
            removeConfirmation: true
        });

    });
</script>