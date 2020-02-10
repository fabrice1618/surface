
    <?php

        include "template/htmlhead.php";
    ?>
 
  <body>
 
    <div class="container">
      <div class="login">
          <form class="px-4 py-3">
            <h1>Inscription</h1>
            <div class="form-group">
              <label for="exampleDropdownFormEmail1"> Adresse e-mail :</label>
              <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
            </div>

            <div class="form-group">
              <label for="exampleDropdownFormPassword1">Mot de passe :</label>
              <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Mot de passe">
            </div>

            <div class="form-group">
              <label for="exampleDropdownFormPassword1">Confirmation mot de passe :</label>
              <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Mot de passe">
            </div>

            <div class="form-group">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="dropdownCheck">
                <label class="form-check-label" for="dropdownCheck">
                  Se souvenir de moi
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
          </form>
          
        </div>
      </div>
    </body>
<?php

    include "template/footer.php";

    ?>

</html>
​