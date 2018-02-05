<?php
/**
* @file
* Default theme implementation for displaying search results.
*
* This template collects each invocation of theme_search_result(). This and the
* child template are dependent on one another, sharing the markup for
* definition lists.
*
* Note that modules and themes may implement their own search type and theme
* function completely bypassing this template.
*
* Available variables:
* - $index: The search index this search is based on.
* - $result_count: Number of results.
* - $spellcheck: Possible spelling suggestions from Search spellcheck module.
* - $search_results: All results rendered as list items in a single HTML
*   string.
* - $items: All results as it is rendered through search-result.tpl.php.
* - $search_performance: The number of results and how long the query took.
* - $sec: The number of seconds it took to run the query.
* - $pager: Row of control buttons for navigating between pages of results.
* - $keys: The keywords of the executed search.
* - $classes: String of CSS classes for search results.
* - $page: The current Search API Page object.
* - $no_results_help: Help text to display under the header if no results were
*   found.
*
* View mode is set in the Search page settings. If you select
* "Themed as search results", then the child template will be used for
* theming the individual result. Any other view mode will bypass the
* child template.
*
* @see template_preprocess_search_api_page_results()
*/

?>


<div id="top-and-first-wrapper">
    <?php include "includes/header.tpl.php"; ?>
</div>
<main>
    <!-- #page -->
    <div id="page" class="clearfix">
        <!-- #main-content -->
        <a id="main-content-anchor" tabindex="-1"></a>
        <div id="main-content" data-js="responsive-video">
            <div class="container">
                <div id="region-highlighted">
                    <?php print render($page['highlighted']); ?>
                </div>
            </div>
            <?php if ($messages): ?>
            <!-- #EOF region-higlighted parent container -->
            <div class="container">
                <div class="col-md-12">
                    <!-- #messages-console -->
                    <?php if ($messages): ?>
                    <div id="messages-console" class="clearfix">
                        <div class="row">
                            <div class="col-md-12">
                                <?php print $messages; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- EOF: #messages-console -->
                </div>
            </div>
            <?php endif; ?>
            <!-- Main page content if not homepage -->
            <div class="container">
                <div class="row">
                    <div class="col-md-9" id="region-content">
                        <section class="news-list">
                            <div class="container">
                                <div class="row">                                    
                                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                                        
                                        <?php if ($result_count): ?>
                                        <?php print render($search_performance); ?>
                                        <?php endif; ?>
                                        <?php print render($spellcheck); ?>
                                        <?php if ($result_count): ?>
                                        <?php
                                        $search_term = arg(1);
                                        $search_term = str_replace('<', '', $search_term);
                                        $search_term = str_replace('>', '', $search_term);
                                        ?>
                                        <h1><?php print t('Search results for "').$search_term.'"'; ?></h1>
                                        <?php print render($search_results); ?>
                                        <?php print render($pager); ?>
                                        <?php else : ?>
                                        <h1><?php print t('No results found.');?></h1>
                                        <?php print $no_results_help; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-3" id="region-sidebar-second">
                        <?php print render($page['sidebar_second']); ?>
                    </div>
                </div>
                <!-- EOF:#main-content -->
            </div>
            <!-- EOF:#page -->
        </div>
    </div>
</main>
<?php include "includes/footer.tpl.php"; ?>
<!-- EOF:#footer -->