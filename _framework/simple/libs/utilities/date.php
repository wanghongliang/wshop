<?php
class WDate{
	var $time;

	var $date;

	/**
	 * Unix timestamp
	 *
	 * @var     int|boolean
	 * @access  protected
	 */
	var $_date = false;

	/**
	 * Time offset (in seconds)
	 *
	 * @var     string
	 * @access  protected
	 */
	var $_offset = 0;


	function WDate($date = 'now', $tzOffset = 0){
		$this->__construct($date,$tzOffset);
	}
	

	/***返回时间***/
	function getTime(){
		$dateString=$this->_date;
		$ymd_his=explode(" ",$dateString);

		$ymd=explode('-',$ymd_his[0]);
		$his=explode(':',$ymd_his[1]);

		//echo intval($his[0]),$his[1],$his[2],$ymd[1],$ymd[2],$ymd[0],'<br>';

		//print_r($ymd);
		$his[0]=$his[0]?$his[0]:date('H');
		$his[1]=$his[1]?$his[1]:date('i');
		$his[2]=$his[2]?$his[2]:date('s');
		return mktime(intval($his[0]),intval($his[1]),intval($his[2]),intval($ymd[1]),intval($ymd[2]),intval($ymd[0]));
	}

	function getTime2( $str=null )
	{
		$timezone = isset($_SESSION['timezone']) ? $_SESSION['timezone'] : $GLOBALS['_CFG']['timezone']; 
		/**
		* $time = mktime($hour, $minute, $second, $month, $day, $year) - date('Z') + (date('Z') - $timezone * 3600)
		* 先用mktime生成时间戳，再减去date('Z')转换为GMT时间，然后修正为用户自定义时间。以下是化简后结果
		**/
		$time = strtotime($str) - $timezone * 3600;

		return $time;

	}


	/***比较是否是本周内***/

	function isInnerWeek($dateString){
		
		$d=(int)(substr($dateString,8,2));


		$currentTime=time();
 

		//今天星期几
		$w=date('w',$currentTime);
		//本星期是从几号开始的
		$w_start_day=date('d',$currentTime)-$w;

		//本星期
		return  $w_start_day<$d;
		
		
	}
	
	/***比较是否是本月内***/
	function isInnerMonth($dateString){
 
		$m=(int)(substr($dateString,5,2));
		$currentTime=time();
		$currentM=date('m',$currentTime);
	 
		return $m==$currentM;
  	}
	 
	function __construct($date = 'now', $tzOffset = 0)
	{

 		if ($date == 'now' || empty($date))
		{
			$this->_date = strtotime(gmdate("M d Y H:i:s", time()));
			return;
		}

		$tzOffset *= 3600;


		if (is_numeric($date))
		{
			$this->_date = $date - $tzOffset;
			return;
		}

		if (preg_match('~(?:(?:Mon|Tue|Wed|Thu|Fri|Sat|Sun),\\s+)?(\\d{1,2})\\s+([a-zA-Z]{3})\\s+(\\d{4})\\s+(\\d{2}):(\\d{2}):(\\d{2})\\s+(.*)~i',$date,$matches))
		{
			$months = Array(
				'jan' => 1, 'feb' => 2, 'mar' => 3, 'apr' => 4,
				'may' => 5, 'jun' => 6, 'jul' => 7, 'aug' => 8,
				'sep' => 9, 'oct' => 10, 'nov' => 11, 'dec' => 12
			);
			$matches[2] = strtolower($matches[2]);
			if (! isset($months[$matches[2]])) {
				return;
			}
			$this->_date = mktime(
				$matches[4], $matches[5], $matches[6],
				$months[$matches[2]], $matches[1], $matches[3]
			);
			if ($this->_date === false) {
				return;
			}

			if ($matches[7][0] == '+') {
				$tzOffset = 3600 * substr($matches[7], 1, 2)
					+ 60 * substr($matches[7], -2);
			} elseif ($matches[7][0] == '-') {
				$tzOffset = -3600 * substr($matches[7], 1, 2)
					- 60 * substr($matches[7], -2);
			} else {
				if (strlen($matches[7]) == 1) {
					$oneHour = 3600;
					$ord = ord($matches[7]);
					if ($ord < ord('M')) {
						$tzOffset = (ord('A') - $ord - 1) * $oneHour;
					} elseif ($ord >= ord('M') && $matches[7] != 'Z') {
						$tzOffset = ($ord - ord('M')) * $oneHour;
					} elseif ($matches[7] == 'Z') {
						$tzOffset = 0;
					}
				}
				switch ($matches[7]) {
					case 'UT':
					case 'GMT': $tzOffset = 0;
				}
			}
			$this->_date -= $tzOffset;
			return;
		}
		if (preg_match('~(\\d{4})-(\\d{2})-(\\d{2})[T\s](\\d{2}):(\\d{2}):(\\d{2})(.*)~', $date, $matches))
		{
			$this->_date = mktime(
				$matches[4], $matches[5], $matches[6],
				$matches[2], $matches[3], $matches[1]
			);
			if ($this->_date == false) {
				return;
			}
			if (isset($matches[7][0])) {
				if ($matches[7][0] == '+' || $matches[7][0] == '-') {
					$tzOffset = 60 * (
						substr($matches[7], 0, 3) * 60 + substr($matches[7], -2)
					);
				} elseif ($matches[7] == 'Z') {
					$tzOffset = 0;
				}
			}
			$this->_date -= $tzOffset;
			return;
		}
        $this->_date = (strtotime($date) == -1) ? false : strtotime($date);
		if ($this->_date) {
			$this->_date -= $tzOffset;
		} 
	}

	/**
	 * Set the date offset (in hours)
	 *
	 * @access public
	 * @param float The offset in hours
	 */
	function setOffset($offset) {
		$this->_offset = 3600 * $offset;
	}

	/**
	 * Get the date offset (in hours)
	 *
	 * @access public
	 * @return integer
	 */
	function getOffset() {
		return ((float) $this->_offset) / 3600.0;
	}

	/**
	 * Gets the date as an RFC 822 date.
	 *
	 * @return a date in RFC 822 format
	 * @link http://www.ietf.org/rfc/rfc2822.txt?number=2822 IETF RFC 2822
	 * (replaces RFC 822)
	 */
	function toRFC822($local = false)
	{
		$date = ($local) ? $this->_date + $this->_offset : $this->_date;
		$date = ($this->_date !== false) ? date('D, d M Y H:i:s O', $date) : null;
		return $date;
	}

	/**
	 * Gets the date as an ISO 8601 date.
	 *
	 * @return a date in ISO 8601 (RFC 3339) format
	 * @link http://www.ietf.org/rfc/rfc3339.txt?number=3339 IETF RFC 3339
	 */
	function toISO8601($local = false)
	{
		$date   = ($local) ? $this->_date + $this->_offset : $this->_date;
        $offset = ($local) ? sprintf("%+03d", $this->getOffset()).':00' : 'Z';
        $date   = ($this->_date !== false) ? date('Y-m-d\TH:i:s', $date).$offset : null;
		return $date;
	}

	/**
	 * Gets the date as in MySQL datetime format
	 *
	 * @return a date in MySQL datetime format
	 * @link http://dev.mysql.com/doc/refman/4.1/en/datetime.html MySQL DATETIME
	 * format
	 */
	function toMySQL($local = false)
	{
		$date = ($local) ? $this->_date + $this->_offset : $this->_date;
		$date = ($this->_date !== false) ? date('Y-m-d H:i:s', $date) : null;
		return $date;
	}

	/**
	 * Gets the date as UNIX time stamp.
	 *
	 * @return a date as a unix time stamp
	 */
	function toUnix($local = false)
	{
		$date = null;
		if ($this->_date !== false) {
			$date = ($local) ? $this->_date + $this->_offset : $this->_date;
		}
		return $date;
	}

	/**
	 * Gets the date in a specific format
	 *
	 * Returns a string formatted according to the given format. Month and weekday names and
	 * other language dependent strings respect the current locale
	 *
	 * @param string $format  The date format specification string (see {@link PHP_MANUAL#strftime})
	 * @return a date in a specific format
	 */
	function toFormat($format = '%Y-%m-%d %H:%M:%S')
	{
		$date = ($this->_date !== false) ? $this->_strftime($format, $this->_date + $this->_offset) : null;

		return $date;
	}

	/**
	 * Translates needed strings in for WDate::toFormat (see {@link PHP_MANUAL#strftime})
	 *
	 * @access protected
	 * @param string $format The date format specification string (see {@link PHP_MANUAL#strftime})
	 * @param int $time Unix timestamp
	 * @return string a date in the specified format
	 */
	function _strftime($format, $time)
	{
		if(strpos($format, '%a') !== false)
			$format = str_replace('%a', $this->_dayToString(date('w', $time), true), $format);
		if(strpos($format, '%A') !== false)
			$format = str_replace('%A', $this->_dayToString(date('w', $time)), $format);
		if(strpos($format, '%b') !== false)
			$format = str_replace('%b', $this->_monthToString(date('n', $time), true), $format);
		if(strpos($format, '%B') !== false)
			$format = str_replace('%B', $this->_monthToString(date('n', $time)), $format);
		$date = strftime($format, $time);
		return $date;
	}

	/**
	 * Translates month number to string
	 *
	 * @access protected
	 * @param int $month The numeric month of the year
	 * @param bool $abbr Return the abreviated month string?
	 * @return string month string
	 */
	function _monthToString($month, $abbr = false)
	{
		switch ($month)
		{
			case 1:  return $abbr ? WText::_('WANUARY_SHORT')   : WText::_('JANUARY');
			case 2:  return $abbr ? WText::_('FEBRUARY_SHORT')  : WText::_('FEBRUARY');
			case 3:  return $abbr ? WText::_('MARCH_SHORT')     : WText::_('MARCH');
			case 4:  return $abbr ? WText::_('APRIL_SHORT')     : WText::_('APRIL');
			case 5:  return $abbr ? WText::_('MAY_SHORT')       : WText::_('MAY');
			case 6:  return $abbr ? WText::_('JUNE_SHORT')      : WText::_('JUNE');
			case 7:  return $abbr ? WText::_('JULY_SHORT')      : WText::_('JULY');
			case 8:  return $abbr ? WText::_('AUGUST_SHORT')    : WText::_('AUGUST');
			case 9:  return $abbr ? WText::_('SEPTEMBER_SHORT')  : WText::_('SEPTEMBER');
			case 10: return $abbr ? WText::_('OCTOBER_SHORT')   : WText::_('OCTOBER');
			case 11: return $abbr ? WText::_('NOVEMBER_SHORT')  : WText::_('NOVEMBER');
			case 12: return $abbr ? WText::_('DECEMBER_SHORT')  : WText::_('DECEMBER');
		}
	}

	/**
	 * Translates day of week number to string
	 *
	 * @access protected
	 * @param int $day The numeric day of the week
	 * @param bool $abbr Return the abreviated day string?
	 * @return string day string
	 */
	function _dayToString($day, $abbr = false)
	{
		switch ($day)
		{
			case 0: return $abbr ? WText::_('SUN') : WText::_('SUNDAY');
			case 1: return $abbr ? WText::_('MON') : WText::_('MONDAY');
			case 2: return $abbr ? WText::_('TUE') : WText::_('TUESDAY');
			case 3: return $abbr ? WText::_('WED') : WText::_('WEDNESDAY');
			case 4: return $abbr ? WText::_('THU') : WText::_('THURSDAY');
			case 5: return $abbr ? WText::_('FRI') : WText::_('FRIDAY');
			case 6: return $abbr ? WText::_('SAT') : WText::_('SATURDAY');
		}
	}

}
?>