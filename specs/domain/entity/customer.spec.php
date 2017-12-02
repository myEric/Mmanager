<?php
use Mmanager\Domain\Entity\Customer;

describe('Customer', function()
{
	describe('->__construct($name)', function()
	{
		it('should set the customer name', function()
		{
			$customer = new Customer();
			$customer->setName('Eric Claver AKAFFOU');
		});
<<<<<<< HEAD
		describe('->getName()', function()
		{
			it('should get the customer name', function(){
				$customer = new Customer();
				$customer->setName('Eric Claver AKAFFOU');
				expect($customer->getName())->to->have->string('Eric Claver AKAFFOU');
			});
=======
	});
	describe('->getName()', function()
	{
		it('should get the customer name', function()
		{
			$customer = new Customer();
			$customer->setName('Eric Claver AKAFFOU');
			expect($customer->getName())->to->have->string('Eric Claver AKAFFOU');
>>>>>>> f89ed31b341a0f92418faa2cdec97b0f0e58244b
		});
	});
});
