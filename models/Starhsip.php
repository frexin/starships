<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "starships".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $capacity
 * @property int|null $available
 * @property int $planet_id
 *
 * @property Planet $planet
 */
class Starhsip extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'starships';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'capacity', 'planet_id'], 'required'],
            ['available', 'default', 'value' => function ($model, $attribute) {
                return $model->capacity;
            }],
            [['name', 'type', 'capacity', 'planet_id', 'available'], 'safe'],
            [['capacity', 'available', 'planet_id'], 'integer'],
            [['name', 'type'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['planet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planet::class, 'targetAttribute' => ['planet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'capacity' => 'Capacity',
            'available' => 'Available',
            'planet_id' => 'Planet ID',
        ];
    }

    /**
     * Gets query for [[Planet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanet()
    {
        return $this->hasOne(Planet::className(), ['id' => 'planet_id']);
    }
}
