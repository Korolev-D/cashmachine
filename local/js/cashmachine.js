document.addEventListener("DOMContentLoaded", () => {
    initKeyBoard();

    function initKeyBoard(){
        const keyBoardItem = document.querySelectorAll(".cashmachine__select--keyboard-item"),
            pinCode = document.querySelector("input[name=\"FIELDS[PIN_CODE]\"]"),
            formAuthorized = document.querySelector("form.authorized");

        keyBoardItem.forEach(item => {
            item.addEventListener("click", function(e){
                const this_ = e.target,
                    dataValue = this_.dataset.value;

                if(this_.classList.contains("cancel")){
                    pinCode.value = "";
                }else if(this_.classList.contains("ok")){
                    formAuthorized.requestSubmit();
                }else if(pinCode.value.length <= 3){
                    pinCode.value += dataValue;
                }
            });
        });
    }
});