<?php
/**
 * m'Manager | Invoices Management System
 * 
 * This content is released under the Proprietary License (Proprietary)
 *
 * Copyright (c) 2017, Eric Claver AKAFFOU - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * 
 * @package m'Manager
 * @author  Eric Claver AKAFFOU
 * @copyright   Copyright (c) 2017, on'Eric Computing, Inc. (https://www.onericcomputing.com/)
 * @license https://www.mmanager.fr  Proprietary License
 * @link    https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1
 * @since   Version 1.0.0
 * @filesource
 */

namespace Mmanager;

use Mmanager\Contract\HelperFunctionsInterface;
use Mmanager\Domain\Factory\InvoiceFactory;

class BootstrapTable {
	protected $cache;
	protected $total = 0;
	protected $rows = [];
	protected $functions;
	protected $filter;
	protected $order;
	protected $offset;
	protected $limit;
	protected $sort;
	protected $list;

	public function __construct(HelperFunctionsInterface $functions) {
		$this->functions = $functions;
	}
	final public function prepareList($entity, $serverSidePagination)
	{
		$return = [];
		switch ($entity) {
			case 'items':
				$this->total = intval($this->functions->totalRows('oc_items'));
				break;
			case 'services':
				$this->total = intval($this->functions->totalServices());
				break;
			case 'orders':
				$this->total = intval($this->functions->totalRows('oc_orders'));
				break;
			case 'customers':
				$this->total = intval($this->functions->totalRows('oc_clients'));
				break;
		}
		if ($serverSidePagination) {
			$return = array(
				'total' => $this->total,
				'rows' => $this->rows
			);
		}
		return $return;
	}
	final public function fetchData($entity, $params)
	{
		$return = [];
		if ( ! $params) {
			return false;
		} else {
			foreach ($params as $key => &$value) {
				$this->setParams($key, $value);
			}
			unset($value);
			switch ($entity) {
				case 'orders':
				$return = $this->functions->getOrders($this->filter);
				break;
				case 'customers':
				$return = $this->functions->getCustomers($this->filter);
				break;
				case 'items':
				$return = $this->functions->getItems($this->filter);
				break;
				case 'services':
				$return = $this->functions->getServices($this->filter);
				break;				
			}
			return $return;
		}
	}
	public function setParams($key, $val) {
		$this->{$key} = $val;
	}
	public function listOrders($params)
	{
		$this->list = $this->prepareList('orders', false);
		$orders = $this->fetchData('orders', $params);

		$invoiceObj = new InvoiceFactory;
		if ($orders)
		{
			foreach ($orders as &$order) {
				if ($order->amount_paid > 0 AND $order->order_status == 'Refunded')
				{
					$number_prefix = null == get_option('credit_note_prefix') ? __('credit_note_prefix').sprintf("%04s", $order->order_number) : get_option('credit_note_prefix').sprintf("%04s", $order->order_number);
				}
				elseif ($order->order_status == 'Refunded')
				{
					$number_prefix = null == get_option('credit_note_prefix') ? __('credit_note_prefix').sprintf("%04s", $order->order_number) : get_option('credit_note_prefix').sprintf("%04s", $order->order_number);
				}
				elseif ($order->amount_paid > 0 AND $order->amount_due > 0 AND $order->order_status !== 'Paid')
				{
					$number_prefix = null == get_option('sale_order_prefix') ? __('sale_order_prefix_short').sprintf("%04s", $order->order_number) : get_option('sale_order_prefix').sprintf("%04s", $order->order_number);
				}
				elseif ($order->order_status == 'Expired' || $order->order_status == 'Open' || $order->order_status == 'Pending' || $order->order_status == 'Failed')
				{
					$number_prefix = null == get_option('sale_order_prefix') ? __('sale_order_prefix_short').sprintf("%04s", $order->order_number) : get_option('sale_order_prefix').sprintf("%04s", $order->order_number);
				}
				else
				{
					$number_prefix = null == get_option('sale_order_prefix') ? __('sale_order_prefix_short').sprintf("%04s", $order->order_number) : get_option('sale_order_prefix').sprintf("%04s", $order->order_number);
				}
				array_push($this->list, array(
					'id' 				  => $order->id,
					'client_id'           => _eID($order->client_id),
					'number_prefix'   	  => $number_prefix,
					'order_number'   	  => $order->order_number,
					'enc_order_number'    => _eID($order->order_number),
					'name_company'		  => $invoiceObj->getCustomer($order->client_id, 'name_company'),
					'date'				  => _fdate(language_string_to_locale_notation(get_option('user_language', 'users_options')), $order->date),
					'due_date'			  => _fdate(language_string_to_locale_notation(get_option('user_language', 'users_options')), $order->due_date),
					'total'				  => format_number($order->total),
					'amount_due'		  => format_number($order->amount_due),
					'amount_paid'		  => format_number($order->amount_paid),
					'amount_refunded'	  => format_number($order->amount_refunded),
					'status'              => order_status_str($order->order_status),
					'stbool'			  => order_status($order->order_number),
					'pay_type'			  => $order->pay_type,
					'has_picking_list'	  => $order->has_picking_list,
					'next_due_date'		  => $order->next_duedate
					)
				);
			}
			unset($order);
		}
		return $this->list;
	}
	public function listCustomers($params)
	{
		$this->list = $this->prepareList('customers', false);
		$clients = $this->fetchData('customers', $params);
		if ($clients)
		{
			foreach ($clients as &$client) {
				if (isset($client->client_address1) && $client->client_postcode && $client->client_city && $client->client_country)
				{
					$address = $client->client_address1.' '.$client->client_postcode.' '.$client->client_city.' '.get_countries($client->client_country);
				}
				else
				{
					$address = false;
				}
				array_push($this->list, array(
					'client_id' 		  => $client->client_id,
					'enc_client_id' 	  => _eID($client->client_id),
					'name_company'        => $client->name_company,
					'email'   	 		  => $client->client_email,
					'client_phone' 		  => $client->client_phone,
					'client_address' 	  => $address,
					'client_status'       => $client->client_status,
					'support_contract'    => $client->support_contract * 60,
					'client_credit'       => $client->client_credit,
					'client_tax_number'	  => isset($client->client_tax_number) ? $client->client_tax_number : "",
					'client_bank_number'  => isset($client->client_bank_number) ? $client->client_bank_number : "",
					'client_status_str'   => status_str($client->client_status),
					'client_date_created' => _fdate(language_string_to_locale_notation(get_option('user_language', 'users_options')), $client->client_date_created)
					)
				);
			}
			unset($client);
		}
		return $this->list;
	}
	public function listItems($params)
	{
		$this->list = $this->prepareList('items', false);
		$items = $this->fetchData('items', $params);
		if ($items)
		{
			foreach ($items as &$item) {
				if (null !== $item->qrcode OR null !== $item->barcode) {
					$hasqrbar = 1;
				} else {
					$hasqrbar = 0;
				}
				array_push($this->list, array(
					'item_id' 			  => $item->item_id,
					'sku'           	  => $item->sku,
					'name'   	 		  => $item->name,
					'mpn'   	 		  => $item->product_mpn,
					'group_name' 		  => $item->group_name,
					'group_id' 		  	  => $item->group_id,
					'price'		  		  => format_number($item->price),
					'tax_percent'		  => $item->tax_percent,
					'item_status'         => $item->item_status,
					'qrcode'         	  => $item->qrcode,
					'barcode'         	  => $item->barcode,
					'hasqrbar'         	  => $hasqrbar,
					'item_status_str'     => '0.00' !== $item->current_stock ? $item->current_stock.'&nbsp;'.item_status_str($item->item_status) : ''.'&nbsp;'.item_status_str($item->item_status)
					)
				);
			}
			unset($item);
		}
		return $this->list;
	}
	public function listServices($params)
	{
		$this->list = $this->prepareList('services', false);
		$items = $this->fetchData('services', $params);
		if ($items)
		{
			foreach ($items as &$item) {
				if (null !== $item->qrcode OR null !== $item->barcode) {
					$hasqrbar = 1;
				}
				array_push($this->list, array(
					'item_id' 			  => $item->item_id,
					'sku'           	  => $item->sku,
					'name'   	 		  => $item->name,
					'group_name' 		  => $item->group_name,
					'group_id' 		  	  => $item->group_id,
					'price'		  		  =>format_number($item->price),
					'tax_percent'		  => $item->tax_percent,
					'item_status'         => $item->item_status,
					'item_status_str'     => '0.00' !== $item->current_stock ? $item->current_stock.'&nbsp;'.item_status_str($item->item_status) : ''.'&nbsp;'.item_status_str($item->item_status)
					)
				);
			}
			unset($item);
		}
		return $this->list;
	}
}