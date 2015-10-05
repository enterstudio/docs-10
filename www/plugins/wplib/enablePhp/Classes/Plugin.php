<?php
/**
 * Plugin class
 */

/*
 * The namespace structure is Phile\Plugin\<vendor>\<plugin-name>
 *
 * - the namespace always starts with Phile\Plugin
 * - the vendor name in lowercase is the folder name under plugins directory
 * - the sub-folder in lowerCamelCase is the plugin name
 *
 * So if your folder is: plugins/mycompany/myPluginName/
 * then your namespace should be: Phile\Plugin\wplib\MyPluginName
 */
namespace Phile\Plugin\WPLib\EnablePhp;

/**
 * Enable PHP in output
 *
 * @author  Mike Schinkel
 */
class Plugin extends \Phile\Plugin\AbstractPlugin {

	protected $events = [
		'before_load_content' => 'before_load_content',
		'after_load_content' => 'after_load_content',
	];

	private $_filepath;

	public function before_load_content( $data ) {
		/**
		 * @var \Phile\Model\Page $page
		 */
		$filePath = $data['filePath'];

		$rawData = str_replace( '<?php', '&lt;?php', file_get_contents( $filePath ) );

		$this->_filepath = tempnam( '/tmp', 'phile-' );
		$handle = fopen( $this->_filepath, 'w' );
		fwrite($handle,$rawData);
		fclose($handle);

		$data['filePath'] = $this->_filepath;

	}
	public function after_load_content( $data ) {
		unlink( $this->_filepath );
	}


}
