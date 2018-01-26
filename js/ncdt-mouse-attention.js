// ncdt-mouse-attention.js
// July 2012
// Rian Rietveld, rrwd.nl

function navigate(url)
{
  if ((jQuery.browser.msie) && (parseInt(jQuery.browser.version) < 9))
  {
    var referLink = document.createElement('a');
    referLink.href = url;
    document.body.appendChild(referLink);
    referLink.click();
} else {
    location.href = url;
  }
}

/* Class Act - CSS style manipulation

Possible actions are:

swap
    - replaces class c1 with class c2 in object o.
add
    - adds class c1 to the object o.
remove
    - removes class c1 from the object o.
check
    - test if class c1 is already applied to object o and returns true or false.
*/

function classAct(a,o,c1,c2) // action, object, class 1, class 2
{
  switch (a){
    case 'swap':
      o.className=!classAct('check',o,c1)?o.className.replace(c2,c1):o.className.replace(c1,c2);
    break;
    case 'add':
      if(!classAct('check',o,c1)){o.className+=o.className?' '+c1:c1;}
    break;
    case 'remove':
      var rep=o.className.match(' '+c1)?' '+c1:c1;
      o.className=o.className.replace(rep,'');
    break;
    case 'check':
      return new RegExp('\\b'+c1+'\\b').test(o.className)
    break;
  }
}