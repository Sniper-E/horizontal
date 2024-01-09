<?php
/**
* @package phpBB Extension - Horizontal Attachments
* @copyright (c) 2024 Sniper_E - https://www.sniper-e.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, [
	'EDITOR_NOTICE'			=> 'dmzx’s Editor extension does not exist!<br />Download <a href="https://www.dmzx-web.net/viewtopic.php?f=66&t=3644" target="_blank">dmzx/editor</a> and copy the editor folder to your dmzx extension folder.',
	'HORIZONTAL_NOTICE'		=> '<p style="text-align:center;">Config setting of this extension are not necessary.</p>',
]);
