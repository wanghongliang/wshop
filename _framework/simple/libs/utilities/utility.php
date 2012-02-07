<?php
/*
 @ URL:		/libraries/whl/utilities/utility.php
 @ �� ��  �� utility.php
 @ �� ��  �� ʵ�ù��߶���
 @ ��     �� XSystem 
 @ ʱ ��  �� 2008-2-28
 @ ������ �� WHL
*/

// Check to ensure this file is within the rest of the framework
defined('PATH_BASE') or die();

/**
 * WUtility is a utility functions class
 *
 * @static
 * @package 	Woomla.Framework
 * @subpackage	Utilities
 * @since	1.5
 */
class Utility
{
	/**
 	 * Mail function (uses phpMailer)
 	 *
 	 * @param string $from From e-mail address
 	 * @param string $fromname From name
 	 * @param mixed $recipient Recipient e-mail address(es)
 	 * @param string $subject E-mail subject
 	 * @param string $body Message body
 	 * @param boolean $mode false = plain text, true = HTML
 	 * @param mixed $cc CC e-mail address(es)
 	 * @param mixed $bcc BCC e-mail address(es)
 	 * @param mixed $attachment Attachment file name(s)
 	 * @param mixed $replyto Reply to email address(es)
 	 * @param mixed $replytoname Reply to name(s)
 	 * @return boolean True on success
  	 */
	function sendMail($from, $fromname, $recipient, $subject, $body, $mode=0, $cc=null, $bcc=null, $attachment=null, $replyto=null, $replytoname=null )
	{
	 	// Get a WMail instance
		$mail =& WFactory::getMailer();

		$mail->setSender(array($from, $fromname));
		$mail->setSubject($subject);
		$mail->setBody($body);

		// Are we sending the email as HTML?
		if ( $mode ) {
			$mail->IsHTML(true);
		}

		$mail->addRecipient($recipient);
		$mail->addCC($cc);
		$mail->addBCC($bcc);
		$mail->addAttachment($attachment);

		// Take care of reply email addresses
		if( is_array( $replyto ) ) {
			$numReplyTo = count($replyto);
			for ( $i=0; $i < $numReplyTo; $i++){
				$mail->addReplyTo( array($replyto[$i], $replytoname[$i]) );
			}
		} elseif( isset( $replyto ) ) {
			$mail->addReplyTo( array( $replyto, $replytoname ) );
		}

		return  $mail->Send();
	}

	/**
	 * Sends mail to administrator for approval of a user submission
 	 *
 	 * @param string $adminName Name of administrator
 	 * @param string $adminEmail Email address of administrator
 	 * @param string $email [NOT USED TODO: Deprecate?]
 	 * @param string $type Type of item to approve
 	 * @param string $title Title of item to approve
 	 * @param string $author Author of item to approve
 	 * @return boolean True on success
 	 */
	function sendAdminMail( $adminName, $adminEmail, $email, $type, $title, $author, $url = null )
	{
		$subject = WText::_( 'User Submitted' ) ." '". $type ."'";

		$message = sprintf ( WText::_( 'MAIL_MSG_ADMIN' ), $adminName, $type, $title, $author, $url, $url, 'administrator', $type);
		$message .= WText::_( 'MAIL_MSG') ."\n";

	 	// Get a WMail instance
		$mail =& WFactory::getMailer();
		$mail->addRecipient($adminEmail);
		$mail->setSubject($subject);
		$mail->setBody($message);

		return  $mail->Send();
	}

	/**
  	 * Provides a secure hash based on a seed
 	 *
 	 * @param string Seed string
 	 * @return string
 	 */
	function getHash( $seed )
	{
		$conf =& WFactory::getConfig();
		return md5( $conf->getValue('config.secret') .  $seed  );
	}

	/**
	 * Method to determine a hash for anti-spoofing variable names
	 *
	 * @return	string	Hashed var name
	 * @since	1.5
	 * @static
	 */
	function getToken($forceNew = false)
	{
		$user		= &WFactory::getUser();
		$session	= &WFactory::getSession();
		$hash		= WUtility::getHash( $user->get( 'id', 0 ).$session->getToken( $forceNew ) );
		return $hash;
	}

	/**
 	 * Method to extract key/value pairs out of a string with xml style attributes
 	 *
 	 * @param	string	$string	String containing xml style attributes
 	 * @return	array	Key/Value pairs for the attributes
 	 * @since	1.5
 	 */
	function parseAttributes( $string )
	{
	 	//Initialize variables
		$attr		= array();
		$retarray	= array();

		// Lets grab all the key/value pairs using a regular expression
		preg_match_all( '/([\w:-]+)[\s]?=[\s]?"([^"]*)"/i', $string, $attr );

		if (is_array($attr))
		{
			$numPairs = count($attr[1]);
			for($i = 0; $i < $numPairs; $i++ )
			{
				$retarray[$attr[1][$i]] = $attr[2][$i];
			}
		}
		return $retarray;
	}

	/**
	 * Method to determine if the host OS is  Windows
	 *
	 * @return	true if Windows OS
	 * @since	1.5
	 * @static
	 */
	function isWinOS() {
		return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
	}

	/**
	 * Method to dump the structure of a variable for debugging purposes
	 *
	 * @param	mixed	A variable
	 * @param	boolean	True to ensure all characters are htmlsafe
	 * @return	string
	 * @since	1.5
	 * @static
	 */
	function dump( &$var, $htmlSafe = true )
	{
		$result = var_export( $var, true );
		return '<pre>'.( $htmlSafe ? htmlspecialchars( $result ) : $result).'</pre>';
	}


	/**
	 * ��ʽ����Ʒ�۸�
	 *
	 * @access  public
	 * @param   float   $price  ��Ʒ�۸�
	 * @return  string
	 */
    function price_format($price, $change_price = true)
	{

 		if ($change_price )
		{
			switch ($GLOBALS['config']['options']['price_format'])
			{
				case 0:
					$price = number_format($price, 2, '.', '');
					break;
				case 1: // ������Ϊ 0 ��β��
					$price = preg_replace('/(.*)(\\.)([0-9]*?)0+$/', '\1\2\3', number_format($price, 2, '.', ''));

					if (substr($price, -1) == '.')
					{
						$price = substr($price, 0, -1);
					}
					break;
				case 2: // ���������룬����1λ
					$price = substr(number_format($price, 2, '.', ''), 0, -1);
					break;
				case 3: // ֱ��ȡ��
					$price = intval($price);
					break;
				case 4: // �������룬���� 1 λ
					$price = number_format($price, 1, '.', '');
					break;
				case 5: // ���������룬������С��
					$price = round($price);
					break;

				default:
					$price = intval($price);
			}
		}
		else
		{
			$price = number_format($price, 2, '.', '');
		}

		return  $price;
	}

}