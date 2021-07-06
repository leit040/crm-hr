<?php

namespace app\Model;

use Ramsey\Uuid\Uuid;
use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property string $id
 * @property string $name
 */
class Skill extends \App\Model\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 512],
            [['name'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    public static function create(string $name)
    {
        $model = new self();
        $model->id = Uuid::uuid6()->toString();
        $model->name = $name;
        return $model;

    }

public function updateData(string $name){
        $this->name = $name;

}
}
