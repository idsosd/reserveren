var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

function bewerkReservering(resid){
    $.ajax({
        url: 'app/haalreserveringop.php',
        data: {
            inp_reservid: resid
        },
        dataType: 'json',
        type: 'post',
        success: function(data) {
            myModal.show();
            $("#exampleModalLabel").empty().append("Bewerk reservering met nr " + resid);
            $("#myModal-body").empty().append(data);
        },
        error: function(){
            alert("er gaat iets mis met het laden van de reservering")
        }
    })
}