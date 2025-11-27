<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model for SameAs
 */
class SameAs extends AbstractEntity
{
    use HiddenTrait;

    /**
     * External web address
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $uri = '';

    /**
     * Construct object
     *
     * @param string $uri
     * @return SameAs
     */
    public function __construct(string $uri)
    {
        $this->setUri($uri);
    }

    /**
     * Get URI
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set URI
     *
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
}
