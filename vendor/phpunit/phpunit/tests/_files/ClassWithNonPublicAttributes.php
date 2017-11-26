<?php
class ParentClassWithPrivateAttributes
{
<<<<<<< HEAD
    private static $privateStaticParentAttribute = 'foo';
    private $privateParentAttribute = 'bar';
=======
	private static $privateStaticParentAttribute = 'foo';
	private $privateParentAttribute              = 'bar';
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}

class ParentClassWithProtectedAttributes extends ParentClassWithPrivateAttributes
{
<<<<<<< HEAD
    protected static $protectedStaticParentAttribute = 'foo';
    protected $protectedParentAttribute = 'bar';
=======
	protected static $protectedStaticParentAttribute = 'foo';
	protected $protectedParentAttribute              = 'bar';
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}

class ClassWithNonPublicAttributes extends ParentClassWithProtectedAttributes
{
<<<<<<< HEAD
    public static $publicStaticAttribute = 'foo';
    protected static $protectedStaticAttribute = 'bar';
    protected static $privateStaticAttribute = 'baz';

    public $publicAttribute = 'foo';
    public $foo = 1;
    public $bar = 2;
    protected $protectedAttribute = 'bar';
    protected $privateAttribute = 'baz';

    public $publicArray = array('foo');
    protected $protectedArray = array('bar');
    protected $privateArray = array('baz');
=======
	public static $publicStaticAttribute       = 'foo';
	protected static $protectedStaticAttribute = 'bar';
	protected static $privateStaticAttribute   = 'baz';

	public $publicAttribute       = 'foo';
	public $foo                   = 1;
	public $bar                   = 2;
	protected $protectedAttribute = 'bar';
	protected $privateAttribute   = 'baz';

	public $publicArray       = ['foo'];
	protected $protectedArray = ['bar'];
	protected $privateArray   = ['baz'];
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
