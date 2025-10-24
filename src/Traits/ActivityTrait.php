<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\Activity;

trait ActivityTrait
{
    /**
     * Activity
     */
    private ?Activity $activity = null;

    /**
     * Get Activity
     */
    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    /**
     * Set Activity using string code, array or Activity instance
     */
    public function setActivity(Activity|array|string $activity): void
    {
        if ($activity instanceof Activity) {
            $this->activity = $activity;

            return;
        }

        $data = (new DataLoader('actividades-economicas'))->getByCode($activity);
        $this->activity = new Activity($data);
    }
}
