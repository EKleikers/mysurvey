//test log
console.log("takeanonymous.js -008");

var survey = new Survey.Model(surveyJSON, "surveyContainer");
//Use onComplete event to save the data
survey.onComplete.add(sendDataToServer);

function sendDataToServer() {
    console.log("takeanonymous.js sendDataToServer");
    $.ajax({
        url: "/mysurvey/saveanonymousresult",
        type: "POST",
        data: {datacontaininganswers: JSON.stringify(survey.data), numberofoursurvey: surveyid},
        dataType: "json",
        cache: false,
        success:function(data){
            //alert(data.success);
            // window.location.href = '../takeanonymousresults/'+ surveyid;
         }
    });
        $(document).ready(function() {
            console.log(JSON.stringify(survey.data));
    });
    
  }
