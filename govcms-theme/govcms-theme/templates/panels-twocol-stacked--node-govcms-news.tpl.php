<?php
/**
 * @file
 * Template for a 2 column panel layout.
 *
 * This template provides a two column panel display layout, with
 * additional areas for the top and the bottom.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['top']: Content in the top row.
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>

  <?php if ($content['top']): ?>
    <section class="news-item-header move-to-top text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 text-center">
            <?php print $content['top']; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($content['left'] && $content['right']): ?>
  <div class="center-wrapper">
    <div class="panel-col-first panel-panel">
      <div class="inside"><?php print $content['left']; ?></div>
    </div>
    <div class="panel-col-last panel-panel">
      <div class="inside"><?php print $content['right']; ?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($content['bottom']): ?>
    <section class="news-item text-content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <article class="news-content">
                <?php print $content['bottom']; ?>
            </article>
            <div class="social-btns text-center">
              <h2>Share this</h2>
              <ul class="list-inline">
                <li>
                  <a href="http://www.facebook.com/sharer.php?u=<?php print $GLOBALS['base_url'];  ?><?php print $_SERVER['REQUEST_URI'] ?>" class="btn-sm btn-facebook">
                    <i class="icon-facebook"></i>
                    <span class="sr-only">Facebook</span>
                  </a>
                </li>
                <li>
                  <a href="http://twitter.com/share?url=<?php print $GLOBALS['base_url'];  ?><?php print $_SERVER['REQUEST_URI'] ?>" class="btn-sm btn-twitter">
                    <i class="icon-twitter"></i>
                    <span class="sr-only">Twitter</span>
                  </a>
                </li>
                <li>
                  <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php print $GLOBALS['base_url'];  ?><?php print $_SERVER['REQUEST_URI'] ?>" class="btn-sm btn-linkedin">
                    <i class="icon-linkedin"></i>
                    <span class="sr-only">LinkedIn</span>
                  </a>
                </li>
                <li>
                  <a href="mailto:?subject=govCMS News&body=<?php print $GLOBALS['base_url'];  ?><?php print $_SERVER['REQUEST_URI'] ?>" class="btn-sm btn-email">
                    <i class="icon-mail"></i>
                    <span class="sr-only">Email</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
</div>
