<?php
use Mmanager\Domain\Entity\Customer;

describe('Customer', function(){
	describe('->getName()', function(){
		it('should return the customer name', function(){
			$customer = new Customer();
			expect($customer->getName())->to->be->equal('Eric Claver');
		});
	});
});
