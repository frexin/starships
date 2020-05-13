<?php

use yii\db\Migration;

/**
 * Class m200503_145944_planet
 */
class m200503_145944_planet extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('planets', [
            'id' => $this->primaryKey(),
            'name' => $this->char(255)->unique()
        ]);

        $this->batchInsert('planets', ['name'], [['Mercury'], ['Venus'], ['Earth'], ['Mars'], ['Jupiter'], ['Saturn'],
            ['uranus'], ['Neptune']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200503_145944_planet cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_145944_planet cannot be reverted.\n";

        return false;
    }
    */
}
