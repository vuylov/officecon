<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductPrice;

/**
 * ProductPriceSearch represents the model behind the search form about `app\models\ProductPrice`.
 */
class PriceSearch extends Price
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productItem_id', 'currency_id'], 'integer'],
            [['value'], 'number'],
            [['cause'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Price::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'productItem_id' => $this->productItem_id,
            'currency_id' => $this->currency_id,
            'value' => $this->value,
        ]);

        $query->andFilterWhere(['like', 'cause', $this->cause]);

        return $dataProvider;
    }
}
