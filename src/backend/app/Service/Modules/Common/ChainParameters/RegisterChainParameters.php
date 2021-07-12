<?php

namespace App\Service\Modules\Common\ChainParameters;

use League\CommonMark\Util\ArrayCollection;

class RegisterChainParameters implements ChainParametersInterface
{
    /**
     * @var \RegisterParameters
     */
    private $registerParameters;

    /**
     * @var ArrayCollection
     */
    private $completedJourneys;

    /**
     * @var ArrayCollection
     */
    private $notCompletedJourneys;

    /**
     * @var ArrayCollection Extra
     */
    private $extra;

    /**
     * @var ArrayCollection
     */
    private $processedChains;

    /**
     * @var \Exception
     */
    private $lastException;

    /**
     * BookabilityChainParameters constructor.
     */
    public function __construct()
    {
        $this->completedJourneys = new ArrayCollection();
        $this->notCompletedJourneys = new ArrayCollection();
        $this->processedChains = new ArrayCollection();
        $this->passengers = new ArrayCollection();
        $this->extra = new ArrayCollection();
    }

    public function getSearchParameters(): SearchParameters
    {
        return $this->searchParameters;
    }

    public function setSearchParameters(SearchParameters $searchParameters): BookabilityChainParameters
    {
        $this->searchParameters = $searchParameters;

        return $this;
    }

    public function getCompletedJourneys(): ArrayCollection
    {
        return $this->completedJourneys;
    }

    public function setCompletedJourneys(ArrayCollection $completedJourneys): BookabilityChainParameters
    {
        $this->completedJourneys = $completedJourneys;

        return $this;
    }

    public function getNotCompletedJourneys(): ArrayCollection
    {
        return $this->notCompletedJourneys;
    }

    public function setNotCompletedJourneys(ArrayCollection $notCompletedJourneys): BookabilityChainParameters
    {
        $this->notCompletedJourneys = $notCompletedJourneys;

        return $this;
    }

    public function getPassengers(): ArrayCollection
    {
        return $this->passengers;
    }

    public function setPassengers(ArrayCollection $passengers): BookabilityChainParameters
    {
        $this->passengers = $passengers;

        return $this;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): BookabilityChainParameters
    {
        $this->contact = $contact;

        return $this;
    }

    public function getExtra(): ArrayCollection
    {
        return $this->extra;
    }

    public function setExtra(ArrayCollection $extra): BookabilityChainParameters
    {
        $this->extra = $extra;

        return $this;
    }

    public function getProcessedChains(): ArrayCollection
    {
        return $this->processedChains;
    }

    public function setProcessedChains(ArrayCollection $processedChains): BookabilityChainParameters
    {
        $this->processedChains = $processedChains;

        return $this;
    }

    public function isCompleted(): bool
    {
        if ($this->getNotCompletedJourneys()->count() > 0) {
            return false;
        }

        return true;
    }

    public function setLastException(Throwable $exception): ChainParametersInterface
    {
        $this->lastException = $exception;

        return $this;
    }

    public function getLastException(): ?Throwable
    {
        return $this->lastException;
    }

    public function complete(ArrayCollection $journeys, string $className = null)
    {
        foreach ($journeys as $journey) {
            $this->addProcessedInfo($journey, $className);
            $this->getCompletedJourneys()->add($journey);
            $this->getNotCompletedJourneys()->removeElement($journey);
        }
    }

    public function addProcessedInfos(ArrayCollection $journeys, string $className = null)
    {
        foreach ($journeys as $journey) {
            $this->addProcessedInfo($journey, $className);
        }
    }

    public function addProcessedInfo(Journey $journey, string $className = null)
    {
        if (null === $journey->getExtra()->get(self::KEY_PROCESSED_HANDLER)) {
            $journey->addExtra(self::KEY_PROCESSED_HANDLER, []);
        }

        $processedHandlers = $journey->getExtra()->get(self::KEY_PROCESSED_HANDLER);
        $processedHandlers[] = [$className => date('Y-m-d H:i:s')];

        $journey->addExtra(self::KEY_PROCESSED_HANDLER, $processedHandlers);
    }
}
