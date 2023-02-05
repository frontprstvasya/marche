(function($) {
  Drupal.behaviors.filterFront = {
    attach: function(context, settings) {
      function customFilter(firstId, secondId, remove) {
        const firstSelect = document.getElementById(firstId);
        const secondSelect = document.getElementById(secondId);
        if (firstSelect && secondSelect) {
          secondSelect.parentElement.classList.add('unClick');
          if (remove) {
            removeSubFields(remove, firstSelect);
            openSub(firstId, secondId);
          }

          if (firstSelect.value != 'All') {
            openSub(firstId, secondId);
          }

          if (document.querySelector('.page-node-edit')) {
            secondSelect.parentElement.classList.remove('unClick');
          }

          firstSelect.addEventListener('change', () => {
            openSub(firstId, secondId);
            if (document.querySelector('.page-node-edit')) {
              let activeId = document.querySelector('[data-value="' + firstSelect.value + '"]');
              let val = activeId.value;
              secondSelect.value = val;
              let event = new Event('change');
              secondSelect.dispatchEvent(event);
            } else {
              let val = secondSelect.childNodes[0].value;
              secondSelect.value = val;
              let event = new Event('change');
              secondSelect.dispatchEvent(event);
            }
          });
        }
      }

      customFilter('edit-field-categories-tid', 'edit-field-sub-categories-tid');
      customFilter('edit-field-ville-tid', 'edit-field-location-tid-1');
      customFilter('edit-field-categories-und', 'edit-field-sub-categories-und', 1);
      customFilter('edit-field-ville-und', 'edit-field-location-und', 1);

      function openSub(valueId, subSelectId) {
        const value = document.getElementById(valueId);
        const subSelect = document.getElementById(subSelectId);

        if (value && subSelect) {
          if (value.value === 'All' || value.value === '_none') {

            subSelect.parentElement.classList.add('unClick');
          } else {
            subSelect.parentElement.classList.remove('unClick');
          }

          subSelect.childNodes.forEach((el) => {
            if (el.dataset.value === value.value || el.dataset.value === 'All' || el.dataset.value === '_none') {
              el.style.display = 'block';
            } else {
              el.style.display = 'none';
            }
          });
        }
      }

      function removeSubFields(bool, useSelect) {
        if (bool == 1) {
          useSelect.childNodes.forEach((node) => {
            if (node.dataset.value == '0' || node.dataset.value == 'All' || node.dataset.value == '_none') {
              node.style.display = 'block';
            } else {
              node.style.display = 'none';
            }
          });
        }
      }

      $(document).ajaxStop(function() {
        openSub('edit-field-categories-tid', 'edit-field-sub-categories-tid');
        openSub('edit-field-ville-tid', 'edit-field-location-tid-1');
      });

      /**
       * REMOVE EMPLOIS FROM DEPOSER
       */
      function removeEmplois(id) {
        const page = document.querySelector(`.${id}`);
        if (page) {
          const select = document.getElementById('edit-field-categories-und');
          select.childNodes.forEach((item) => {
            if (item.innerHTML == 'Emplois') {
              item.style.display = 'none';
            }
          })
        }
      }
      removeEmplois('node-submit_an_ad-form');
    }
  };
})(jQuery);



