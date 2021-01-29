 
<?php
error_reporting(E_ALL);
/**
 * Password Generator
 *
 * Simple password generator to help you generate
 * secure passwords.
 *
 * Changelog v1.0:
 * - first version ;)
 *
 * Bugs:
 * - If you set passwords longer than is range
 * of characters while having enabled unique_chars,
 * than it will do nothing good.
 *
 * Issues:
 * - way to get unique characters in password
 * can be improved. It's not the best solution
 * I think and sometimes causing slower load of
 * script.
 *
 * Usage:
 * - See example.php
 *
 * Notes:
 * - I'm now about to find a nice way to ensure
 * that password contains at least one character
 * from each option enabled.
 * - Also need to find a way how to keep some
 * security of code in unique_chars vs limited
 * count of chars range.
 * - Using special chars is disabled for default
 * becausing some systems, apps and websites don't
 * allow using them and also ppl in different
 * countries may not know how to make some of
 * them...
 *
 * Copyright 2007-2009, Daniel Tlach
 *
 * Licensed under GNU GPL

 * changed by Michael Schramm
 *
 *
 * Updated 23 Feb 2014 by Michael M Chiwere michaelmartinc@gmail.com
 *
 * @copyright	Copyright 2007-2009, Daniel Tlach
 * @link		http://www.danaketh.com
 * @version		1.0
 * @license		http://www.gnu.org/licenses/gpl.txt
 */
class password
{
	private $length			= 8;
	private $unique_chars	= TRUE;
	private $using			= array(
				'lower_case'		=> TRUE,
				'upper_case'		=> TRUE,
				'digits'			=> TRUE,
				'special'			=> FALSE
			);
	private $work_range		= array();
	private $range			= array();
	
	public function __construct( $using=array(), $special_chars=array() )
	{
		
		$this->using = $using;
		$this->range['s'] = $special_chars;
		
		if(empty($special_chars))
			$this->range['s'] = array('*', '_', '-', '?', '!', '+', '#', '@', ';', ':');
		
		if(!isset($using['lower_case'])) $this->using['lower_case'] = TRUE;
		if(!isset($using['upper_case'])) $this->using['upper_case'] = TRUE;
		if(!isset($using['digits'])) $this->using['digits'] = TRUE;
		if(!isset($using['special'])) $this->using['special'] = FALSE;
		if(!isset($using['unique'])) $this->unique_chars = TRUE;
		else $this->unique_chars = $using['unique'];
		if(!isset($using['length'])) $this->length = 8;
		else $this->length = $using['length'];
		if(isset($using['digits']))
		{
			if($using['digits']=="2")
			{
				$this->range['uc'] = range('A', 'F');
				$this->range['lc'] = range('a', 'f');
			}
			else
			{
				$this->range['uc'] = range('A', 'Z');
				$this->range['lc'] = range('a', 'z');
			}
		}
		else
		{
			$this->range['uc'] = range('A', 'Z');
			$this->range['lc'] = range('a', 'z');
		}
		
		if($this->length>100)
		{
			$this->length = 100;
			$this->error = 'to limit the strain on our server, we have limited the password to a hundred characters';
		}
		elseif($this->length<5)
		{
			$this->length = 10;
			$this->error = 'Your password is too short, we have set it to 10 characters';
		}
		
		$this->init();
	}

	public function get_error()
	{
		if(isset($this->error)) return $this->error;
		else return FALSE;
	}

	private function init(){
		//lower-case [a-z] chars
		//$this->range['lc'] = range('a', 'z');
		//upper-case [A-Z] chars
		//$this->range['uc'] = range('A', 'Z');
		//digits [0-9]
		$this->range['d'] = range('0', '9');
		//special chars
		//using more if you wish - I usingd only these becausing
		//a lost of ppl don't know how to make ^ or ~ and
		//also quotes can be tricky
		//$this->range['s'] = array('*', '_', '-', '?', '!', '+', '#', '@', ';', ':');
		
		$this->prepareWorkRange();
	}
	
	private function prepareWorkRange()
	{
		$this->work_range = array(); // this will be range of chars we'll be working with
		// lower-case [a-z] chars
		if ($this->using['lower_case']) {
			$this->work_range = array_merge($this->work_range,$this->range['lc']);
		}
		
		// upper-case [A-Z] chars
		if ($this->using['upper_case']) {
			$this->work_range = array_merge($this->work_range,$this->range['uc']);
		}
		
		// digits [0-9]
		if ($this->using['digits']) {
			$this->work_range = array_merge($this->work_range,$this->range['d']);
		}
		
		// special chars
		if ($this->using['special']) {
			$this->work_range = array_merge($this->work_range,$this->range['s']);
		}
		
		// quit if we don't have any chars to generate password from
		if (empty($this->work_range)) {
        	$this->error = 'no working chars selected for passwd!';
		}
	}
	
	public function setConfig($lower_case=TRUE,$upper_case=TRUE,$digits=TRUE,$special=TRUE)
	{
		if($lower_case)
			$this->using['lower_case']	= $lower_case;
		if($upper_case)
			$this->using['upper_case']	= $upper_case;
		if($digits)
			$this->using['digits']		= $digits;
		if($special)
			$this->using['special']		= $special;
		ini_set('memory_limit','64M'); // boost the memory limit if it's low
		$this->prepareWorkRange();
	}
	
	
	public function generatePassword()
	{
		if(empty($this->work_range)) return '<< select options and submit';
		
		//echo '<pre>'; print_r($work_range); echo '</pre>';
		$range = count($this->work_range)-1; // count character arrays
		
		// Generate "$this->date['count']" passwords
		$c = 0; // password chars counter
		$pass = NULL; // empty password variable
		
		// Generate password
		while($c < $this->length){
			$pass .= $this->getChar( $this->work_range, $range, $pass);
			$c++;
		}
		
		return $pass;
	}
	
	public function generateMultiblePasswords($count=5){
		$passwords = array();
		
		for($i=0; $i<$count; $i++){
			$passwords[] = $this->generatePassword();
		}
		
		return $passwords;
	}
	
	/**
	 * Characted generator
	 *
	 * @author        Daniel Tlach <mail@danaketh.com>
	 * @access         private
	 * @return         string
	 */
	private function getChar( $charr, $range, $pass ){
		$index = mt_rand(0, $range);
		$char = $charr[$index];
		$check_char = $char;
		
		if(in_array($char, $this->range['s'])){
			$check_char = '\\'.$check_char;
		}
		$check_char = "/$check_char/";
		if($this->unique_chars && preg_match($check_char, $pass) >0 && $this->length < $range){
			//unique fail
			return $this->getChar($charr, $range, $pass);
		}else{
			return $char;
		}
	}
}
?>
