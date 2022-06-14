let today = new Date().toISOString().slice(0, 10)
let previousDate;
document.getElementById('date').min = today
if(document.getElementById('date') == null){
    previousDate = today;
    document.getElementById('date').value = today;
    DateVal();
}
else {
    previousDate = document.getElementById('date').value;
    DateVal();
}

function DateVal(){
    document.getElementById('date').addEventListener('input', function(event){
        if(document.getElementById('date').value <= today){
            document.getElementById('date').value = previousDate;
        }
    })
}
