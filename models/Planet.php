<?php

namespace app\models;


/**
 * This is the model class for table "planets".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Starhsip[] $starships
 */
class Planet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'planets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
        ];
    }

    /**
     * Gets query for [[Starships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStarships()
    {
        return $this->hasMany(Starhsip::class, ['planet_id' => 'id']);
    }

    public function getAvailableStarships()
    {
        return $this->getStarships()->where(['>', 'available', '0'])->orderBy('available asc');
    }
}
