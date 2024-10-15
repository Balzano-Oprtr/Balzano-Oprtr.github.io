function showChart(sign){
    if(sign == "Income"){
        document.getElementById("chart_expense").style.display = "none";
        document.getElementById("chart_income").style.display = "block";
    }else{
        document.getElementById("chart_expense").style.display = "block";
        document.getElementById("chart_income").style.display = "none";
    }
}
   