$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#question").on('input',function(){
 const regex = new RegExp("");
 if($("#question").val().match(/^(?=.*[A-ZА-Я0-9])[\w.,\s]+\?$/i)){
    $("button#btn-question").css("display", "block");
 }
 else{
    if($("button#btn-question").length){
        $("button#btn-question").css("display", "none");
    }
 }
});

$("#btn-question").click(function (e) {
    e.preventDefault();

    var question = $("#question").val();

    $.ajax({
        type: 'POST',
        url: "/",
        dataType: 'json',
        data: { question: question },
        success: function (data) {
            if(data.errors){
                console.log(data.errors);
            }
            else{
            var answer = data.answer;
            var user_count = data.user_count;
            var others_count = data.others_count;
            var user_count_response = "";
            var others_count_response = "";
            var user_count_last_symbol = user_count.toString().slice(-1);
            var others_count_last_symbol = others_count.toString().slice(-1);

            if (answer == "Сконцентрируйся и спроси опять.") {
                $("#response").css('font-size', '14px');
            }
            else {
                $("#response").css('font-size', '24px');
            }
            $("#response").html(answer);

            $(".counts").empty();
            if(user_count_last_symbol == "2" || user_count_last_symbol == "3" || user_count_last_symbol == "4"){
                if(user_count != "12" && user_count != "13" && user_count != "14"){
                    user_count_response = "<p>Ты задавал этот вопрос " + user_count  + " раза</p>";
                }
                else{
                    user_count_response = "<p>Ты задавал этот вопрос " + user_count  + " раз</p>";
                }
            }
            else{
                user_count_response = "<p>Ты задавал этот вопрос " + user_count  + " раз</p>";
            }

            if(others_count_last_symbol == "2" || others_count_last_symbol == "3" || others_count_last_symbol == "4"){
                if(others_count != "12" && others_count != "13" && others_count != "14"){
                    others_count_response = "<p>Другие посетители задавали этот вопрос " + others_count  + " раза</p>";
                }
                else{
                    others_count_response = "<p>Другие посетители задавали этот вопрос " + others_count  + " раз</p>";
                }
            }
            else{
                others_count_response = "<p>Другие посетители задавали этот вопрос " + others_count  + " раз</p>";
            }
            
            $(".counts").append(user_count_response);
            $(".counts").append(others_count_response);
            }
        },
        error: function (e) {
            console.log(e);
        },

    });
});
$(document).ready(function () {
    if($("#welcome").length){
        $("#welcome").fadeIn(1000);

        setTimeout(timeup, 3000);
        function timeup(){
            $("#welcome").fadeOut(1000, function(){
                $("#welcome").html("Представься");
                $("#welcome").fadeIn(1000);
            });
            
        };

        
    };
    
});