<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Mon super site' ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link href="https://bootswatch.com/4/sandstone/bootstrap.min.css" rel="stylesheet">
  </head>
  
  <body>
    <div>
      <header>
        <h1>
          <a href="/" style="color:black" >Billet simple pour l'Alaska</a> <small class="text-muted"><a href="/contacts.html" style="color:grey">par Jean Forteroche</a></small>
        </h1>
      </header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="/">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/summary.html">Sommaire</a>
            </li>
            <?php if ($user->isAuthenticated()) { ?>
            <li class="nav-item">
              <a class="nav-link" href="/admin">Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/chapters-insert.html">Ajouter un chapitre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout">Déconnexion</a>
            </li>
            <?php } ?>
            <?php if (!$user->isAuthenticated()) { ?>
            <li class="nav-item">
              <a class="nav-link" href="/contacts.html">Contact</a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </nav>      
      <div>
        <section>
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          
          <?= $content ?>
        </section>
      </div>
      <footer></footer>
    </div>
  </body>
</html>