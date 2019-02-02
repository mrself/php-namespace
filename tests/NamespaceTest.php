<?php declare(strict_types=1);

namespace Mrself\NamespaceHelper\Tests;

use Mrself\NamespaceHelper\NamespaceHelper;
use PHPUnit\Framework\TestCase;

class NamespaceTest extends TestCase
{
    public function testFrom()
    {
        $ns = NamespaceHelper::from([1]);
        $this->assertEquals([1], $ns->get());
    }

    public function testFromSource()
    {
        $ns = NamespaceHelper::fromSource([1]);
        $this->assertEquals([1], $ns->get());
    }

    public function testFromDotted()
    {
        $ns = NamespaceHelper::fromDotted('a.b');
        $this->assertEquals(['a', 'b'], $ns->get());
    }

    public function testToDotted()
    {
        $ns = NamespaceHelper::from(['a', 'b']);
        $this->assertEquals('a.b', $ns->toDotted());
    }

    public function testToDirectory()
    {
        $ns = NamespaceHelper::from(['a', 'b']);
        $this->assertEquals('a' . DIRECTORY_SEPARATOR . 'b', $ns->toDirectory());
    }

    public function testToLowerDashed()
    {
        $ns = NamespaceHelper::from(['a', 'B']);
        $this->assertEquals('a-b', $ns->toDashed());
    }

    public function testToDashedTotLower()
    {
        $ns = NamespaceHelper::from(['a', 'B']);
        $this->assertEquals('a-B', $ns->toDashed(false));
    }

    public function testToLowerSlashed()
    {
        $ns = NamespaceHelper::from(['a', 'B']);
        $this->assertEquals('a/b', $ns->toSlashed());
    }

    public function testToLowerSlashedNotLower()
    {
        $ns = NamespaceHelper::from(['a', 'B']);
        $this->assertEquals('a/B', $ns->toSlashed(false));
    }

    public function testGet()
    {
        $ns = NamespaceHelper::fromSource([1]);
        $this->assertEquals([1], $ns->get());
    }

    public function testPrependString()
    {
        $ns = NamespaceHelper::from(['a']);
        $this->assertEquals(['b', 'a'], $ns->prepend('b')->get());
    }

    public function testPrependArray()
    {
        $ns = NamespaceHelper::from(['a']);
        $this->assertEquals(['b', 'a'], $ns->prepend(['b'])->get());
    }

    public function testAppendString()
    {
        $ns = NamespaceHelper::from(['a']);
        $this->assertEquals(['a', 'b'], $ns->append('b')->get());
    }

    public function testAppendArray()
    {
        $ns = NamespaceHelper::from(['a']);
        $this->assertEquals(['a', 'b'], $ns->append(['b'])->get());
    }

    public function testClone()
    {
        $ns1 = NamespaceHelper::from(['a']);
        $ns2 = $ns1->clone();
        $ns1->append('b');
        $this->assertEquals(['a'], $ns2->get());
    }

    public function testLast()
    {
        $ns = NamespaceHelper::from(['a', 'b']);
        $this->assertEquals('b', $ns->last());
    }

    public function testFirst()
    {
        $ns = NamespaceHelper::from(['a', 'b']);
        $this->assertEquals('a', $ns->first());
    }
}