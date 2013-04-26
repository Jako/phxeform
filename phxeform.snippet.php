<?php
/**
 * phxeform
 *
 * Copyright 2013 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * phxeform is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * phxeform is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * phxeform; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package phxeform
 * @subpackage snippet
 *
 * @author      Thomas Jakobi (thomas.jakobi@partout.info)
 * @copyright   Copyright 2013, Thomas Jakobi
 * @version     1.0.1
 */
if (!class_exists('evoChunkie')) {
	include_once (MODX_BASE_PATH . 'assets/snippets/phxeform/includes/chunkie/chunkie.class.inc.php');
}

if (!function_exists('phxBeforeFormParse')) {

	function phxBeforeFormParse(&$fields, &$templates) {
		global $modx;

		$modx->eformTemplates = $templates;
		$phxOutput = new evoChunkie('@CODE' . $templates['tpl']);
		$phxOutput->CreateVars($fields);
		$templates['tpl'] = preg_replace('/(\(\()((?!yams).*?)(\)\))/s', '[+$2+]', $phxOutput->Render());
		$templates['report'] = '[+reportOutput+]';
		$templates['thankyou'] = '[+thankyouOutput+]';
		$templates['autotext'] = '[+autotextOutput+]';
	}

	function phxBeforeMailSent(&$fields) {
		global $modx;

		$phxOutput = new evoChunkie('@CODE' . $modx->eformTemplates['report']);
		$phxOutput->CreateVars($fields);
		$fields['reportOutput'] = $phxOutput->Render();

		$phxOutput = new evoChunkie('@CODE' . $modx->eformTemplates['thankyou']);
		$phxOutput->CreateVars($fields);
		$fields['thankyouOutput'] = $phxOutput->Render();

		$phxOutput = new evoChunkie('@CODE' . $modx->eformTemplates['autotext']);
		$phxOutput->CreateVars($fields);
		$fields['autotextOutput'] = $phxOutput->Render();
	}

}
?>