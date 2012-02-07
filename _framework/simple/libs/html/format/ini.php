<?php
 
class FormatINI 
{
 
	function arrayToString( &$arr  )
	{

		// 初始化相关变量
		$retval = '';
		$prepend = '';

		// First handle groups (or first level key/value pairs)
		foreach ($arr as $key => $level1)
		{
			if (is_object($level1))
			{
				// This field is an object, so we treat it as a section
				$retval .= "[".$key."]\n";
				foreach (get_object_vars($level1) as $key => $level2)
				{
					if (!is_object($level2) && !is_array($level2))
					{
						// Join lines
						$level2		= str_replace('|', '\|', $level2);
						$level2		= str_replace(array("\r\n", "\n"), '\\n', $level2);
						$retval		.= $key."=".$level2."\n";
					}
				}
				$retval .= "\n";
			}
			elseif (is_array($level1))
			{
				foreach ($level1 as $k1 => $v1)
				{
					// Escape any pipe characters before storing
					$level1[$k1]	= str_replace('|', '\|', $v1);
					$level1[$k1]	= str_replace(array("\r\n", "\n"), '\\n', $v1);
				}

				// Implode the array to store
				$prepend	.= $key."=".implode('|', $level1)."\n";
			}
			else
			{
				// Join lines
				$level1		= str_replace('|', '\|', $level1);
				$level1		= str_replace(array("\r\n", "\n"), '\\n', $level1);
				$prepend	.= $key."=".$level1."\n";
			}
		}

		return $prepend."\n".$retval;
	}

	/**
	 * Parse an .ini string, based on phpDocumentor phpDocumentor_parse_ini_file function
	 *
	 * @param mixed The INI string or array of lines
	 * @param boolean add an associative index for each section [in brackets]
	 * @return object Data Object
	 */
	function &stringToArray( $data, $process_sections = false )
	{
		static $inistocache;

		if (!isset( $inistocache )) {
			$inistocache = array();
		}

		if (is_string($data))
		{
			$lines = explode("\n", $data);
			$hash = md5($data);
		}
		else
		{
			if (is_array($data)) {
				$lines = $data;
			} else {
				$lines = array ();
			}
			$hash = md5(implode("\n",$lines));
		}

		if(array_key_exists($hash, $inistocache)) {
			return $inistocache[$hash];
		}

		$arr = array();

		$sec_name = '';
		$unparsed = 0;
		if (!$lines) {
			return $arr;
		}

		foreach ($lines as $line)
		{
			// ignore comments
			if ($line && $line{0} == ';') {
				continue;
			}

			$line = trim($line);

			if ($line == '') {
				continue;
			}

			$lineLen = strlen($line);
			if ($line && $line{0} == '[' && $line{$lineLen-1} == ']')
			{
				$sec_name = substr($line, 1, $lineLen - 2);
				if ($process_sections) {
					$arr[$sec_name] = new stdClass();
				}
			}
			else
			{
				if ($pos = strpos($line, '='))
				{
					$property = trim(substr($line, 0, $pos));

					// property is assumed to be ascii
					if ($property && $property{0} == '"')
					{
						$propLen = strlen( $property );
						if ($property{$propLen-1} == '"') {
							$property = stripcslashes(substr($property, 1, $propLen - 2));
						}
					}
					// AJE: 2006-11-06 Fixes problem where you want leading spaces
					// for some parameters, eg, class suffix
					// $value = trim(substr($line, $pos +1));
					$value = substr($line, $pos +1);

					if (strpos($value, '|') !== false && preg_match('#(?<!\\\)\|#', $value))
					{
						$newlines = explode('\n', $value);
						$values = array();
						foreach($newlines as $newlinekey=>$newline) {

							// Explode the value if it is serialized as an arry of value1|value2|value3
							$parts	= preg_split('/(?<!\\\)\|/', $newline);
							$array	= (strcmp($parts[0], $newline) === 0) ? false : true;
							$parts	= str_replace('\|', '|', $parts);

							foreach ($parts as $key => $value)
							{
								if ($value == 'false') {
									$value = false;
								}
								else if ($value == 'true') {
									$value = true;
								}
								else if ($value && $value{0} == '"')
								{
									$valueLen = strlen( $value );
									if ($value{$valueLen-1} == '"') {
										$value = stripcslashes(substr($value, 1, $valueLen - 2));
									}
								}
								if(!isset($values[$newlinekey])) $values[$newlinekey] = array();
								$values[$newlinekey][] = str_replace('\n', "\n", $value);
							}

							if (!$array) {
								$values[$newlinekey] = $values[$newlinekey][0];
							}
						}

						if ($process_sections)
						{
							if ($sec_name != '') {
								$arr[$sec_name]->$property = $values[$newlinekey];
							} else {
								$arr[$property] = $values[$newlinekey];
							}
						}
						else
						{
							$arr[$property] = $values[$newlinekey];
						}
					}
					else
					{
						//unescape the \|
						$value = str_replace('\|', '|', $value);

						if ($value == 'false') {
							$value = false;
						}
						else if ($value == 'true') {
							$value = true;
						}
						else if ($value && $value{0} == '"')
						{
							$valueLen = strlen( $value );
							if ($value{$valueLen-1} == '"') {
								$value = stripcslashes(substr($value, 1, $valueLen - 2));
							}
						}

						if ($process_sections)
						{
							$value = str_replace('\n', "\n", $value);
							if ($sec_name != '') {
								$arr[$sec_name][$property] = $value;
							} else {
								$arr[$property] = $value;
							}
						}
						else
						{
							$arr[$property] = str_replace('\n', "\n", $value);
						}
					}
				}
				else
				{
					if ($line && $line{0} == ';') {
						continue;
					}
					if ($process_sections)
					{
						$property = '__invalid'.$unparsed ++.'__';
						if ($process_sections)
						{
							if ($sec_name != '') {
								$arr[$sec_name][$property] = trim($line);
							} else {
								$arr[$property] = trim($line);
							}
						}
						else
						{
							$arr[$property] = trim($line);
						}
					}
				}
			}
		}

		$inistocache[$hash] = ($arr);
		return $arr;
	}
}
