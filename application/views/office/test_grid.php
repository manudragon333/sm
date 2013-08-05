<?if($_SERVER['HTTPS']!="on")
  {
     $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     header("Location:$redirect");
  }
?>
<div class="jqgrid_wrap">
            <table id="grid_table"></table>
            <div id="grid_pager"></div>
</div>
<script type="text/javascript" rel="javascript">
          // payment_grid();
        </script>