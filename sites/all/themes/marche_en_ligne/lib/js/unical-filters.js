document.addEventListener('DOMContentLoaded', ()=>{
  const categSelect = document.getElementById('edit-field-categories-und');
  function showFilter(){
    const allFilters = document.querySelectorAll('.wrap-filters');
    allFilters.forEach((filtersItem)=>{
      if(!filtersItem.classList.contains('unical-filters')){
        filtersItem.classList.add('unical-filters');
        let filterSelect = filtersItem.querySelectorAll('.shs-select-level-1');
        filterSelect.forEach((element)=>{
          element.selectedIndex = 0;
        });
      }
    });
    let filterWrapper = document.getElementById(`${categSelect.value}`);
    if(filterWrapper){
      filterWrapper.classList.remove('unical-filters');
    }
  }

    categSelect.addEventListener('change', ()=>{
      showFilter();
    });

    showFilter();
});
