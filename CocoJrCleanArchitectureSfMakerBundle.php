<?php

namespace CocoJr\CleanArchitectureSfMakerBundle;

use CocoJr\CleanArchitectureSfMakerBundle\DependencyInjection\CocoJrCleanArchitectureSfMakerExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CocoJrCleanArchitectureSfMakerBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new CocoJrCleanArchitectureSfMakerExtension();
    }
}
