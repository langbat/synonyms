  
<section class="clearfix">
    <div class="row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <div class="span12">
                    <div class="logo">
                        <a href="/"><img src="/themes/default/images/logo.png" alt=""/></a>
                        <p style="margin-top: -30px !important; font-weight: bold; font-size: 25px;"> <?php echo Yii::t('global', 'Antonyms of ') . $antonimos ?> </p>
                        <p style="margin-top:10px !important;"><?php echo Yii::t('global', 'Dictionary of synonyms online with more than 20,000 words'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row-fluid wrap_content">
                <div class="content">
                    <div class="content_search">
                        <ul class="nav nav-tabs" id="myTab">
                            <li><a href="#home"><?php echo Yii::t('global', 'Synonym'); ?></a></li>
                            <li ><a href="#profile"><?php echo Yii::t('global', 'Definition'); ?></a></li>
                            <?php foreach(Yii::app()->params['allowAntonym'] as $allowAntonnym):
                                if(Yii::app()->language == $allowAntonnym) { ?>
                                    <li class="active"><a href="#messages"><?php echo Yii::t('global', 'Antonym'); ?></a></li>
                                <?php } endforeach;?>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" id="home">
                                <form method="post" action="" id="form-sinonimo">
                                    <input id="buscar" type="text" class="input-large search-query" value="" placeholder="<?php echo Yii::t('global', 'Search'); ?>" name="sinonimo"/>
                                    <button type="submit" class="btn btn-search" id="btn-buscar"><?php echo Yii::t('global', 'Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global', 'Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane" id="profile">
                                <form method="post" action="" id="form-definicion">
                                    <input id="definicion" type="text" class="input-large search-query" value="" placeholder="<?php echo Yii::t('global', 'Definitions'); ?>" name="definicion"/>
                                    <button type="submit" class="btn btn-search" id="btn-definicion"><?php echo Yii::t('global', 'Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global', 'Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane  active" id="messages">
                                <form method="post" action="" id="form-antonimos">
                                    <input id="antonimos" type="text" class="input-large search-query antonimos_text" value="<?php echo (isset($antonimos)) ? $antonimos : '' ?>" placeholder="<?php echo Yii::t('global', 'Antonyms'); ?>" name="antonimos"/>
                                    <button type="submit" class="btn btn-search" id="btn-antonimos"><?php echo Yii::t('global', 'Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch" <?php
if ($option == 1) {
    if ($checksearch == 'on') {
       ?> checked ="checked" <?php
                                                                  }
                                                              }
?>> <?php echo Yii::t('global', 'Containing it'); ?></div>
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
                            <h1 class="title_result"><?php echo Yii::t('error', Yii::app()->controller->action->id); ?> : </h1>
                            <div class="item showItems">  
                                <?php if ($error['code'] == 404): ?>
                                    <p><?php echo Yii::t('error', 'Sorry, But the page you were looking for was not found.'); ?></p>
                                <?php elseif ($error['code'] == 403): ?>	
                                    <p><?php echo Yii::t('error', 'Sorry, But you are not authorized to view this page.'); ?></p>
                                <?php else: ?>	
                                    <p><?php echo $error['message']; ?></p>
                                <?php endif; ?>
                            </div>  
                        </div>
                    </div>
                </div>

                <?php $this->renderPartial('../elements/advertise'); ?>

            </div>
        </div>
    </div>
</section>  