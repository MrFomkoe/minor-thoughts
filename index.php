<?php
include './database/get-songs.php';
include './database/get-gigs.php';

try {
  // Get gigs and songs
  $songs = getSongs();
  $gigs = getGigs();
} catch (Exception $e) {
  // If an error is thrown, echo the message
  echo $e->getMessage();
}

// print_r($songs);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./styles/style.css">
  <title>Document</title>
</head>

<body>
  <header>
    <div class="header-background">
      <h1>The Minor Thoughts</h1>
    </div>
    <nav class="navigation">
      <ul>
        <li><a href="#bio">Bio</a></li>
        <li><a href="#discography">Discography</a></li>
        <li><a href="#gigs">Upcoming Shows</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="bio">
      <h2>Bio</h2>
      <p> The Minor Thoughts is a two-piece indie/alternative rock band from Riga, Latvia. </p>

      <p>Initially, the band was formed in 2018 by drummer Dmitry Dvoryanov and singer/guitarist Roman Ponomarjov.</p>

      <p>The band has been playing British indie rock with some elements of alternative rock. </p>

      <p>Later bassist Kristina Monahova joined the band. After that, the band played several shows in clubs in Riga under the name Nekkid and was warmly welcomed by the audience. </p>

      <p>In April 2019 the place of bassist was taken by Arturs Eimanis and the band continued live performances, as well as, took up the recording of a single "Johnnie Walker". Unfortunately, the record has never been finished. </p>

      <p>In December 2020 the band broke up after the departure of the bassist.</p>

      <p>In 2022 Roman and Dmitry decided to change the sound of the band to more electronic music and heavier rock. </p>

      <p>Everything else is the future...</p>

    </section>

    <section id="discography">
      <h2>Discography</h2>
      <div class="songs">
        <?php foreach ($songs as $song) : ?>
          <div class="song-container">
            <img class="song-image" src="./media/song_covers/<?= $song['image']; ?>" alt="">
            <div class="song-data">
              <!-- <h3 class="song-name"><?= $song['name']; ?></h3> -->
              <div class="spotify">
                <a href=""><img src="./media/logos/spotify-logo.png" alt=""></a>
                <h3>TBA</h3>
              </div>
              <div class="apple">
                <a href=""><img src="./media/logos/apple-logo.png" alt=""></a>
                <h3>TBA</h3>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="gigs">
      <h2>Gigs</h2>
      <div class="gig-list">
        <?php if(empty($gigs)): ?>
          <h3>There are no gigs at the moment. Stay tuned.</h3>
        <?php else: ?>
          <?php foreach ($gigs as $gig): ?>
            <div class="gig-container <?php echo $gig['upcoming']?: 'completed' ?>">
              <?php if(!$gig['upcoming']): ?>
                <img class="gig-done-stamp" src="./media/logos/done-stamp.png" alt="">
              <?php endif;?>

              <h4>Where: <?php echo $gig['venue'] ?></h4>
              <h4>When: <?php echo $gig['date'] ?></h4>
              <h4>Time: <?php echo $gig['time'] ?></h4>
              <!-- <?php print_r($gig);?> -->
            </div>
          <?php endforeach; ?>

        <?php endif; ?>
      </div>
    </section>

  </main>
</body>

</html>