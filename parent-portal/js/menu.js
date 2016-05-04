

/*

Javascript for the display Menu and animation.

*/

$('#buttonMasterContainer').click(function(){
   $('#button').toggleClass('active');
   $('#menuMasterContainer').fadeToggle('fast');
});

function selectMenu(menu)
{
  var selectedMenu = menu;

  //Loop through all menuBox's and pass in each box as a argument
  $('.menuBox').each(function(menuBox) {

    //Retain the reference to the current object for the callback function complete
    var currentMenu = this;

    //If the current Menu DOES NOT match our selected menu OR if the current Menu has the calss isSelected
    if((this !== selectedMenu) || ($(this).hasClass("isSelected")))
    {
      //console.log('Menu #: ' + menuBox + " was not the selectedMenu or had class isSelected.");

      //Relative to the current Menu, check if the optionsColumn is currently displaying the menu. If so, toggle it to none.
      if( $(this).next(".optionsColumn").css('display') == 'block') {

        $(this).next(".optionsColumn").animate(
          {
            display:'none',
            height: "toggle"
          }, {
            duration: 500,
            //We need to call isSelected after the animation is complete to prevent a jumping action with margins
            complete: function() {
              //console.log("Removed class for Menu #: " + menuBox);
              $(currentMenu).removeClass('isSelected');
            }
          }
        );

      }
    }

    else
    {
      $(this).next(".optionsColumn").animate({display:'block', height: "toggle"}, 500);
      $(this).addClass('isSelected');
      //console.log("Added class isSelected to Menu #: " + menuBox);
    }
  });
}
