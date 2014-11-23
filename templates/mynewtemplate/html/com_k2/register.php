
<?php
/**
 * @version	 $Id: register.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package	 K2
 * @author	 JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license	 GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<!-- K2 user register form -->
<?php if(isset($this->message)) $this->display('message'); ?>

<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" id="josForm" name="josForm" class="form-validate">
	<?php if($this->params->def('show_page_title',1)): ?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php echo $this->escape($this->params->get('page_title')); ?>
</div>
<?php endif; ?>
<div  id="k2Container" class="k2AccountPage">
<table class="admintable " cellpadding="0" cellspacing="0">
<tr>
<td>
<h3>	<?php echo JText::_('開始使用MINMIN'); ?> </h3>
</td>
</tr>
			<tr>
			
				<td>
					<input class="name" placeholder="稱號" type="text" name="<?php echo $this->nameFieldName; ?>" id="name" size="40" value="<?php echo $this->escape($this->user->get( 'name' )); ?>" class="inputbox required" maxlength="50" />
					
				</td>
			</tr>
			<tr>
				
				<td>
					<input type="text" class="registerAccount" placeholder="帳號"  id="username" name="<?php echo $this->usernameFieldName; ?>" size="40" value="<?php echo $this->escape($this->user->get( 'username' )); ?>" class="inputbox required validate-username" maxlength="25" />
					
				</td>
			</tr>
			<tr>
				
				<td>
					<input type="text"   class="registerEmail" placeholder="電子郵件"id="email" name="<?php echo $this->emailFieldName; ?>" size="40" value="<?php echo $this->escape($this->user->get( 'email' )); ?>" class="inputbox required validate-email" maxlength="100" />
					
				</td>
			</tr>
			<?php if(version_compare(JVERSION, '1.6', 'ge')): ?>
			<tr>
				
				<td>
					<input type="text"  class="registerEmail2" placeholder="確認電子郵件" id="email2" name="jform[email2]" size="40" value="" class="inputbox required validate-email" maxlength="100" />
					
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				
				<td>
					<input  class="registerPassword" placeholder="密碼"  type="password" id="password" name="<?php echo $this->passwordFieldName; ?>" size="40" value="" />
					
				</td>
			</tr>
			<tr>
				
				<td>
					<input class="registerPassword2" placeholder="確認密碼" type="password" id="password2" name="<?php echo $this->passwordVerifyFieldName; ?>" size="40" value="" />
				</td>


			</tr>
			<tr>
				<td>
					<?php echo JText::_('我已了解並同意'); ?>
					<a href="https://drive.google.com/file/d/0B5hcneiw3-hSdVdxWVZ2dGtvdnM/edit?usp=sharing" color="blue" target="_blank">MINMIN服務條款</a>

				<td>

			</tr>
			<?php if(count(array_filter($this->K2Plugins))): ?>
<!-- K2 Plugin attached fields -->
<tr>
<th colspan="2" class="k2ProfileHeading">
<?php echo JText::_('K2_ADDITIONAL_DETAILS'); ?>
</th>
</tr>
<?php foreach ($this->K2Plugins as $K2Plugin): ?>
<?php if(!is_null($K2Plugin)): ?>
<tr>
<td colspan="2">
<?php echo $K2Plugin->fields; ?>
</td>
</tr>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<!-- Joomla! 1.6+ JForm implementation -->
<?php if(isset($this->form)): ?>
<?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
<?php if($fieldset->name != 'default'): ?>
<?php $fields = $this->form->getFieldset($fieldset->name);?>
<?php if (count($fields)):?>
<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
<tr>
<th colspan="2" class="k2ProfileHeading">
<?php echo JText::_($fieldset->label);?>
</th>
</tr>
<?php endif;?>
<?php foreach($fields as $field):// Iterate through the fields in the set and display them.?>
<?php if ($field->hidden):// If the field is hidden, just display the input.?>
<tr><td colspan="2"><?php echo $field->input;?></td></tr>
<?php else:?>
<tr>
<td class="key">
<?php echo $field->label; ?>
<?php if (!$field->required && $field->type != 'Spacer'): ?>
<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL');?></span>
<?php endif; ?>
</td>
<td><?php echo $field->input;?></td>
</tr>
<?php endif;?>
<?php endforeach;?>
<?php endif;?>
<?php endif; ?>
<?php endforeach;?>
<?php endif; ?>
<tr>
<td>
<div class="k2AccountPageUpdate">
<button class="buttonRegister" id="register" type="submit">
<?php echo JText::_('馬上註冊'); ?>
</button>
</div>
</td>
</tr>
</table>
<?php if($this->K2Params->get('recaptchaOnRegistration') && $this->K2Params->get('recaptcha_public_key')): ?>
<label class="formRecaptcha"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label>
<div id="recaptcha"></div>
<?php endif; ?>
</div>
<input type="hidden" name="option" value="<?php echo $this->optionValue; ?>" />
<input type="hidden" name="task" value="<?php echo $this->taskValue; ?>" />
<input type="hidden" name="id" value="0" />
<input type="hidden" name="gid" value="0" />
<input type="hidden" name="K2UserForm" value="1" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>
