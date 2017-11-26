<?php
class TestIterator implements Iterator
{
	protected $array;
	protected $position = 0;

<<<<<<< HEAD
    public function __construct($array = array())
    {
        $this->array = $array;
    }
=======
	public function __construct($array = [])
	{
		$this->array = $array;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	public function rewind()
	{
		$this->position = 0;
	}

	public function valid()
	{
		return $this->position < count($this->array);
	}

	public function key()
	{
		return $this->position;
	}

	public function current()
	{
		return $this->array[$this->position];
	}

	public function next()
	{
		$this->position++;
	}
}
