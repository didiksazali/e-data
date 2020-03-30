<?php
namespace app\modules\administrator\models;
use Yii;
use yii\base\Model;
/**
 * Created by PhpStorm.
 * User: irosadie
 * Date: 21/07/17
 * Time: 9:36
 */

class Main extends Model
{
    public function backEndMenu(){
        //order by squence number
        $json= '[
                {"text":"Data Master","icon":"fa fa-home","href":"http://home.com","children":[
                {"text":"Data Anggota","icon":"fa fa-bar-chart-o", "href":"administrator/anggota/index"},
                {"text":"Data User","icon":"fa fa-bar-chart-o", "href":"administrator/admin/index"}

                ]}
                ]';
        $menu= json_decode($json);

        return $menu;
    }
}
