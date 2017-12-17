<?php
/**
 * @file
 * Template for a 3 column panel layout.
 *
 * This template provides a three column 25%-50%-25% panel display layout, with
 * additional areas for the top and the bottom.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['top']: Content in the top row.
 *   - $content['left']: Content in the left column.
 *   - $content['middle']: Content in the middle column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<div class="container">
    <div class="col-md-10 col-md-offset-1 move-into-top text-center">
      <?php print $content['intro']; ?>
      <p class="lead search-for" aria-live="polite">&nbsp;</p>
      <form class="navbar-form">
        <div class="form-group" style="display:inline;">
          <div class="input-group input-group-lg">
            <label class="sr-only" for="s">Search</label>
            <input id="s" type="text" class="form-control"
                   placeholder="Filter the knowledge base items">
            <button type="submit" class="input-group-addon">
              <i class="icon-search"></i>
              <span class="sr-only">Search</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  
<section id="knowledge-base">
				<div class="container">
						<div class="row">
								<div class="col-md-12">
										<div class="row">

												<div class="col-md-4 col-sm-12">
                          <?php print $content['getting_started']; ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                          <?php print $content['user_guides']; ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                          <?php print $content['distribution']; ?>
                        </div>
                        <div class="col-md-12 text-center">
													<p class="lead no-results" aria-live="polite"></p>
												</div>
                    </div>
                </div>
            </div>
        </div>
</section>
