<?php

// Plugin definition
$plugin = array(
  'title' => t('govCMS Knowledge base page'),
  'category' => t('Columns: 3'),
  'icon' => 'knowledge_base.png',
  'theme' => 'govcms-layouts-knowledge-base',
  'css' => 'knowledge_base.css',
  'regions' => array(
    'intro' => t('Introduction'),
    'getting_started' => t('Getting Started'),
    'user_guides' => t('User Guides'),
    'distribution' => t('Distribution')
  ),
);
