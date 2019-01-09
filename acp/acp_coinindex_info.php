<?php
/**
*
* @package phpBB Extension - Coin index
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\coinindex\acp;

class acp_coinindex_info
{
	function module()
	{
		return array(
			'filename'	=> '\dmzx\coinindex\acp\acp_coinindex_module',
			'title'		=> 'ACP_COININDEX_TITLE',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_COININDEX_CONFIG', 'auth' => 'ext_dmzx/coinindex && acl_a_board', 'cat'	=> array('ACP_COININDEX_CONFIG')),
			),
		);
	}
}
