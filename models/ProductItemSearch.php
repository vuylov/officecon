<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductItem;

/**
 * ProductItemSearch represents the model behind the search form about `app\models\ProductItem`.
 */
class ProductItemSearch extends ProductItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'amount'], 'integer'],
            [['article', 'size', 'description'], 'safe'],
            [['weight', 'volume'], 'number'],
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
        $query = ProductItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'weight' => $this->weight,
            'volume' => $this->volume,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
