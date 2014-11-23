<?php
/**
 * @version		$Id: itemform.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addScriptDeclaration("
	Joomla.submitbutton = function(pressbutton){
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (\$K2.trim(\$K2('#title').val()) == '') {
			alert( '".JText::_('K2_ITEM_MUST_HAVE_A_TITLE', true)."' );
		}
		else if (\$K2.trim(\$K2('#catid').val()) == '0') {
			alert( '".JText::_('K2_PLEASE_SELECT_A_CATEGORY', true)."' );
		}
		else {
			syncExtraFieldsEditor();
			var validation = validateExtraFields();
			if(validation === true) {
				\$K2('#selectedTags option').attr('selected', 'selected');
				submitform( pressbutton );
			}
		}
	}
");

?>

<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">
	<?php if($this->mainframe->isSite()): ?>
	<div id="k2FrontendContainer">
		<div id="k2Frontend">
			
			<?php endif; ?>
			
			<table cellspacing="0" cellpadding="0" border="0" class="adminFormK2Container table">
				<tbody>
					<tr>
						<td>
							<table class="adminFormK2">
								<!-- title -->
								<tr>
									<td class="adminK2LeftCol">
										<label for="title"><?php echo JText::_('標題'); ?></label>
									</td>
									<td class="adminK2RightCol">
										<input class="text_area k2TitleBox" type="text" name="title" id="title" maxlength="250" value="<?php echo $this->row->title; ?>" />
									</td>
								</tr>
								<!-- title url -->
								<tr style='display:none'>
									<td class="adminK2LeftCol">
										<label for="alias"><?php echo JText::_('K2_TITLE_ALIAS'); ?></label>
									</td>
									<td class="adminK2RightCol">
										<input class="text_area k2TitleAliasBox" type="text" name="alias" id="alias" maxlength="250" value="<?php echo $this->row->alias; ?>" />
									</td>
								</tr>
								<!-- category -->
								<tr style='display:none;'>
									<td class="adminK2LeftCol">
										<label><?php echo JText::_('K2_CATEGORY'); ?></label>
									</td>
									<td class="adminK2RightCol">
										<?php echo $this->lists['categories']; ?>
									</td>
								</tr>
								<!-- tag -->
								<tr>
									<td class="adminK2LeftCol">
										<label><?php echo JText::_('TAG'); ?></label>
									</td>
									<td class="adminK2RightCol">
										<?php if($this->params->get('taggingSystem')): ?>
										<!-- Free tagging -->
										<ul class="tags">
											<?php if(isset($this->row->tags) && count($this->row->tags)): ?>
											<?php foreach($this->row->tags as $tag): ?>
											<li class="tagAdded">
												<?php echo $tag->name; ?>
												<span title="<?php echo JText::_('K2_CLICK_TO_REMOVE_TAG'); ?>" class="tagRemove">x</span>
												<input type="hidden" name="tags[]" value="<?php echo $tag->name; ?>" />
											</li>
											<?php endforeach; ?>
											<?php endif; ?>
											<li class="tagAdd">
												<input type="text" id="search-field" />
											</li>
											<li class="clr"></li>
										</ul>
										<span class="k2Note"> <?php echo JText::_('按ENTER鍵即可建立TAG'); ?> </span>
										<?php else: ?>
										<!-- Selection based tagging -->
										<?php if( !$this->params->get('lockTags') || $this->user->gid>23): ?>
										<div style="float:left;">
											<input type="text" name="tag" id="tag" />
											<input type="button" id="newTagButton" value="<?php echo JText::_('K2_ADD'); ?>" />
										</div>
										<div id="tagsLog"></div>
										<div class="clr"></div>
										<span class="k2Note"> <?php echo JText::_('K2_WRITE_A_TAG_AND_PRESS_ADD_TO_INSERT_IT_TO_THE_AVAILABLE_TAGS_LISTNEW_TAGS_ARE_APPENDED_AT_THE_BOTTOM_OF_THE_AVAILABLE_TAGS_LIST_LEFT'); ?> </span>
										<?php endif; ?>
										<table cellspacing="0" cellpadding="0" border="0" id="tagLists">
											<tr>
												<td id="tagListsLeft">
													<span><?php echo JText::_('K2_AVAILABLE_TAGS'); ?></span> <?php echo $this->lists['tags'];	?>
												</td>
												<td id="tagListsButtons">
													<input type="button" id="addTagButton" value="<?php echo JText::_('K2_ADD'); ?> &raquo;" />
													<br />
													<br />
													<input type="button" id="removeTagButton" value="&laquo; <?php echo JText::_('K2_REMOVE'); ?>" />
												</td>
												<td id="tagListsRight">
													<span><?php echo JText::_('K2_SELECTED_TAGS'); ?></span> <?php echo $this->lists['selectedTags']; ?>
												</td>
											</tr>
										</table>
										<?php endif; ?>
									</td>
								</tr>
								<!-- tag end -->
								<!-- published -->
								<?php if($this->mainframe->isAdmin() || ($this->mainframe->isSite() && $this->permissions->get('publish'))): ?>						
								<tr style='display:none'>
									<td class="adminK2LeftCol">
										<label><?php echo JText::_('K2_PUBLISHED'); ?></label>
									</td>
									<td class="adminK2RightCol">
										<?php echo $this->lists['published']; ?>
									</td>
								</tr>
								<?php endif; ?>
								<!-- published end-->
							</table>
							<ul id="k2ExtraFieldsValidationResults"></ul>
							<!-- image upload -->
							<table class="admintable">
								<tr>
									<td align="right" class="key">
										<?php echo JText::_('上傳圖片'); ?>
									</td>
									<td>
										<input type="file" name="image" class="fileUpload" />
										<i>(<?php echo JText::_('K2_MAX_UPLOAD_SIZE'); ?>: <?php echo ini_get('upload_max_filesize'); ?>)</i>
										<br />
										<br />
									</td>
								</tr>
								
								<?php if (!empty($this->row->image)): ?>
								<tr>
									<td align="right" class="key">
										<?php echo JText::_('K2_ITEM_IMAGE_PREVIEW'); ?>
									</td>
									<td>
										<a class="modal" rel="{handler: 'image'}" href="<?php echo $this->row->image; ?>" title="<?php echo JText::_('K2_CLICK_ON_IMAGE_TO_PREVIEW_IN_ORIGINAL_SIZE'); ?>">
											<img alt="<?php echo $this->row->title; ?>" src="<?php echo $this->row->thumb; ?>" class="k2AdminImage" />
										</a>
										<input type="checkbox" name="del_image" id="del_image" />
										<label for="del_image"><?php echo JText::_('K2_CHECK_THIS_BOX_TO_DELETE_CURRENT_IMAGE_OR_JUST_UPLOAD_A_NEW_IMAGE_TO_REPLACE_THE_EXISTING_ONE'); ?></label>
									</td>
								</tr>
								<?php endif; ?>
							</table>
							<?php if (count($this->K2PluginsItemImage)): ?>
							<div class="itemPlugins">
								<?php foreach($this->K2PluginsItemImage as $K2Plugin): ?>
								<?php if(!is_null($K2Plugin)): ?>
								<fieldset>
									<legend><?php echo $K2Plugin->name; ?></legend>
									<?php echo $K2Plugin->fields; ?>
								</fieldset>
								<?php endif; ?>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
							<!-- image URL -->
								<div id="extraFieldsContainer">
										<?php if (count($this->extraFields)): ?>
										<table class="admintable" id="extraFields">
											<?php foreach($this->extraFields as $extraField): ?>
											<?php if($extraField->type == 'header'): ?>
											<tr>
												<td colspan="2" ><h4 class="k2ExtraFieldHeader"><?php echo $extraField->name; ?></h4></td>
											</tr>												
											<?php else: ?>
											<tr>
												<td align="right" class="key">
													<label for="K2ExtraField_<?php echo $extraField->id; ?>"><?php echo $extraField->name; ?></label>
												</td>
												<td>
													<?php echo $extraField->element; ?>
												</td>
											</tr>
											<?php endif; ?>
											<?php endforeach; ?>
										</table>
										<?php else: ?>
											<?php if (K2_JVERSION == '15'): ?>
												<dl id="system-message">
													<dt class="notice"><?php echo JText::_('K2_NOTICE'); ?></dt>
													<dd class="notice message fade">
														<ul>
															<li><?php echo JText::_('K2_PLEASE_SELECT_A_CATEGORY_FIRST_TO_RETRIEVE_ITS_RELATED_EXTRA_FIELDS'); ?></li>
														</ul>
													</dd>
												</dl>
											<?php elseif (K2_JVERSION == '25'): ?>
											<div id="system-message-container">
												<dl id="system-message">
													<dt class="notice"><?php echo JText::_('K2_NOTICE'); ?></dt>
													<dd class="notice message">
														<ul>
															<li><?php echo JText::_('K2_PLEASE_SELECT_A_CATEGORY_FIRST_TO_RETRIEVE_ITS_RELATED_EXTRA_FIELDS'); ?></li>
														</ul>
													</dd>
												</dl>
											</div>
											<?php else: ?>
											<div class="alert">
												<h4 class="alert-heading"><?php echo JText::_('K2_NOTICE'); ?></h4>
												<div>
													<p><?php echo JText::_('K2_PLEASE_SELECT_A_CATEGORY_FIRST_TO_RETRIEVE_ITS_RELATED_EXTRA_FIELDS'); ?></p>
												</div>
											</div>
											<?php endif; ?>
										<?php endif; ?>
									</div>
									<?php if (count($this->K2PluginsItemExtraFields)): ?>
									<div class="itemPlugins">
										<?php foreach($this->K2PluginsItemExtraFields as $K2Plugin): ?>
										<?php if(!is_null($K2Plugin)): ?>
										<fieldset>
											<legend><?php echo $K2Plugin->name; ?></legend>
											<?php echo $K2Plugin->fields; ?>
										</fieldset>
										<?php endif; ?>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
				<table class="k2FrontendToolbar" cellpadding="2" cellspacing="4">
				<tr>
					<td id="toolbar-save" class="button">
						<a class="toolbar" href="#" onclick="Joomla.submitbutton('save'); return false;"> <span title="<?php echo JText::_('張貼需求'); ?>" class="icon-32-save icon-save"></span> <?php echo JText::_('PO需求'); ?> </a>
					</td>
				
				</tr>
			</table>
			<?php if(!$this->permissions->get('publish')): ?>
			<div id="k2FrontendPermissionsNotice">
				<p><?php echo JText::_('K2_FRONTEND_PERMISSIONS_NOTICE'); ?></p>
			</div>
			<?php endif; ?>

							
							<input type="hidden" name="isSite" value="<?php echo (int)$this->mainframe->isSite(); ?>" />
							<?php if($this->mainframe->isSite()): ?>
							<input type="hidden" name="lang" value="<?php echo JRequest::getCmd('lang'); ?>" />
							<?php endif; ?>
							<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
							<input type="hidden" name="option" value="com_k2" />
							<input type="hidden" name="view" value="item" />
							<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
							<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>" />
							<?php echo JHTML::_('form.token'); ?>
						</td>
						
					</tr>
				</tbody>
			</table>
			<div class="clr"></div>
			<?php if($this->mainframe->isSite()): ?>
		</div>
	</div>
	<?php endif; ?>
</form>
<script type="text/javascript" >
//disable alert
alert = function() {};
</script>>