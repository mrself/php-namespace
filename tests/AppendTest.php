<?php declare(strict_types=1);

namespace Mrself\NamespaceHelper\Tests;

use Mrself\NamespaceHelper\NamespaceHelper;
use PHPUnit\Framework\TestCase;

class AppendTest extends TestCase
{
    public function testItAppendsString()
    {
        $ns = NamespaceHelper::from(['a']);
        $this->assertEquals(['a', 'b'], $ns->append('b')->get());
    }

    public function testItsAppendsArray()
    {
        $ns = NamespaceHelper::from(['a']);
        $this->assertEquals(['a', 'b'], $ns->append(['b'])->get());
    }

    public function testItCanAppendStringAtPosition()
    {
        $ns = NamespaceHelper::from(['a', 'c']);
        $this->assertEquals(['a', 'b', 'c'], $ns->append('b', 1)->get());
    }

    public function testItCanAppendArrayAtPosition()
    {
        $ns = NamespaceHelper::from(['a', 'c']);
        $this->assertEquals(['a', 'b', 'c'], $ns->append(['b'], 1)->get());
    }
}