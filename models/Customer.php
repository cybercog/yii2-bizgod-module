<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $full_name
 * @property string $mobile
 * @property string $email
 * @property string $address
 * @property string $city
 * @property integer $status
 * @property integer $score
 * @property integer $customer_type
 *
 * @property Order[] $orders
 * @property Po[] $pos
 * @property Rating[] $ratings
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'full_name', 'mobile', 'email', 'address', 'city', 'status', 'score', 'customer_type'], 'required'],
            [['status', 'score', 'customer_type'], 'integer'],
            [['username'], 'string', 'max' => 40],
            [['password', 'address', 'city'], 'string', 'max' => 255],
            [['full_name'], 'string', 'max' => 80],
            [['mobile', 'email'], 'string', 'max' => 20],
            [['username', 'email'], 'unique', 'targetAttribute' => ['username', 'email'], 'message' => 'The combination of Username and Email has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'full_name' => Yii::t('app', 'Full Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'status' => Yii::t('app', 'Status'),
            'score' => Yii::t('app', 'Score'),
            'customer_type' => Yii::t('app', 'Customer Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPos()
    {
        return $this->hasMany(Po::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['customer_id' => 'id']);
    }
}
