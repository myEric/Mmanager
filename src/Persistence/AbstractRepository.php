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
 
namespace MyEric\Mmanager\Persistence;
use MyEric\Mmanager\Domain\Repository\RepositoryInterface;
use MyEric\Mmanager\Domain\Repository\QueryBuilderInterface;
use MyEric\Mmanager\Domain\Repository;

defined('EZSQL_VERSION') or define('EZSQL_VERSION', '2.17');
defined('OBJECT') or define('OBJECT', 'OBJECT');
defined('ARRAY_A') or define('ARRAY_A', 'ARRAY_A');
defined('ARRAY_N') or define('ARRAY_N', 'ARRAY_N');

/**********************************************************************
*  Core class containg common functions to manipulate query result
*  sets once returned
*/

abstract class AbstractRepository extends AbstractDB implements RepositoryInterface {

	protected $query;

	/**********************************************************************
	*  Constructor
	*/

	public function __construct(QueryBuilderInterface $query)
	{
		$this->query = $query;
	}

	/**********************************************************************
	*  Get one variable from the DB - see docs for more detail
	*/

	public function get_var($query = null, $x = 0, $y = 0)
	{

		// Log how the function was called
		$this->func_call = "\$db->get_var(\"$query\",$x,$y)";

		// If there is a query then perform it if not then use cached results..
		if ($query)
		{
			$this->query($query);
		}

		// Extract var out of cached results based x,y vals
		if ($this->last_result[$y])
		{
			$values = array_values(get_object_vars($this->last_result[$y]));
		}

		// If there is a value return it else return null
		return (isset($values[$x]) && $values[$x] !== '') ? $values[$x] : null;
	}

	/**********************************************************************
	*  Get one row from the DB - see docs for more detail
	*/

	public function get_row($query = null, $output = OBJECT, $y = 0)
	{

		// Log how the function was called
		$this->func_call = "\$db->get_row(\"$query\",$output,$y)";

		// If there is a query then perform it if not then use cached results..
		if ($query)
		{
			$this->query($query);
		}

		// If the output is an object then return object using the row offset..
		if ($output == OBJECT)
		{
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		}
		// If the output is an associative array then return row as such..
		elseif ($output == ARRAY_A)
		{
			return $this->last_result[$y] ?get_object_vars($this->last_result[$y]) : null;
		}
		// If the output is an numerical array then return row as such..
		elseif ($output == ARRAY_N)
		{
			return $this->last_result[$y] ?array_values(get_object_vars($this->last_result[$y])) : null;
		}
		// If invalid output type was specified..
		else
		{
			$this->show_errors ? trigger_error(" \$db->get_row(string query, output type, int offset) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N", E_USER_WARNING) : null;
		}

	}

	/**********************************************************************
	*  Function to get 1 column from the cached result set based in X index
	*  see docs for usage and info
	*/

	public function get_col($query = null, $x = 0)
	{

		$new_array = array();

		// If there is a query then perform it if not then use cached results..
		if ($query)
		{
			$this->query($query);
		}

		// Extract the column values
		$j = count($this->last_result);
		for ($i = 0; $i < $j; $i++)
		{
			$new_array[$i] = $this->get_var(null, $x, $i);
		}

		return $new_array;
	}


	/**********************************************************************
	*  Return the the query as a result set - see docs for more details
	*/

	public function get_results($query = null, $output = OBJECT)
	{
		$new_array = array();
		// Log how the function was called
		$this->func_call = "\$db->get_results(\"$query\", $output)";

		// If there is a query then perform it if not then use cached results..
		if ($query)
		{
			$this->query($query);
		}

		// Send back array of objects. Each row is an object
		if ($output == OBJECT)
		{
			return $this->last_result;
		} elseif ($output == ARRAY_A || $output == ARRAY_N)
		{
			if ($this->last_result)
			{
				$i = 0;
				foreach ($this->last_result as $row)
				{

					$new_array[$i] = get_object_vars($row);

					if ($output == ARRAY_N)
					{
						$new_array[$i] = array_values($new_array[$i]);
					}

					$i++;
				}

				return $new_array;
			} else
			{
				return array();
			}
		}
	}


	/**********************************************************************
	*  Function to get column meta data info pertaining to the last query
	* see docs for more info and usage
	*/

	public function get_col_info($info_type = "name", $col_offset = -1)
	{
		$new_array = array();
		if ($this->col_info)
		{
			if ($col_offset == -1)
			{
				$i = 0;
				foreach ($this->col_info as $col)
				{
					$new_array[$i] = $col->{$info_type};
					$i++;
				}
				return $new_array;
			} else
			{
				return $this->col_info[$col_offset]->{$info_type};
			}

		}

	}
	/**********************************************************************
	*  Timer related functions
	*/

	public function timer_get_cur()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float) $usec + (float) $sec);
	}

	public function timer_start($timer_name)
	{
		$this->timers[$timer_name] = $this->timer_get_cur();
	}

	public function timer_elapsed($timer_name)
	{
		return round($this->timer_get_cur() - $this->timers[$timer_name], 2);
	}

	public function timer_update_global($timer_name)
	{
		if ($this->do_profile)
		{
			$this->profile_times[] = array(
				'query' => $this->last_query,
				'time' => $this->timer_elapsed($timer_name)
			);
		}

		$this->total_query_time += $this->timer_elapsed($timer_name);
	}

	/**********************************************************************
	* Creates a SET nvp sql string from an associative array (and escapes all values)
	*
	*  Usage:
	*
	*     $db_data = array('login'=>'jv','email'=>'jv@vip.ie', 'user_id' => 1, 'created' => 'NOW()');
	*
	*     $db->query("INSERT INTO users SET ".$db->get_set($db_data));
	*
	*     ...OR...
	*
	*     $db->query("UPDATE users SET ".$db->get_set($db_data)." WHERE user_id = 1");
	*
	* Output:
	*
	*     login = 'jv', email = 'jv@vip.ie', user_id = 1, created = NOW()
	*/

	public function get_set($params)
	{
		if (!is_array($params))
		{
			$this->register_error('get_set() parameter invalid. Expected array in '.__FILE__.' on line '.__LINE__);
			return;
		}
		$sql = array();
		foreach ($params as $field => $val)
		{
			if ($val === 'true' || $val === true) {
							$val = 1;
			}
			if ($val === 'false' || $val === false) {
							$val = 0;
			}

			switch ($val) {
				case 'NOW()' :
				case 'NULL' :
				  $sql[] = "$field = $val";
					break;
				default :
					$sql[] = "$field = '".$this->escape($val)."'";
			}
		}

		return implode(', ', $sql);
	}

	/**
	 * Function for operating query count
	 *
	 * @param bool $all Set to false for function to return queries only during this connection
	 * @param bool $increase Set to true to increase query count (internal usage)
	 * @return int Returns query count base on $all
	 */
	public function count($all = true, $increase = false) {
		if ($increase) {
			$this->num_queries++;
			$this->conn_queries++;
		}

		return ($all) ? $this->num_queries : $this->conn_queries;
	}
}
