<?php

use yii\helpers\Html;

// $searchModel = new app\models\GSensorAlarmSearch();
// $searchModel->gsa_alarm_mode_ref = 0;
// $session = \Yii::$app->session;
// $temp_master_id = $session['g_customer_gc_id'];
// if ($temp_master_id != null) {
//     $searchModel->g_customer_gc_id = $temp_master_id;
// }

// $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
// if ($dataProvider->getTotalCount() > 0) {



//     $models = $dataProvider->getModels();
//     if ($models != null) {
//         $no = 0;
//         foreach ($models as $values) {
//             $fSensorDetailFsd = $values->fSensorDetailFsd;
//             $condition = "";
//             switch ($fSensorDetailFsd->fsd_alarm_type_ref) {
//                 case 3:
//                     $condition = "in range (" . $fSensorDetailFsd->fsd_alarm_value . $fSensorDetailFsd->fsd_value_attribute . "-" . $fSensorDetailFsd->fsd_alarm_value2 . $fSensorDetailFsd->fsd_value_attribute . ")";
//                     break;
//                 case 0: $condition = "=";
//                 case 1: $condition = ">";
//                 case 2: $condition = "<";
//                 default:
//                     $condition = $condition . $fSensorDetailFsd->fsd_alarm_value . $fSensorDetailFsd->fsd_value_attribute;
//             }
//             echo "<b>" . Html::a("alaram " . $values->gsa_id, ['g-sensor-alarm/update', 'id' => $values->gsa_id]) . "</b> " . Html::a($values->gSensorDbGsd->gsd_name, ['g-sensor-db/view', 'id' => $values->gSensorDbGsd->gsd_id]) . " => " . $fSensorDetailFsd->fsd_name . " = " . $values->gsa_value . " " . $fSensorDetailFsd->fsd_value_attribute . " (normal:" . $condition . ") " . "<br>";
//             //$d3[]= (int)$values->tsh_param_3;
//         };
//     }
// }
?>