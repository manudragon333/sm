$(function(){
   $('#email_attach').uploadify({
            'uploader'  : base_url+'/uploadify/uploadify.swf',
            'script'    : base_url+'/uploadify/uploadify.php',
            'cancelImg' : base_url+'/uploadify/cancel.png',
            'folder'    : '/uploads',
            'auto'      : true,
            'multi'     : false,
            'fileExt'   : '*.jpg;*.png;*.gif;*.pdf;*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx',
            'fileDesc'    : 'Image/Office Files',
            'sizeLimit'   : 1100000,
            'removeCompleted' : false,
            'onComplete'  : function(event, ID, fileObj, response, data) {
                // console.log(fileObj); console.log(data); console.log(event); console.log(ID)
                $('#file_name').val(response);
                $('#file_type').val(fileObj.type);
                $('#file_size').val(fileObj.size);
            }
    });
});

/************************************************/