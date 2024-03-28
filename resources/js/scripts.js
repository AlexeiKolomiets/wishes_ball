$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#question").on('input', function () {
    const regex = new RegExp("");
    if ($("#question").val().match(/[,\p{L}\d\s\p{S}\p{P}]+\?$/iu)) {
        $("button#btn-question").css("display", "block");
    }
    else {
        if ($("button#btn-question").length) {
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
            if (data.errors) {
                console.log(data.errors);
            }
            else {
                var answer = data.answer;
                var user_count = data.user_count;
                var others_count = data.others_count;
                var user_count_response = "";
                var others_count_response = "";

                if (answer == "Сконцентрируйся и спроси опять") {
                    $("#response").css('font-size', '14px');
                }
                else {
                    $("#response").css('font-size', '24px');
                }

                $("#response").html(answer);
                $(".counts").empty();

                user_count_response = "<p>Ты задавал этот вопрос " + user_count + " " + endOfPhrase(user_count) + "</p>";
                others_count_response = "<p>Другие посетители задавали этот вопрос " + others_count + " " + endOfPhrase(others_count) + "</p>";

                $(".counts").append(user_count_response);
                $(".counts").append(others_count_response);
            }
        },
        error: function (e) {
            console.log(e);
        },
    });
});

function endOfPhrase(count) {
    var count_last_symbol = count.toString().slice(-1);
    var endOfPhrase = "";

    if (count_last_symbol == "2" || count_last_symbol == "3" || count_last_symbol == "4") {
        if (count != "12" && count != "13" && count != "14") {
            endOfPhrase = "раза";
        }
        else {
            endOfPhrase = "раз";
        }
    }
    else {
        endOfPhrase = "раз";
    }

    return endOfPhrase;
};

$(document).ready(function () {
    if ($("#welcome").length) {
        $("#welcome").fadeIn(1000);

        setTimeout(timeup, 3000);
        function timeup() {
            $("#welcome").fadeOut(1000, function () {
                $("#welcome").html("Представься");
                $("#welcome").fadeIn(1000);
            });
        };
    };
});