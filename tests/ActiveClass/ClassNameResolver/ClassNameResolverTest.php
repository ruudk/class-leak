<?php

declare(strict_types=1);

namespace TomasVotruba\ClassLeak\Tests\ActiveClass\ClassNameResolver;

use Iterator;
use Symplify\PackageBuilder\Testing\AbstractKernelTestCase;
use TomasVotruba\ClassLeak\ClassNameResolver;
use TomasVotruba\ClassLeak\Kernel\EasyCIKernel;
use TomasVotruba\ClassLeak\Tests\ActiveClass\ClassNameResolver\Fixture\SomeClass;

final class ClassNameResolverTest extends AbstractKernelTestCase
{
    private ClassNameResolver $classNameResolver;

    protected function setUp(): void
    {
        $this->bootKernel(EasyCIKernel::class);
        $this->classNameResolver = $this->getService(ClassNameResolver::class);
    }

    /**
     * @dataProvider provideData()
     *
     * @param class-string $expectedClassName
     */
    public function test(string $filePath, string $expectedClassName): void
    {
        $resolvedClassName = $this->classNameResolver->resolveFromFromFilePath($filePath);
        $this->assertSame($expectedClassName, $resolvedClassName);
    }

    public function provideData(): Iterator
    {
        yield [__DIR__ . '/Fixture/SomeClass.php', SomeClass::class];
    }
}