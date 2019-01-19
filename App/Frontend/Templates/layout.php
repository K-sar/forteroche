<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Mon super site' ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    
    <link rel="stylesheet" href="/css/Envision.css" type="text/css" />
  </head>
  
  <body>
    <div id="wrap">
      <header>
        <h1><a href="/">Billet simple pour l'Alaska</a></h1>
        <p>Jean Forteroche</p>
      </header>
      
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          <li><a href="/summary.html">Sommaire</a></li>
          <?php if ($user->isAuthenticated()) { ?>
          <li><a href="/admin">Admin</a></li>
          <li><a href="/admin/chapters-insert.html">Ajouter un chapitre</a></li>
          <li><a href="/logout">Déconnexion</a></li>
          <?php } ?>
          <?php if (!$user->isAuthenticated()) { ?>
          <li><a href="/contacts.html">Contact</a></li>
          <?php } ?>
        </ul>
      </nav>
      
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          
          <?= $content ?>
        </section>
      </div>
    
      <footer></footer>
    </div>
  </body>
</html>