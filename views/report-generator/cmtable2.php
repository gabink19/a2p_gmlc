<?

use yii\helpers\Json;
use yii\web\View;
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/formatted-numbers.js"></script>




<table id="datatable_table<?= $id ?>" class="" style="width:100%">

</table>
<p id="<?= $id ?>_param2" style="display:none;position: absolute;left:10px;top:40px" class="value_select_style box_select"></p>
<style>
.box_select {
        position: absolute;
        border-style: solid;
        border-radius: 5px;
        width: 140px;
        height: auto;
        border-width: thin;
        background-color: rgba(0,255,0,0.9);
        border-color: green;
    }
    .value_select_style {

        font-size: 10px;
        position: absolute;
        left: 5px;
        top: 0px;
    }
</style>

<script>


    var datatable<?= $id ?> = null;
    var dataSet3<?= $id ?>=[];

    $(document).ready(function () {
        //  $.noConflict();

    });


    function cmtable2<?= $id ?>_hide(data, report, graph_idx, graphData) {


    }

    function cmtable2<?= $id ?>(data, report, graph_idx, graphData) {
        sessionRec=sessionMap[0];
        option = <?= Json::encode($options) ?>;
        dataSet3<?= $id ?> = [];
        for (let i2 = 1; i2 < data.length; i2++) {
            rec = data[i2];
            dataSet4 = [];

            dataSet4.push("");

            ;
            key_len = report.key.length;
            for (let i3 = 0; i3 < rec.length; i3++) {

                field = rec[i3];
                data_type = "";
                if (i3 < key_len) {
                    data_type = report.key[i3].data_type;
                } else {
                    data_type = report.field[i3 - key_len].data_type;
                }
                ;

                if (data_type == "date") {
                    d = new Date(field);
                    dformat = [d.getFullYear(),
                        (d.getMonth() + 1).toString().padStart(2, '0'),
                        d.getDate().toString().padStart(2, '0')
                    ].join('/');
                    dataSet4.push(dformat);
                } else if ((data_type == "datetime") || (data_type == "5n") || (data_type == "15n") || (data_type == "30n") || (data_type == "1h")) {
                    d = new Date(field);
                    dformat = [d.getFullYear(),
                        (d.getMonth() + 1).toString().padStart(2, '0'),
                        d.getDate().toString().padStart(2, '0')
                    ].join('/') + ' ' +
                            [d.getHours().toString().padStart(2, '0'),
                                d.getMinutes().toString().padStart(2, '0'),
                                d.getSeconds().toString().padStart(2, '0')].join(':');
                    dataSet4.push(dformat);
                } else {
                    /*if (field==null){
                     dataSet4.push("");
                     } else {*/
                    dataSet4.push(field);
                    //}
                }
            }
            dataSet3<?= $id ?>.push(dataSet4);

        }
        console.log("[" + graph_idx + ":CMTable]", dataSet3<?= $id ?>);

        if (datatable<?= $id ?> == null) {

            var element = document.getElementById('datatable_table<?= $id ?>');
            if (option.table_class != null) {
                option_table_class = option.table_class.split(" ");
                for (let i2 = 0; i2 < option_table_class.length; i2++) {
                    element.classList.add(option_table_class[i2]);
                }
            } else {
                element.classList.add("display");
                element.classList.add("compact");
            }
            counter = 0;
            target = [];
            columns = [];

            //option.searchDelay=3000;

            columns.push({title: "no"});
            target.push(counter);
            counter++;


            header = data[0];
            /*
             
             for (let i2 = 0; i2 < header.length; i2++) {
             field = header[i2];
             if (typeof field === 'object') {
             columns.push({title: field.label});
             } else {
             columns.push({title: field});
             }
             }*/

            for (let i2 = 0; i2 < report.key.length; i2++) {
                field = header[i2];
                if (typeof field === 'object') {
                    columns.push({title: field.label});
                } else {
                    columns.push({title: field});
                }
                counter++;

            }
            for (let i2 = 0; i2 < report.field.length; i2++) {

                field = header[report.key.length + i2];
                if (typeof field === 'object') {
                    columns.push({title: field.label});
                } else {
                    columns.push({title: field});
                }
                target.push(counter);
                counter++;
            }
            if (option == null)
                option = {};
            console.log("[" + graph_idx + ":CMTable] target:", target);
            //option.data= dataSet3;
            option.columns = columns;
            //option.deferLoading= 0;
            option.processing = true;
            option.serverSide = true;
            console.log("res: init")
            option.ajax = {
                
        
                //url: "https://icloud.icode.id/index.php?r=report-generator%2Fget-data-report3&folder=test_bulk_data.json&report_name=0&datatableflag=1",
                url: "<?= $url."&filter_where=".urlencode($filter_where)."&add_where2=".urlencode($andWhere) ?>&datatableflag=1",
                type: "POST",
                dataSrc: function (json) {
                    console.log("[" + graph_idx + ":CMTable] res:", json)
                    save_response = json.data;

                    refreshData(save_response,sessionRec);
                    console.log("[" + graph_idx + ":CMTable] res2:", dataSet3<?= $id ?>)
                    return dataSet3<?= $id ?>;
                    //return json.data;
                }
            };

            option.columnDefs = [{
                    "searchable": false,
                    "orderable": false,
                    "targets": target
                }
            ];
            option.order = [[1, 'asc']];


            console.log("[" + graph_idx + ":CMTable]", option);
            /*
             datatable<?= $id ?>=$('#datatable_table<?= $id ?>').DataTable({data: dataSet3,
             columns: columns,
             dom: 'Blfrtip',
             buttons: [
             'copy', 'csv', 'excel', 'pdf', 'print'
             ],
             "columnDefs": [ {
             "searchable": false,
             "orderable": false,
             "targets": 0
             } ],
             "order": [[ 1, 'asc' ]]
             });*/
            datatable<?= $id ?> = $('#datatable_table<?= $id ?>').DataTable(option);
            
            $('#datatable_table<?=$id?>').on( 'click', 'tr', function () {
                console.log("[" + graph_idx + ":CMTable]" , datatable<?=$id?>.row( this ).data() );
                if (graphData[graph_idx].selection_flag == 1) {
                    
                        add_pos=1;
                        
                        
                        data_label = "<b>filter:</b><br>";
                        selected_value = "";
                        value_chart = datatable<?=$id?>.row( this ).data();
                        for (let i2 = 0; i2 < report.key.length; i2++) {
                            data_type = report.key[i2].data_type;
                            if (selected_value != "") {
                                selected_value = selected_value + "{B4t45}";
                            }

                            if ((data_type == "datetime") || (data_type == "5n") || (data_type == "15n") || (data_type == "30n") || (data_type == "1h") || (data_type == "date")) {

                                var_d = new Date(value_chart[i2+add_pos]);
                                data_label = data_label + var_d + "-";

                                selected_value = selected_value + var_d;
                            } else {
                                data_label = data_label + value_chart[i2+add_pos] + "-";
                                selected_value = selected_value + value_chart[i2+add_pos];
                            }
                        }
                        
                        document.getElementById("<?= $id ?>_param2").style.display = "block";
                                    document.getElementById("<?= $id ?>_param2").innerHTML = data_label;
                        graphData[graph_idx].selected_value = selected_value;
                        console.log("[" + graph_idx + ":CMTable] selected:" , selected_value );
                        setTimeout(function () {
                            execSelect(sessionRec);
                        }, 1000);
                   
                }
                
            } );

            datatable<?= $id ?>.on('draw.dt', function () {
                var PageInfo = $('#datatable_table<?= $id ?>').DataTable().page.info();
                datatable<?= $id ?>.column(0, {page: 'current'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                    datatable<?=$id?>.cell(cell).invalidate('dom');
                });
            });

        } else {
            //datatable<?= $id ?>.clear().rows.add(dataSet3).draw();
        }



    }

    document.getElementById("<?= $id ?>_param2").addEventListener("click", function () {
        sessionRec=sessionMap[0];
        console.log("[<?= $id ?>:SELECT] select* click");
        document.getElementById("<?= $id ?>_param2").style.display = "none";
        sessionRec.graphData[<?= $idx ?>].selected_value = null;
        setTimeout(function () {
            execSelect(sessionRec);

        }, 1000);


    });
</script>


<?
$js = "$.noConflict();";
$this->registerJs($js);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js', ['position' => View::POS_HEAD]);
?>
