<?php

namespace backend\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\UserAuthCode;

/**
 * backend\modules\user\models\UserAuthCodeSearch represents the model behind the search form about `backend\modules\user\models\UserAuthCode`.
 */
 class UserAuthCodeSearch extends UserAuthCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bind_user', 'created_by', 'updated_by', 'status'], 'integer'],
            [['bind_at', 'created_at', 'updated_at', 'code'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
        $query = UserAuthCode::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'bind_user' => $this->bind_user,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
        ]);
        if ( ! is_null($this->bind_at) && strpos($this->bind_at, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->bind_at);
            $query->andFilterWhere(['between', 'created_at', strtotime($start_date), strtotime($end_date.' 23:59:59')]);
        }
        if ( ! is_null($this->created_at) && strpos($this->created_at, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->created_at);
            $query->andFilterWhere(['between', 'created_at', strtotime($start_date), strtotime($end_date.' 23:59:59')]);
        }
        if ( ! is_null($this->updated_at) && strpos($this->updated_at, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->updated_at);
            $query->andFilterWhere(['between', 'updated_at', strtotime($start_date), strtotime($end_date.' 23:59:59')]);
        }
        $query->andFilterWhere(['like', 'code', $this->code]);
        return $dataProvider;
    }
}
