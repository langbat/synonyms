<header >
    <div class="header">
        <div class="row-fluid">
            <div class="span12">
                <div class="title_header"><?php echo Yii::t('global','Sinónimo.com') ?> - <em><?php echo Yii::t('global','Thesaurus in Spanish') ?></em></div>
                <?php 
                    $Socials            = Banners::GetSocialTop();
                    $content = '';
                    foreach( $Socials as $Social ){
                       $content = $Social['content'];
                    }
                    echo $content;
                ?>
              <?php /*  <ul id="social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                </ul> */ ?>
            </div>
        </div>
    </div>

</header>