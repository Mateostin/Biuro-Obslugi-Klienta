$(function () {
    getConversation();
});

function getConversation() {

        var userid = $("input[type=text][name=userId]").val();

        $.ajax({
            dataType: "json",
            url: "../api/Conversation.php",
            data: {clientId: userid}
        }).done(function (data) {

            var table = $('.subject-conversation').find('tr');
            var tr = $('<tr></tr>');
            var td = $('<td></td>');
            console.log(table)

            $.each(data, function (key, value) {

                table.after(tr)
                tr.append(td)
                td.text(value)
            });
        });
}