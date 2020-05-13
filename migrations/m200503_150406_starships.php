<?php

use yii\db\Migration;

/**
 * Class m200503_150406_starships
 */
class m200503_150406_starships extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('starships', [
            'id' => $this->primaryKey(),
            'name' => $this->char(255)->notNull()->unique(),
            'type' => $this->char(255)->notNull(),
            'capacity' => $this->integer()->notNull()->unsigned()->defaultValue(0),
            'available' => $this->integer()->unsigned()->defaultValue(0),
            'planet_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('planet', 'starships', 'planet_id', 'planets', 'id');

        $this->batchInsert('starships', ['name', 'type', 'capacity', 'available', 'planet_id'], [
           ['Enterprise', 'mothership', 10000, 10000, 1],
           ['Junior', 'fregat', 5000, 5000, 2],
           ['Sunrise', 'boat', 2500, 2500, 3],
           ['Skyfall', 'boat', 2500, 2500, 4]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200503_150406_starships cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_150406_starships cannot be reverted.\n";

        return false;
    }
    */
}
