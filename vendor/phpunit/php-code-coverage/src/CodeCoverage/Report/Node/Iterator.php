<?php
/*
 * This file is part of the PHP_CodeCoverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Recursive iterator for PHP_CodeCoverage_Report_Node object graphs.
 *
 * @category   PHP
 * @package    CodeCoverage
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/sebastianbergmann/php-code-coverage
 * @since      Class available since Release 1.1.0
 */
class PHP_CodeCoverage_Report_Node_Iterator implements RecursiveIterator
{
<<<<<<< HEAD
    /**
     * @var integer
     */
    protected $position;
=======
	/**
	 * @var int
	 */
	protected $position;
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * @var PHP_CodeCoverage_Report_Node[]
	 */
	protected $nodes;

	/**
	 * Constructor.
	 *
	 * @param PHP_CodeCoverage_Report_Node_Directory $node
	 */
	public function __construct(PHP_CodeCoverage_Report_Node_Directory $node)
	{
		$this->nodes = $node->getChildNodes();
	}

<<<<<<< HEAD
    /**
     * Rewinds the Iterator to the first element.
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Checks if there is a current element after calls to rewind() or next().
     *
     * @return boolean
     */
    public function valid()
    {
        return $this->position < count($this->nodes);
    }

    /**
     * Returns the key of the current element.
     *
     * @return integer
     */
    public function key()
    {
        return $this->position;
    }
=======
	/**
	 * Rewinds the Iterator to the first element.
	 */
	public function rewind()
	{
		$this->position = 0;
	}

	/**
	 * Checks if there is a current element after calls to rewind() or next().
	 *
	 * @return bool
	 */
	public function valid()
	{
		return $this->position < count($this->nodes);
	}

	/**
	 * Returns the key of the current element.
	 *
	 * @return int
	 */
	public function key()
	{
		return $this->position;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * Returns the current element.
	 *
	 * @return PHPUnit_Framework_Test
	 */
	public function current()
	{
		return $this->valid() ? $this->nodes[$this->position] : null;
	}

<<<<<<< HEAD
    /**
     * Moves forward to next element.
     *
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * Returns the sub iterator for the current element.
     *
     * @return PHP_CodeCoverage_Report_Node_Iterator
     */
    public function getChildren()
    {
        return new PHP_CodeCoverage_Report_Node_Iterator(
            $this->nodes[$this->position]
        );
    }

    /**
     * Checks whether the current element has children.
     *
     * @return boolean
     */
    public function hasChildren()
    {
        return $this->nodes[$this->position] instanceof PHP_CodeCoverage_Report_Node_Directory;
    }
=======
	/**
	 * Moves forward to next element.
	 */
	public function next()
	{
		$this->position++;
	}

	/**
	 * Returns the sub iterator for the current element.
	 *
	 * @return PHP_CodeCoverage_Report_Node_Iterator
	 */
	public function getChildren()
	{
		return new self(
			$this->nodes[$this->position]
		);
	}

	/**
	 * Checks whether the current element has children.
	 *
	 * @return bool
	 */
	public function hasChildren()
	{
		return $this->nodes[$this->position] instanceof PHP_CodeCoverage_Report_Node_Directory;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
