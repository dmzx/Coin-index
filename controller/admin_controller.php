<?php
/**
*
* @package phpBB Extension - Coin index
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\coinindex\controller;

class admin_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\log\log_interface */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string */
	protected $coinindex_table;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config											$config
	 * @param \phpbb\template\template										$template
	 * @param \\phpbb\log\log_interface										$log
	 * @param \phpbb\user													$user
	 * @param \phpbb\db\driver\driver_interface								$db
	 * @param \phpbb\request\request										$request
	 * @param string														$coinindex_table
	 */
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\log\log_interface $log,
		\phpbb\user $user,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\request\request $request,
		$coinindex_table
	)
	{
		$this->config 				= $config;
		$this->template 			= $template;
		$this->log 					= $log;
		$this->user 				= $user;
		$this->db 					= $db;
		$this->request 				= $request;
		$this->coinindex_table 		= $coinindex_table;
	}

	/**
	* Display the options a user can configure for this extension
	*
	* @return null
	* @access public
	*/
	public function display_options()
	{
		add_form_key('acp_coinindex');

		$this->user->add_lang_ext('dmzx/coinindex', 'acp_coinindex');

		$sql = 'SELECT *
			FROM '. $this->coinindex_table;
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			if (!empty($row['coinindex']))
			{
				$this->template->assign_block_vars('coinindex', array(
					'COININDEX'			=> $row['coinindex'],
					'COININDEX_TEXT'		=> $row['coinindex_text'],
					'COININDEX_CURRENCY'	=> $row['coinindex_currency'],
					'COININDEX_SIZE'		=> $row['coinindex_size'],
				));
			};
		};

		if (empty($row['coinindex']))
		{
			$this->template->assign_block_vars('coinindex', array(
				'COININDEX' => '',
			));
		};

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('acp_coinindex'))
			{
				trigger_error('FORM_INVALID');
			}

			$this->db->sql_query('TRUNCATE TABLE ' . $this->coinindex_table);

			if (!$row['coinindex_id'])
			{
				$sql_arr_id = array(
					'coinindex_id' => '1',
				);
				$sql = 'INSERT INTO ' . $this->coinindex_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr_id);
				$this->db->sql_query($sql);
			};

			$coinindex 			= $this->request->variable('coinindex', array('' => ''),true);
			$coinindex_text 		= $this->request->variable('coinindex_text', array('' => ''),true);
			$coinindex_currency 	= $this->request->variable('coinindex_currency', array('' => ''),true);
			$coinindex_size 		= $this->request->variable('coinindex_size', array('' => ''),true);
			$coinindex			= array_merge(array_filter($coinindex));

			$i = 0;
			while ($i < count($coinindex))
			{
				$coinindex[$i] = $coinindex[$i];

				$sql_ary1 = array(
					'coinindex' 			=> $coinindex[$i],
					'coinindex_text' 		=> $coinindex_text[$i],
					'coinindex_currency' 	=> $coinindex_currency[$i],
					'coinindex_size' 		=> $coinindex_size[$i],
				);
				$this->db->sql_multi_insert($this->coinindex_table, $sql_ary1);
				$i++;
			}

			$sql_ary_block = array(
				'coinindex_enable' => $this->request->variable('coinindex_enable', ''),
			);

			$this->db->sql_query('UPDATE ' . $this->coinindex_table . '
				SET ' . $this->db->sql_build_array('UPDATE', $sql_ary_block) . "
				WHERE coinindex_id =	1"
			);

			// Add option settings change action to the admin log
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_COININDEX_SAVE');

			trigger_error($this->user->lang('COININDEX_SAVED') . adm_back_link($this->u_action));
		}

		$sql = 'SELECT coinindex_enable
			FROM ' . $this->coinindex_table . "
			WHERE coinindex_id =	1";
		$result = $this->db->sql_query($sql);
		$coinindex_data = $this->db->sql_fetchrow($result);

		$this->template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'COININDEX_ENABLE'	=> $coinindex_data['coinindex_enable'],
			'COININDEX_VERSION'	=> $this->config['coinindex_version'],
		));
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return null
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
