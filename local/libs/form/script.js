document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form"),
        inputs = form.querySelectorAll("input"),
        clearButtons = form.querySelectorAll(".form-group__clear"),
        loadCashMachine = form.querySelector("input[name=\"FIELDS[BALANCE]\"]");

    inputs.forEach(input => {
        input.addEventListener("focusin", focusIn);
        input.addEventListener("focusout", focusOut);
        input.addEventListener("keyup", keyUp);
    });

    clearButtons.forEach(button => {
        button.addEventListener("click", function(e){
            const this_ = e.target,
                formGroup = this_.closest(".form-group"),
                input = formGroup.querySelector("input"),
                label = formGroup.querySelector("label");
            input.value = "";
            label.classList.add("empty");
            this_.classList.remove("show");
            keyUp();
        });
    });

    function focusIn(e){
        const this_ = e.target,
            formGroup = this_.closest(".form-group"),
            label = formGroup.querySelector("label"),
            clearButton = formGroup.querySelector(".form-group__clear");
        label.classList.remove("empty");
        clearButton.classList.add("show");
    }

    function focusOut(e){
        const this_ = e.target,
            formGroup = this_.closest(".form-group"),
            label = formGroup.querySelector("label"),
            clearButton = formGroup.querySelector(".form-group__clear");
        if(this_.value === ""){
            label.classList.add("empty");
            clearButton.classList.remove("show");
        }else{
            label.classList.remove("empty");
        }
    }

    function keyUp(){
        let loadCashMachineValue = 0;
        inputs.forEach(input => {
            if(input.classList.contains("banknote")){
                loadCashMachineValue += Number(input.value) * Number(input.dataset.value);
                loadCashMachine.value = loadCashMachineValue;
            }else if(input.classList.contains("work-time")){
                let value = input.value;
                value = value.replace(/[^\d]/g, "");
                if(value.length > 2 && value[2] !== ":"){
                    value = value.slice(0, 2) + ":" + value.slice(2);
                }
                if(value.length > 5 && value[5] !== ":"){
                    value = value.slice(0, 5) + "-" + value.slice(5);
                }
                if(value.length > 8 && value[8] !== ":"){
                    value = value.slice(0, 8) + ":" + value.slice(8);
                }
                if(value.length > 11){
                    value = value.slice(0, 11);
                }
                input.value = value;
            }
        });
    }
});
