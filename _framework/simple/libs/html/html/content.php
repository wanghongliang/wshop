<?php
 

/**
 * Utility class to fire onPrepareContent for non-article based content.
 *
  * @subpackage	HTML
 * @since		1.5
 */
class WHTMLContent
{
	/**
	 * Fire onPrepareContent for content that isn't part of an article.
	 *
	 * @param string The content to be transformed.
	 * @param array The content params.
	 * @return string The content after transformation.
	 */
	function prepare($text, $params = null)
	{
		if ($params === null) {
			$params = array();
		}
		/*
		 * Create a skeleton of an article
		 */
		$article = new stdClass();
		$article->text = $text;
		WPluginHelper::importPlugin('content');
		$dispatcher = &WDispatcher::getInstance();
		$results = $dispatcher->trigger(
			'onPrepareContent', array (&$article, &$params, 0)
		);

		return $article->text;
	}

}
