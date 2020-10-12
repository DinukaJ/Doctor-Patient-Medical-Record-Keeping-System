//Adding data to the database
$('#medAddForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data: $('#medAddForm').serialize()+"&type=addMed",
        success:function(data){
            close(modalAddMed);
            getAllMed();
        }
    });
});