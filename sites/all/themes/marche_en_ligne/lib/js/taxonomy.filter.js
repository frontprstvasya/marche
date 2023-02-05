/**
 * Adding class 'wrapper-select' to wrap div select.
 */
Drupal.behaviors.taxonomyFilter = {
  attach: function (context, settings) {
    let allWidget = document.querySelectorAll('#block-views-exp-taxonomy-term-page .views-exposed-widgets .views-exposed-widget .views-widget .form-type-select .form-select')
    allWidget.forEach(function(userItem) {
      userItem.parentElement.classList.add('wrapper-select')
    });

    /**
     * Remove class after click btn apply filter
     */
    let closeFilterApply = document.getElementById('edit-submit-taxonomy-term')
    let filterSpoiler = document.getElementById('SFC')
    if(filterSpoiler){
      closeFilterApply.addEventListener("click", function(){
        filterSpoiler.classList.remove('active--filter-menu')
      })
    }
  }
};

/**
 * Toggle class filter label.
 */
function filterClickSpoiler() {
  let filterSpoiler = document.getElementById('SFC')
  filterSpoiler.classList.toggle('active--filter-spoiler')
}

function filterClickSpoilerMobile() {
  let filterMobile = document.getElementById('SFC')
  filterMobile.classList.add('active--filter-menu')
}

function filterCloseMenu() {
  let filterSpoiler = document.getElementById('SFC')
  filterSpoiler.classList.remove('active--filter-menu')
}
