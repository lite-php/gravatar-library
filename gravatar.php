<?php
/**
 * LightPHP Framework
 * LitePHP is a framework that has been designed to be lite waight, extensible and fast.
 * 
 * @author Robert Pitt <robertpitt1988@gmail.com>
 * @category core
 * @copyright 2013 Robert Pitt
 * @license GPL v3 - GNU Public License v3
 * @version 1.0.0
 */
!defined('SECURE') && die('Access Forbidden!');

/**
 * Gravatar Library
 */
class Gravatar_Library
{
	/**
	 * Gravatar's URL
	 */
	const GRAVATAR_URL = "http://www.gravatar.com";

	/**
	 * Gravatar's secure URL
	 */
	const GRAVATAR_URL_SECURE = "https://secure.gravatar.com";

	/**
	 * Allowed ratings
	 */
	protected $ratings = array("g", "pg", "r", "x");

	/**
	 * Allowed image sets
	 */
	protected $imagesets = array("404", "mm", "identicon", "monsterid", "wavatar", "retro", "blank");

	/**
	 * Getter method
	 */
	public function get($email, $size = 80, $secure = true, $imageset = "mm", $rating = "g")
	{
		/**
		 * Validate the email address is valid
		 */
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			throw new Exception("Email address is invalid");
		}

		/**
		 * Valdiaite the image set is allowed
		 */
		if(in_array($imageset, $this->imagesets) === false)
		{
			throw new Exception("Imageset requested is invalid, allowed sets are (" . implode(", ", $this->imagesets) . ").");
		}

		/**
		 * Valdiate rating
		 */
		if(in_array($rating, $this->ratings) === false)
		{
			throw new Exception("Rating requested is invalid, allowed ratings are (" . implode(", ", $this->ratings) . ").");
		}

		/**
		 * Select the resource base url that we are using
		 */
		return ($secure === false ? self::GRAVATAR_URL : self::GRAVATAR_URL_SECURE) . "/avatar/" . md5($email) . "?" . http_build_query(array(
			"s" => $size,
			"r" => $rating,
			"d" => $imageset
		));
	}
}