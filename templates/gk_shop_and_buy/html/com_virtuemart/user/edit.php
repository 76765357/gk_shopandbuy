<?php
/**
*
* Modify user form view
*
* @package	VirtueMart
* @subpackage User
* @author Oscar van Eijk
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit.php 4562 2011-10-26 21:28:08Z electrocity $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

//AdminMenuHelper::startAdminArea();

// Implement Joomla's form validation
JHTML::_('behavior.formvalidation');
JHTML::stylesheet('vmpanels.css', JURI::root().'components/com_virtuemart/assets/css/'); // VM_THEMEURL
?>
<style type="text/css">
.invalid {
	border-color: #f00;
	background-color: #ffd;
	color: #000;
}
label.invalid {
	background-color: #fff;
	color: #f00;
}
</style>
<script language="javascript">
function myValidator(f, t)
{
	f.task.value=t;
	if (document.formvalidator.isValid(f)) {
		f.submit();
		return true;
	} else {
		var msg = '<?php echo addslashes( JText::_('COM_VIRTUEMART_USER_FORM_MISSING_REQUIRED_JS') ); ?>';
		alert (msg);
	}
	return false;
}
</script>
<h1><?php echo $this->page_title ?></h1>
<?php echo shopFunctionsF::getLoginForm(false); ?>

<h4><?php echo JText::_('COM_VIRTUEMART_YOUR_ACCOUNT_REG'); ?></h4>

<form method="post" id="adminForm" name="userForm" action="<?php echo JRoute::_('index.php?view=user',$this->useXHTML,$this->useSSL) ?>" class="form-validate">

<?php // Loading Templates in Tabs
if($this->userDetails->virtuemart_user_id!=0) {
    $tabarray = array();
    if(!empty($this->add_product_link)) {
	    echo $this->add_product_link;
    }
    $tabarray['shopper'] = 'COM_VIRTUEMART_SHOPPER_FORM_LBL';
    //$tabarray['user'] = 'COM_VIRTUEMART_USER_FORM_TAB_GENERALINFO';
    if (!empty($this->shipto)) {
	    $tabarray['shipto'] = 'COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL';
    }
    if (($_ordcnt = count($this->orderlist)) > 0) {
	    $tabarray['orderlist'] = 'COM_VIRTUEMART_YOUR_ORDERS';
    }

    shopFunctionsF::buildTabs ( $this, $tabarray);
 } else {
    echo $this->loadTemplate ( 'shopper' );
 }
?>

<?php if($this->userDetails->user_is_vendor){ ?>
<div style="text-align: right; width: 100%;">
	<button class="button" type="submit" onclick="javascript:return myValidator(userForm, 'saveUser');" ><?php echo $this->button_lbl ?></button>
	&nbsp;
	<button class="button" type="reset" onclick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=user', FALSE); ?>'" ><?php echo JText::_('COM_VIRTUEMART_CANCEL'); ?></button>
</div>
<?php } ?>

<input type="hidden" name="option" value="com_virtuemart" />
<input type="hidden" name="controller" value="user" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>

