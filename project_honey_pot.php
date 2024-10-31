<?PHP
/*
Plugin Name: Project Honey Pot Spam Trap
Plugin URI: http://andrewensley.com/projects/project-honey-pot-wordpress-plugin/
Version: 1.0.1
Author: Andrew Ensley
Author URI: http://andrewensley.com/
Description: This plugin automatically scatters invisible links to <a href="http://www.projecthoneypot.org/">Project Honey Pot</a> spam traps throughout your wordpress blog to help catch and stop spammers.
License: GPLv3
*/

if (!class_exists("ProjectHoneyPotSpamTrap"))
{
	class ProjectHoneyPotSpamTrap
	{
		// Properties
		private $adminOptionsName = 'ProjectHoneyPotSpamTrapAdminOptions',
			$options = array(),
			$linkArray = array(),
			$imageURL = '',
			$laSize = 0,
			$outputCounter = 0,
			/*****************************************************
			* To add an action or filter hook, simply add it as a key to the
			* corresponding array below with a value of 'true' or 'false'
			* indicating whether or not it should be enabled by default.
			*****************************************************/
			// Actions
			$actions = array('loop_start'=>'true','loop_end'=>'true','the_post'=>'true','wp_footer'=>'true',
				'get_footer'=>'true','get_sidebar'=>'true','comment_loop_start'=>'true','comment_form'=>'true',
				'login_form'=>'true','register_form'=>'true','get_search_form'=>'false','wp_meta'=>'false'),
			// Filters
			$filters = array('wp_list_pages'=>'true','the_content'=>'true','the_tags'=>'true','the_time'=>'true',
				'the_excerpt'=>'false','the_date'=>'false','link_title'=>'false','the_author'=>'false',
				'bloginfo'=>'false','wp_title'=>'false','the_title'=>'false'),
			// Dictionary words to be used for link text and image name
			// NO SPACES ALLOWED.  Array length cannot be less than the longest possible linkArray (definition in class's constructor)
			$dictionary = array('contact','terms','service','about','news','advertise','privacy','e-mail',
				'mail','conditions','home','tour','search','rss','faq','report','guidelines','blog','podcast',
				'jobs','tools','feed','api','store','partner','content','help','handbook','forum','copyright',
				'notice','language','international','site-map','support','information','marketing',
				'participate','research','feedback','suggest','trademarks','profile','careers','address');
		// Constructor
		public function ProjectHoneyPotSpamTrap()
		{
			// Make sure this is an instantiated object, and not a static access of this constructor - why on earth someone would do that.... who knows, but this code is safe
			if(isset($this))
			{
				// Get options from DB
				$this->options = get_option($this->adminOptionsName);
				// Build URL for image
				$this->imageURL = WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__)) . 'images/' . $this->options['image_name'];
				// Randomize the dictionary array
				shuffle($this->dictionary);
				// Build link array
				if(!empty($this->options['honey_pot1']))
				{
					$this->linkArray[] = '<a href="' . $this->options['honey_pot1'] . '" style="padding:0;margin:0;" rel="nofollow"><img border="0" width="0" height="0" style="padding:0;margin:0;" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"/></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot1'] . '" style="padding:0;margin:0;" rel="nofollow"><!-- ' . array_pop($this->dictionary) . ' --></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot1'] . '" style="padding:0;margin:0;" rel="nofollow"><img src="' . $this->imageURL . '" height="0" width="0" border="0" style="padding:0;margin:0;" /></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot1'] . '" rel="nofollow" style="display:none;">' . array_pop($this->dictionary) . '</a>';
					$this->linkArray[] = '<div style="display:none;"><a href="' . $this->options['honey_pot1'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></div>';
					$this->linkArray[] = '<span style="display:none;"><a href="' . $this->options['honey_pot1'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></span>';
					$this->linkArray[] = '<span style="position:absolute;top:-250px;left:-250px;"><a href="' . $this->options['honey_pot1'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></span>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot1'] . '" style="padding:0;margin:0;" rel="nofollow"></a>';
					$this->linkArray[] = '<!-- <a href="' . $this->options['honey_pot1'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a> -->';
					$this->linkArray[] = '<div style="position:absolute;top:-250px;left:-250px;"><a href="' . $this->options['honey_pot1'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></div>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot1'] . '" style="padding:0;margin:0;" rel="nofollow"><span style="display:none;">' . array_pop($this->dictionary) . '</span></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot1'] . '" style="padding:0;margin:0;" rel="nofollow"><div style="display:none;">' . array_pop($this->dictionary) . '</div></a>';
				}
				if(!empty($this->options['honey_pot2']))
				{
					$this->linkArray[] = '<a href="' . $this->options['honey_pot2'] . '" style="padding:0;margin:0;" rel="nofollow"><img border="0" width="0" height="0" style="padding:0;margin:0;" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"/></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot2'] . '" style="padding:0;margin:0;" rel="nofollow"><!-- ' . array_pop($this->dictionary) . ' --></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot2'] . '" style="padding:0;margin:0;" rel="nofollow"><img src="' . $this->imageURL . '" height="0" width="0" border="0" style="padding:0;margin:0;" /></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot2'] . '" rel="nofollow" style="display:none;">' . array_pop($this->dictionary) . '</a>';
					$this->linkArray[] = '<div style="display:none;"><a href="' . $this->options['honey_pot2'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></div>';
					$this->linkArray[] = '<span style="display:none;"><a href="' . $this->options['honey_pot2'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></span>';
					$this->linkArray[] = '<span style="position:absolute;top:-250px;left:-250px;"><a href="' . $this->options['honey_pot2'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></span>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot2'] . '" style="padding:0;margin:0;" rel="nofollow"></a>';
					$this->linkArray[] = '<!-- <a href="' . $this->options['honey_pot2'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a> -->';
					$this->linkArray[] = '<div style="position:absolute;top:-250px;left:-250px;"><a href="' . $this->options['honey_pot2'] . '" rel="nofollow">' . array_pop($this->dictionary) . '</a></div>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot2'] . '" style="padding:0;margin:0;" rel="nofollow"><span style="display:none;">' . array_pop($this->dictionary) . '</span></a>';
					$this->linkArray[] = '<a href="' . $this->options['honey_pot2'] . '" style="padding:0;margin:0;" rel="nofollow"><div style="display:none;">' . array_pop($this->dictionary) . '</div></a>';
				}
				// Count items in the link array
				$this->laSize = count($this->linkArray) - 1;
				// Randomize the link array
				shuffle($this->linkArray);
				// Are the honey pot options empty?
				if(empty($this->options['honey_pot1']) && empty($this->options['honey_pot2']))
				{
					// Nope - notify the admin
					add_action('admin_notices', array(&$this, 'no_honey_pot_notice'));
				}
				elseif(empty($this->options['access_key']) && $this->options['output_to_all'] == 'false')
				{
					// If the access key is empty and they didn't check "Output links to all visitors", the links will never be output - notify the admin
					add_action('admin_notices', array(&$this, 'no_access_key_notice'));
				}
				//Add the admin menu item
				add_action('admin_menu', array(&$this, 'honeyPot_ap'));
				// Add init function to run on activation of the plugin
				add_action('activate_' . plugin_basename(__FILE__),  array(&$this, 'init'));
				// If there's a honey pot in options and "output to all" is set to true or the visitor is suspicious, add link output hooks
				if((!empty($this->options['honey_pot1']) || !empty($this->options['honey_pot1'])) && ($this->options['output_to_all'] == 'true' || $this->is_visitor_bad()))
				{
					// Actions
					foreach($this->actions as $action => $default)
					{
						if($this->options[$action] == 'true')
						{
							add_action($action, array(&$this, 'honeypot_link_action'), PHP_INT_MAX);
						}
					}
					// Filters
					foreach($this->filters as $filter => $default)
					{
						if($this->options[$filter] == 'true')
						{
							add_filter($filter, array(&$this, 'honeypot_link_filter'), PHP_INT_MAX);
						}
					}
				}
			}
		}
		// This runs when the plugin is activated
		public function init()
		{
			// Get image path
			$imageDir = realpath(dirname(__FILE__)) . '/images/';
			// Default image name
			$imageName = 'pixel.png';
			if(file_exists($imageDir . $imageName) && is_writable($imageDir) && is_writable($imageDir . $imageName))
			{
				// Rename the image to one of the randomly chosen dictionary words
				$newImageName = $this->dictionary[mt_rand(0,(count($this->dictionary)-1))] . '.png';
				if(rename($imageDir . $imageName, $imageDir . $newImageName))
				{
					$imageName = $newImageName;
				}
			}
			if(file_exists($imageDir . $imageName))
			{
				// Update options in DB with new image location
				update_option($this->adminOptionsName, array('image_name'=>$imageName));
			}
			// Update options in DB with all other defaults if there are any new settings.
			$this->setAdminOptions();
		}
		public function no_honey_pot_notice()
		{
			// The admin doesn't have any honey pots entered in settings, let them know they need to enter it.
			?><div style="background-color:rgb(255,251,204);" class="error fade">
				<p><strong>Project Honey Pot</strong>: You don't have a honey pot configured yet!
				Go to <a href="<?PHP
					echo get_option('siteurl'), '/wp-admin/options-general.php?page=', basename(__FILE__);
				?>">the options page</a>
				to enter a honey pot address.</p>
			</div><?PHP
		}
		public function no_access_key_notice()
		{
			// The admin doesn't have an access key entered and they unchecked "Output links to all visitors".
			?><div style="background-color:rgb(255,251,204);" class="error fade">
				<p><strong>Project Honey Pot</strong>: You don't have an HTTP:BL access key configured yet!
				Go to <a href="<?PHP
					echo get_option('siteurl'), '/wp-admin/options-general.php?page=', basename(__FILE__);
				?>">the options page</a>
				to enter your access key or check the option "Output links to all visitors"</p>
			</div><?PHP
		}
		// Echoes the next honey pot link in the array
		public function honeypot_link_action()
		{
			if($this->outputCounter > $this->laSize)
			{
				$this->outputCounter = 0;
			}
			echo $this->linkArray[$this->outputCounter++];
		}
		// Appends the next honey pot link in the array to $content and returns it.
		public function honeypot_link_filter($content)
		{
			if($this->outputCounter > $this->laSize)
			{
				$this->outputCounter = 0;
			}
			return $content . $this->linkArray[$this->outputCounter++];
		}
		// Checks against Project Honey Pot's HTTP:BlackList to see if the visitor's IP is in the database.
		private function is_visitor_bad()
		{
			// There has to be an access key for this to be possible.
			if(empty($this->options['access_key']))
			{
				return false;
			}
			// Get the result from HTTP:BL and store the octets in $first, $days, $score, and $type
			list($first,$days,$score,$type) = explode('.',gethostbyname($this->options['access_key'] . '.' . implode('.', array_reverse(explode('.',$_SERVER['REMOTE_ADDR']))) . '.dnsbl.httpbl.org'));
			// Return true if the IP is in the HTTP:BL as anything but a search engine.
			return ($first == 127 && $type != 0);
		}
		// Adds the options page link for Project Honey Pot
		public function honeyPot_ap()
		{
			if(isset($this))
			{
				if(function_exists('add_options_page'))
				{
					add_options_page('ProjectHoneyPot', 'ProjectHoneyPot', 9, basename(__FILE__), array(&$this, 'printAdminPage'));
				}
			}
		}
		//Initial Setting of admin options to be used only by the plugin activation process.
		public function setAdminOptions()
		{
			// Default values for configuration options
			$honeyPotAdminOptions = array('access_key'=>'', 'honey_pot1'=>'', 'honey_pot2'=>'', 'output_to_all'=>'true');
			foreach($this->actions as $action => $default)
			{
				$honeyPotAdminOptions[$action] = $default;
			}
			foreach($this->filters as $filter => $default)
			{
				$honeyPotAdminOptions[$filter] = $default;
			}
			// Load options stored in the Database
			$honeyPotOptions = get_option($this->adminOptionsName);
			if(!empty($honeyPotOptions))
			{
				// Overwrite defaults with options retrieved from the database
				foreach($honeyPotOptions as $key => $option)
				{
					$honeyPotAdminOptions[$key] = $option;
				}
			}
			// Store updated options back in the database.
			update_option($this->adminOptionsName, $honeyPotAdminOptions);
		}
		//Prints out the admin page
		public function printAdminPage()
		{
			// The form was submitted
			if(isset($_POST['update_honeyPotSettings']))
			{
				if(isset($_POST['honey_pot1']))
				{
					$this->options['honey_pot1'] = $_POST['honey_pot1'];
				}
				if(isset($_POST['honey_pot2']))
				{
					$this->options['honey_pot2'] = $_POST['honey_pot2'];
				}
				if(isset($_POST['access_key']))
				{
					$this->options['access_key'] = $_POST['access_key'];
				}
				$this->options['output_to_all'] = (isset($_POST['output_to_all']) ? 'true' : 'false');
				foreach($this->actions as $action => $default)
				{
					$this->options[$action] = (isset($_POST[$action]) ? 'true' : 'false');
				}
				foreach($this->filters as $filter => $default)
				{
					$this->options[$filter] = (isset($_POST[$filter]) ? 'true' : 'false');
				}
				// Store options in the database
				update_option($this->adminOptionsName, $this->options);
				?>
				<div class="updated"><p><strong><?php
					_e("Settings Updated.", "ProjectHoneyPot");
				?></strong></p></div>
				<?php
			}
			?>
			<div class=wrap>
				<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
					<h2>Project Honey Pot Plugin</h2>
					<strong>Thanks for helping to catch the spammers!</strong><br/>
					In order to use this plugin, you must have an account with Project Honey Pot.
					Don't have an account?  <a href="http://www.projecthoneypot.org/create_account.php">Create one here</a>.<br/>
					Once you have an account, <a href="http://www.projecthoneypot.org/account_login.php">login</a>, and create a
					<a href="http://www.projecthoneypot.org/manage_honey_pots.php">Honey Pot</a>
					or - if you can't install a honey pot on your server - a
					<a href="http://www.projecthoneypot.org/manage_quicklink.php">Quick Link</a>.
					<h3>Honey Pot URL</h3>
					Provide the full URL to your <a href="http://www.projecthoneypot.org/manage_honey_pots.php">Honey Pot</a>,
					<a href="http://www.projecthoneypot.org/manage_quicklink.php">Quick Link</a>, or both (one per input box)<br/>
					<input type="text" name="honey_pot1" value="<?php
						echo $this->options['honey_pot1'];
					?>" size="100"/><br/>
					<input type="text" name="honey_pot2" value="<?php
						echo $this->options['honey_pot2'];
					?>" size="100"/><br/><br/>

					<h3>Link Locations</h3>
					Below is a list of hooks this plugin uses to output the honey pot links.
					These are configurable because some themes might make calls to these in places that could break formatting if a honey pot link is inserted.
					The safest ones are enabled by default.<br/><br/>
					<table>
					<thead style="font-weight:bold;"><tr><td>Hook Name</td><td>Enabled</td></tr></thead>
					<tbody><tr><td colspan=2 style="font-weight:bold;">Actions</td></tr>
					<?PHP
						foreach($this->actions as $action => $default)
						{
							echo '<tr><td style="padding-right:10px;">',$action,($default=='false'?' (risky)':''),'</td><td><input type="checkbox" name="',$action,'" value="1"';
							if($this->options[$action] == 'true')
							{
								echo ' checked="true"';
							}
							echo '/></td></tr>';
						}
					?><tr><td colspan=2 style="font-weight:bold;">Filters</td></tr><?PHP
						foreach($this->filters as $filter => $default)
						{
							echo '<tr><td style="padding-right:10px;">',$filter,($default=='false'?' (risky)':''),'</td><td><input type="checkbox" name="',$filter,'" value="1"';
							if($this->options[$filter] == 'true')
							{
								echo ' checked="true"';
							}
							echo '/></td></tr>';
						}
					?>
					</tbody>
					</table>
					<h3>Link Output</h3>
					Output links to all visitors:
					<input type="checkbox" name="output_to_all" id="output_to_all" onChange="checkHttpblKey()" value="1"<?PHP
						if($this->options['output_to_all'] == 'true')
						{
							echo ' checked="true"';
						}
					?>/> (recommended)<br/><br/>
					If this option is unchecked (not recommended), links will only be output for visitors identified by the Http:BL as potentially malicious.<br/>
					Remember, the links are never actually visible to visitors.  They are simply hidden in the html source code where harvesters will find them.<br/><br/>

					<h3>Http:BL Access Key</h3>
					Enter the key to use Project Honey Pot's <a href="http://www.projecthoneypot.org/services_overview.php">Http:BL</a>
					to identify potentially malicious visitors.
					<a href="http://www.projecthoneypot.org/httpbl_configure.php">Get your key</a>.<br/>
					This option is not required if "Output links to all visitors" is checked.<br/>
					<input type="text" name="access_key" id="access_key" value="<?php
						echo $this->options['access_key'];
					?>" size="20" <?PHP
						if($this->options['output_to_all'] == 'true')
						{
							echo ' disabled="true"';
						}
					?>/><br/><br/>
					<div class="submit">
					<input type="submit" name="update_honeyPotSettings" value="<?php
						_e('Update Settings', 'ProjectHoneyPot');
					?>" /></div>
					<script>
						function checkHttpblKey()
						{
							document.getElementById("access_key").disabled = document.getElementById("output_to_all").checked;
						}
					</script>
				</form>
			</div>
			<?php
		}//End function printAdminPage()
	}
}//End Class ProjectHoneyPotSpamTrap

if(class_exists("ProjectHoneyPotSpamTrap"))
{
	$ProjectHoneyPotSpamTrap = new ProjectHoneyPotSpamTrap();
}
?>