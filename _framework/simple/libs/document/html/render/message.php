<?php
 
class DocumentRenderMessage
{
 
	function render($name = null, $params = array (), $content = null)
	{
		global $app;

		// Initialize variables
		$contents	= null;
		$lists		= null;

		// Get the message queue
		$messages = $app->getMessageQueue();


 

		// Build the sorted message list
		if (is_array($messages) && count($messages)) {
			foreach ($messages as $msg)
			{
				if (isset($msg['type']) && isset($msg['message'])) {
					$lists[$msg['type']][] = $msg['message'];
				}
			}
		}

		// If messages exist render them
		if (is_array($lists))
		{
			$className=strtolower($type);

			// Build the return string
			$contents .= "\n<dl id=\"system-message\" class=\"".$className."\" >";
			foreach ($lists as $type => $msgs)
			{
				if (count($msgs)) {
					//$contents .= "\n<dt class=\"".$className."\">".WText::_( $type )."</dt>";
					$contents .= "\n<dt class=\"".$className."\">消息提示:</dt>";
					$contents .= "\n<dd class=\"".$className." message fade\">";
					$contents .= "\n\t<ul class='".$type."-text'>";
					foreach ($msgs as $msg)
					{
						$contents .="\n\t\t<li>".$msg."</li>";
					}
					$contents .= "\n\t</ul>";
					$contents .= "\n</dd>";
				}
			}
			$contents .= "\n</dl>";
		}
		return $contents;
	}
}