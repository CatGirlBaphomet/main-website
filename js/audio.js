// Get audio and enter button elements
let audio = document.getElementById('audio');
let enterButton = document.getElementById('enter');

// Add event listener to enter button
enterButton.addEventListener('click', function() {
  enterButton.style.opacity = '0';
  enterButton.addEventListener('transitionend', () => enterButton.remove());
  if (typeof window.orientation === 'undefined') {
    audio.play();
  }
});

// Loop audio
audio.onended = function() {
  audio.play();
};
/*
     FILE ARCHIVED ON 03:14:11 Aug 23, 2022 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 01:04:26 Jan 05, 2024.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 115.118
  exclusion.robots: 0.066
  exclusion.robots.policy: 0.057
  cdx.remote: 0.051
  esindex: 0.008
  LoadShardBlock: 82.886 (3)
  PetaboxLoader3.datanode: 78.323 (4)
  load_resource: 137.984
  PetaboxLoader3.resolve: 94.915
*/