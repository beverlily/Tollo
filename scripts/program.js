function initAll() {
    // get form elements
    var days = document.getElementById("n_Days");
    var daybox = document.getElementById("dayBox");
    var exbox = document.getElementById("exBox");

    //functions to generate fields relative to numbers desired
    // rebuild with components/custom elements? Ajax?

    function makeexrows() {
        var card = this.id;
        var num = card.replace(/[^0-9]/g,'');
        var thiscard = document.getElementById('exbox' + num);
        var numEx = this.value;

        $.ajax({
            type: "GET",
            url: "getexercisesforprograms.php",
            //dataType: "json",
            success: function(data) {
                let options = data;

                thiscard.innerHTML = '';

                for (let i = 0; i < numEx; i++) {
                    let r = '<div class="row" style="max-width: 18rem;">';
                    r += '<div class="card-body"><select class="form-control" name="exercise_id'+num+i+'">' + options + '</select>';
                    r += 'Sets: <input type="number" name="numSets'+num+i+'" id="n_Sets' + i +'" class="exers form-control" placeholder="1" />';
                    r += 'Reps: <input type="number" name="numReps'+num+i+'" id="n_Reps' + i +'" class="exers form-control" placeholder="1" /></div></div>';
                    r += '</div>';
                    thiscard.innerHTML += r;
                }

            }
        });
    }

    function makedays() {
        daybox.innerHTML = "";
        exbox.innerHTML = "";
        let d = days.value;
        for (let i = 1; i <= d; i++) {
            let c = '<div class="card bg-light mb-3" style="max-width: 18rem;"><div class="card-header">';
            c+= 'Day ' + i + ' Name: <input type="text" name="dayName' + i + '" class="form-control" /></div>';
            c+= '<div class="card-body">How many exercises? <input type="number" name="numEx'+i+'" id="n_Ex' + i +'" class="exers form-control" placeholder="1" /></div></div>';
            daybox.innerHTML += c;
            let r = '<div id="exbox' + i + '" class="card bg-light mb-3" style="max-width: 18rem;"></div>';
            exbox.innerHTML += r;
        } 

        let ex = document.getElementsByClassName("exers");

        for (let i = 0; i < ex.length; i++) {
            ex[i].addEventListener('change',makeexrows);
        }
    }

    //event listeners
    days.addEventListener('change',makedays);

}

window.onload = initAll;