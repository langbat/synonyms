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
 <div id="container-list-anpha" <?php if( $optionlist == 1 ){ echo ''; } else { ?> style="display: none;" <?php } ?> >
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
 <?php if( $optionlist == 1 ){ echo ''; } else { ?> <div class="link_bottom"><a href="/listapalabras.html "><?php echo Yii::t('global','List of words'); ?></a></div> <?php } ?>

