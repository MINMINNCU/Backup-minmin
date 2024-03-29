<?php
/***************************************************************
*  Copyright notice
*
*  Copyright 2010 Daniel Dimitrov. (http://compojoom.com)
*  All rights reserved
*
*  This script is part of the Compojoom Comment project. The Compojoom Comment project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

defined('_JEXEC') or die('Restricted access');

?>
<div class="row-fluid">
	<?php $fieldsets = $this->form->getFieldsets('basic'); ?>
	<?php foreach ($fieldsets as $key => $value) : ?>
		<div class="span6">
			<h3><?php echo JText::_($value->label); ?></h3>

			<?php $fields = $this->form->getFieldset($key); ?>

			<?php foreach ($fields as $field) : ?>

				<?php
				$pro = '';
				if (!CCOMMENT_PRO)
				{
					$fieldClass = $this->form->getFieldAttribute($field->fieldname, 'class', '', 'general');
					if (strstr($fieldClass, 'ccomment-pro'))
					{
						$pro = '<span class="ccomment-pro">*</span>';
					}
				}
				?>
				<div class="control-group">
					<div class="control-label">
						<?php echo $field->label; ?>
						<?php echo $pro; ?>
					</div>
					<div class="controls">
						<?php echo $field->input; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>