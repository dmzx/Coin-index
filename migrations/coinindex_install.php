<?php
/**
*
* @package phpBB Extension - Coin index
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\coinindex\migrations;

class coinindex_install extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\dev');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('coinindex_version', '1.0.0')),

			// Add ACP extension category
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_COININDEX_TITLE'
			)),
			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_COININDEX_TITLE',
				array(
					'module_basename'	=> '\dmzx\coinindex\acp\acp_coinindex_module',
				),
			)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'coinindex'	=> array(
					'COLUMNS' => array(
						'coinindex_id'			=> array('UINT', null, 'auto_increment'),
						'coinindex_enable' 		=> array('UINT', '0'),
						'coinindex'				=> array('VCHAR', ''),
						'coinindex_text'		=> array('VCHAR', ''),
						'coinindex_currency'	=> array('VCHAR', ''),
						'coinindex_size'		=> array('VCHAR', ''),
					),
					'PRIMARY_KEY'	=> 'coinindex_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'coinindex',
			),
		);
	}
}
