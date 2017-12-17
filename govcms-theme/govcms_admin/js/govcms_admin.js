/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var Drupal = Drupal || {};

(function($, Drupal){
    jQuery(document).ready(function($) {
        if(typeof CKEDITOR != 'undefined') {
            CKEDITOR.dtd.a.h2 = 1;
            CKEDITOR.dtd.a.h3 = 1;
            CKEDITOR.dtd.a.i = 1;
            CKEDITOR.dtd.a.div = 1;
            CKEDITOR.dtd.a.p = 1;
            CKEDITOR.dtd.$removeEmpty.i = 0;
        }

        $("body.page-admin div#branding div.breadcrumb").prepend("<a href='/'>Home</a><span></span>");

    });

})(jQuery, Drupal);



