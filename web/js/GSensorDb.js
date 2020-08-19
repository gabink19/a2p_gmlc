
function init_detailview() {
    
    $varVal=$("#ttransaksiservicesdetail-g_inventory_gi_id").val();
    $.ajax({
       url: '/index.php?r=t-transaksi-services-detail%2Fg-inventory-name&id='+$varVal,
       success: function (data) {
          $('[id="ttransaksiservicesdetail-uom"]').text(data.results.text);
              
       }
    });
}
   