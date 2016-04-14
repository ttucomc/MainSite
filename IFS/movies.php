<div class="row small-collapse">
    <div class="small-12 columns card">
        <div class="row collapse card-header" style="background-image:url('images/<?php echo $movie_image; ?>');">
            <div class="small-10 medium-6 columns">
                <h3><?php echo $movie['title']; ?></h3>
            </div>
        </div>
        <div class="row card-body" data-equalizer>
            <div class="small-11 medium-3 columns" data-equalizer-watch>
                <img src="images/<?php echo $movie['poster']; ?>" alt="<?php echo $movie['title']; ?> movie poster" title="<?php echo $movie['title']; ?> Movie" class="movie-poster">
            </div>
            <div class="small-11 medium-8 columns" data-equalizer-watch>
                <h4><time datetime="<?php echo $movie['show_date']; ?>"><?php echo $show_date; ?></time></h4>
                <p>
                    <strong><em><?php echo $movie['title']; ?></em></strong> (dir. <?php echo $movie['director'] . ' / ' . $movie['country'] . ' / ' . $movie['release_year'] . ' / ' . $movie['length'] . ' min'; ?>)<br>
                    <?php if (!is_null($movie['show_series'])) {
                        echo $movie['show_series'] . '<br>';
                    } ?>
                    <?php if (!is_null($movie['show_sponsor'])) {
                        echo $movie['show_sponsor'] . '<br>';
                    } ?>
                    Time and Location: <?php if(!is_null($movie['show_time'])) { echo $show_time; } else { echo 'TBD'; } ?> - <?php if(!is_null($movie['show_location'])) { echo $movie['show_location']; } else { echo 'TBD'; } ?> (<a href="<?php echo $movie['show_directions']; ?>" target="_blank">directions</a>)<br>
                    More info: <a href="<?php echo $movie['info']; ?>" class="external"><?php echo $movie['info']; ?></a><br>
                    <a href="<?php echo $movie['trailer']; ?>" class="button" target="_blank">View Trailer</a>
                    <?php if (!is_null($movie['tickets'])) { ?>
                        <a href="<?php echo $movie['tickets']; ?>" class="button" target="_blank">Get Tickets Here</a>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</div>
