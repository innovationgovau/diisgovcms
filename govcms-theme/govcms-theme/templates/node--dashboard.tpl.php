<div class="move-into-top col-md-10 col-md-offset-1 text-center">
  <?php
    $default_view_modes = array(
        'label'=>'hidden',
        'type' => 'default',
    );
    $the_view = field_view_field('node', $node, 'field_summary', $default_view_modes);
    echo '<div class="lead">'.render($the_view).'</div>';  // "An overview of spending and performance of the govCMS platform."
  ?>
  <p>Last updated <?php print check_plain($govcms_dashboard_last_updated) ?></p>
    <!-- <?php print check_plain($govcms_dashboard_last_updated_debug); ?> -->
</div>

<section class="dashboard light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                          <i class="icon-check"></i>
                          <h2>Live sites</h2>
                          <span class="int">
                            <strong>
                              <?php
                                print views_embed_view('dashboard_sites_stats', $display_id = 'block');
                              ?>
                            </strong>
                          </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                          <i class="icon-cog"></i>
                          <h2>In development</h2>
                          <span class="int">
                            <strong>
                              <?php
                                print views_embed_view('dashboard_sites_stats', $display_id = 'block_1');
                              ?>
                            </strong>
                          </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                          <i class="icon-users"></i>
                          <h2>Agencies using</h2>
                          <span class="int">
                            <strong>
                              <?php
                                print views_embed_view('dashboard_agencies_number', $display_id = 'block');
                              ?>
                            </strong>
                          </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
											<div class="grid-item">
												<i class="icon-harddrive"></i>
												<h2>Site types</h2>
												<span class="int">
													<strong><?php print check_plain($govcms_dashboard_saas_count); ?><span class="slash">/</span><?php print check_plain($govcms_dashboard_paas_count); ?></strong>
												</span>
                        <small><abbr title="Software as a Service">SaaS</abbr> / <abbr title="Platform as a Service">PaaS</abbr></small>
											</div>
										</div>
                    <div class="col-md-4 col-sm-6">
                      <div class="grid-item">
                        <i class="icon-package"></i>
                        <h2>Distribution</h2>
                        <span class="int"><strong><?php print check_plain($govcms_dashboard_github_releases); ?></strong></span>
                        <small>releases</small>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="grid-item">
                        <i class="icon-stats-up"></i>
                        <h2><abbr title="Software as a Service">SaaS</abbr> uptime</h2>
                        <span class="int"><strong><?php print check_plain($govcms_dashboard_site247_availability); ?></strong>%</span>
                        <small>last 30 days</small>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="grid-item">
                        <i class="icon-timer"></i>
                        <h2>Server response</h2>
                        <span class="int"><strong><?php print check_plain($govcms_dashboard_ga_page_loads); ?></strong>s</span>
                        <small>on average</small>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="grid-item">
                        <i class="icon-download"></i>
                        <h2>Distribution</h2>
                        <span class="int"><strong><?php print check_plain($govcms_dashboard_drupal_downloads); ?></strong>k</span>
                        <small>downloads from drupal.org</small>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="grid-item">
                        <i class="icon-laptop-phone"></i>
                        <h2><abbr title="Software as a Service">SaaS</abbr> page views</h2>
                        <span class="int"><strong><?php print check_plain($govcms_dashboard_ga_page_visits); ?></strong>M</span>
                        <small>last 30 days</small>
                      </div>
                    </div>
                    <?php  /*
                    // example item:
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                            <i class="icon-question"></i>
                            <h2>Something</h2>
                            <span class="int">$<strong>??</strong>m</span>
                            <small>on average</small>
                        </div>
                    </div>

                    // others not currently used:
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                            <i class="icon-piggy"></i>
                            <h2>Agency savings</h2>
                            <span class="int">$<strong><?php //print check_plain($govcms_dashboard_savings); ?></strong><?php //print check_plain($govcms_dashboard_savings_unit); ?></span>
                            <small>total to date</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                            <i class="icon-shop"></i>
                            <h2><abbr title="Small and Medium-sized Enterprises">SMEs</abbr></h2>
                            <span class="int">$<strong><?php //print check_plain($govcms_dashboard_smes); ?></strong><?php //print check_plain($govcms_dashboard_smes_unit); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                            <i class="icon-coas"></i>
                            <h2><abbr title="Department of Finance">Finance</abbr></h2>
                            <span class="int">$<strong><?php //print check_plain($govcms_dashboard_finance); ?></strong><?php //print check_plain($govcms_dashboard_finance_unit); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-item">
                            <i class="icon-acquia-outline"></i>
                            <h2>Acquia</h2>
                            <span class="int">$<strong><?php //print check_plain($govcms_dashboard_acquia); ?></strong><?php //print check_plain($govcms_dashboard_acquia_unit); ?></span>
                        </div>
                    </div>
                    */ ?>
                </div>
            </div>
        </div>
    </div>
</section>
