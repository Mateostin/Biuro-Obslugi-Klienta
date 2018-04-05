<div class="row" id="content">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Załóż konto</h2>
        </div>
        <form class="form-inline" action="" method="POST">
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" class="form-control" id="login" name="login">
            </div>
            <div class="form-group">
                <label for="pwd">Hasło:</label>
                <input type="password" class="form-control" id="pwd" name="password">
            </div>
            <div class="form-group">
                <select name="role">
                    <option value="Client" selected>Client</option>
                    <option value="Support">Support</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Załóż konto</button>
        </form>
    </div>
</div>

<script src="../js/login.js"></script>