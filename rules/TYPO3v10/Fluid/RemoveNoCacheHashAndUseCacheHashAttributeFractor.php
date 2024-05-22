<?php

declare(strict_types=1);

namespace a9f\Typo3Fractor\TYPO3v10\Fluid;

use a9f\FractorFluid\Contract\FluidFractorRule;
use Nette\Utils\Strings;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class RemoveNoCacheHashAndUseCacheHashAttributeFractor implements FluidFractorRule
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Remove noCacheHash="1" and useCacheHash="1" attribute', [
            new CodeSample(
                <<<'CODE_SAMPLE'
<f:link.page noCacheHash="1">Link</f:link.page>
<f:link.typolink useCacheHash="1">Link</f:link.typolink>
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
<f:link.page>Link</f:link.page>
<f:link.typolink>Link</f:link.typolink>
CODE_SAMPLE
            ),
        ]);
    }

    public function refactor(string $fluid): string
    {
        $fluid = Strings::replace($fluid, '# noCacheHash="(1|0|true|false)"#imsU', '');

        return Strings::replace($fluid, '# useCacheHash="(1|0|true|false)"#imsU', '');
    }
}
