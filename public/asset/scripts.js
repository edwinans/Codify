$(function() {
    $(".list1, .list2").sortable({
        connectWith: ".sortable"
    });
});

// recharge la page 
function reloadData(argument) {
    window.location.reload();
}

// retourne la solution fournis par l'utilisateur
function getArray() {
    var indexArray = [];
    var lis = document.getElementById("list2")
        .querySelectorAll('li');
    lis.forEach((item) => {
        indexArray.push(item.id);
    });
    return indexArray;
}

// Envoi les donnée post via une requete async. ajax
function postRequest() {
    var indexArray = getArray();
    //console.log(indexArray);
    $.ajax({
            type: 'POST',
            url: "/exercices/handleExercice",
            dataType: "json",
            data: {
                'indexArray': indexArray
            },
            statusCode: {
                301: function(responseObject, textStatus, errorThrown) {

                },
                302: function(responseObject, textStatus, errorThrown) {
                    //yor code goes here
                }
            },
            success: function(data1) {
                //console.log(data1)
                //alert("envoyé avec succes!");
            }
        })
        .done(function(data) {
            var json = JSON.parse(data);
            console.log(data);

            var resultView = document.getElementById("result");
            if (json["result"] == 'f') {
                resultView.innerHTML = '<span id="result" class="card-title center red-text">Echec</span>';
            } else {
                resultView.innerHTML = '<span id="result" class="card-title center green-text">Succès</span>';
            }
        })
        .fail(function(jqXHR, textStatus) {
            alert('Something went wrong: ' + textStatus);
        })
        .always(function(jqXHR, textStatus) {
            //alert('Ajax request was finished')
        });
}