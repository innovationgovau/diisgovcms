<!-- #messages-console top -->
<?php if ($messages): ?>
<div class="container messages-wrapper messages-wrapper-top">
  <div id="messages-console" class="clearfix">
    <?php print $messages; ?>
  </div>
</div>
<?php endif; ?>
<!-- EOF: #messages-console -->

<header id="top">
  <div id="region-top">
    <?php print render($page['top']); ?>
    <div id="cs-content"><p class="feedbackmsg">This feedback is anonymous. Please <a href="/about-us/contact-us">Contact us</a> if you would like a response.</p><?php $block = module_invoke('webform', 'block_view', 'client-block-13336'); print render($block['content']); ?></div>
  </div>
  <div id="main-page-top" class="full-width">
    <div class="container">
      <div class="row">
        <div class="col-md-6 logos">
          <div class="coa-inline">
            <div class="coa-titles-inline">
              <div class="coa-titles">
                <a href="/">
                  <img src=<?php print("/" . drupal_get_path('theme',$GLOBALS['theme']) . "/img/crest-64.png"); ?> alt="Home" class="coa-img" />
                  <div>
                    <div class="coa-line-one coa-lines-2">Australian Government</div>
                    <div><?php $block = module_invoke('bean', 'block_view', 'crest---department-name'); print render($block['content']); ?></div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6" id="region-header">
          <?php print render($page['header']); ?>
          <div id="block-search-form">
            <?php $block = module_invoke('views', 'block_view', '-exp-advanced_search-page'); print render($block['content']); ?>
          </div>
          <?php $block = module_invoke('menu_block', 'block_view', '14'); ?>
          <div class="collapsible-menu">
            <a id="main-navigation" class="element-invisible" tabindex="-1">Main navigation</a>
            <input type="checkbox" id="menu"><label for="menu"></label>
            <div class="menu-content">
                <?php print render($block['content']);?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div id="meanmenu-dest"></div>
      </div>
    </div>
    <?php if (drupal_is_front_page()): ?>
    <div id="mission-statement" class="container">
      <?php $block = module_invoke('bean', 'block_view', 'vision-statement'); print render($block['content']); ?>
    </div>
    <?php endif; ?>
  </div>
</header>

<!-- #messages-console under header -->
<?php if ($messages): ?>
<div class="container messages-wrapper messages-wrapper-under-header">
  <div id="messages-console" class="clearfix">
    <?php print $messages; ?>
  </div>
</div>
<?php endif; ?>
<!-- EOF: #messages-console -->
