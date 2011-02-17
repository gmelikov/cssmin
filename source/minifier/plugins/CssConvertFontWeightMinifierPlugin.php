<?php
/**
 * CssMin - A (simple) css minifier with benefits
 * 
 * --
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING 
 * BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND 
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, 
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * --
 * 
 * This {@link aCssMinifierPlugin} will convert the font-weight values normal and bold to their numeric notation.
 * Example:
 * 
 * <code>
 * font-weight: normal;
 * font: bold 11px monospace;
 * </code>
 * 
 * Will get converted to:
 * 
 * <code>
 * font-weight:400;
 * font:700 11px monospace;
 * </code>
 * --
 *
 * @package		CssMin
 * @link		http://code.google.com/p/cssmin/
 * @author		Joe Scylla <joe.scylla@gmail.com>
 * @copyright	2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license		http://opensource.org/licenses/mit-license.php MIT License
 * @version		3.0.0
 */
class CssConvertFontWeightMinifierPlugin extends aCssMinifierPlugin
	{
	/**
	 * Array of included declaration properties this plugin will process; others declaration properties will get
	 * ignored. 
	 * 
	 * @var array
	 */
	private $include = array
		(
		"font",
		"font-weight"
		);
	/**
	 * Regular expression matching the value.
	 * 
	 * @var string
	 */
	private $reMatch = null;
	/**
	 * Regular expression replace the value.
	 * 
	 * @var string
	 */
	private $reReplace = "\"\${1}\" . \$this->transformation[\"\${2}\"] . \"\${3}\"";
	/**
	 * Transformation table used by the {@link CssConvertFontWeightMinifierPlugin::$reReplace replace regular expression}.
	 * 
	 * @var array
	 */
	private $transformation = array
		(
		"normal"	=> "400",
 		"bold"		=> "700"
		);
	/**
	 * Overwrites {@link aCssMinifierPlugin::__construct()}.
	 * 
	 * The constructor will create the {@link CssConvertFontWeightMinifierPlugin::$reReplace replace regular expression}
	 * based on the {@link CssConvertFontWeightMinifierPlugin::$transformation transformation table}.
	 * 
	 * @param CssMinifier $minifier The CssMinifier object of this plugin.
	 * @return void
	 */
	public function __construct(CssMinifier $minifier)
		{
		$this->reMatch = "/(^|\s)+(" . implode("|", array_keys($this->transformation)). ")(\s|$)+/eiS";
		parent::__construct($minifier);
		}
	/**
	 * Implements {@link aCssMinifierPlugin::minify()}.
	 * 
	 * @param aCssToken $token Token to process
	 * @return boolean Return TRUE to break the processing of this token; FALSE to continue
	 */
	public function apply(aCssToken &$token)
		{
		if (get_class($token) === "CssRulesetDeclarationToken")
			{
			if (in_array($token->Property, $this->include) && preg_match($this->reMatch, $token->Value, $m))
				{
				$token->Value = preg_replace($this->reMatch, $this->reReplace, $token->Value);
				}
			}
		return false;
		}
	}
?>