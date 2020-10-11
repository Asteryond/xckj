function showScore(obj)
{
    $.ajax({
        async: false,
        type:"GET",
        url: "getRank.php?id=" + obj,
        success:function (msg){
            let scores = $.parseJSON(msg);
            $('#sp').empty().text(scores['sP']);
            $('#rp').empty().text(scores['rP']);
            $('#pp').empty().text(scores['pP']);
            $('#mp').empty().text(scores['mP']);
            $('#op').empty().text(scores['oP']);
        },
    });
}