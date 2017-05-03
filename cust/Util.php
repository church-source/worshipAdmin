<?php
namespace utilphp;
/**
 * util.php
 *
 * util.php is a library of helper functions for common tasks such as
 * formatting bytes as a string or displaying a date in terms of how long ago
 * it was in human readable terms (E.g. 4 minutes ago). The library is entirely
 * contained within a single file and hosts no dependencies. The library is
 * designed to avoid any possible conflicts.
 *
 * @author Brandon Wamboldt <brandon.wamboldt@gmail.com>
 * @link   http://github.com/brandonwamboldt/utilphp/ Official Documentation
 */
class util
{
    /**
     * Checks to see if a string is empty.
     *
     *
     * Written by Rowan Pillay
     *
     * @param  string $string The string to be checked
     * @return boolean
     */
    public static function IsNullOrEmptyString($question)
    {
	    return (!isset($question) || trim($question)==='');
    }
	
	public static function getFileContents($url)
    {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
    }
}
