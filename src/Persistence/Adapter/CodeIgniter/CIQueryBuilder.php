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
 * @package m'Manager
 * @author  Eric Claver AKAFFOU
 * @copyright   Copyright (c) 2017, on'Eric Computing, Inc. (https://www.onericcomputing.com/)
 * @license http://opensource.org/licenses/MIT  MIT License
 * @link    https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1
 * @since   Version 1.0.0
 * @filesource
 */

namespace Mmanager\Persistence\Adapter\CodeIgniter;
use Mmanager\Domain\Repository\RepositoryInterface;
use Mmanager\Persistence\Adapter\CodeIgniter\CIModel;


class CIQueryBuilder extends CIModel implements RepositoryInterface
{
	public function __construct() {
		parent::__construct();
	}
	public function test() {
		$query = $this->db->get('oc_clients', 10);
		return $query->result();
	}
	public function get_var($query = null, $x = 0, $y = 0) {
		$query = $this->db->get('oc_clients', 10);
		return $query->result();
	}
	public function get_row($query = null, $output = null, $y = 0) {
		$query = $this->db->get('oc_clients', 10);
		return $query->result();
	}
	public function get_results($query = null, $output = null) {
		$query = $this->db->get('oc_clients', 10);
		return $query->result();
	}
	public function get_set($params) {
		$query = $this->db->get('oc_clients', 10);
		return $query->result();
	}
}
