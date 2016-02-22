<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendgrid_mail
{

	function send_mail( $mail_to, $mail_from, $mail_subject, $main_html )
	{
		require( BASEPATH . 'sg_php/vendor/autoload.php' ); #require 'sendgrid-php/vendor/autoload.php';
		$sendgrid = new SendGrid("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");
		$email    = new SendGrid\Email();

		$email->addTo( $mail_to )
			  ->setFrom( $mail_from )
		      ->setSubject( $mail_subject )
		      ->setHtml( $main_html );
		$sendgrid->send($email);
	}
	
}