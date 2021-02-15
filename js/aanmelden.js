function bepaalSterkte() {
    var wachtwoord = $("#wachtwoord1").val();
    $.ajax({
        url: 'app/bepaalwachtwoordsterkte.php',
        data: {
            inp_wachtwoord: wachtwoord
            },
        type: 'post',
        success: function(data) {
            $("#wachtwoordsterkte").empty().append(data);
            if((data.match(/zeer sterk/g) || []).length){
                $("#submitbutton").empty().append("<button type='submit' class='btn btn-primary'>Aanmelden</button>")
            }
            },
        error: function(){
            alert("er gaat iets mis om de sterkte van het wachtwoord te bepalen!" + wachtwoord)
            }
    })
}

function test(){
    $("#exampleModal").show();
}