<?php
/**
 * m'Manager | Invoices Management System
 *
 * Official API to create modules for m'Manager | Invoices Management System
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017, Eric Claver AKAFFOU
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	m'Manager
 * @author	Eric Claver AKAFFOU
 * @copyright	Copyright (c) 2017, on'Eric Computing, Inc. (https://www.onericcomputing.com/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1
 * @since	Version 1.0.0
 * @filesource
 */
 
namespace Mmanager\Persistence;

defined('EZSQL_VERSION') or define('EZSQL_VERSION', '2.17');
defined('OBJECT') or define('OBJECT', 'OBJECT');
defined('ARRAY_A') or define('ARRAY_A', 'ARRAY_A');
defined('ARRAY_N') or define('ARRAY_N', 'ARRAY_N');

abstract class AbstractDB extends Cache
{
	
	protected $num_rows = null; // hours
	protected $trace = false; // same as $debug_all
	protected $debug_all = false; // same as $trace
	protected $num_queries = 0;
	protected $func_call = null;
	// == TJH == default now needed for echo of debug function
	protected $debug_echo_is_on = true;
	protected $vardump_called = false;
	protected $debug_called = false;
	protected $conn_queries = 0;
	protected $timers = array();
	protected $total_query_time = 0;
	protected $db_connect_time  = 0;
	protected $trace_log = array();
	protected $use_trace_log = false;
	protected $sql_log_file = false;
	protected $do_profile = false;
	protected $profile_times = array();
	protected $last_error;
	/**********************************************************************
	*  Get host and port from an "host:port" notation.
	*  Returns array of host and port. If port is omitted, returns $default
	*/
	public function get_host_port($host, $default = false) {
		$port = $default;
		if (false !== strpos($host, ':')) {
			list($host, $port) = explode(':', $host);
			$port = (int) $port;
		}
		return array($host, $port);
	}
	
	/**********************************************************************
	*  Dumps the contents of any input variable to screen in a nicely
	*  formatted and easy to understand way - any type: Object, Var or Array
	*/

	public function vardump($mixed = '') {

		// Start outup buffering
		ob_start();

		echo "<p><table><tr><td bgcolor=ffffff><blockquote><font color=000090>";
		echo "<pre><font face=arial>";

		if (!$this->vardump_called) {
			echo "<font color=800080><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Variable Dump..</b></font>\n\n";
		}

		$var_type = gettype($mixed);
		print_r(($mixed ? $mixed : "<font color=red>No Value / False</font>"));
		echo "\n\n<b>Type:</b> ".ucfirst($var_type)."\n";
		echo "<b>Last Query</b> [$this->num_queries]<b>:</b> ".($this->last_query ? $this->last_query : "NULL")."\n";
		echo "<b>Last Function Call:</b> ".($this->func_call ? $this->func_call : "None")."\n";
		//echo "<b>Last Rows Returned:</b> ".count($this->last_result)."\n";
		echo "</font></pre></font></blockquote></td></tr></table>";
		echo "\n<hr size=1 noshade color=dddddd>";

		// Stop output buffering and capture debug HTML
		$html = ob_get_contents();
		ob_end_clean();

		// Only echo output if it is turned on
		if ($this->debug_echo_is_on) {
			echo $html;
		}

		$this->vardump_called = true;

		return $html;

	}

	/**********************************************************************
	*  Alias for the above function
	*/

	public function dumpvar($mixed) {
		$this->vardump($mixed);
	}

	/**********************************************************************
	*  Displays the last query string that was sent to the database & a
	* table listing results (if there were any).
	* (abstracted into a seperate file to save server overhead).
	*/

	public function debug($print_to_screen = true) {

		// Start outup buffering
		ob_start();

		echo "<blockquote>";

		$this->_isDebugCalled();
		$this->_hasError();
		$this->_isFromCache();

		echo "<font face=arial size=2 color=000099><b>Query</b> [$this->num_queries] <b>--</b> ";
		echo "[<font color=000000><b>$this->last_query</b></font>]</font><p>";

		echo "<font face=arial size=2 color=000099><b>Query Result..</b></font>";
		echo "<blockquote>";
		$this->_colInfo();
		echo "</blockquote></blockquote><hr noshade color=dddddd size=1>";

		// Stop output buffering and capture debug HTML
		$html = ob_get_contents();
		ob_end_clean();

		// Only echo output if it is turned on
		if ($this->debug_echo_is_on && $print_to_screen) {
			echo $html;
		}

		$this->debug_called = true;

		return $html;
	}
	/**********************************************************************
	*  Format a sql string correctly for safe insert
	*/
	public function escape($str) {
		return $this->CI->db->escape_str(stripslashes($str));
	}
	private function _isDebugCalled() {
		if ( ! $this->debug_called) {
			echo "<font color=800080 face=arial size=2><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Debug..</b></font><p>\n";
		}
	}

	private _hasError() {
		if ($this->last_error) {
			echo "<font face=arial size=2 color=000099><b>Last Error --</b> [<font color=000000><b>$this->last_error</b></font>]<p>";
		}
	}

	private _isFromCache() {
		if ($this->from_disk_cache) {
			echo "<font face=arial size=2 color=000099><b>Results retrieved from disk cache</b></font><p>";
		}
	}

	private _colInfo() {
		if ($this->col_info) {

			// =====================================================
			// Results top rows

			echo "<table cellpadding=5 cellspacing=1 bgcolor=555555>";
			echo "<tr bgcolor=eeeeee><td nowrap valign=bottom><font color=555599 face=arial size=2><b>(row)</b></font></td>";


			for ($i = 0, $j = count($this->col_info); $i < $j; $i++) {
				/* when selecting count(*) the maxlengh is not set, size is set instead. */
				echo "<td nowrap align=left valign=top><font size=1 color=555599 face=arial>{$this->col_info[$i]->type}";
				if (!isset($this->col_info[$i]->max_length)) {
					echo "{$this->col_info[$i]->size}";
				} else {
					echo "{$this->col_info[$i]->max_length}";
				}
				echo "</font><br><span style='font-family: arial; font-size: 10pt; font-weight: bold;'>{$this->col_info[$i]->name}</span></td>";
			}

			echo "</tr>";

			// ======================================================
			// print main results

		if ($this->last_result) {

			$i = 0;
			foreach ($this->get_results(null, ARRAY_N) as $one_row) {
				$i++;
				echo "<tr bgcolor=ffffff><td bgcolor=eeeeee nowrap align=middle><font size=2 color=555599 face=arial>$i</font></td>";

				foreach ($one_row as $item) {
					echo "<td nowrap><font face=arial size=2>$item</font></td>";
				}

				echo "</tr>";
			}

		} // if last result
		else {
			echo "<tr bgcolor=ffffff><td colspan=".(count($this->col_info) + 1)."><font face=arial size=2>No Results</font></td></tr>";
		}

		echo "</table>";

		} // if col_info
		else {
			echo "<font face=arial size=2>No Results</font>";
		}

	}
	abstract public function get_results($query = null, $output = OBJECT);
}