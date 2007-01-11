<?php
/*
    DOKEOS - elearning and course management software

    For a full list of contributors, see documentation/credits.html
   
    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.
    See "documentation/licence.html" more details.
 
    Contact: 
		Dokeos
		Rue des Palais 44 Paleizenstraat
		B-1030 Brussels - Belgium
		Tel. +32 (2) 211 34 56
*/

/**
*	@package dokeos.survey
* 	@author 
* 	@version $Id: select_question.php 10680 2007-01-11 21:26:23Z pcool $
*/
// including the global dokeos file
require_once ('../inc/global.inc.php');

if(isset($_POST['add_question']))
{
	
	$groupid=$_REQUEST['groupid'];
	$surveyid=$_REQUEST['surveyid'];
	// name of the language file that needs to be included 
	$language_file = 'survey';
	
    $add_question=$_REQUEST['add_question'];
	switch ($_POST['add_question'])
	{
		case get_lang('YesNo'):
		header("location:yesno.php?add_question=$add_question&groupid=$groupid&surveyid=$surveyid");
		break;
		case get_lang('MultipleChoiceSingle'):
		header("location:mcsa.php?add_question=$add_question&groupid=$groupid&surveyid=$surveyid");
		break;
		case get_lang('MultipleChoiceMulti'):
		header("location:mcma.php?add_question=$add_question&groupid=$groupid&surveyid=$surveyid");
		break;
		case get_lang('Open'):
		header("location:open.php?add_question=$add_question&groupid=$groupid&surveyid=$surveyid");
		break;
		case get_lang('Numbered'):
		header("location:numbered.php?add_question=$add_question&groupid=$groupid&surveyid=$surveyid");
		break;
		default :
		header("location:select_question_type.php");
		break;
	}	
	exit;
}
function select_question_type($add_question12,$groupid,$surveyid,$cidReq,$curr_dbname)
{	
		$sql = "SELECT groupname FROM survey_group WHERE group_id='$groupid'";
		$sql_result = api_sql_query($sql,__FILE__,__LINE__);
		$group_name = @mysql_result($sql_result,0,'groupname');
?>

<table>
<tr>
<td><?php api_display_tool_title('Group Name :'); ?></td>
<td><?php api_display_tool_title($group_name); ?></td>
</tr>
</table>
<?php
if( isset($error_message) )
{
	Display::display_error_message($error_message);	
}
?>
<form name="question" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="hidden" name="groupid" value="<?php echo $groupid?>">
<input type="hidden" name="surveyid" value="<?php echo $surveyid?>">
<input type="hidden" name="curr_dbname" value="<?php echo $curr_dbname?>">
<table>
<tr>
<td>
<?php echo get_lang('Selectype');?>
</td>
<td>
<select name="add_question" onChange="javascript:this.form.submit();">
	<option value="0"><?php echo get_lang('Select');?></option>
	<option value="<?php echo get_lang('YesNo'); ?>" <?php if($add_question12==get_lang('YesNo'))echo "selected";?>><?php echo get_lang('YesNo');?></option>
	<option value="<?php echo get_lang('MultipleChoiceSingle'); ?>" <?php if($add_question12==get_lang('MultipleChoiceSingle')) { echo " selected ";}?>><?php echo get_lang('MultipleChoiceSingle');?></option>
	<option value="<?php echo get_lang('MultipleChoiceMulti'); ?>" <?php if($add_question12==get_lang('MultipleChoiceMulti')) { echo " selected ";}?>><?php echo get_lang('MultipleChoiceMulti');?></option>
	<option value="<?php echo get_lang('Open'); ?>" <?php if($add_question12==get_lang('Open')) { echo "selected";}?>><?php echo get_lang('Open');?></option>
	<option value="<?php echo get_lang('Numbered'); ?>" <?php if($add_question12==get_lang('Numbered')) { echo "selected";}?>><?php echo get_lang('Numbered');?></option>
</select>
</td>
</tr>
</table>
</form>
<?php
}
?>