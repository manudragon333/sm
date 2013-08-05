
<input type="button" onclick="javascript:window.location='<?php echo site_url('admin/edit_items');  ?>';" name="" id="imageField" class=" m_t_b_10 button green  " value="+ Add Item " />

<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>

<script type="text/javascript" rel="javascript">
    $(function(){
        jQuery("#grid_table").jqGrid({
                url:site_url+'/admin/items_grid',
                datatype: "json",
                height:'auto',
                autowidth: true,
                mtype: 'POST',
                recordtext: "Viewing {0} - {1} of {2} Item(s)",
                pgtext : "Page {0} of {1}",
                colNames:['S.No','Name','Status','Edit'],
                colModel:[
                        {name:'id',index:'id', width:50},
                        {name:'name',index:'name', width:150},
                        {name:'status',index:'status', width:150},
                        {name:'edit',index:'edit', width:50, sortable:false, title:false}
                ],
                rowNum:10,
                rowList:[10,30,50,100],
                pager: '#grid_pager',
                sortname: 'name',
                viewrecords: true,
                sortorder: "asc",
                caption:"Calandar Items",
                loadtext:'Loading...'
        });
    });
    
    
</script>

<style type="text/css">
    .ui-jqgrid tr.jqgrow td {
        white-space: normal;
    }
</style>

