<div class="result result_suggest">
    <h1><?php echo Yii::t('suggest',"Suggest a")." ".Yii::t('suggest',$search) ?> </h1>

    <?php //echo CHtml::form($this->createUrl('/'.$type.'/'.$search), 'post', array('class'=>'frmsuggest', 'id'=>'validation2')); ?>
    <?php /*$form=$this->beginWidget('CActiveForm', array(
        'id'=>'validation',
        'enableAjaxValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); */?>

    <div class="control-group">
        <label class="control-label" for="inputEmail"><?php echo Yii::t('global','User Email') ?> <span class="required">*</span> </label>
        <div class="controls">
            <input type="text" id="inputEmail" placeholder="Email" name="SuggestForm[email]" >
            <div class="error errorEmail"></div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputSuggestion"><?php echo Yii::t('global','Suggestion') ?> <span class="required">*</span></label>
        <div class="controls">
            <textarea id="suggestion"  rows="5" cols="179" name="SuggestForm[suggest]" ></textarea>
            <div class="error errorContent"></div>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-info submit_btn"><?php echo Yii::t('global','Submit') ?></button>
            <button type="reset" class="btn btn-danger reset cancel_btn"><?php echo Yii::t('global','Cancel') ?></button>
        </div>
    </div>
    <input type="hidden" class="searched" value="<?php echo $searched ?>"/>
    <input type="hidden" class="search" value="<?php echo $search ?>"/>
    <input type="hidden" class="type" value="<?php echo $type ?>"/>
    <?php //$this->endWidget(); ?>
</div>
<script>
    $(document).ready(function(){
        $('.cancel_btn').click(function(){
            $('.btn_suggest_fail').css('display','block');
            $('.form_suggest').css('display','none');
        });

        $('.submit_btn').click(function(){
            var email = $('#inputEmail').val();
            var content = $('#suggestion').val();
            if(email != '') {
                var checkEmail = validateEmail(email);
                if(checkEmail !=true){
                    $('.errorContent').html('');
                    $('.errorEmail').html('<?php echo Yii::t("global","Email is invalid") ?>');
                } else if(content !=''){
                        $('.errorEmail').html('');
                        $('.errorContent').html('');
                        var searched = $('.searched').val();
                        var search = $('.search').val();
                        var type = $('.type').val();
                        $.get('/index/saveSuggest?searched='+searched+'&search='+search+'&type='+type+'&email='+email+'&content='+content,function(html){
                            $('.btn_suggest_fail').css('display','block');
                            $('.form_suggest').css('display','none');
                            $('.notice_sug').html(html);
                            setTimeout(function() {
                                $('.notice_sug').html('');
                            }, 3000);

                         })
                } else {
                    $('.errorEmail').html('');
                    $('.errorContent').html('<?php echo Yii::t("global","Please fill in the required information") ?>')
                }
            } else {
                $('.errorContent').html('');
                $('.errorEmail').html('<?php echo Yii::t("global","Please fill in the required information") ?>')
            }

            /*$.post('/suggest',function(){

            })*/
        })
    });
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>
