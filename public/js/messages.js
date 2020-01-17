setInterval(function(){ 

    $('#messages').ajax({
        url: '/canals/1',
        success: function(){
             alert('OK !');
        }
    }, 1000);
})