console.log(112);
document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.querySelector("#movement_type");
        const relocateFields = document.querySelector("#relocate-fields");
        const outFields = document.querySelector("#out-fields");
        const quantityLabel = document.querySelector('#quantity_label');

        function toggleFields(value) {
            relocateFields.classList.add('hidden');
            outFields.classList.add('hidden');

            quantityLabel.textContent = 'Quantity';

            if (value === 'relocate') {
                relocateFields.classList.remove('hidden');
            } else if (value === 'out') {
                outFields.classList.remove('hidden')
            } else {
                quantityLabel.textContent = 'Final amount';
            }
        }

        typeSelect.addEventListener('change', (event) => toggleFields(event.target.value));
    }
);
