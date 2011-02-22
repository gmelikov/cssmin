<?php
/**
 * This {@link aCssToken CSS token} represents a declaration of a @page at-rule block.
 * 
 * @package		CssMin/Tokens
 * @link		http://code.google.com/p/cssmin/
 * @author		Joe Scylla <joe.scylla@gmail.com>
 * @copyright	2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license		http://opensource.org/licenses/mit-license.php MIT License
 * @version		3.0.0
 */
class CssAtPageDeclarationToken extends aCssToken
	{
	/**
	 * Property name of the declaration.
	 * 
	 * @var string
	 */
	public $Property = "";
	/**
	 * Is the declaration flagged as important?
	 * 
	 * @var boolean
	 */
	public $IsImportant = false;
	/**
	 * Is the declaration flagged as last one of the block?
	 * 
	 * @var boolean
	 */
	public $IsLast = false;
	/**
	 * Value of the declaration.
	 * 
	 * @var string
	 */
	public $Value = "";
	/**
	 * Set the properties of the @page declaration. 
	 * 
	 * @param string $property Property of the declaration
	 * @param string $value Value of the declaration
	 * @param boolean $isImportant Is the !important flag is set?
	 * @param boolean $isLast Is the declaration the last one of the block
	 * @return void
	 */
	public function __construct($property, $value, $isImportant = false, $isLast = false)
		{
		$this->Property		= $property;
		$this->Value		= $value;
		$this->IsImportant	= $isImportant;
		$this->IsLast		= $isLast;
		}
	/**
	 * Implements {@link aCssToken::__toString()}.
	 * 
	 * @return string
	 */
	public function __toString()
		{
		return $this->Property . ":" . $this->Value . ($this->IsImportant ? " !important" : "") . ";";
		}
	}
?>