<?php
/**********************************************************************************
* Subs-ELUX.php                                                                   *
***********************************************************************************
* This mod is licensed under the 2-clause BSD License, which can be found here:   *
*	http://opensource.org/licenses/BSD-2-Clause                                   *
***********************************************************************************
* This program is distributed in the hope that it is and will be useful, but	  *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY	  *
* or FITNESS FOR A PARTICULAR PURPOSE.											  *
**********************************************************************************/
if (!defined('SMF'))
	die('Hacking attempt...');

function ELUX_Admin($areas)
{
	$areas['maintenance']['areas']['logs']['subsections']['errorlog'][0] .= '<elux></elux>';
}

function ELUX_Menu(&$buttons)
{
	$buttons['admin']['title'] .= '<elux></elux>';
	$buttons['admin']['sub_buttons']['errorlog']['title'] .= '<elux></elux>';
}

function ELUX_Buffer($buffer)
{
	global $context, $smcFunc;
	
	// If we are admin, then show the number of errors in the log:
	if ($context['user']['is_admin'])
	{
		$result = $smcFunc['db_query']('', '
			SELECT COUNT(id_error) AS errors
			FROM {db_prefix}log_errors'
		);
		list($errors) = $smcFunc['db_fetch_row']($result);
		$smcFunc['db_free_result']($result);
	}
	return str_replace('<elux></elux>', empty($errors) ? '' : ' <strong>(' . $errors . ')</strong>', $buffer);
}

?>