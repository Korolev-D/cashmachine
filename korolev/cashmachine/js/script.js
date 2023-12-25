document.addEventListener("DOMContentLoaded", () => {

    const cashmachineItem = document.querySelectorAll(".js-cashmachine-item");
    const cashmachineSelect = document.querySelectorAll(".js-cashmachine-select");

    cashmachineItem.forEach(function(item){
        item.addEventListener("click", function(){
            const dataColor = item.dataset.color;

            if(dataColor){
                const cashmachineWrap = document.querySelector(".js-cashmachine-wrap");
                cashmachineWrap.classList.remove("red");
                cashmachineWrap.classList.remove("green");
                cashmachineWrap.classList.remove("blue");
                cashmachineWrap.classList.add(dataColor);
            }
            console.log(dataColor)
        });
    });

    // let counter = 0;
    // let text = "Операция: снятие наличных Операция: снятие наличных Операция: снятие наличных Операция: снятие наличных Операция: снятие наличных";
    // const cashmachinePaperText = document.querySelector(".js-cashmachine-select-cheque-paper-text");
    //
    // function appendText(){
    //     cashmachinePaperText.innerHTML += text[counter];
    //     cashmachinePaperText.style.top = parseInt(cashmachinePaperText.style.top) + 1 + "px";
    //     counter++;
    //
    //     if(counter === text.length){
    //         clearInterval(interval);
    //     }
    // }
    //
    // let interval = setInterval(appendText, 100);

});