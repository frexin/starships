<?php


namespace app\models\forms;


use app\models\Planet;
use app\models\Starhsip;
use app\modules\api\services\CargoService;
use yii\base\Model;

class CargoForm extends Model
{

    public $planet_id;
    public $load;

    /**
     * @var Starhsip[]
     */
    private $starships;

    /**
     * @var Planet
     */
    private $planet;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['load', 'planet_id'], 'required'],
            [['load', 'planet_id'], 'safe'],
            [['load', 'planet_id'], 'integer'],
            [['planet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planet::class,
                'targetAttribute' => ['planet_id' => 'id']],
            ['load', 'loadCargo']
        ];
    }

    public function loadCargo($attr, $params)
    {
        if (!$this->hasErrors()) {
            $this->planet = Planet::findOne($this->planet_id);

            $cargoService = new CargoService($this->planet, new Starhsip);
            $this->starships = $cargoService->getAvailableShips($this->load);

            if (!$this->starships) {
                $this->addError($attr, 'There are not enough available starships on this planet');
            }
        }
    }

    public function getStarships()
    {
        return $this->starships;
    }

    /**
     * @return Planet
     */
    public function getPlanet()
    {
        return $this->planet;
    }
}
