<section class="clearfix">
    <div class="row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <div class="span12">
                    <div class="logo">
                        <a href="/"><img src="/themes/default/images/logo.png" alt=""/></a>
                        <p style="margin-top: -30px !important; font-weight: bold; font-size: 25px;"> <?php  echo  Yii::t('global','Antonyms of ').$antonimos ?> </p>
                        <p style="margin-top:10px !important;"><?php echo Yii::t('global','Dictionary of synonyms online with more than 20,000 words'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row-fluid wrap_content">
                <div class="content">
                    <div class="content_search">
                        <ul class="nav nav-tabs" id="myTab">
                            <li><a href="#home"><?php echo Yii::t('global','Synonym'); ?></a></li>
                            <li ><a href="#profile"><?php echo Yii::t('global','Definition'); ?></a></li>

                            <?php foreach(Yii::app()->params['allowAntonym'] as $allowAntonnym):
                                if(Yii::app()->language == $allowAntonnym) { ?>
                                    <li class="active"><a href="#messages"><?php echo Yii::t('global','Antonym'); ?></a></li>
                                <?php } endforeach;?>
                        </ul>
            
                        <div class="tab-content">
                            <div class="tab-pane" id="home">
                              <form method="post" action="" id="form-sinonimo">
                                    <input id="buscar" type="text" class="input-large search-query" value="<?php echo (isset($antonimos))?$antonimos:'' ?>" placeholder="<?php echo Yii::t('global','Search'); ?>" name="sinonimo"/>
                                    <button type="submit" class="btn btn-search" id="btn-buscar"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane" id="profile">
                                 <form method="post" action="" id="form-definicion">
                                    <input id="definicion" type="text" class="input-large search-query" value="<?php echo (isset($antonimos))?$antonimos:'' ?>" placeholder="<?php echo Yii::t('global','Definitions'); ?>" name="definicion"/>
                                    <button type="submit" class="btn btn-search" id="btn-definicion"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane  active" id="messages">
                                  <form method="post" action="" id="form-antonimos">
                                    <input id="antonimos" type="text" class="input-large search-query antonimos_text" value="<?php echo (isset($antonimos))?$antonimos:'' ?>" placeholder="<?php echo Yii::t('global','Antonyms'); ?>" name="antonimos"/>
                                    <button type="submit" class="btn btn-search" id="btn-antonimos"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch" <?php if( $option == 1 ) { if($checksearch == 'on' ){  ?> checked ="checked" <?php } } ?>> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                        </div>
                        
                        <script>
                            $(function() {
                                $('#myTab a:last').tab('show');
                                $('#myTab a').click(function(e) {
                                    e.preventDefault();
                                    $(this).tab('show');
                                });
                                $('input[type=checkbox]').prettyCheckable({
                                    color: 'blue'
                                }); 
                                $('.close').click(function(){
                                    $('.item').hide(1000);
                                }); 
                            });

                        </script>
               <div class="resultSearch">
                    <h1 class="title_result"><?php  echo Yii::t('global','Antonyms'); ?> : </h1>
                   <div class="item showItems">
                        <?php if ( $option == 1 ){ ;
                            if(count($wordRelative->getData())>0){ ?>
                                <div class="result_bold">
                                    <?php    $this->widget('zii.widgets.CListView', array(
                                        'dataProvider'=>$wordRelative,
                                        'summaryText'=>'',
                                        'itemView'=>'../elements/antonimos',
                                    )); ?>
                                </div>
                                <script>
                                    $(".word_search a").each(function(){
                                        var key = $('.antonimos_text').val();
                                        var regex = new RegExp(key,"gi");
                                        $(this).html($(this).html().replace(regex, '<strong>'+key+'</strong>'));
                                    });

                                </script>
                            <?php } else{
                                echo '<p>'.Yii::t( 'global', 'No matches' ).'</p>';
                            ?>
                                <!--<div class="tab-pane  active" id="messages">
                                    <form method="post" action="" id="form-antonimos">
                                        <input id="antonimos" type="text" class="input-large search-query antonimos_text" value="<?php /*echo (isset($antonimos))?$antonimos:'' */?>" placeholder="<?php /*echo Yii::t('global','antónimos'); */?>" name="antonimos"/>
                                        <button type="submit" class="btn btn-search" id="btn-antonimos"><?php /*echo Yii::t('global','Search'); */?></button>
                                        <div class="wrap_checkbox"><input type="checkbox" name="checksearch" <?php /*if( $option == 1 ) { if($checksearch == 'on' ){  */?> checked ="checked" <?php /*} } */?>> <?php /*echo Yii::t('global','Que la contenga'); */?></div>
                                    </form>
                                </div>
                                <script>
                                    $('.title_result').html('<?php /*echo Yii::t('global','New search :'); */?>')
                                </script>-->
                            <?php    }
                        } else  if ( count($antonimosword) > 0 ){
                            foreach ( $antonimosword as $meaning ){
                                echo '<p>'.$meaning['word'].'</p><span class="close"></span>';  
                            } 
                        }
                        else
                              echo '<p>'.Yii::t( 'global', 'No matches' ).'</p>';
                        ?>
                    </div> 
                    <div style="margin: 10px ;"></div>
                   <div class="btn_suggest_fail">
                        <a href="/suggest/antonym/<?php echo (isset($antonimos))?$antonimos.'.html':''; ?>" class="suggest"><button class="btn btn-large btn-primary" type="button" ><?php echo Yii::t('global','Suggest Antonym'); ?></button></a>
                        <a href="/fail/antonym/<?php echo (isset($antonimos))?$antonimos.'.html':''; ?>" class="suggest"><button class="btn btn-large btn-warning" type="button"><?php echo Yii::t('global','Report a Fail'); ?></button></a>
                   </div>
                   <div class="notice_sug"></div>
               </div>
                    </div>
                    <div class="form_suggest">   </div>
                </div>
             
               <?php $this->renderPartial('../elements/advertise'); ?>
              
            </div>
        </div>
    </div>
</section>