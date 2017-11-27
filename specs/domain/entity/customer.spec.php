<?php
use Mmanager\Domain\Entity\Customer;

describe('Customer', function()
{
	describe('->setName($name)', function()
	{
		it('should set the customer name', function()
		{
			$customer = new Customer();
			$customer->setName('Eric Claver AKAFFOU');
			expect($customer->getName())->to->have->string('AKAFFOU');
		});
	});
});
