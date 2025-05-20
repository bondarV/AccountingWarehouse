console.log(112);
document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.querySelector("#movement_type");
        const inFields = document.querySelector("#in-fields");
        const outFields = document.querySelector("#out-fields");
        const adjustFields = document.querySelector("#adjust-fields");

        function toggleFields(value) {
            inFields.classList.add('hidden');
            outFields.classList.add('hidden');
            adjustFields.classList.add('hidden');

            if (value === 'in') inFields.classList.remove('hidden');
            if (value === 'out') outFields.classList.remove('hidden');
            if (value === 'adjust') adjustFields.classList.remove('hidden');
        }

        typeSelect.addEventListener('change', (event) => toggleFields(event.target.value));
    }
);
