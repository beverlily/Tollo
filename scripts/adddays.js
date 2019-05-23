function initAll() {
    var ex = document.getElementById("n_Ex");
    var exbox = document.getElementById("exBox");

    function makeexrows() {
        var numEx = this.value;

        $.ajax({
            type: "GET",
            url: "getexercisesforprograms.php",
            //dataType: "json",
            success: function(data) {
                let options = data;

                exbox.innerHTML = '';

                for (let i = 0; i < numEx; i++) {
                    let r = '<div class="row" style="max-width: 18rem;">';
                    r += '<div class="card-body"><select class="form-control" name="exercise_id'+i+'">' + options + '</select>';
                    r += 'Sets: <input type="number" name="numSets'+i+'" id="n_Sets' + i +'" class="exers form-control" placeholder="1" />';
                    r += 'Reps: <input type="number" name="numReps'+i+'" id="n_Reps' + i +'" class="exers form-control" placeholder="1" /></div></div>';
                    r += '</div>';
                    exbox.innerHTML += r;
                }

            }
        });
    }


    ex.addEventListener('change',makeexrows);
}

window.onload = initAll;