<?php

/**
 * Class Common
 * @author Mochamad Gibran Meidiyan <gibran1905@gmail.com>
 */

namespace app\components;

use app\models\Notification;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

class Common extends Component {

    public function SendEsmail()
    {
       echo "HUHU";
    }

    public function sendEmail($to,$subject,$body,$attach=[],$from='scheduller1905@gmail.com')
    {
      try{
        if (!empty($attach)) {
            Yii::$app->mailer->compose()
            ->setTo($to)
            ->setFrom($from)
            ->setSubject($subject)
            ->setTextBody($body)
            ->attach($attach)
            ->send();
        }else{
            Yii::$app->mailer->compose()
            ->setTo($to)
            ->setFrom($from)
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
        }
        return true;
      }catch (\Exception $e){
        // echo "<pre>"; print_r(substr($e, 0,2000));echo "</pre>";
        $e = json_encode($e);
        echo $e;
        error_log("[".date('Y-m-d H:i:s')."] Send Mail Exception: $e \n",3,'/ticketing/log/sendmail_'.date('Ymd').".log");
        return false;
      }
    }

    public function log($message,$file){
        $date = date('Y-m-d H:i:s');
        $folder = Yii::$app->params['folder_log'];
//        echo "folder $folder".$file;
        error_log("[$date]$message\n",3,$folder.$file);
    }

    public function getMenu(){
        $result = Yii::$app->db->createCommand("select  name,menu1,menu2,menu_label,menu_url,perent from auth_item where type=3 order by menu1,menu2,menu_label,perent;")
            ->queryAll();
        $last_menu = "";
        $last_id = -1;
        $last_menu2 = "";
        $last_id2 = -1;
        function deleteFirstWord($menu)
        {
            $res = strstr($menu, '.');
            if ($res == "") {
                return $menu;
            } else {
                return substr($res, 1);
            }
        }

        foreach ($result as $item) {
            if (@$menu1 != "hidden") {
                if ($item['perent'] != null) {
                    $urlex = explode('&', $item['menu_url']);
                    if (count($urlex) > 1) {
                        $simpan[] = $urlex[0];
                        $urlex[0] = null;
                        foreach ($urlex as $urlresult) {
                            $urlex3 = explode('=', $urlresult);
                            $simpan[$urlex3[0]] = $urlex3[1];
                        }

                        if (Yii::$app->user->can($item['name'])) {
                            $isi = ['data' => ['name' => $item['name'], 'label' => deleteFirstWord($item["menu_label"]), 'url' => $simpan, 'items' => []]];
                            if ($a[$item['perent']] == null) {
                                $a[$item['perent']] = [$isi];
                            } else {
                                array_push($a[$item['perent']], $isi);
                            }
                            unset($simpan, $urlex, $urlex2, $urlex3);
                        }

                    } else {
                        if (Yii::$app->user->can($item['name'])) {
                            $isi = ['data' => ['name' => $item['name'], 'label' => deleteFirstWord($item["menu_label"]), 'url' => [$item["menu_url"]], 'items' => []]];
                            if ($a[$item['perent']] == null) {
                                $a[$item['perent']] = [$isi];
                            } else {
                                array_push($a[$item['perent']], $isi);
                            }
                        }
                    }
                }
            }
        }
        $a = array_reverse($a);
        $child = $a;
        foreach ($a as $b => $c) {
            $nama_perent = $b;
            foreach ($a as $x => $y) {
                foreach ($y as $z => $w) {
                    // print("<pre>" . print_r($z['data']['name'], true) . "</pre>");
                    // exit;
                    if ($w['data']['name'] == $nama_perent) {
                        // print("<pre>" . print_r($z['data']['name'], true) . "</pre>");
                        // exit;
                        foreach ($c as $d => $e) {
                            // print("<pre>" . print_r($e, true) . "</pre>");
                            // exit;
                            array_push($child[$x][$z]['data']['items'], $child[$b][$d]['data']);

                        }
                        unset($child[$b]);
                        //                 print("<pre>" . print_r($child, true) . "</pre>");
                        // exit;
                        // $data_child[]=
                    }
                }
            }
        }
        foreach ($result as $item) {
            /*
                print_r($item);
                echo "<br>";
                echo $item["menu1"].'<br>';*/
            $menu1 = $item["menu1"];
            if ($menu1 != "hidden") {
                if ($last_menu != $menu1) {
                    $items[] = ['label' => deleteFirstWord($menu1), 'items' => []];
                    $last_id++;
                    $last_id2 = -1;
                    $last_menu = $menu1;
                    $last_menu2 = "";
                };
                $menu2 = $item["menu2"];
                if ($last_menu2 != $menu2) {
                    $items[$last_id]["items"][] = ['label' => deleteFirstWord($menu2), 'items' => []];
                    $last_id2++;
                    $last_menu2 = $menu2;
                    $last_id3 = 0;
                };

                if ($item['perent'] == null) {
                    foreach ($child as $b => $c) {
                        if ($item['name'] == $b) {
                            foreach ($c as $d) {
                                // print("<pre>" . print_r($d, true) . "</pre>"); exit;
                                $simpan1[] = $d['data'];
                            }
                        }
                    }
                    if ($item['menu_url'] != null) {
                        $urlex = explode('&', $item['menu_url']);
                        if (count($urlex) > 1) {
                            $simpan[] = $urlex[0];
                            $urlex[0] = null;
                            foreach ($urlex as $urlresult) {
                                $urlex3 = explode('=', $urlresult);
                                $simpan[$urlex3[0]] = $urlex3[1];
                            }

                            if (Yii::$app->user->can($item['name'])) {
                                $items[$last_id]["items"][$last_id2]["items"][] = ['label' => deleteFirstWord($item["menu_label"]), 'url' => $simpan, 'items' => $simpan1];
                                unset($simpan, $urlex, $urlex2, $urlex3);
                                $simpan1 = null;
                            }
                        } else
                            if (Yii::$app->user->can($item['name'])) {


                                $items[$last_id]["items"][$last_id2]["items"][] = ['label' => deleteFirstWord($item["menu_label"]), 'url' => [$item["menu_url"]], 'items' => $simpan1];
                                $simpan1 = null;
                            }
                        // $name[]= ['name'=>$item['name'],'no1'=> $last_id, 'no2'=> $last_id2, 'no3'=> $last_id3];
                        //     $last_id3++;
                    }
                }
            }
        };

        return $items;
    }

    /**
     * @desc Usermode User Login
     * @return array
     */
    public function getUsermode(){
        $usermodes = Yii::$app->InformationUser->info['usermode'];
        $usermode = [];
        foreach ($usermodes AS $key => $val){
            $usermode[] = $val->attributes;
        }
        return $usermode;
    }
}
