<div class="row" id="content">
    <div class="col-md-4 colHeight">
        <div class="page-header">
            <h3>Moje Wątki</h3>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th>Temat</th>
                </tr>
                {{conversations}}
            </table>
        </div>
    </div>
    <div class="col-md-4 colHeight">
        <div class="page-header">
            <h3>Otwarte wątki</h3>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th>Temat</th>
                    <th></th>
                </tr>
                {{openConversations}}
            </table>
        </div>
    </div>
    <div class="col-md-4 colHeight">
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

<script src="../js/deleteButton.js"></script>
<script src="../js/assertOpenConversation.js"></script>