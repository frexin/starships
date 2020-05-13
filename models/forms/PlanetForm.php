<?php


namespace app\models\forms;


use app\models\Planet;
use yii\base\Model;

class PlanetForm extends Model
{
    public $planet_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['planet_id'], 'required'],
            [['planet_id'], 'safe'],
            [['planet_id'], 'integer'],
            [['planet_id'], 'exist', 'skipOnError' => false, 'targetClass' => Planet::class,
                'targetAttribute' => ['planet_id' => 'id']],
        ];
    }
}
