document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form"),
        formGroup = form.querySelector(".form-group"),
        inputs = form.querySelectorAll("input"),
        loadCashMachine = form.querySelector("input[name=\"FIELDS[LOAD_CASHMACHINE]\"]")

    console.log(inputs);

    inputs.forEach(function(input) {
        input.addEventListener("click", function(e) {
            const thisInput = e.target;
            const label = thisInput.closest(".form-group").querySelector("label");

            label.classList.remove("empty");

            loadCashMachine.value = thisInput.value;
        });
    });
});