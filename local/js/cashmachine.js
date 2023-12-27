document.addEventListener("DOMContentLoaded", () => {

    initCashMachine();
    initTabletBoard();
    initKeyBoard("input[name=\"FIELDS[PIN_CODE]\"]", 3);
    initKeyBoard("input[name=\"FIELDS[GET_MONEY]\"]");
    removeReloadParamFromURL();

    function initTabletBoard(){
        const tabletBoardItems = document.querySelectorAll(".cashmachine__key"),
            formTerminal = document.querySelector("form.terminal");
        tabletBoardItems.forEach(tabletBoardItem => {
            tabletBoardItem.addEventListener("click", function(e){
                const this_ = e.target.closest(".cashmachine__key"),
                    dataValue = this_.dataset.value,
                    input = document.createElement("input");
                input.name = "FIELDS[ACTION]";
                input.value = dataValue;
                input.type = "hidden";
                formTerminal.appendChild(input);
                formTerminal.requestSubmit();
            });
        });
    }

    function initCashMachine(){
        const cashMachines = document.querySelectorAll(".cashmachine-item");
        cashMachines.forEach(cashMachine => {
            cashMachine.addEventListener("click", function(e){
                const this_ = e.target.closest(".cashmachine-item"),
                    dataId = this_.dataset.id,
                    params = new URLSearchParams();
                params.set("id", dataId)
                params.set("reload", "Y")
                history.pushState(null, null, `?${params}`);
                location.reload();
            });
        });
    }

    function initKeyBoard(selector, length = null){
        const keyBoardItem = document.querySelectorAll(".cashmachine__keyboard-item"),
            input = document.querySelector(selector),
            formTerminal = document.querySelector("form.terminal");

        if(input){
            keyBoardItem.forEach(item => {
                item.addEventListener("click", function(e){
                    console.log(input)
                    const this_ = e.target,
                        dataValue = this_.dataset.value;

                    if(this_.classList.contains("cancel")){
                        input.value = "";
                    }else if(this_.classList.contains("ok")){
                        const input = document.createElement("input");
                        input.name = "FIELDS[ACTION]";
                        input.value = dataValue;
                        input.type = "hidden";
                        formTerminal.appendChild(input);
                        formTerminal.requestSubmit();
                    }else if(length && input.value.length <= length){
                        input.value += dataValue;
                    }else {
                        input.value += dataValue;
                    }
                });
            });
        }
    }

    function removeReloadParamFromURL() {
        const params = new URLSearchParams(window.location.search);
        params.delete("reload");
        const newURL = window.location.pathname + "?" + params.toString();
        history.replaceState(null, null, newURL);
    }
});