<?php
/**
*
* @package phpBB Extension - Coin index
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\coinindex\acp;

class acp_coinindex_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $user;

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('dmzx.coinindex.admin.controller');

		// Make the $u_action url available in the admin controller
		$admin_controller->set_page_url($this->u_action);

		switch ($mode)
		{
			case 'settings':
				// Load a template from adm/style for our ACP page
				$this->tpl_name = 'acp_coinindex';
				// Set the page title for our ACP page
				$this->page_title = $user->lang('ACP_COININDEX_TITLE');
				// Load the display options handle in the admin controller
				$admin_controller->display_options();
			break;
		}
	}
}
