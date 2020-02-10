
    <?php

    include "template/htmlhead.php";
?>
  <body>

<div class="container">
    <div class="login">
        <form class="px-4 py-3">
            <h1>Connexion</h1>
          <div class="form-group">
            <label for="exampleDropdownFormEmail1"> adresse e-mail :</label>
            <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
          </div>

          <div class="form-group">
            <label for="exampleDropdownFormPassword1">Mot de passe :</label>
            <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
          </div>

          <div class="form-group">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="dropdownCheck">
              <label class="form-check-label" for="dropdownCheck">
                Se souvenir de moi
              </label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
        <div class="dropdown-divider"></div>
        <a href="inscription.php">Nouveau ici? Inscrivez - vous</a> 
        <br> <br>
        <a href="mdpoublie.php">Mot de passe oublié?</a>

      </div>
    </div>
    </body>
    <?php

include "template/footer.php";
    ?>
</html>
​