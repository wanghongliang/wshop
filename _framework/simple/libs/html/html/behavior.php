<?php
 

/**
 * Utility class for javascript behaviors
 *
 * @static
  * @subpackage	HTML
 * @version		1.5
 */
class WHTMLBehavior
{
	/**
	 * Method to load the mootools framework into the document head
	 *
	 * - If debugging mode is on an uncompressed version of mootools is included for easier debugging.
	 *
	 * @static
	 * @param	boolean	$debug	Is debugging mode on? [optional]
	 * @return	void
	 * @since	1.5
	 */
	function mootools($debug = null)
	{
		static $loaded;

		// Only load once
		if ($loaded) {
			return;
		}

		// If no debugging value is set, use the configuration setting
		if ($debug === null) {
			$config = &WFactory::getConfig();
			$debug = $config->getValue('config.debug');
		}

		// TODO NOTE: Here we are checking for Konqueror - If they fix thier issue with compressed, we will need to update this
		$konkcheck = strpos (strtolower($_SERVER['HTTP_USER_AGENT']), "konqueror");

		if ($debug || $konkcheck) {
			//WHTML::script('mootools-uncompressed.js', 'media/system/js/', false);
		} else {
			//WHTML::script('mootools.js', 'media/system/js/', false);
		}
		$loaded = true;
		return;
	}

		function caption() {
		WHTML::script('caption.js');
	}

	function formvalidation() {
		WHTML::script('validate.js' );
	}

	function switcher() {
		WHTML::script('switcher.js' );
	}

	function combobox() {
		WHTML::script('combobox.js' );
	}


	/**
	 * 显示鼠标提示
	 */
	function tooltip($selector='.hasTip', $params = array())
	{
		static $tips;

		//初始化提示
		if (!isset($tips)) {
			$tips = array();
		}

		//加载对应的JS框架
		// Include mootools framework
		WHTMLBehavior::mootools();
		
		//信息ID
		$sig = md5(serialize(array($selector,$params)));

		//从数组中直接取数据
		if (isset($tips[$sig]) && ($tips[$sig])) {
			return;
		}
		
		//设置对应参数
		// Setup options object

		//最多字符数量
		$opt['maxTitleChars']	= (isset($params['maxTitleChars']) && ($params['maxTitleChars'])) ? (int)$params['maxTitleChars'] : 50 ;

		//
		$opt['offsets']			= (isset($params['offsets'])) ? (int)$params['offsets'] : null;

		//显示延迟
		$opt['showDelay']		= (isset($params['showDelay'])) ? (int)$params['showDelay'] : null;

		//隐藏延迟
		$opt['hideDelay']		= (isset($params['hideDelay'])) ? (int)$params['hideDelay'] : null;

		//类名
		$opt['className']		= (isset($params['className'])) ? $params['className'] : null;

		//固定的还是灵活显示的
		$opt['fixed']			= (isset($params['fixed']) && ($params['fixed'])) ? '\\true' : '\\false';

		//显示
		$opt['onShow']			= (isset($params['onShow'])) ? '\\'.$params['onShow'] : null;

		//隐藏
		$opt['onHide']			= (isset($params['onHide'])) ? '\\'.$params['onHide'] : null;

		//把数据转为JOSN对象字符

		$options = WHTMLBehavior::_getWSObject($opt);

		// Attach tooltips to document
		$document =& WFactory::getDocument();
		//$tooltipInit = '		window.addEvent(\'domready\', function(){ var WTooltips = new Tips($$(\''.$selector.'\'), '.$options.'); });';
		$document->addScriptDeclaration($tooltipInit);

		// Set static array
		$tips[$sig] = true;
		return;
	}

	function modal($selector='a.modal', $params = array())
	{
		static $modals;
		static $included;

		$document =& WFactory::getDocument();

		// Load the necessary files if they haven't yet been loaded
		if (!isset($included)) {

			// Load the javascript and css
			WHTML::script('bgiframe.js');
			WHTML::script('weebox.js');
			WHTML::stylesheet('weebox.css');

			$included = true;
		}

		if (!isset($modals)) {
			$modals = array();
		}

		$sig = md5(serialize(array($selector,$params)));
		if (isset($modals[$sig]) && ($modals[$sig])) {
			return;
		}

		// Setup options object
		$opt['ajaxOptions']	= (isset($params['ajaxOptions']) && (is_array($params['ajaxOptions']))) ? $params['ajaxOptions'] : null;
		$opt['size']		= (isset($params['size']) && (is_array($params['size']))) ? $params['size'] : null;
		$opt['onOpen']		= (isset($params['onOpen'])) ? $params['onOpen'] : null;
		$opt['onClose']		= (isset($params['onClose'])) ? $params['onClose'] : null;
		$opt['onUpdate']	= (isset($params['onUpdate'])) ? $params['onUpdate'] : null;
		$opt['onResize']	= (isset($params['onResize'])) ? $params['onResize'] : null;
		$opt['onMove']		= (isset($params['onMove'])) ? $params['onMove'] : null;
		$opt['onShow']		= (isset($params['onShow'])) ? $params['onShow'] : null;
		$opt['onHide']		= (isset($params['onHide'])) ? $params['onHide'] : null;

		//把数据转为JOSN对象字符
		$options = WHTMLBehavior::_getWSObject($opt);

		// Attach modal behavior to document
		$document->addScriptDeclaration("
		$(function() {
			$('".$selector."').click(function(){

					//alert(this.rel);
 					//把json字符串转换为对象
					//param = eval('('+this.rel+')');//this.rel ;

					//alert(param.x);
 					//$.weeboxs.open(this.href, {title:'AJAX得到服务器上的内容', //contentType:'ajax',width:(param.size.x+40), height:(param.size.y+10)});

					$.weeboxs.wdialog=$.weeboxs.select(this.href,this.title,this.rel);

					return false;
			});
		});");

		// Set static array
		$modals[$sig] = true;
		return;
	}

	function uploader($id='file-upload', $params = array())
	{
		WHTML::script('swf.js' );
		WHTML::script('uploader.js' );

		static $uploaders;

		if (!isset($uploaders)) {
			$uploaders = array();
		}

		if (isset($uploaders[$id]) && ($uploaders[$id])) {
			return;
		}

		// Setup options object
		$opt['url']					= (isset($params['targetURL'])) ? $params['targetURL'] : null ;
		$opt['swf']					= (isset($params['swf'])) ? $params['swf'] : WURI::root(true).'/media/system/swf/uploader.swf';
		$opt['multiple']			= (isset($params['multiple']) && !($params['multiple'])) ? '\\false' : '\\true';
		$opt['queued']				= (isset($params['queued']) && !($params['queued'])) ? '\\false' : '\\true';
		$opt['queueList']			= (isset($params['queueList'])) ? $params['queueList'] : 'upload-queue';
		$opt['instantStart']		= (isset($params['instantStart']) && ($params['instantStart'])) ? '\\true' : '\\false';
		$opt['allowDuplicates']		= (isset($params['allowDuplicates']) && !($params['allowDuplicates'])) ? '\\false' : '\\true';
		$opt['limitSize']			= (isset($params['limitSize']) && ($params['limitSize'])) ? (int)$params['limitSize'] : null;
		$opt['limitFiles']			= (isset($params['limitFiles']) && ($params['limitFiles'])) ? (int)$params['limitFiles'] : null;
		$opt['optionFxDuration']	= (isset($params['optionFxDuration'])) ? (int)$params['optionFxDuration'] : null;
		$opt['container']			= (isset($params['container'])) ? '\\$('.$params['container'].')' : '\\$(\''.$id.'\').getParent()';
		$opt['types']				= (isset($params['types'])) ?'\\'.$params['types'] : '\\{\'All Files (*.*)\': \'*.*\'}';


		// Optional functions
		$opt['createReplacement']	= (isset($params['createReplacement'])) ? '\\'.$params['createReplacement'] : null;
		$opt['onComplete']			= (isset($params['onComplete'])) ? '\\'.$params['onComplete'] : null;
		$opt['onAllComplete']		= (isset($params['onAllComplete'])) ? '\\'.$params['onAllComplete'] : null;

/*  types: Object with (description: extension) pairs, default: Images (*.jpg; *.jpeg; *.gif; *.png)
 */

		$options = WHTMLBehavior::_getWSObject($opt);

		// Attach tooltips to document
		$document =& WFactory::getDocument();
		$uploaderInit = 'sBrowseCaption=\''.WText::_('Browse Files', true).'\';
				sRemoveToolTip=\''.WText::_('Remove from queue', true).'\';
				window.addEvent(\'load\', function(){
				var Uploader = new FancyUpload($(\''.$id.'\'), '.$options.');
				$(\'upload-clear\').adopt(new Element(\'input\', { type: \'button\', events: { click: Uploader.clearList.bind(Uploader, [false])}, value: \''.WText::_('Clear Completed').'\' }));				});';
		$document->addScriptDeclaration($uploaderInit);

		// Set static array
		$uploaders[$id] = true;
		return;
	}

	function tree($id, $params = array(), $root = array())
	{
		static $trees;

		if (!isset($trees)) {
			$trees = array();
		}

		// Include mootools framework
		WHTMLBehavior::mootools();
		WHTML::script('mootree.js');
		WHTML::stylesheet('mootree.css');

		if (isset($trees[$id]) && ($trees[$id])) {
			return;
		}

		// Setup options object
		$opt['div']		= (array_key_exists('div', $params)) ? $params['div'] : $id.'_tree';
		$opt['mode']	= (array_key_exists('mode', $params)) ? $params['mode'] : 'folders';
		$opt['grid']	= (array_key_exists('grid', $params)) ? '\\'.$params['grid'] : '\\true';
		$opt['theme']	= (array_key_exists('theme', $params)) ? $params['theme'] : WURI::root(true).'/media/system/images/mootree.gif';

		// Event handlers
		$opt['onExpand']	= (array_key_exists('onExpand', $params)) ? '\\'.$params['onExpand'] : null;
		$opt['onSelect']	= (array_key_exists('onSelect', $params)) ? '\\'.$params['onSelect'] : null;
		$opt['onClick']		= (array_key_exists('onClick', $params)) ? '\\'.$params['onClick'] : '\\function(node){  window.open(node.data.url, $chk(node.data.target) ? node.data.target : \'_self\'); }';
		$options = WHTMLBehavior::_getWSObject($opt);

		// Setup root node
		$rt['text']		= (array_key_exists('text', $root)) ? $root['text'] : 'Root';
		$rt['id']		= (array_key_exists('id', $root)) ? $root['id'] : null;
		$rt['color']	= (array_key_exists('color', $root)) ? $root['color'] : null;
		$rt['open']		= (array_key_exists('open', $root)) ? '\\'.$root['open'] : '\\true';
		$rt['icon']		= (array_key_exists('icon', $root)) ? $root['icon'] : null;
		$rt['openicon']	= (array_key_exists('openicon', $root)) ? $root['openicon'] : null;
		$rt['data']		= (array_key_exists('data', $root)) ? $root['data'] : null;
		$rootNode = WHTMLBehavior::_getWSObject($rt);

		$treeName		= (array_key_exists('treeName', $params)) ? $params['treeName'] : '';

		$js = '		window.addEvent(\'domready\', function(){
			tree'.$treeName.' = new MooTreeControl('.$options.','.$rootNode.');
			tree'.$treeName.'.adopt(\''.$id.'\');})';

		// Attach tooltips to document
		$document =& WFactory::getDocument();
		$document->addScriptDeclaration($js);

		// Set static array
		$trees[$id] = true;
		return;
	}

	function calendar()
	{
		$document =& WFactory::getDocument();
		WHTML::stylesheet('calendar-jos.css', 'media/system/css/', array(' title' => WText::_( 'green' ) ,' media' => 'all' ));
		WHTML::script( 'calendar.js', 'media/system/js/' );
		WHTML::script( 'calendar-setup.js', 'media/system/js/' );

		$translation = WHTMLBehavior::_calendartranslation();
		if($translation) {
			$document->addScriptDeclaration($translation);
		}
	}

	/**
	 * Keep session alive, for example, while editing or creating an article.
	 */
	function keepalive()
	{
		// Include mootools framework
		WHTMLBehavior::mootools();

		$config 	 =& WFactory::getConfig();
		$lifetime 	 = ( $config->getValue('lifetime') * 60000 );
		$refreshTime =  ( $lifetime <= 60000 ) ? 30000 : $lifetime - 60000;
		//refresh time is 1 minute less than the liftime assined in the configuration.php file

		$document =& WFactory::getDocument();
		$script  = '';
		$script .= 'function keepAlive( ) {';
		$script .=  '	$.get( "index.php",function(){ });';
		$script .=  '}';
		$script .= 	' $(function(){ setTimeout( function(){keepAlive();},'.$refreshTime.' ); }';
		$script .=  ');';

		$document->addScriptDeclaration($script);

		return;
	}

	/**
	 * Internal method to get a WavaScript object notation string from an array
	 *
	 * @param	array	$array	The array to convert to WavaScript object notation
	 * @return	string	WavaScript object notation representation of the array
	 * @since	1.5
	 */
	function _getWSObject($array=array())
	{
		// Initialize variables
		$object = '{';

		// Iterate over array to build objects
		foreach ((array)$array as $k => $v)
		{
			if (is_null($v)) {
				continue;
			}
			if (!is_array($v) && !is_object($v)) {
				$object .= ' '.$k.': ';
				$object .= (is_numeric($v) || strpos($v, '\\') === 0) ? (is_numeric($v)) ? $v : substr($v, 1) : "'".$v."'";
				$object .= ',';
			} else {
				$object .= ' '.$k.': '.WHTMLBehavior::_getWSObject($v).',';
			}
		}
		if (substr($object, -1) == ',') {
			$object = substr($object, 0, -1);
		}
		$object .= '}';

		return $object;
	}

	/**
	 * Internal method to translate the WavaScript Calendar
	 *
	 * @return	string	WavaScript that translates the object
	 * @since	1.5
	 */
	function _calendartranslation()
	{
		static $jsscript = 0;

		if($jsscript == 0)
		{
			$return = 'Calendar._DN = new Array ("'.WText::_('Sunday').'", "'.WText::_('Monday').'", "'.WText::_('Tuesday').'", "'.WText::_('Wednesday').'", "'.WText::_('Thursday').'", "'.WText::_('Friday').'", "'.WText::_('Saturday').'", "'.WText::_('Sunday').'");Calendar._SDN = new Array ("'.WText::_('Sun').'", "'.WText::_('Mon').'", "'.WText::_('Tue').'", "'.WText::_('Wed').'", "'.WText::_('Thu').'", "'.WText::_('Fri').'", "'.WText::_('Sat').'", "'.WText::_('Sun').'"); Calendar._FD = 0;	Calendar._MN = new Array ("'.WText::_('Wanuary').'", "'.WText::_('February').'", "'.WText::_('March').'", "'.WText::_('April').'", "'.WText::_('May').'", "'.WText::_('Wune').'", "'.WText::_('Wuly').'", "'.WText::_('August').'", "'.WText::_('September').'", "'.WText::_('October').'", "'.WText::_('November').'", "'.WText::_('December').'");	Calendar._SMN = new Array ("'.WText::_('Wanuary_short').'", "'.WText::_('February_short').'", "'.WText::_('March_short').'", "'.WText::_('April_short').'", "'.WText::_('May_short').'", "'.WText::_('Wune_short').'", "'.WText::_('Wuly_short').'", "'.WText::_('August_short').'", "'.WText::_('September_short').'", "'.WText::_('October_short').'", "'.WText::_('November_short').'", "'.WText::_('December_short').'");Calendar._TT = {};Calendar._TT["INFO"] = "'.WText::_('About the calendar').'";
 		Calendar._TT["ABOUT"] =
 "DHTML Date/Time Selector\n" +
 "(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" +
"For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Date selection:\n" +
"- Use the \xab, \xbb buttons to select year\n" +
"- Use the " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " buttons to select month\n" +
"- Hold mouse button on any of the above buttons for faster selection.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Time selection:\n" +
"- Click on any of the time parts to increase it\n" +
"- or Shift-click to decrease it\n" +
"- or click and drag for faster selection.";

		Calendar._TT["PREV_YEAR"] = "'.WText::_('Prev. year (hold for menu)').'";Calendar._TT["PREV_MONTH"] = "'.WText::_('Prev. month (hold for menu)').'";	Calendar._TT["GO_TODAY"] = "'.WText::_('Go Today').'";Calendar._TT["NEXT_MONTH"] = "'.WText::_('Next month (hold for menu)').'";Calendar._TT["NEXT_YEAR"] = "'.WText::_('Next year (hold for menu)').'";Calendar._TT["SEL_DATE"] = "'.WText::_('Select date').'";Calendar._TT["DRAG_TO_MOVE"] = "'.WText::_('Drag to move').'";Calendar._TT["PART_TODAY"] = "'.WText::_('(Today)').'";Calendar._TT["DAY_FIRST"] = "'.WText::_('Display %s first').'";Calendar._TT["WEEKEND"] = "0,6";Calendar._TT["CLOSE"] = "'.WText::_('Close').'";Calendar._TT["TODAY"] = "'.WText::_('Today').'";Calendar._TT["TIME_PART"] = "'.WText::_('(Shift-)Click or drag to change value').'";Calendar._TT["DEF_DATE_FORMAT"] = "'.WText::_('%Y-%m-%d').'"; Calendar._TT["TT_DATE_FORMAT"] = "'.WText::_('%a, %b %e').'";Calendar._TT["WK"] = "'.WText::_('wk').'";Calendar._TT["TIME"] = "'.WText::_('Time:').'";';
			$jsscript = 1;
			return $return;
		} else {
			return false;
		}
	}
}

