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
 * @version     1.0.3
 */

define('PXE_PATH', str_replace(MODX_BASE_PATH, '', str_replace('\\', '/', realpath(dirname(__FILE__)))) . '/');
define('PXE_BASE_PATH', MODX_BASE_PATH . PXE_PATH);

if (!class_exists('evoChunkie')) {
	include_once (PXE_BASE_PATH . 'includes/chunkie/chunkie.class.inc.php');
}

if (!function_exists('phxBeforeFormParse')) {

	function phxBeforeFormParse(&$fields, &$templates) {
		global $modx;

		if ($modx->eformTemplates) {
			$modx->eformTemplates = array_merge($modx->eformTemplates, $templates);
		} else {
			$modx->eformTemplates = $templates;
		}
		$phxOutput = new evoChunkie('@CODE' . $templates['tpl']);
		$phxOutput->CreateVars($fields);
		$templates['tpl'] = preg_replace('/(\(\()((?!yams).*?)(\)\))/s', '[+$2+]', $phxOutput->Render());
		$templates['report'] = '[+reportOutput+]';
		if ($templates['thankyou']) {
			$templates['thankyou'] = '[+thankyouOutput+]';
		}
		if ($templates['autotext']) {
			$templates['autotext'] = '[+autotextOutput+]';
		}
	}

	function phxBeforeMailSent(&$fields) {
		global $modx;

		$placeholder = array();
		foreach ($fields as $key => $value) {
			if (is_array($value)) {
				$placeholder['key'] = implode(', ', $value);
			} else {
				$placeholder['key'] =  $value;
			}
		}

		$phxOutput = new evoChunkie($modx->eformTemplates['report']);
		$phxOutput->CreateVars($placeholder);
		$fields['reportOutput'] = $phxOutput->Render();

		if ($modx->eformTemplates['thankyou'] == '[+thankyouOutput+]') {
			$phxOutput = new evoChunkie($modx->eformTemplates['thankyou']);
			$phxOutput->CreateVars($placeholder);
			$fields['thankyouOutput'] = $phxOutput->Render();
		}

		if ($modx->eformTemplates['autotext'] == '[+autotextOutput+]') {
			$phxOutput = new evoChunkie($modx->eformTemplates['autotext']);
			$phxOutput->CreateVars($placeholder);
			$fields['autotextOutput'] = $phxOutput->Render();
		}
	}

}
?>