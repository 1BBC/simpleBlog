<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $body
 * @property string $image
 *
 * @property Category $category
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['user_id'], 'required'],
//            [['user_id', 'category_id'], 'integer'],
            [['body'], 'string'],
            [['body', 'title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg,png'],
//            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'categoryName' => 'Category',
            'title' => 'Title',
            'body' => 'Body',
            'image' => 'Image',
            'userName' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoryName()
    {
        return $this->category->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /**
     * @return boolean
     */
    public function saveCategory($category_id)
    {
        $category = Category::findOne($category_id);

        if ($category != null) {
            $this->link('category', $category);
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        return '/' . Yii::getAlias('@uploads') . '/' . (($this->image) ?  $this->image : 'no-img.png');
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->user->login;
    }
}
