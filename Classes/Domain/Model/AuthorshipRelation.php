<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\RecordTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AuthorshipRelation
 */
class AuthorshipRelation extends AbstractRelation
{
    use RecordTrait;

    /**
     * Contributors to relate to the record
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $contributor;

    /**
     * Qualification of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'author',
                'photographer',
                'editor',
                'translator',
                'contributor',
                'publisher',
                'rightsOwner',
            ],
        ],
    ])]
    protected string $role = 'author';

    /**
     * Construct object
     *
     * @param AbstractBase $record
     * @param Agent $contributor
     * @return AuthorshipRelation
     */
    public function __construct(AbstractBase $record, Agent $contributor)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setType('authorshipRelation');
        $this->setRecord($record);
        $this->addContributor($contributor);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->contributor = new ObjectStorage();
    }

    /**
     * Get contributor
     *
     * @return ObjectStorage<Agent>
     */
    public function getContributor(): ObjectStorage
    {
        return $this->contributor;
    }

    /**
     * Set contributor
     *
     * @param ObjectStorage<Agent> $contributor
     */
    public function setContributor(ObjectStorage $contributor): void
    {
        $this->contributor = $contributor;
    }

    /**
     * Add contributor
     *
     * @param Agent $contributor
     */
    public function addContributor(Agent $contributor): void
    {
        $this->contributor->attach($contributor);
    }

    /**
     * Remove contributor
     *
     * @param Agent $contributor
     */
    public function removeContributor(Agent $contributor): void
    {
        $this->contributor->detach($contributor);
    }

    /**
     * Remove all contributors
     */
    public function removeAllContributor(): void
    {
        $contributor = clone $this->contributor;
        $this->contributor->removeAll($contributor);
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}
