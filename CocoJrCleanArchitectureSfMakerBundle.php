<?php

namespace CocoJr\CleanArchitectureSfMakerBundle;

use CocoJr\CleanArchitectureSfMakerBundle\DependencyInjection\CocoJrCleanArchitectureSfMakerExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CocoJrCleanArchitectureSfMakerBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension()
    {
        return new CocoJrCleanArchitectureSfMakerExtension();
    }
}
