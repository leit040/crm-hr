<?php


namespace App\Model;



use yii\base\Model;
use yii\data\ActiveDataProvider;

class EmployeeSearch extends Model
{
    public ?string $skillLike = null;
    public ?string $fullNameLike = null;
    public ?string $positionAtCompanyLike = null;

    public function rules()
    {
        return [
        [['skillLike', 'fullNameLike', 'positionAtCompanyLike'], 'string', 'max' => 512],
        ];
    }

    public function search($params): ActiveDataProvider
    {

        $query = Employee::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
      $this->load($params,'');

        $query->andFilterWhere(['like','full_name',$this->fullNameLike]);
        $query->andFilterWhere(['like','position_at_company',$this->positionAtCompanyLike]);
        $query->join('LEFT JOIN','employee_skill','employee_skill.employee_id = employee.user_id')
            ->join('LEFT JOIN','skill','employee_skill.skill_id = skill.id')->andFilterWhere(['like','skill.name',$this->skillLike]);
        return $dataProvider;

    }

}