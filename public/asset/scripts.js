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

    $.ajax({
            type: 'POST',
            url: '/asset/backend.php',
            data: {
                'indexArray': indexArray
            },
            statusCode: {
                301: function(responseObject, textStatus, errorThrown) {
                    //yor code goes here
                },
                302: function(responseObject, textStatus, errorThrown) {
                    //yor code goes here
                }
            }
        })
        .done(function(data) {
            // data est sous le format json
            var json = JSON.parse(data);
            var resultView = document.getElementById("result");
            if (json["result"] == "f") {
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