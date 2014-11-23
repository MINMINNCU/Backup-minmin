<?php

// no direct access
defined('_JEXEC') or die;

?>

    <?php $params = K2HelperUtilities::getParams('com_k2'); ?>
    <div id="container" class='container demo-7'>
      <ul class="grid effect-2" id="grid">

        <?php foreach($this->leading as $key=>$item): ?>
          <?php
            $this->item=$item;

            K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
          ?> 
            <li class='ditem'>  
             
                
                <div class='mainitem'> 
                  {modal <?php echo $this->item->link; ?>}
                    <!-- img -->
                      <?php if(!empty($this->item->image)): ?>
                        <img src="<?php echo $this->item->image; ?>"/>
                        <?php elseif (count($this->item->extra_fields)): ?>
                        <?php $extraFields = json_decode($item->extra_fields);?>
                        <img src="<?php echo $extraFields[0]->value; ?>"/>
                      <?php endif; ?>
                  {/modal}
                   <!-- Date created -->

                  <?php if($this->item->params->get('itemDateCreated')): ?>
                  <span class="itemDateCreated">
                    <?php echo JHTML::_('date', $this->item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
                  </span>
                  <?php endif; ?>
                  <!-- Quotation -->
                  <?php  

                  jimport( 'joomla.application.module.helper' );
                  $module_n = JModuleHelper::getModule( 'qlform','Quotation');
                  $params_n = $module_n->params;
                 
                  require_once(JPATH_ROOT.'/modules/mod_qlform/helper.php');
                  $obj_helper = new modQlformHelper($params_n,$module_n);
                  $quotations = $obj_helper->getQuotationByPrice($item->id);

                  if(sizeof($quotations)>0 && sizeof($quotations)>2){
                    $size=3;
                  }
                  else{
                    $size=sizeof($quotations);
                  }
                  ?>
                  <div class="itemTitle">
                  {modal <?php echo $this->item->link; ?>}<h3><?php echo $this->item->title; ?></h3>{/modal}
                  </div>

                  <div class="numOfComments">

                    <span>

                      <!-- <img id="quo" src="/minmin/templates/mynewtemplate/images/quotation.png" align=left height="16" width="16" alt="quotation"/> -->
                      <?php echo "+ ". $size ?>

                    </span> 

                  </div>

                  <div class="introtext sp">

                    <?php if($this->item->params->get('itemIntroText')): ?>
                    <!-- Item introtext -->
                    <?php echo $this->item->introtext; ?>
                 
                    <?php endif; ?>

                  </div>

                  <!-- tag -->
                  <div class='tagbox'>
                    <?php if(count($this->item->tags)):?>
                      <?php foreach ($this->item->tags as $tag): ?>
                        <span class='tag'>
                          {modal <?php echo $tag->link; ?>}<?php echo $tag->name; ?>{/modal}
                        </span>
                      <?php endforeach; ?>
                    <?php endif;?>
                  </div>

                </div><!--end main item-->

                   
              <!-- Ccomment -->

              

                <!-- K2 Comments -->
                <!-- 
                <?php 

                $limit = $this->item->params->get('commentsLimit');
                $limitstart = JRequest::getInt('limitstart', 0);
                $model = new K2ModelItem;
                $comments = $model->getItemComments($item->id, $limitstart, $limit, true);

                ?>
     -->
                <div class='comments'>
<!-- 
                  <?php for ($i = 0; $i < sizeof($comments); $i++): ?>

                    <span class="commentDate">
                      <?php echo JHTML::_('date', $comments[$i]->commentDate, JText::_('K2_DATE_FORMAT_LC2')); ?>
                    </span>
                    <?php $comments[$i]->userImage = K2HelperUtilities::getAvatar($comments[$i]->userID, $comments[$i]->commentEmail, $params->get('commenterImgWidth')); ?>
                    <?php if($comments[$i]->userImage):?>
                      <img src="<?php echo $comments[$i]->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comments[$i]->userName); ?>" width="<?php echo $this->item->params->get('commenterImgWidth'); ?>" id="userimg"/>
                    <?php endif; ?>
                    <p><?php echo $comments[$i]->commentText; ?></p>

                  <?php endfor; ?> -->


                  <!-- Quotation -->

                  <?php if($size>0): 

                  ?>
                    <?php for($i = 0; $i < $size; $i++): ?>

                    <h3>$<?php echo $quotations[$i]->quotation; ?></h3>
                    <?php echo $quotations[$i]->description; ?>
                
                    <?php endfor; ?>
                  <?php endif; ?>


                </div>
           
            </li>
          <?php endforeach; ?>
          
          
        </ul>
      </div>

    
 <script type="text/javascript">
      new AnimOnScroll( document.getElementById( 'grid' ), {
              minDuration : 0.4,
              maxDuration : 0.7,
              viewportFactor : 0.2
            } );
    </script>