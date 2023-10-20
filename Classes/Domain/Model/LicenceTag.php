<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for LicenceTag
 */
class LicenceTag extends AbstractTag
{
    /**
     * List of resources that use this tag as a metadata licence
     * 
     * @var ObjectStorage<Resource>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMetadataOfResource;

    /**
     * List of resources that use this tag as a text licence
     * 
     * @var ObjectStorage<Resource>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfTextOfResource;

    /**
     * List of resources that use this tag as a media licence
     * 
     * @var ObjectStorage<Resource>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMediaOfResource;

    /**
     * List of agents that use this tag as a metadata licence
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMetadataOfAgent;

    /**
     * List of agents that use this tag as a text licence
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfTextOfAgent;

    /**
     * List of agents that use this tag as a media licence
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMediaOfAgent;

    /**
     * List of locations that use this tag as a metadata licence
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMetadataOfLocation;

    /**
     * List of locations that use this tag as a text licence
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfTextOfLocation;

    /**
     * List of locations that use this tag as a media licence
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMediaOfLocation;

    /**
     * List of periods that use this tag as a metadata licence
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMetadataOfPeriod;

    /**
     * List of periods that use this tag as a text licence
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfTextOfPeriod;

    /**
     * List of periods that use this tag as a media licence
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asLicenceOfMediaOfPeriod;

    /**
     * Construct object
     *
     * @param string $uuid
     * @param string $code
     * @param string $text
     * @return LicenceTag
     */
    public function __construct(string $uuid, string $code, string $text)
    {
        $this->initializeObject();

        parent::__construct($uuid, 'licenceTag', $code, $text);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asLicenceOfMetadataOfResource = new ObjectStorage();
        $this->asLicenceOfTextOfResource = new ObjectStorage();
        $this->asLicenceOfMediaOfResource = new ObjectStorage();
        $this->asLicenceOfMetadataOfAgent = new ObjectStorage();
        $this->asLicenceOfTextOfAgent = new ObjectStorage();
        $this->asLicenceOfMediaOfAgent = new ObjectStorage();
        $this->asLicenceOfMetadataOfLocation = new ObjectStorage();
        $this->asLicenceOfTextOfLocation = new ObjectStorage();
        $this->asLicenceOfMediaOfLocation = new ObjectStorage();
        $this->asLicenceOfMetadataOfPeriod = new ObjectStorage();
        $this->asLicenceOfTextOfPeriod = new ObjectStorage();
        $this->asLicenceOfMediaOfPeriod = new ObjectStorage();
    }

    /**
     * Get as licence of metadata of resource
     *
     * @return ObjectStorage<Resource>
     */
    public function getAsLicenceOfMetadataOfResource(): ObjectStorage
    {
        return $this->asLicenceOfMetadataOfResource;
    }

    /**
     * Set as licence of metadata of resource
     *
     * @param ObjectStorage<Resource> $asLicenceOfMetadataOfResource
     */
    public function setAsLicenceOfMetadataOfResource(ObjectStorage $asLicenceOfMetadataOfResource): void
    {
        $this->asLicenceOfMetadataOfResource = $asLicenceOfMetadataOfResource;
    }

    /**
     * Add as licence of metadata of resource
     *
     * @param Resource $asLicenceOfMetadataOfResource
     */
    public function addAsLicenceOfMetadataOfResource(Resource $asLicenceOfMetadataOfResource): void
    {
        $this->asLicenceOfMetadataOfResource->attach($asLicenceOfMetadataOfResource);
    }

    /**
     * Remove as licence of metadata of resource
     *
     * @param Resource $asLicenceOfMetadataOfResource
     */
    public function removeAsLicenceOfMetadataOfResource(Resource $asLicenceOfMetadataOfResource): void
    {
        $this->asLicenceOfMetadataOfResource->detach($asLicenceOfMetadataOfResource);
    }

    /**
     * Remove all as licence of metadata of resource
     */
    public function removeAllAsLicenceOfMetadataOfResource(): void
    {
        $asLicenceOfMetadataOfResource = clone $this->asLicenceOfMetadataOfResource;
        $this->asLicenceOfMetadataOfResource->removeAll($asLicenceOfMetadataOfResource);
    }

    /**
     * Get as licence of text of resource
     *
     * @return ObjectStorage<Resource>
     */
    public function getAsLicenceOfTextOfResource(): ObjectStorage
    {
        return $this->asLicenceOfTextOfResource;
    }

    /**
     * Set as licence of text of resource
     *
     * @param ObjectStorage<Resource> $asLicenceOfTextOfResource
     */
    public function setAsLicenceOfTextOfResource(ObjectStorage $asLicenceOfTextOfResource): void
    {
        $this->asLicenceOfTextOfResource = $asLicenceOfTextOfResource;
    }

    /**
     * Add as licence of text of resource
     *
     * @param Resource $asLicenceOfTextOfResource
     */
    public function addAsLicenceOfTextOfResource(Resource $asLicenceOfTextOfResource): void
    {
        $this->asLicenceOfTextOfResource->attach($asLicenceOfTextOfResource);
    }

    /**
     * Remove as licence of text of resource
     *
     * @param Resource $asLicenceOfTextOfResource
     */
    public function removeAsLicenceOfTextOfResource(Resource $asLicenceOfTextOfResource): void
    {
        $this->asLicenceOfTextOfResource->detach($asLicenceOfTextOfResource);
    }

    /**
     * Remove all as licence of text of resource
     */
    public function removeAllAsLicenceOfTextOfResource(): void
    {
        $asLicenceOfTextOfResource = clone $this->asLicenceOfTextOfResource;
        $this->asLicenceOfTextOfResource->removeAll($asLicenceOfTextOfResource);
    }

    /**
     * Get as licence of media of resource
     *
     * @return ObjectStorage<Resource>
     */
    public function getAsLicenceOfMediaOfResource(): ObjectStorage
    {
        return $this->asLicenceOfMediaOfResource;
    }

    /**
     * Set as licence of media of resource
     *
     * @param ObjectStorage<Resource> $asLicenceOfMediaOfResource
     */
    public function setAsLicenceOfMediaOfResource(ObjectStorage $asLicenceOfMediaOfResource): void
    {
        $this->asLicenceOfMediaOfResource = $asLicenceOfMediaOfResource;
    }

    /**
     * Add as licence of media of resource
     *
     * @param Resource $asLicenceOfMediaOfResource
     */
    public function addAsLicenceOfMediaOfResource(Resource $asLicenceOfMediaOfResource): void
    {
        $this->asLicenceOfMediaOfResource->attach($asLicenceOfMediaOfResource);
    }

    /**
     * Remove as licence of media of resource
     *
     * @param Resource $asLicenceOfMediaOfResource
     */
    public function removeAsLicenceOfMediaOfResource(Resource $asLicenceOfMediaOfResource): void
    {
        $this->asLicenceOfMediaOfResource->detach($asLicenceOfMediaOfResource);
    }

    /**
     * Remove all as licence of media of resource
     */
    public function removeAllAsLicenceOfMediaOfResource(): void
    {
        $asLicenceOfMediaOfResource = clone $this->asLicenceOfMediaOfResource;
        $this->asLicenceOfMediaOfResource->removeAll($asLicenceOfMediaOfResource);
    }

    /**
     * Get as licence of metadata of agent
     *
     * @return ObjectStorage<Agent>
     */
    public function getAsLicenceOfMetadataOfAgent(): ObjectStorage
    {
        return $this->asLicenceOfMetadataOfAgent;
    }

    /**
     * Set as licence of metadata of agent
     *
     * @param ObjectStorage<Agent> $asLicenceOfMetadataOfAgent
     */
    public function setAsLicenceOfMetadataOfAgent(ObjectStorage $asLicenceOfMetadataOfAgent): void
    {
        $this->asLicenceOfMetadataOfAgent = $asLicenceOfMetadataOfAgent;
    }

    /**
     * Add as licence of metadata of agent
     *
     * @param Agent $asLicenceOfMetadataOfAgent
     */
    public function addAsLicenceOfMetadataOfAgent(Agent $asLicenceOfMetadataOfAgent): void
    {
        $this->asLicenceOfMetadataOfAgent->attach($asLicenceOfMetadataOfAgent);
    }

    /**
     * Remove as licence of metadata of agent
     *
     * @param Agent $asLicenceOfMetadataOfAgent
     */
    public function removeAsLicenceOfMetadataOfAgent(Agent $asLicenceOfMetadataOfAgent): void
    {
        $this->asLicenceOfMetadataOfAgent->detach($asLicenceOfMetadataOfAgent);
    }

    /**
     * Remove all as licence of metadata of agent
     */
    public function removeAllAsLicenceOfMetadataOfAgent(): void
    {
        $asLicenceOfMetadataOfAgent = clone $this->asLicenceOfMetadataOfAgent;
        $this->asLicenceOfMetadataOfAgent->removeAll($asLicenceOfMetadataOfAgent);
    }

    /**
     * Get as licence of text of agent
     *
     * @return ObjectStorage<Agent>
     */
    public function getAsLicenceOfTextOfAgent(): ObjectStorage
    {
        return $this->asLicenceOfTextOfAgent;
    }

    /**
     * Set as licence of text of agent
     *
     * @param ObjectStorage<Agent> $asLicenceOfTextOfAgent
     */
    public function setAsLicenceOfTextOfAgent(ObjectStorage $asLicenceOfTextOfAgent): void
    {
        $this->asLicenceOfTextOfAgent = $asLicenceOfTextOfAgent;
    }

    /**
     * Add as licence of text of agent
     *
     * @param Agent $asLicenceOfTextOfAgent
     */
    public function addAsLicenceOfTextOfAgent(Agent $asLicenceOfTextOfAgent): void
    {
        $this->asLicenceOfTextOfAgent->attach($asLicenceOfTextOfAgent);
    }

    /**
     * Remove as licence of text of agent
     *
     * @param Agent $asLicenceOfTextOfAgent
     */
    public function removeAsLicenceOfTextOfAgent(Agent $asLicenceOfTextOfAgent): void
    {
        $this->asLicenceOfTextOfAgent->detach($asLicenceOfTextOfAgent);
    }

    /**
     * Remove all as licence of text of agent
     */
    public function removeAllAsLicenceOfTextOfAgent(): void
    {
        $asLicenceOfTextOfAgent = clone $this->asLicenceOfTextOfAgent;
        $this->asLicenceOfTextOfAgent->removeAll($asLicenceOfTextOfAgent);
    }

    /**
     * Get as licence of media of agent
     *
     * @return ObjectStorage<Agent>
     */
    public function getAsLicenceOfMediaOfAgent(): ObjectStorage
    {
        return $this->asLicenceOfMediaOfAgent;
    }

    /**
     * Set as licence of media of agent
     *
     * @param ObjectStorage<Agent> $asLicenceOfMediaOfAgent
     */
    public function setAsLicenceOfMediaOfAgent(ObjectStorage $asLicenceOfMediaOfAgent): void
    {
        $this->asLicenceOfMediaOfAgent = $asLicenceOfMediaOfAgent;
    }

    /**
     * Add as licence of media of agent
     *
     * @param Agent $asLicenceOfMediaOfAgent
     */
    public function addAsLicenceOfMediaOfAgent(Agent $asLicenceOfMediaOfAgent): void
    {
        $this->asLicenceOfMediaOfAgent->attach($asLicenceOfMediaOfAgent);
    }

    /**
     * Remove as licence of media of agent
     *
     * @param Agent $asLicenceOfMediaOfAgent
     */
    public function removeAsLicenceOfMediaOfAgent(Agent $asLicenceOfMediaOfAgent): void
    {
        $this->asLicenceOfMediaOfAgent->detach($asLicenceOfMediaOfAgent);
    }

    /**
     * Remove all as licence of media of agent
     */
    public function removeAllAsLicenceOfMediaOfAgent(): void
    {
        $asLicenceOfMediaOfAgent = clone $this->asLicenceOfMediaOfAgent;
        $this->asLicenceOfMediaOfAgent->removeAll($asLicenceOfMediaOfAgent);
    }

    /**
     * Get as licence of metadata of location
     *
     * @return ObjectStorage<Location>
     */
    public function getAsLicenceOfMetadataOfLocation(): ObjectStorage
    {
        return $this->asLicenceOfMetadataOfLocation;
    }

    /**
     * Set as licence of metadata of location
     *
     * @param ObjectStorage<Location> $asLicenceOfMetadataOfLocation
     */
    public function setAsLicenceOfMetadataOfLocation(ObjectStorage $asLicenceOfMetadataOfLocation): void
    {
        $this->asLicenceOfMetadataOfLocation = $asLicenceOfMetadataOfLocation;
    }

    /**
     * Add as licence of metadata of location
     *
     * @param Location $asLicenceOfMetadataOfLocation
     */
    public function addAsLicenceOfMetadataOfLocation(Location $asLicenceOfMetadataOfLocation): void
    {
        $this->asLicenceOfMetadataOfLocation->attach($asLicenceOfMetadataOfLocation);
    }

    /**
     * Remove as licence of metadata of location
     *
     * @param Location $asLicenceOfMetadataOfLocation
     */
    public function removeAsLicenceOfMetadataOfLocation(Location $asLicenceOfMetadataOfLocation): void
    {
        $this->asLicenceOfMetadataOfLocation->detach($asLicenceOfMetadataOfLocation);
    }

    /**
     * Remove all as licence of metadata of location
     */
    public function removeAllAsLicenceOfMetadataOfLocation(): void
    {
        $asLicenceOfMetadataOfLocation = clone $this->asLicenceOfMetadataOfLocation;
        $this->asLicenceOfMetadataOfLocation->removeAll($asLicenceOfMetadataOfLocation);
    }

    /**
     * Get as licence of text of location
     *
     * @return ObjectStorage<Location>
     */
    public function getAsLicenceOfTextOfLocation(): ObjectStorage
    {
        return $this->asLicenceOfTextOfLocation;
    }

    /**
     * Set as licence of text of location
     *
     * @param ObjectStorage<Location> $asLicenceOfTextOfLocation
     */
    public function setAsLicenceOfTextOfLocation(ObjectStorage $asLicenceOfTextOfLocation): void
    {
        $this->asLicenceOfTextOfLocation = $asLicenceOfTextOfLocation;
    }

    /**
     * Add as licence of text of location
     *
     * @param Location $asLicenceOfTextOfLocation
     */
    public function addAsLicenceOfTextOfLocation(Location $asLicenceOfTextOfLocation): void
    {
        $this->asLicenceOfTextOfLocation->attach($asLicenceOfTextOfLocation);
    }

    /**
     * Remove as licence of text of location
     *
     * @param Location $asLicenceOfTextOfLocation
     */
    public function removeAsLicenceOfTextOfLocation(Location $asLicenceOfTextOfLocation): void
    {
        $this->asLicenceOfTextOfLocation->detach($asLicenceOfTextOfLocation);
    }

    /**
     * Remove all as licence of text of location
     */
    public function removeAllAsLicenceOfTextOfLocation(): void
    {
        $asLicenceOfTextOfLocation = clone $this->asLicenceOfTextOfLocation;
        $this->asLicenceOfTextOfLocation->removeAll($asLicenceOfTextOfLocation);
    }

    /**
     * Get as licence of media of location
     *
     * @return ObjectStorage<Location>
     */
    public function getAsLicenceOfMediaOfLocation(): ObjectStorage
    {
        return $this->asLicenceOfMediaOfLocation;
    }

    /**
     * Set as licence of media of location
     *
     * @param ObjectStorage<Location> $asLicenceOfMediaOfLocation
     */
    public function setAsLicenceOfMediaOfLocation(ObjectStorage $asLicenceOfMediaOfLocation): void
    {
        $this->asLicenceOfMediaOfLocation = $asLicenceOfMediaOfLocation;
    }

    /**
     * Add as licence of media of location
     *
     * @param Location $asLicenceOfMediaOfLocation
     */
    public function addAsLicenceOfMediaOfLocation(Location $asLicenceOfMediaOfLocation): void
    {
        $this->asLicenceOfMediaOfLocation->attach($asLicenceOfMediaOfLocation);
    }

    /**
     * Remove as licence of media of location
     *
     * @param Location $asLicenceOfMediaOfLocation
     */
    public function removeAsLicenceOfMediaOfLocation(Location $asLicenceOfMediaOfLocation): void
    {
        $this->asLicenceOfMediaOfLocation->detach($asLicenceOfMediaOfLocation);
    }

    /**
     * Remove all as licence of media of location
     */
    public function removeAllAsLicenceOfMediaOfLocation(): void
    {
        $asLicenceOfMediaOfLocation = clone $this->asLicenceOfMediaOfLocation;
        $this->asLicenceOfMediaOfLocation->removeAll($asLicenceOfMediaOfLocation);
    }

    /**
     * Get as licence of metadata of period
     *
     * @return ObjectStorage<Period>
     */
    public function getAsLicenceOfMetadataOfPeriod(): ObjectStorage
    {
        return $this->asLicenceOfMetadataOfPeriod;
    }

    /**
     * Set as licence of metadata of period
     *
     * @param ObjectStorage<Period> $asLicenceOfMetadataOfPeriod
     */
    public function setAsLicenceOfMetadataOfPeriod(ObjectStorage $asLicenceOfMetadataOfPeriod): void
    {
        $this->asLicenceOfMetadataOfPeriod = $asLicenceOfMetadataOfPeriod;
    }

    /**
     * Add as licence of metadata of period
     *
     * @param Period $asLicenceOfMetadataOfPeriod
     */
    public function addAsLicenceOfMetadataOfPeriod(Period $asLicenceOfMetadataOfPeriod): void
    {
        $this->asLicenceOfMetadataOfPeriod->attach($asLicenceOfMetadataOfPeriod);
    }

    /**
     * Remove as licence of metadata of period
     *
     * @param Period $asLicenceOfMetadataOfPeriod
     */
    public function removeAsLicenceOfMetadataOfPeriod(Period $asLicenceOfMetadataOfPeriod): void
    {
        $this->asLicenceOfMetadataOfPeriod->detach($asLicenceOfMetadataOfPeriod);
    }

    /**
     * Remove all as licence of metadata of period
     */
    public function removeAllAsLicenceOfMetadataOfPeriod(): void
    {
        $asLicenceOfMetadataOfPeriod = clone $this->asLicenceOfMetadataOfPeriod;
        $this->asLicenceOfMetadataOfPeriod->removeAll($asLicenceOfMetadataOfPeriod);
    }

    /**
     * Get as licence of text of period
     *
     * @return ObjectStorage<Period>
     */
    public function getAsLicenceOfTextOfPeriod(): ObjectStorage
    {
        return $this->asLicenceOfTextOfPeriod;
    }

    /**
     * Set as licence of text of period
     *
     * @param ObjectStorage<Period> $asLicenceOfTextOfPeriod
     */
    public function setAsLicenceOfTextOfPeriod(ObjectStorage $asLicenceOfTextOfPeriod): void
    {
        $this->asLicenceOfTextOfPeriod = $asLicenceOfTextOfPeriod;
    }

    /**
     * Add as licence of text of period
     *
     * @param Period $asLicenceOfTextOfPeriod
     */
    public function addAsLicenceOfTextOfPeriod(Period $asLicenceOfTextOfPeriod): void
    {
        $this->asLicenceOfTextOfPeriod->attach($asLicenceOfTextOfPeriod);
    }

    /**
     * Remove as licence of text of period
     *
     * @param Period $asLicenceOfTextOfPeriod
     */
    public function removeAsLicenceOfTextOfPeriod(Period $asLicenceOfTextOfPeriod): void
    {
        $this->asLicenceOfTextOfPeriod->detach($asLicenceOfTextOfPeriod);
    }

    /**
     * Remove all as licence of text of period
     */
    public function removeAllAsLicenceOfTextOfPeriod(): void
    {
        $asLicenceOfTextOfPeriod = clone $this->asLicenceOfTextOfPeriod;
        $this->asLicenceOfTextOfPeriod->removeAll($asLicenceOfTextOfPeriod);
    }

    /**
     * Get as licence of media of period
     *
     * @return ObjectStorage<Period>
     */
    public function getAsLicenceOfMediaOfPeriod(): ObjectStorage
    {
        return $this->asLicenceOfMediaOfPeriod;
    }

    /**
     * Set as licence of media of period
     *
     * @param ObjectStorage<Period> $asLicenceOfMediaOfPeriod
     */
    public function setAsLicenceOfMediaOfPeriod(ObjectStorage $asLicenceOfMediaOfPeriod): void
    {
        $this->asLicenceOfMediaOfPeriod = $asLicenceOfMediaOfPeriod;
    }

    /**
     * Add as licence of media of period
     *
     * @param Period $asLicenceOfMediaOfPeriod
     */
    public function addAsLicenceOfMediaOfPeriod(Period $asLicenceOfMediaOfPeriod): void
    {
        $this->asLicenceOfMediaOfPeriod->attach($asLicenceOfMediaOfPeriod);
    }

    /**
     * Remove as licence of media of period
     *
     * @param Period $asLicenceOfMediaOfPeriod
     */
    public function removeAsLicenceOfMediaOfPeriod(Period $asLicenceOfMediaOfPeriod): void
    {
        $this->asLicenceOfMediaOfPeriod->detach($asLicenceOfMediaOfPeriod);
    }

    /**
     * Remove all as licence of media of period
     */
    public function removeAllAsLicenceOfMediaOfPeriod(): void
    {
        $asLicenceOfMediaOfPeriod = clone $this->asLicenceOfMediaOfPeriod;
        $this->asLicenceOfMediaOfPeriod->removeAll($asLicenceOfMediaOfPeriod);
    }
}

?>
