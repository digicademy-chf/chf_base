<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model for ContentElement
 */
class ContentElement extends AbstractEntity
{
    use HiddenTrait;

    /**
     * Name of the content element
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $header = '';

    /**
     * Body of the content element
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $bodytext = '';

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * Set header
     *
     * @param string $header
     */
    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    /**
     * Get bodytext
     *
     * @return string
     */
    public function getBodytext(): string
    {
        return $this->bodytext;
    }

    /**
     * Set bodytext
     *
     * @param string $bodytext
     */
    public function setBodytext(string $bodytext): void
    {
        $this->bodytext = $bodytext;
    }
}
