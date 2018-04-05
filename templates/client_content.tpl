<div class="row" id="content">
    <div class="col-md-4 colHeight">
        <div class="page-header">
            <h3>Wątki</h3>
        </div>
        <div>
            <table class="table subject-conversation">
                <tr>
                    <th>Temat</th>
                </tr>
                {{conversations}}
            </table>
        </div>
    </div>
    <div class="col-md-8 colHeight">
        <div class="page-header">
            <h3>Chat</h3>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th>Nadawca</th>
                    <th>Wiadomość</th>
                </tr>
                {{messages}}
            </table>
        </div>
    </div>
</div>
<div class="page-header">
    <h3>Odpowiedz</h3>
</div>
<div class="row">
    <div class="col-md-4">
        <form class="form-inline" method="post" action="../controllers/MessageController.php">
            <input type="hidden" name="conversationId" value="{{conversationID}}">
            <label for="conversationReply" id="newConvText">Wiadomość: <input id="conversationReply" type="text" name="conversationReply" placeholder="Wiadomość..."></label>
            <br>
            <button class="btn">Dodaj...</button>
        </form>
    </div>
</div>

<div class="page-header">
    <h3>Nowa Konwersacja</h3>
</div>
<div class="row">
    <div class="col-md-4">
        <form class="form-inline" method="post" action="../controllers/ConversationController.php">
            <label for="conversationSubject" id="newConvSubject">Temat: <input id="conversationSubject" type="text" name="conversationSubject" placeholder="Temat..."></label>
            <label for="conversationText" id="newConvText">Wiadomość: <input id="conversationText" type="text" name="conversationText" placeholder="Wiadomość..."></label>
            <br>
            <button class="btn">Dodaj...</button>
        </form>
    </div>
</div>
<br>
<br>
<br>