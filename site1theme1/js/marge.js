
//Hover - Tooltip hover message

jQuery(document).ready(function($) {
$('a[href^="http"]').filter(function() {
return this.hostname && this.hostname !== location.hostname;
})
.addClass("external")

var sitesClasses = [
  {
  hostname: 'business.gov.au', 
  class: 'business', 
  message: 'You are now leaving this website for the business.gov.au website'
  },
  {
   hostname: 'minister.industry.gov.au', 
  class: 'minister', 
  message: 'This will take you to the Department of Industry, Innovation and Science Ministers site'
  },
   {
   hostname: 'www.facebook.com/sharer.php', 
  class: 'fbshare', 
  message: 'Share via Facebook'
  },
   {
   hostname: 'twitter.com/share', 
  class: 'twittershare', 
  message: 'Share via Twitter'
  },
   {
   hostname: 'www.linkedin.com/shareArticle', 
  class: 'linkedinshare', 
  message: 'Share via LinkedIn'
  },
   {
   hostname: 'plus.google.com/share', 
  class: 'googleshare', 
  message: 'Share via Google+'
  },
  ]

$.each(sitesClasses, function(index) {
$('[href*="' + sitesClasses[index]['hostname'] + '"]').removeClass('external').addClass(sitesClasses[index]['class']);
$('a.' + sitesClasses[index]['class'] + '').attr('title', sitesClasses[index]['message']);
});


$("a.external").attr('title', 'This will take you to an external website.');

$("a.doc.external").attr('title', 'This document is located on an external website.');

});

//Font resize

$(document).ready(function() {
    $("#sizeUp").click(function() {
        $("body").css("font-size","115%");
    });
    $("#normal").click(function() {
        $("body").css("font-size","100%");
    })
    $("#sizeDown").click(function() {
        $("body").css("font-size","85%");
    })
});

//Case study slide

$(document).ready(function(){
    $("#flip").click(function(){
        $("#cs-content").slideToggle("fast");
    });
});

