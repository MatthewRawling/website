<?php

namespace FileEye\MimeMap\Test;

use FileEye\MimeMap\Type;
use FileEye\MimeMap\TypeParameter;

class TypeParameterTest extends MimeMapTestBase
{
    public function testHasComment()
    {
        $mt = new Type('image/png; a="parameter" (with a comment)');
        $this->assertSame('a', $mt->getParameter('a')->getName());
        $this->assertSame('parameter', $mt->getParameter('a')->getValue());
        $this->assertTrue($mt->getParameter('a')->hasComment());
        $this->assertSame('with a comment', $mt->getParameter('a')->getComment());
        $mt = new Type('image/png;param=foo(with a comment)');
        $this->assertSame('param', $mt->getParameter('param')->getName());
        $this->assertSame('foo', $mt->getParameter('param')->getValue());
        $this->assertTrue($mt->getParameter('param')->hasComment());
        $this->assertSame('with a comment', $mt->getParameter('param')->getComment());
    }

    public function testHasCommentNegative()
    {
        $mt = new Type('image/png; a="parameter"');
        $this->assertSame('a', $mt->getParameter('a')->getName());
        $this->assertSame('parameter', $mt->getParameter('a')->getValue());
        $this->assertFalse($mt->getParameter('a')->hasComment());
        $mt = new Type('image/png;foo=bar');
        $this->assertSame('foo', $mt->getParameter('foo')->getName());
        $this->assertSame('bar', $mt->getParameter('foo')->getValue());
        $this->assertFalse($mt->getParameter('foo')->hasComment());
    }
}
