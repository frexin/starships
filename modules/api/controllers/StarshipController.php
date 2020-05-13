<?php

namespace app\modules\api\controllers;

use app\models\forms\CargoForm;
use app\models\forms\PlanetForm;
use app\models\Starhsip;
use app\modules\api\services\CargoService;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class StarshipController extends ActiveController
{
    public $modelClass = Starhsip::class;

    public function actionLoad()
    {
        $bodyParams = \Yii::$app->request->getBodyParams();

        $form = new CargoForm();
        $form->load($bodyParams, '');

        if (!$form->validate()) {
            return $form;
        }

        $starships = $form->getStarships();

        $cargoService = new CargoService($form->getPlanet(), new Starhsip);
        $loadedStarships = $cargoService->loadStarships($starships, $form->load);

        foreach ($loadedStarships as $starship) {
            $starship->save();
        }

        return $loadedStarships;
    }

    public function actionArrive($id)
    {
        $starship = $this->getStarship($id);
        $bodyParams = \Yii::$app->request->getBodyParams();

        $form = new PlanetForm();
        $form->load($bodyParams, '');

        if (!$form->validate()) {
            return $form;
        }

        $starship->planet_id = $form->planet_id;
        $starship->save();

        return $starship;
    }

    public function actionUnload($id)
    {
        $starship = $this->getStarship($id);

        $starship->available = $starship->capacity;
        $starship->save();

        return $starship;
    }

    /**
     * @param $id
     * @return Starhsip
     * @throws NotFoundHttpException
     */
    protected function getStarship($id)
    {
        $starship = Starhsip::findOne($id);

        if (!$starship) {
            throw new NotFoundHttpException("Starship with id #$id was not found");
        }

        return $starship;
    }
}
