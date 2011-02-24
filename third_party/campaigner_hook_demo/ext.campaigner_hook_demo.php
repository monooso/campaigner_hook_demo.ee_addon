<?php if ( ! defined('BASEPATH')) exit('Direct script access is not permitted.');

/**
 * Extension demonstrating the use of the Campaigner `campaigner_subscribe_start` hook.
 * 
 * @author			: Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright		: Experience Internet
 * @package			: Campaigner_hook_demo
 */

require_once PATH_THIRD .'campaigner/classes/campaigner_subscriber' .EXT;

class Campaigner_hook_demo_ext {

	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */

	/**
	 * ExpressionEngine object reference.
	 *
	 * @access	private
	 * @var		object
	 */
	private $_ee;
	
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Description.
	 *
	 * @access	public
	 * @var		string
	 */
	public $description = 'Extension demonstrating the use of the Campaigner `campaigner_subscribe_start` hook.';
	
	/**
	 * Documentation URL.
	 *
	 * @access	public
	 * @var		string
	 */
	public $docs_url = 'http://experienceinternet.co.uk/software/campaigner/';
	
	/**
	 * Extension name.
	 *
	 * @access	public
	 * @var		string
	 */
	public $name = 'Campaigner Hook Demo';
	
	/**
	 * Settings.
	 *
	 * @access	public
	 * @var		array
	 */
	public $settings = array();
	
	/**
	 * Does this extension have a settings screen?
	 *
	 * @access	public
	 * @var		string
	 */
	public $settings_exist = 'n';
	
	/**
	 * Version.
	 *
	 * @access	public
	 * @var		string
	 */
	public $version = '1.0.0';
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */

	/**
	 * Class constructor.
	 *
	 * @access	public
	 * @param	array 		$settings		Previously-saved extension settings.
	 * @return	void
	 */
	public function __construct($settings = array())
	{
		$this->_ee =& get_instance();
		$this->settings = $settings;
	}
	
	
	/**
	 * Activates the extension.
	 *
	 * @access	public
	 * @return	void
	 */
	public function activate_extension()
	{
		$hooks = array('campaigner_subscribe_start');
		
		$hook_data = array(
			'class'		=> get_class($this),
			'enabled'	=> 'y',
			'hook'		=> '',
			'method'	=> '',
			'priority'	=> 5,
			'settings'	=> '',
			'version'	=> $this->version
		);
		
		foreach ($hooks AS $hook)
		{
			$hook_data['hook'] = $hook;
			$hook_data['method'] = 'on_' .$hook;
			
			$this->_ee->db->insert('extensions', $hook_data);
		}
	}
	
	
	/**
	 * Disables the extension.
	 *
	 * @access	public
	 * @return	void
	 */
	public function disable_extension()
	{
		$this->_ee->db->delete('extensions', array('class' => get_class($this)));
	}


	/**
	 * Handles the 'campaigner_subscribe_start' hook. The whole reason we're here.
	 *
	 * @access	public
	 * @param	int|string				$member_id		The ID of the member being subscribed.
	 * @param	Campaigner_subscriber	$subscriber		The 'subscriber' information that will be passed to Campaign Monitor.
	 * @return	Campaigner_subscriber
	 */
	public function on_campaigner_subscribe_start($member_id, Campaigner_subscriber $subscriber)
	{
		$subscriber->set_name('Fergus McTafferty');
		return $subscriber;
	}


	/**
	 * Updates the extension.
	 *
	 * @access	public
	 * @param	string		$installed_version		The currently-installed version.
	 * @return	bool
	 */
	public function update_extension($installed_version = '')
	{
		return FALSE;
	}

}

/* End of file		: ext.campaigner_hook_demo.php */
/* File location	: third_party/campaigner_hook_demo/ext.campaigner_hook_demo.php */
