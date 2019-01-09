<?php
/**
*
* @package phpBB Extension - Coin index
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\coinindex\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string */
	protected $coinindex_table;

	/**
	* Constructor
	*
	* @param \phpbb\template\template				$template
	* @param \phpbb\user							$user
	* @param \phpbb\db\driver\driver_interface 		$db
	* @param \phpbb\request\request					$request
	* @param string									$coinindex_table
	*/
	public function __construct(
		\phpbb\template\template $template,
		\phpbb\user $user,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\request\request $request,
		$coinindex_table
	)
	{
		$this->template 			= $template;
		$this->user 				= $user;
		$this->db 					= $db;
		$this->request 				= $request;
		$this->coinindex_table 		= $coinindex_table;
	}

	public static function getSubscribedEvents()
	{
		return array(
			'core.page_header' 	=> 'page_header',
		);
	}

	public function page_header($event)
	{
		$sql = 'SELECT *
			FROM ' . $this->coinindex_table;
		$result	 = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);

		$this->user->add_lang_ext('dmzx/coinindex', 'common');

		if ($row['coinindex_enable'])
		{
			$this->template->assign_vars(array(
				'COININDEX_ENABLE'	=> $row['coinindex_enable'],
			));

			while ($row = $this->db->sql_fetchrow($result))
			{
				if (!empty($row['coinindex']))
				{
					$this->template->assign_block_vars('coinindex', array(
						'COININDEX'				=> $row['coinindex'],
						'COININDEX_TEXT'		=> $row['coinindex_text'],
						'COININDEX_CURRENCY'	=> $row['coinindex_currency'],
						'COININDEX_SIZE'		=> $row['coinindex_size'],
					));
				};
			}
		}
		$this->db->sql_freeresult($result);
	}
}
