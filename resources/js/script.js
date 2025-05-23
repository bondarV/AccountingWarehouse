console.log(112);
document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.querySelector("#movement_type");
        const relocateFields = document.querySelector("#relocate-fields");
        const outFields = document.querySelector("#out-fields");

        function toggleFields(value) {
            relocateFields.classList.add('hidden');
            outFields.classList.add('hidden');


            if (value === 'relocate') {
                relocateFields.classList.remove('hidden');
            } else if (value === 'out') outFields.classList.remove('hidden')
        }

        typeSelect.addEventListener('change', (event) => toggleFields(event.target.value));
    }
);
