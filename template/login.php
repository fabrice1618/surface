<form action="/checklogin" class="px-4 py-3" method="post">
    <div class="form-group">
        <label for="exampleDropdownFormEmail1"> adresse e-mail :</label>
        <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com"
               name="user_email">
    </div>

    <div class="form-group">
        <label for="exampleDropdownFormPassword1">Mot de passe :</label>
        <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password"
               name="user_password">
    </div>

    <div class="form-group">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="dropdownCheck" name="autologin">
            <label class="form-check-label" for="dropdownCheck">Se souvenir de moi</label>
        </div>
    </div>

    <button type="submit" class="btn">Se connecter</button>
</form>
<div class="dropdown-divider"></div>
<a href="/inscription">Nouveau ici? Inscrivez - vous</a>
<a href="/forgotpasswd">Mot de passe oublié?</a>


​