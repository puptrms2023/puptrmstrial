const inputElements = document.querySelectorAll("input[type='text']");
const selectYear = document.getElementById("selectYear");

inputElements.forEach(inputElement => {
    inputElement.addEventListener("input", displayResult);
});

selectYear.addEventListener("change", displayResult);

function displayResult() {
    var gwa1 = parseFloat($("#gwa").val());
    var gwa2 = parseFloat($("#gwa1").val());

    if (!isNaN(gwa1) && !isNaN(gwa2) && gwa1 > 0 && gwa2 > 0) {
        const average = (gwa1 + gwa2)/2;
        const averageWithTwoDecimals = parseFloat(average.toFixed(3));

        document.getElementById("avg").innerHTML = averageWithTwoDecimals;

        if(selectYear.value == '1st Year')
        {
            if (average <= 1.75) {
                document.getElementById("result").innerHTML = "ACHIEVERS AWARD";
            }
            else {
                document.getElementById("result").innerHTML = "NOT ELIGIBLE";
            }
        }
        else
        {
            if (average >= 1.00 && average <= 1.50) {
                document.getElementById("result").innerHTML = "PRESIDENT'S LISTERS";
            }
            else if (average > 1.50 && average <= 1.75) {
                document.getElementById("result").innerHTML = "DEAN'S LISTERS";
            }
            else {
                document.getElementById("result").innerHTML = "NOT ELIGIBLE";
            }
        }
    }
}
