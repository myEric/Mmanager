<?php
<<<<<<< HEAD
class TestIterator2 implements Iterator {

    protected $data;
=======
class TestIterator2 implements Iterator
{
	protected $data;
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	public function __construct(array $array)
	{
		$this->data = $array;
	}

	public function current()
	{
		return current($this->data);
	}

	public function next()
	{
		next($this->data);
	}

	public function key()
	{
		return key($this->data);
	}

	public function valid()
	{
		return key($this->data) !== null;
	}

<<<<<<< HEAD
    public function rewind()
    {
        reset($this->data);
    }
}
=======
	public function rewind()
	{
		reset($this->data);
	}
}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
