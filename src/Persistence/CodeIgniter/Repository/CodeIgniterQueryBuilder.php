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
namespace Mmanager\Persistence\CodeIgniter\Repository;

use Mmanager\Domain\Repository\QueryBuilderInterface;
use Mmanager\Persistence\AbstractRepository;

/**
 * class CodeIgniterQueryBuilder
 */
class CodeIgniterQueryBuilder extends AbstractRepository implements QueryBuilderInterface
{
	protected $debug = true;
	protected $rows_affected = false;
	protected $insert_id;
	protected $is_insert = false;
	protected $ci_query;
	public $tables = array(
		'options'			 => 'oc_options',
		'users_options'		 => 'oc_usersoptions',
		'users'		         => 'users',
		'clients'		     => 'oc_clients',
		'providers'		     => 'oc_providers',
		'invoices'		     => 'oc_invoices',
		'purchases'		     	 => 'oc_purchases',
		'quotes'		     => 'oc_quotes',
		'invoices_items'	 => 'oc_invoiceitems',
		'purchases_items'	 	 => 'oc_purchaseditems',
		'quotes_items'		 => 'oc_quoteitems',
		'items'		         => 'oc_items',
		'items_groups'		 => 'oc_productsgroups',
		'taxes'		         => 'oc_taxes',
		'transactions'		 => 'oc_transactions',
		'charges_categories' => 'oc_charges_categories',
		'incomes_categories' => 'oc_incomes_categories',
		'notes' 			 => 'oc_notes',
		'timeline' 			 => 'oc_timeline',
		'payment_history'   			=> 'oc_payment_history',
		'calendar'   		 			=> 'oc_calendar',
		'orders'   		 			=> 'oc_orders',
		'orders_items'   		 	=> 'oc_ordereditems',
		'payment_methods'   		 	=> 'oc_payment_methods',
		'hsn_sac'   		 			=> 'oc_hsn_sac',
		'uom'   		 				=> 'oc_uom',
		'cgst'   		 				=> 'oc_cgst',
		'sgst'   		 				=> 'oc_sgst',
		'igst'   		 				=> 'oc_igst',
		'cess'   		 				=> 'oc_cess'
		);
	public function __construct() {
		global $db;
		$db = $this;
		$this->CI = & get_instance();
	}
	public function query($query) {
		
		// Flush cached values..
		$this->flush();
    	
		// For reg expressions
		$query = trim($query);
    	
		// Log how the function was called
		$this->func_call = "\$db->query(\"$query\")";
    	
		// Keep track of the last query for debug..
		$this->last_query = $query;
    	
		// Count how many queries there have been
		$this->count(true, true);
    	
		// Start timer
		$this->timer_start($this->num_queries);
    	
		// Use core file cache function
		if ($cache = $this->get_cache($query)) {

			// Keep tack of how long all queries have taken
			$this->timer_update_global($this->num_queries);

			// Trace all queries
			if ($this->use_trace_log) {
				$this->trace_log[] = $this->debug(false);
			}

			return $cache;
		}
    	
		// Perform the query via CI database system
		$this->ci_query = $this->CI->db->query($query);
    	
		// If there is an error then take note of it..
		if ($str = $this->CI->db->error()['message']) {
			$this->register_error($str);
			$this->show_errors ? trigger_error($str, E_USER_WARNING) : null;				
    		
			// If debug ALL queries
			$this->trace || $this->debug_all ? $this->debug() : null;
    		
			return false;
		}
    	$return_val = $this->_execute($query);
		// disk caching of queries
		$this->store_cache($query, $this->is_insert);

		// If debug ALL queries
		$this->trace || $this->debug_all ? $this->debug() : null;

		// Keep tack of how long all queries have taken
		$this->timer_update_global($this->num_queries);

		// Trace all queries
		if ($this->use_trace_log) {
			$this->trace_log[] = $this->debug(false);
		}

		return $return_val;
	}	
	/**********************************************************************
	*  Format a sql string correctly for safe insert
	*/
	public function escape($str) {
		return $this->CI->db->escape_str(stripslashes($str));
	}
	private function _execute($query)
	{
		// Query was write (insert/delete/update etc.) query?
		if (preg_match("/^(insert|delete|update|replace|truncate|drop|create|alter)\s+/i", $query)) {
			$this->is_insert = true;
			$this->rows_affected = $this->CI->db->affected_rows();

			// Take note of the insert_id
			if (preg_match("/^(insert|replace)\s+/i", $query)) {
				$this->insert_id = $this->CI->db->insert_id();
			}

			// Return number fo rows affected
			return $this->rows_affected;
		}
		// Query was a select
		else {	
			// Store Query Results
			$num_rows = 0;
			if ($this->ci_query->num_rows()) {
				foreach ($this->ci_query->result() as $row) {
					// Take note of column info
					if ($num_rows == 0) {
						$i = 0;
						foreach (get_object_vars($row) as $k => $v) {
							$this->col_info[$i] = (object) [];

							$this->col_info[$i]->name = $k;
							$this->col_info[$i]->max_length = $k;
							$this->col_info[$i]->type = '';
							$i++;
						}
					}
		  				
					// Store relults as an objects within main array
					$this->last_result[$num_rows] = $row;
					$num_rows++;
				}
			}
		  		
			// Log number of rows the query returned
			return $this->num_rows = $num_rows;

		}
	}
}