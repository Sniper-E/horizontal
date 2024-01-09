<?php
/**
* @package phpBB Extension - Horizontal Attachments
* @copyright (c) 2024 Sniper_E - https://www.sniper-e.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

namespace sniper\horizontal;
use phpbb\extension\base;

class ext extends base
{
	public function is_enableable()
	{
		if (!class_exists('dmzx\editor\editor'))
		{
			$this->container->get('user')->add_lang_ext('sniper/horizontal', 'info_acp_horizontal');
			trigger_error($this->container->get('user')->lang['EDITOR_NOTICE'], E_USER_WARNING);
		}
		if (!$this->container->get('ext.manager')->is_enabled('dmzx/editor'))
		{
			$this->container->get('ext.manager')->enable('dmzx/editor');
		}
		return class_exists('dmzx\editor\editor');
	}

	public function enable_step($old_state)
	{
		if (empty($old_state))
		{
			$this->container->get('user')->add_lang_ext('sniper/horizontal', 'info_acp_horizontal');
			$this->container->get('template')->assign_var('L_EXTENSION_ENABLE_SUCCESS', $this->container->get('user')->lang['EXTENSION_ENABLE_SUCCESS'] .
				(isset($this->container->get('user')->lang['HORIZONTAL_NOTICE']) ? $this->container->get('user')->lang['HORIZONTAL_NOTICE'] : ''));
		}
		return parent::enable_step($old_state);
	}
}
