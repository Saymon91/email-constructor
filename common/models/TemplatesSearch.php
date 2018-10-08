<?php

namespace common\models;

use yii\data\ActiveDataProvider;

class TemplatesSearch extends Templates
{
    public function rules()
    {
        return [
            [['title', 'filename'], 'string']
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        return $dataProvider;
    }
}