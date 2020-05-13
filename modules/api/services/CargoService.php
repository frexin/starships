<?php


namespace app\modules\api\services;


use app\models\Planet;
use app\models\Starhsip;

class CargoService
{

    /**
     * @var Planet
     */
    private $planet;

    /**
     * @var Starhsip
     */
    private $starshipModel;

    /**
     * CargoService constructor.
     * @param Planet $planet
     * @param Starhsip $starhsip
     */
    public function __construct(Planet $planet, Starhsip $starhsip)
    {
        $this->planet = $planet;
        $this->starshipModel = $starhsip;
    }

    public function getAvailableShips($load)
    {
        $ships = [];
        $available = $this->planet->getAvailableStarships()->sum('available');

        if ($available > $load) {
            $ships = $this->planet->availableStarships;
        }

        return $ships;
    }

    public function loadStarships(array $ships, $load)
    {
        $result = [];

        foreach ($ships as $ship) {
            $result[] = $ship;

            if ($ship->available - $load < 0) {
                $load -= $ship->available;
                $ship->available = 0;
            }
            else {
                $ship->available -= $load;
                break;
            }
        }

        return $result;
    }

}
