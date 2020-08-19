<?php
/* @var $this yii\web\View */
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@0.6.4/dist/gridstack.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gridstack@0.6.4/dist/gridstack.all.js"></script>

<div class="grid-stack">
  <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="4" data-gs-height="2">
    <div class="grid-stack-item-content">my first widget</div>
  </div>
  <div class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="4" data-gs-height="4">
    <div class="grid-stack-item-content">another widget!</div>
   
  </div>
</div>

<script type="text/javascript">
  $('.grid-stack').gridstack();
</script>

