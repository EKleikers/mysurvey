//test log
console.log("TAKE 26");

var survey = new Survey.Model(surveyJSON, "surveyContainer");
//Use onComplete event to save the data
survey.onComplete.add(sendDataToServer);

function sendDataToServer() {
    console.log("My Console");
    $.ajax({
        url: "/mysurvey/saveresult",
        type: "POST",
        data: {datacontaininganswers: JSON.stringify(survey.data), numberofoursurvey: surveyid},
        dataType: "json",
        cache: false,
        success:function(data){
            //alert(data.success);
            window.location.href = '../takesurveyresults/'+ surveyid;
         }
    });
        $(document).ready(function() {
    });
    
  }
