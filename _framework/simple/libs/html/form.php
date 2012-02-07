<?php  
class Form {

	/**
	 * Generates an opening HTML form tag.
	 *
	 * @param   string  form action attribute
	 * @param   array   extra attributes
	 * @param   array   hidden fields to be created immediately after the form tag
	 * @return  string
	 */
	function open($action = NULL, $attr = array(), $hidden = NULL)
	{
		// Make sure that the method is always set
		empty($attr['method']) and $attr['method'] = 'post';

		if ($attr['method'] !== 'post' AND $attr['method'] !== 'get')
		{
			// If the method is invalid, use post
			$attr['method'] = 'post';
		}

		if ($action === NULL)
		{
			// Use the current URL as the default action
			$action = '';
		}
		elseif (strpos($action, '://') === FALSE)
		{
			// Make the action URI into a URL
			//$action = $action;
		}

		// Set action
		$attr['action'] = $action;

		// Form opening tag
		$form = '<form'.Form::attributes($attr).'>'."\n";

		// Add hidden fields immediate after opening tag
		empty($hidden) or $form .= Form::hidden($hidden);

		return $form;
	}

	/**
	 * Generates an opening HTML form tag that can be used for uploading files.
	 *
	 * @param   string  form action attribute
	 * @param   array   extra attributes
	 * @param   array   hidden fields to be created immediately after the form tag
	 * @return  string
	 */
	function open_multipart($action = NULL, $attr = array(), $hidden = array())
	{
		// Set multi-part form type
		$attr['enctype'] = 'multipart/form-data';

		return Form::open($action, $attr, $hidden);
	}

	/**
	 * Generates a fieldset opening tag.
	 *
	 * @param   array   html attributes
	 * @param   string  a string to be attached to the end of the attributes
	 * @return  string
	 */
	function open_fieldset($data = NULL, $extra = '')
	{
		return '<fieldset'.html::attributes((array) $data).' '.$extra.'>'."\n";
	}

	/**
	 * Generates a fieldset closing tag.
	 *
	 * @return  string
	 */
	function close_fieldset()
	{
		return '</fieldset>'."\n";
	}

	/**
	 * Generates a legend tag for use with a fieldset.
	 *
	 * @param   string  legend text
	 * @param   array   HTML attributes
	 * @param   string  a string to be attached to the end of the attributes
	 * @return  string
	 */
	function legend($text = '', $data = NULL, $extra = '')
	{
		return '<legend'.Form::attributes((array) $data).' '.$extra.'>'.$text.'</legend>'."\n";
	}

	/**
	 * Generates hidden form fields.
	 * You can pass a simple key/value string or an associative array with multiple values.
	 *
	 * @param   string|array  input name (string) or key/value pairs (array)
	 * @param   string        input value, if using an input name
	 * @return  string
	 */
	function hidden($data, $value = '')
	{
		if ( ! is_array($data))
		{
			$data = array
			(
				$data => $value
			);
		}

		$input = '';
		foreach ($data as $name => $value)
		{
			$attr = array
			(
				'type'  => 'hidden',
				'name'  => $name,
				'value' => $value
			);

			$input .= Form::input($attr)."\n";
		}

		return $input;
	}

	/**
	 * Creates an HTML form input tag. Defaults to a text type.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function input($data, $value = '', $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		// Type and value are required attributes
		$data += array
		(
			'type'  => 'text',
			'value' => $value
		);

		return '<input'.Form::attributes($data).' '.$extra.' />';
	}

	/**
	 * Creates a HTML form password input tag.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function password($data, $value = '', $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		$data['type'] = 'password';

		return Form::input($data, $value, $extra);
	}

	/**
	 * Creates an HTML form upload input tag.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function upload($data, $value = '', $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		$data['type'] = 'file';

		return Form::input($data, $value, $extra);
	}

	/**
	 * Creates an HTML form textarea tag.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   string        a string to be attached to the end of the attributes
	 * @param   boolean       encode existing entities
	 * @return  string
	 */
	function textarea($data, $value = '', $extra = '', $double_encode = TRUE)
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		// Use the value from $data if possible, or use $value
		$value = isset($data['value']) ? $data['value'] : $value;

		// Value is not part of the attributes
		unset($data['value']);

		return '<textarea'.Form::attributes($data, 'textarea').' '.$extra.'>'.Form::specialchars($value, $double_encode).'</textarea>';
	}

	/**
	 * Creates an HTML form select tag, or "dropdown menu".
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   array         select options, when using a name
	 * @param   string|array  option key(s) that should be selected by default
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function dropdown($data, $options = NULL, $selected = NULL, $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}
		else
		{
			if (isset($data['options']))
			{
				// Use data options
				$options = $data['options'];
			}

			if (isset($data['selected']))
			{
				// Use data selected
				$selected = $data['selected'];
			}
		}

		if (is_array($selected))
		{
			// Multi-select box
			$data['multiple'] = 'multiple';
		}
		else
		{
			// Single selection (but converted to an array)
			$selected = array($selected);
		}

 
		$input = '<select'.Form::attributes($data, 'select').' '.$extra.'>'."\n";
		foreach ((array) $options as $key => $val)
		{
			// Key should always be a string
			$key = (string) $key;

			if (is_array($val))
			{
				$input .= '<optgroup label="'.$key.'">'."\n";
				foreach ($val as $inner_key => $inner_val)
				{
					// Inner key should always be a string
					$inner_key = (string) $inner_key;

					$sel = in_array($inner_key, $selected) ? ' selected="selected"' : '';
					$input .= '<option value="'.$inner_key.'"'.$sel.'>'.$inner_val.'</option>'."\n";
				}
				$input .= '</optgroup>'."\n";
			}
			else
			{
 
				 $sel = in_array($key, $selected) ? ' selected="selected"' : '';
 				$input .= '<option value="'.$key.'"'.$sel.'>'.$val.'</option>'."\n";
			}
		}
		$input .= '</select>';

		return $input;
	}

	function _buildTreeOptions(&$arr,$pid=0,$depth=0,$selectID =0,$data = array() )
	{
		
		if( is_array( $arr[$pid] ) )
		{
			$depth++;	//加一个深度,当启动递归时
			$items = $arr[$pid];
			foreach( $items as $item )
			{

				//是否为选择父栏目框
				if( $selectID > 0 && $selectID == $item['id'] ){
					continue;
				}

				$str ='&nbsp;';

				if( $depth > 1 ){	//子栏 
					for($i=1;$i<$depth;$i++){
						$str.= '&nbsp;&nbsp;';
					}
					$str .= '└';
				}else{

				}
				
				//⊥－├┌└$str .= $item['id'];
				$str .= $item['name'];// 名称
				//echo $item['parent_id'];

				$data[$item['id']] = $str;
				Form::_buildTreeOptions($arr,$item['id'],$depth,$selectID, $data);
 			}
		}

		return $data;
	}

	/** 
	 * 构造所有菜单选择框
	 * $arr 以父ID为索引的多维数组
	 * $pid 父ID
	 * $depth 深度
	 * $com 不能选择的 $com 
	 */
	function _buildAllSelect(&$arr,$pid=0,$depth=0,$com = '',$selectid=0)
	{
		
		$str = '';
		if( is_array( $arr[$pid] ) )
		{
			$depth++;	//加一个深度,当启动递归时
			$items = $arr[$pid];
 
			foreach( $items as $item )
			{
 
				$str .='<option value="'.$item['id'].'" ';
				if( $com != $item['component'] or $item['id']==$selectid )
				{
					$str.=" disabled=\"disabled\" ";
				}
				$str .='> &nbsp;';

				if( $depth > 1 ){	//子栏 
					for($i=1;$i<$depth;$i++){
						$str.= '&nbsp;&nbsp;';
					}
					$str .= '└';
				}else{

				}
				//⊥－├┌└$str .= $item['id'];
				$str .= $item['name'];// 名称
				//echo $item['parent_id'];
				$str .="</option>";
				$str .= Form::_buildAllSelect($arr,$item['id'],$depth,$com );
 			}
		}

		return $str;
	}


	/**
	 * Creates an HTML form checkbox input tag.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   boolean       make the checkbox checked by default
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function checkbox($data, $value = '', $checked = FALSE, $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		$data['type'] = 'checkbox';

		if ($checked == TRUE OR (isset($data['checked']) AND $data['checked'] == TRUE))
		{
			$data['checked'] = 'checked';
		}
		else
		{
			unset($data['checked']);
		}

		return Form::input($data, $value, $extra);
	}

	/**
	 * Creates an HTML form radio input tag.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   boolean       make the radio selected by default
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function radio($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		$data['type'] = 'radio';

		if ($checked == TRUE OR (isset($data['checked']) AND $data['checked'] == TRUE))
		{
			$data['checked'] = 'checked';
		}
		else
		{
			unset($data['checked']);
		}

		return Form::input($data, $value, $extra);
	}

	/**
	 * Creates an HTML form submit input tag.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function submit($data = '', $value = '', $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		if (empty($data['name']))
		{
			// Remove the name if it is empty
			unset($data['name']);
		}

		$data['type'] = 'submit';

		return Form::input($data, $value, $extra);
	}

	/**
	 * Creates an HTML form button input tag.
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   string        input value, when using a name
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function button($data = '', $value = '', $extra = '')
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		if (empty($data['name']))
		{
			// Remove the name if it is empty
			unset($data['name']);
		}

		if (isset($data['value']) AND empty($value))
		{
			$value = arr::remove('value', $data);
		}

		return '<button'.Form::attributes($data, 'button').' '.$extra.'>'.$value.'</button>';
	}

	/**
	 * Closes an open form tag.
	 *
	 * @param   string  string to be attached after the closing tag
	 * @return  string
	 */
	function close($extra = '')
	{
		return '</form>'."\n".$extra;
	}

	/**
	 * Creates an HTML form label tag.
	 *
	 * @param   string|array  label "for" name or an array of HTML attributes
	 * @param   string        label text or HTML
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	function label($data = '', $text = NULL, $extra = '')
	{
		if ( ! is_array($data))
		{
			if (is_string($data))
			{
				// Specify the input this label is for
				$data = array('for' => $data);
			}
			else
			{
				// No input specified
				$data = array();
			}
		}

		if ($text === NULL AND isset($data['for']))
		{
			// Make the text the human-readable input name
			$text = ucwords(inflector::humanize($data['for']));
		}

		return '<label'.Form::attributes($data).' '.$extra.'>'.$text.'</label>';
	}

	/**
	 * Sorts a key/value array of HTML attributes, putting form attributes first,
	 * and returns an attribute string.
	 *
	 * @param   array   HTML attributes array
	 * @return  string
	 */
	function attributes($attr, $type = NULL)
	{
		if (empty($attr))
			return '';

		if (isset($attr['name']) AND empty($attr['id']) AND strpos($attr['name'], '[') === FALSE)
		{
			if ($type === NULL AND ! empty($attr['type']))
			{
				// Set the type by the attributes
				$type = $attr['type'];
			}

			switch ($type)
			{
				case 'text':
				case 'textarea':
				case 'password':
				case 'select':
				case 'checkbox':
				case 'file':
				case 'image':
				case 'button':
				case 'submit':
					// Only specific types of inputs use name to id matching
					$attr['id'] = $attr['name'];
				break;
			}
		}

		$order = array
		(
			'action',
			'method',
			'type',
			'id',
			'name',
			'value',
			'src',
			'size',
			'maxlength',
			'rows',
			'cols',
			'accept',
			'tabindex',
			'accesskey',
			'align',
			'alt',
			'title',
			'class',
			'style',
			'selected',
			'checked',
			'readonly',
			'disabled'
		);

		$sorted = array();
		foreach ($order as $key)
		{
			if (isset($attr[$key]))
			{
				// Move the attribute to the sorted array
				$sorted[$key] = $attr[$key];

				// Remove the attribute from unsorted array
				unset($attr[$key]);
			}
		}

		// Combine the sorted and unsorted attributes and create an HTML string
		return Form::attributes2(array_merge($sorted, $attr));
	}

	function attributes2($attrs)
	{
		if (empty($attrs))
			return '';

		if (is_string($attrs))
			return ' '.$attrs;

		$compiled = '';
		foreach ($attrs as $key => $val)
		{
			$compiled .= ' '.$key.'="'.Form::specialchars($val).'"';
		}

		return $compiled;
	}
	function specialchars($str, $double_encode = TRUE)
	{
		// Force the string to be a string
		$str = (string) $str;

		// Do encode existing HTML entities (default)
		if ($double_encode === TRUE)
		{
			$str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
		}
		else
		{
			// Do not encode existing HTML entities
			// From PHP 5.2.3 this functionality is built-in, otherwise use a regex
			if (version_compare(PHP_VERSION, '5.2.3', '>='))
			{
				$str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8', FALSE);
			}
			else
			{
				$str = preg_replace('/&(?!(?:#\d++|[a-z]++);)/ui', '&amp;', $str);
				$str = str_replace(array('<', '>', '\'', '"'), array('&lt;', '&gt;', '&#39;', '&quot;'), $str);
			}
		}

		return $str;
	}

} // End form