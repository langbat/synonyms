<section class="clearfix">
    <div class="row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <div class="span12">
                    <div class="logo">
                        <a href="/"><img src="/themes/default/images/logo.png" alt=""/></a>
                        <p style="margin-top: -30px !important; font-weight: bold; font-size: 25px;"> <?php  echo  Yii::t('global','Definitions of ').$definicion ?> </p>
                        <p style="margin-top:10px !important;"><?php echo Yii::t('global','Dictionary of synonyms online with more than 20,000 words'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row-fluid wrap_content">
                <div class="content">
                    <div class="content_search">
                        <ul class="nav nav-tabs" id="myTab">
                            <li><a href="#home"><?php echo Yii::t('global','Synonym'); ?></a></li>
                            <li class="active"><a href="#profile"><?php echo Yii::t('global','Definition'); ?></a></li>
                            <?php foreach(Yii::app()->params['allowAntonym'] as $allowAntonnym):
                                if(Yii::app()->language == $allowAntonnym) { ?>
                                    <li><a href="#messages"><?php echo Yii::t('global','Antonym'); ?></a></li>
                                <?php } endforeach;?>
                        </ul>
            
                        <div class="tab-content">
                            <div class="tab-pane" id="home">
                             <form method="post" action="" id="form-sinonimo">
                                    <input id="buscar" type="text" class="input-large search-query" value="<?php echo (isset($definicion))?$definicion:'' ?>" placeholder="<?php echo Yii::t('global','Search'); ?>" name="sinonimo"/>
                                    <button type="submit" class="btn btn-search" id="btn-buscar"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch" > <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane active" id="profile">
                                 <form method="post" action="" id="form-definicion">
                                    <input id="definicion" type="text" class="input-large search-query definition_text" value="<?php echo (isset($definicion))?$definicion:'' ?>" placeholder="<?php echo Yii::t('global','Definitions'); ?>" name="definicion"/>
                                    <button type="submit" class="btn btn-search" id="btn-definicion"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch" <?php if( $option == 1 ) { if($checksearch == 'on' ){  ?> checked ="checked" <?php } } ?>> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane" id="messages">
                                 <form method="post" action="" id="form-antonimos">
                                    <input id="antonimos" type="text" class="input-large search-query" value="<?php echo (isset($definicion))?$definicion:'' ?>" placeholder="<?php echo Yii::t('global','Antonym'); ?>" name="antonimos"/>
                                    <button type="submit" class="btn btn-search" id="btn-antonimos"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                        </div>
  
                        <script>
                            $(function() {
                                $('#myTab a[href="#profile"]').tab('show');
                                $('#myTab a').click(function(e) {
                                    e.preventDefault();
                                    $(this).tab('show');
                                });
                                $('input[type=checkbox]').prettyCheckable({
                                    color: 'blue'
                                }); 
                                
                                //$('.close').click(function(){
//                                    $('.item').hide(1000);
//                                });  
                            });
                            function deleteElement( id )
                            {
                                $('.delete-element'+id).hide(1000);
                            }    
                        </script>
               <div class="resultSearch">
                    <h1 class="title_result"><?php  echo Yii::t('global','Definitions'); ?> : </h1>
                   <div class="item showItems">
                        <?php if ( $option == 1 ){ ;
                            if(count($wordRelative->getData())>0){ ?>
                                <div class="result_bold">
                                    <?php    $this->widget('zii.widgets.CListView', array(
                                        'dataProvider'=>$wordRelative,
                                        'summaryText'=>'',
                                        'itemView'=>'../elements/definition',
                                    )); ?>
                                </div>
                                <script>
                                    $(".word_search a").each(function(){
                                        var key = $('.definition_text').val();
                                        var regex = new RegExp(key,"gi");
                                        $(this).html($(this).html().replace(regex, '<strong>'+key+'</strong>'));
                                    });

                                </script>
                            <?php } else{
                                echo '<p>'.Yii::t( 'global', 'No matches' ).'</p>';
                                ?>
                                <!--<div class="tab-pane active" id="profile">
                                    <form method="post" action="" id="form-definicion">
                                        <input id="definicion" type="text" class="input-large search-query" value="" placeholder="<?php /*echo (isset($definicion))?$definicion:Yii::t('global','definición'); */?>" name="definicion"/>
                                        <button type="submit" class="btn btn-search" id="btn-definicion"><?php /*echo Yii::t('global','Search'); */?></button>
                                        <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php /*echo Yii::t('global','Que la contenga'); */?></div>
                                    </form>
                                </div>
                                <script>
                                    $('.title_result').html('<?php /*echo Yii::t('global','New search :'); */?>')
                                </script>-->
                            <?php    }
                        } else  if ( count($definicionword) > 0 ){
                            $i = 0;
                            foreach ( $definicionword as $meaning ){
                                echo '<span class="delete-element'.$i.'"> <div class="item"><p>'.$meaning['definition'].'</p><span class="close" onclick="deleteElement('.$i.')"></span> </div> </span>';  
                                $i++;
                            } 
                        }
                        else
                              echo '<div class="item"><p>'.Yii::t( 'global', 'No matches' ).'</p></div>';
                        ?>
                   </div>
                    <div style="margin: 10px ;"></div>
                   <div class="btn_suggest_fail">
                        <a href="/suggest/definition/<?php echo (isset($definicion))?$definicion.'.html':''; ?>" class="suggest"><button class="btn btn-large btn-primary" type="button"><?php echo Yii::t('global','Suggest definition'); ?></button></a>
                        <a href="/fail/definition/<?php echo (isset($definicion))?$definicion.'.html':''; ?>" class="suggest"> <button class="btn btn-large btn-warning" type="button"><?php echo Yii::t('global','Report a Fail'); ?></button></a>
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