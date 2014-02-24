<?php $this->widget('widgets.admin.notifications'); ?>
<section class="clearfix">
    <div class="row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <div class="span12">
                    <div class="logo">
                        <a href="/"><img src="/themes/default/images/logo.png" alt=""/></a>
                        <p><?php echo Yii::t('global','Dictionary of synonyms online with more than 20,000 words'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row-fluid wrap_content">
                <div class="content">
                    <div class="content_search">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#home"><?php echo Yii::t('global','Synonym'); ?></a></li>
                            <li><a href="#profile"><?php echo Yii::t('global','Definition'); ?></a></li>
                            <?php foreach(Yii::app()->params['allowAntonym'] as $allowAntonnym):
                                if(Yii::app()->language == $allowAntonnym) { ?>
                                    <li><a href="#messages"><?php echo Yii::t('global','Antonym'); ?></a></li>
                                <?php } endforeach;?>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <form method="post" action="" id="form-sinonimo">
                                    <input id="buscar" type="text" class="input-large search-query" value="" placeholder="<?php echo Yii::t('global','Search'); ?>" name="sinonimo"/>
                                    <button type="submit" class="btn btn-search" id="btn-buscar"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane" id="profile">
                                <form method="post" action="" id="form-definicion">
                                    <input id="definicion" type="text" class="input-large search-query" value="" placeholder="<?php echo Yii::t('global','Definitions'); ?>" name="definicion"/>
                                    <button type="submit" class="btn btn-search" id="btn-definicion"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                            <div class="tab-pane" id="messages">
                                <form method="post" action="" id="form-antonimos">
                                    <input id="antonimos" type="text" class="input-large search-query" value="" placeholder="<?php echo Yii::t('global','Antonyms'); ?>" name="antonimos"/>
                                    <button type="submit" class="btn btn-search" id="btn-antonimos"><?php echo Yii::t('global','Search'); ?></button>
                                    <div class="wrap_checkbox"><input type="checkbox" name="checksearch"> <?php echo Yii::t('global','Containing it'); ?></div>
                                </form>
                            </div>
                        </div>
                        <script>
                            $(function() {
                                $('#myTab a:first').tab('show');
                                $('#myTab a').click(function(e) {
                                    e.preventDefault();
                                    $(this).tab('show');
                                    $('.result_search').html('');
                                });
                                $('input[type=checkbox]').prettyCheckable({
                                    color: 'blue'
                                });

                            });

                        </script>
                    </div>
                </div>
                <div class="banner">
                    <?php
                    error_reporting(0);
                    $advertises = Banners::GetAdvertise(1);
                    foreach ( $advertises as $advertise ){
                        $Advertisefd = $advertise;
                    }
                    if( $Advertisefd['type'] == Banners::TYPE_IMAGE )
                        echo '<a rel="nofollow" target="_blank" href="'.$Advertisefd['link'].'">
				<img src="/uploads/banner/'.$Advertisefd['filename'].'">
	           </a>';
                    else if ( $Advertisefd['type'] == Banners::TYPE_CONTENT )
                        echo $Advertisefd['content'];

                    ?>

                </div>

                <?php
                $listAnphas = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","Ñ", "O", "P","Q", "R","S","T","U","V","W","X","Y","Z");
                ?>
                <div id="container-list-anpha" <?php if( $optionlist == 1 ){ echo ''; } else { ?> <?php } ?> >
                    <h2><?php echo Yii::t('global','List of synonyms'); ?></h2>
                    <nav id="links">
                        <ul class="clearfix">
                            <?php
                            foreach ( $listAnphas as $key=>$listAnpha){  ?>
                                <li <?php if( $listAnpha == $alpha || ( $listAnpha == 'Ñ' && $alpha =='Nn' ) ) { ?> class='active-list-anpha' <?php } ?> ><a href="/listapalabras/<?php  echo Word::SeoUrlTitle($listAnpha); ?>.html" ><?php echo $listAnpha; ?> </a></li>
                            <?php   }
                            ?>
                        </ul>
                    </nav>

                    <?php
                    $totalList = count($wordAnpha);
                    $checkNull = array_filter($wordAnpha);
                    $i = 1;
                    if( $totalList > 0 ){
                        foreach ($wordAnpha as $wordLi ){
                            echo '<span class="wordAnpha"> <a href="/sinonimo/'.Word::SeoUrlTitle($wordLi['word']).'.html">'.$wordLi['word'].'</a></span>';
                            if ( $i % 4 == 0 )
                                echo '<div class="breaklinenew" style"height:15px;"></div>';
                            $i++;
                        }
                        ?>
                    <?php } else if(!empty($checkNull))
                        echo Yii::t( 'global', 'No matches' );
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>
