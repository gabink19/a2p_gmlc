<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;

$session = Yii::$app->session;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $items=[];
            if (Yii::$app->user->isGuest){}else {
            $result = Yii::$app->db->createCommand("select  name,menu1,menu2,menu_label,menu_url,perent from auth_item where type=3 order by menu1,menu2,menu_label,perent;")
                ->queryAll();
//                print("<pre>" . print_r($result, true) . "</pre>");
// exit; 
            $last_menu="";
            $last_id=-1;
            $last_menu2="";
            $last_id2=-1;
            function deleteFirstWord($menu) {
                $res=strstr($menu,'.');
                if ($res==""){
                    return $menu;
                  } else { 
                      return substr($res,1);
                  }
            }
                // $menu = array(
                //     array(
                //         'Menu_IDX' => '1',
                //         'Order' => '1',
                //         'Name' => 'History',
                //         'Parent' => '',
                //         'Path' => 'History',
                //         'Link' => '',
                //     ),
                //     array(
                //         'Menu_IDX' => '2',
                //         'Order' => '25',
                //         'Name' => 'Review',
                //         'Parent' => '',
                //         'Path' => 'Review',
                //         'Link' => 'Review',
                //     ),
                //     array(
                //         'Menu_IDX' => '3',
                //         'Order' => '35',
                //         'Name' => 'Past Medical History',
                //         'Parent' => '',
                //         'Path' => 'Past Medical History',
                //         'Link' => 'Past Medical History',
                //     ),
                //     array(
                //         'Menu_IDX' => '4',
                //         'Order' => '45',
                //         'Name' => 'Item 1',
                //         'Parent' => '0',
                //         'Path' => 'Item 1',
                //         'Link' => 'Item 1',
                //     ),
                //     array(
                //         'Menu_IDX' => '5',
                //         'Order' => '55',
                //         'Name' => 'Item 2',
                //         'Parent' => '0',
                //         'Path' => 'Item 2',
                //         'Link' => 'Item 2',
                //     ),
                //     array(
                //         'Menu_IDX' => '6',
                //         'Order' => '65',
                //         'Name' => 'Item 3',
                //         'Parent' => '0',
                //         'Path' => 'Item 3',
                //         'Link' => 'Item 3',
                //     ),
                //     array(
                //         'Menu_IDX' => '7',
                //         'Order' => '65',
                //         'Name' => 'Item 31',
                //         'Parent' => '5',
                //         'Path' => 'Item 31',
                //         'Link' => 'Item 31',
                //     )
                // );

                // function prepareMenu($array)
                // {
                //     $return = array();
                //     //1
                //     krsort($array);
                //     foreach ($array as $k => &$item) {
                //         if (is_numeric($item['parent'])) {
                //             $parent = $item['parent'];
                //             if (empty($array[$parent]['Childs'])) {
                //                 $array[$parent]['Childs'] = array();
                //             }
                //             //2
                //             array_unshift($array[$parent]['Childs'], $item);
                //             unset($array[$k]);
                //         }
                //     }
                //     //3
                //     ksort($array);
                //     return $array;
                // }
                // function buildMenu($array)
                // {
                //     echo '<ul>';
                //     foreach ($array as $item) {
                //         echo '<li>';
                //         echo $item['name'];
                //         if (!empty($item['Childs'])) {
                //             buildMenu($item['Childs']);
                //         }
                //         echo '</li>';
                //     }
                //     echo '</ul>';
                // }

                // $menu = prepareMenu($result);
                // // buildMenu($menu);
                // print("<pre>" . print_r(buildMenu($menu), true) . "</pre>");
                //                 exit;
                foreach ($result as $item) {
                    if ($menu1 != "hidden") {
                    if($item['perent']!=null){
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
                                
                            } else{
                            if (Yii::$app->user->can($item['name'])) {
                                $isi = ['data' => ['name'=> $item['name'],'label' => deleteFirstWord($item["menu_label"]), 'url' => [$item["menu_url"]], 'items' => []]];
                                if ($a[$item['perent']]==null){
                                    $a[$item['perent']] = [$isi];
                                }
                                else {
                                    array_push($a[$item['perent']], $isi); 
                                }
                                
                                // print("<pre>" . print_r($a, true) . "</pre>");
                                // exit;
                            }
                        }
                    } 
                }
            }
            $a = array_reverse($a);
                $child = $a;
                // print("<pre>" . print_r(array_reverse($child), true) . "</pre>");
                //                 exit;
                
            foreach ($a as $b => $c){
                $nama_perent=$b;
                foreach ($a as $x => $y){
                    foreach ($y as $z => $w){
                            // print("<pre>" . print_r($z['data']['name'], true) . "</pre>");
                            // exit;
                        if ($w['data']['name']==$nama_perent){
                                // print("<pre>" . print_r($z['data']['name'], true) . "</pre>");
                                // exit;
                                foreach ($c as $d => $e){
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
                // print("<pre>" . print_r($child, true) . "</pre>");
                // exit;
            foreach($result as $item){
                /*
                print_r($item);
                echo "<br>";
                echo $item["menu1"].'<br>';*/
                $menu1=$item["menu1"];
                if ($menu1!="hidden" ) {
                    if ($last_menu!=$menu1) {
                        $items[]=['label' => deleteFirstWord($menu1) , 'items'=>[]];
                        $last_id++;
                        $last_id2=-1;
                        $last_menu=$menu1;
                        $last_menu2="";
                    };
                    $menu2=$item["menu2"];
                    if ($last_menu2!=$menu2) {
                        $items[$last_id]["items"][]=['label' =>deleteFirstWord($menu2), 'items'=>[]];
                        $last_id2++;
                        $last_menu2=$menu2;
                        $last_id3=0;
                    };

                    if ($item['perent']==null){
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
        }

            //print_r($items);
            //exit();   
            $pic= $session["picture"] != null ? '<img src="' . $session['picture'] . '" alt="Avatar" style="width:25px;border-radius: 50%"/>' : '';
            $items[]=Yii::$app->user->isGuest ? (
                                ['label' => 'Login', 'url' => ['/site/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                '<span class="glyphicon glyphicon-log-out"> </span>' . 'Logout (' . Yii::$app->user->identity->username . ')'.$pic, ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                            );
//             print("<pre>" . print_r($items, true) . "</pre>");
// exit;

                /*print_r($items);
                echo "<br>";
                */
                /*
                $items=[
                
                        [
                        'label' => 'Config',
                        'items' => [
                                [
                                'label' => 'General',
                                'items' => [
                                    ['label' => 'rumah sakit type', 'url' => ['f-rumah-sakit-type/']],
                                    ['label' => 'jenis dokter', 'url' => ['f-jenis-dokter/']],
                                    ['label' => 'pasien type', 'url' => ['f-pasien-type/']],
                                    ['label' => 'peralatan non medis', 'url' => ['f-peralatan-non-medis/']],
                                ],
                            ],
                                
                               
                                
                        ],
                        ]
                    ];
                print_r($items);
                echo "<br>";*/
                
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
                
                /*'items' => [
                
                        [
                        'label' => 'Config',
                        'items' => [
                                [
                                'label' => 'General',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\FRumahSakitTypeController') ? (['label' => 'rumah sakit type', 'url' => ['f-rumah-sakit-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FJenisDokterController') ? (['label' => 'jenis dokter', 'url' => ['f-jenis-dokter/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FPasienTypeController') ? (['label' => 'pasien type', 'url' => ['f-pasien-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FPeralatanNonMedisController') ? (['label' => 'peralatan non medis', 'url' => ['f-peralatan-non-medis/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Apotik',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\FApotekerTypeController') ? (['label' => 'apoteker type', 'url' => ['f-apoteker-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FApotikTypeController') ? (['label' => 'apotik type', 'url' => ['f-apotik-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FJenisStokMedisController') ? (['label' => 'jenis stok media', 'url' => ['f-jenis-stok-medis/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Pemeriksaan Penunjang',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\FPemeriksaanPenunjangTypeController') ? (['label' => 'pemeriksaan penunjang type', 'url' => ['f-pemeriksaan-penunjang-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FPpPemeriksaanTypeController') ? (['label' => 'pemeriksaan type', 'url' => ['f-pp-pemeriksaan-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FPemeriksaanPenunjangSubTypeController') ? (['label' => 'Pemeriksaan Penunjang SubType Controller', 'url' => ['f-pemeriksaan-penunjang-sub-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FPpPeralatanTypeController') ? (['label' => 'peralatan type', 'url' => ['f-pp-peralatan-type/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Rawat jalan',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\FRuangPraktekTypeController') ? (['label' => 'ruang praktek type', 'url' => ['f-ruang-praktek-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FTindakanPeralatanTypeController') ? (['label' => 'tindakan peralatan type', 'url' => ['f-tindakan-peralatan-type/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Rawat inap',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\FKamarTypeController') ? (['label' => 'room type', 'url' => ['f-kamar-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FAlatRawatInapController') ? (['label' => 'alat rawat inap', 'url' => ['f-alat-rawat-inap/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FAsuhanGiziTypeController') ? (['label' => 'asuhan gizi type', 'url' => ['f-asuhan-gizi-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FAsuhanKeperawatanType') ? (['label' => 'asuhan keperawatan type', 'url' => ['f-asuhan-keperawatan-type/']]) : (''),
                                    Yii::$app->user->can('app\controllers\FNonMedisTypeController') ? (['label' => 'non medis type', 'url' => ['f-non-medis-type/']]) : (''),
                                ],
                            ],
                        ],
                    ],
                        [
                        'label' => 'Global',
                        'items' => [
                                [
                                'label' => 'General',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\GRumahSakitController') ? (['label' => 'RumahSakit', 'url' => ['g-rumah-sakit/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GDokterController') ? (['label' => 'Dokter', 'url' => ['g-dokter/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GPasienController') ? (['label' => 'Pasien', 'url' => ['g-pasien/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GPeralatanNonMedisController') ? (['label' => 'Peralatan NonMedis', 'url' => ['g-peralatan-non-medis/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Apotik',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\GApotekerController') ? (['label' => 'Apoteker', 'url' => ['g-apoteker/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GsStokMedisController') ? (['label' => 'stok-medis', 'url' => ['gs-stok-medis/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Pemeriksaan Penunjang',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\GPpPeralatanController') ? (['label' => 'Pp Peralatan', 'url' => ['g-pp-peralatan/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GsPpPemeriksaanController') ? (['label' => 'Pp Pemeriksaan', 'url' => ['gs-pp-pemeriksaan/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Rawat jalan',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\GsTindakanPeralatanController') ? (['label' => 'Tindakan Peralatan', 'url' => ['gs-tindakan-peralatan/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Rawat inap',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\GsAlatRawatInapController') ? (['label' => 'alat rawat inap', 'url' => ['gs-alat-rawat-inap/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GsAsuhanGiziController') ? (['label' => 'asuhan gizi', 'url' => ['gs-asuhan-gizi/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GsAsuhanKeperawatanController') ? (['label' => 'asuhan keperawatan', 'url' => ['gs-asuhan-keperawatan/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GsTransaksiNonMedisController') ? (['label' => 'transksi no medis', 'url' => ['gs-transaksi-non-medis/']]) : (''),
                                ],
                            ],
                        ],
                    ],
                        [
                        'label' => 'Rumah Sakit',
                        'items' => [
                                [
                                'label' => 'General',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\RsApotikController') ? (['label' => 'apotik', 'url' => ['rs-apotik/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RsKamarController') ? (['label' => 'kamar', 'url' => ['rs-kamar/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RsDokterController') ? (['label' => 'dokter', 'url' => ['rs-dokter/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RsPasienController') ? (['label' => 'pasien', 'url' => ['rs-pasien/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RsPemeriksaanPenunjangController') ? (['label' => 'pemeriksaan penunjang', 'url' => ['rs-pemeriksaan-penunjang/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RsRuangPraktekController') ? (['label' => 'ruang praktek', 'url' => ['rs-ruang-praktek/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Apotik',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\ApApotekerController') ? (['label' => 'Apoteker', 'url' => ['ap-apoteker/']]) : (''),
                                    Yii::$app->user->can('app\controllers\ApsStokMedisController') ? (['label' => 'stok medis', 'url' => ['aps-stok-medis/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Pemeriksaan Penunjang',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\PpCapPeralatanController') ? (['label' => 'Cap Peralatan', 'url' => ['pp-cap-peralatan/']]) : (''),
                                    Yii::$app->user->can('app\controllers\PpsCapPemeriksaanController') ? (['label' => 'Cap Pemeriksaan', 'url' => ['pps-cap-pemeriksaan/']]) : (''),
                                    Yii::$app->user->can('app\controllers\GPpPemeriksaanSubTypeController') ? (['label' => 'Pp Pemeriksaan Sub Type', 'url' => ['g-pp-pemeriksaan-sub-type/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Rawat jalan',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\RssTindakanPeralatanController') ? (['label' => 'Tindakan Peralatan', 'url' => ['rss-tindakan-peralatan/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Rawat inap',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\RssAlatRawatInapController') ? (['label' => 'Alat Rawat Inap', 'url' => ['rss-alat-rawat-inap/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RssAsuhanGiziController') ? (['label' => 'Asuhan Gizi', 'url' => ['rss-asuhan-gizi/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RssAsuhanKeperawatanController') ? (['label' => 'Asuhan Keperawatan', 'url' => ['rss-asuhan-keperawatan/']]) : (''),
                                    Yii::$app->user->can('app\controllers\RssTransaksiNonMedisController') ? (['label' => 'Transaksi Non Medis', 'url' => ['rss-transaksi-non-medis/']]) : (''),
                                ],
                            ],
                        ],
                    ],
                        [
                        'label' => 'Transksi',
                        'items' => [
                                [
                                'label' => 'General',
                                'items' => [
                                ],
                            ],
                                [
                                'label' => 'Transaksi Apotik',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\TTransaksiApotikController') ? (['label' => 'Transaksi Apotik', 'url' => ['t-transaksi-apotik/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Transaksi Pemeriksaan Penunjang',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\TTransaksiPpController') ? (['label' => 'Transksi Pemeriksaan Penunjang', 'url' => ['t-transaksi-pp/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Transaksi Rawat jalan',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\TTransaksiController') ? (['label' => 'Transaksi', 'url' => ['t-transaksi/']]) : (''),
                                ],
                            ],
                                [
                                'label' => 'Transaksi Rawat inap',
                                'items' => [
                                    Yii::$app->user->can('app\controllers\TTransksiRawatInapController') ? (['label' => 'Transksi Rawat Inap', 'url' => ['t-transksi-rawat-inap/']]) : (''),
                                ],
                            ],
                        ],
                    ],
                        [
                        'label' => 'Payment',
                        'items' => [
                            Yii::$app->user->can('app\controllers\PayPembayaranController') ? (['label' => 'Pembayaran', 'url' => ['pay-pembayaran/']]) : (''),
                        ],
                    ],
                        [
                        'label' => 'Maint',
                        'items' => [
                        ],
                    ],
                        [
                        'label' => 'Book',
                        'items' => [
                        ],
                    ],
                        [
                        'label' => 'Acct/Report',
                        'items' => [
                                [
                                'label' => 'Accounting',
                                'items' => [
                                ],
                            ],
                                [
                                'label' => 'Pajak',
                                'items' => [
                                ],
                            ],
                                [
                                'label' => 'Report',
                                'items' => [
                                ],
                            ],
                        ],
                    ],
                        [
                        'label' => 'User',
                        'items' => [
                            Yii::$app->user->can('app\controllers\AuthAssignmentController') ? (['label' => 'Auth Assign', 'url' => ['auth-assignment/']]) : (''),
                            Yii::$app->user->can('app\controllers\AuthItemController') ? (['label' => 'Auth Item', 'url' => ['auth-item/']]) : (''),
                            Yii::$app->user->can('app\controllers\AuthItemChildController') ? (['label' => 'Auth Item Detail', 'url' => ['auth-item-child/']]) : (''),
                        ],
                    ],
                        [
                        'label' => 'About',
                        'items' => [
                                ['label' => 'About', 'url' => ['/site/about']],
                                ['label' => 'Contact', 'url' => ['/site/contact']],
                        ],
                    ],
                    Yii::$app->user->isGuest ? (
                                ['label' => 'Login', 'url' => ['/site/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                ],*/
            ]);
            NavBar::end();
            ?>

            <div class="container">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= Alert::widget() ?>
            <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

            <?php $this->endBody() ?>
    </body>
</html>
            <?php $this->endPage() ?>


