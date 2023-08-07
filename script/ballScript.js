const resultBall = ["Насколько<br>я вижу<br>да", "Спроси<br>позже", "Лучше сейчас<br>не говорить<br>тебе", "Не могу<br>сейчас<br>сказать", "Соберись<br>с мыслями<br>и спроси<br>снова",
    "Не рассчитывай<br>на это", "Я так<br>не думаю", "Я сомневаюсь<br>насчёт<br>этого", "Это<br>бесспорно", "Да<br>это так", "Может<br>быть", "Наиболее<br>вероятно",
    "Мои<br>источники<br>говорят<br>нет", "Мои<br>источники<br>говорят<br>да", "НЕТ!", "Перспектива<br>хорошая", "Перспектива<br>не очень<br>хорошая",
    "Спроси<br>позже", "Извини,<br>нет", "Очень<br>сомневаюсь", "Без сомнения", "ДА!", "Определённо<br>да", "Ты можешь<br>надеяться<br>на это"];

let search = document.getElementById("search")
let clear = document.getElementById("clear")
let result = document.getElementById("result")
let imgball = document.querySelector(".imgball")
let textBall = document.getElementById("textBall")

search.addEventListener("click", readSearchBall)
function readSearchBall() {
    if (textBall.value != "") {
        let timer = null;
        const rnd = Math.floor(Math.random() * resultBall.length)

        if (result.innerHTML == "") {
            search.disabled = true
            timer = setTimeout(() => result.classList.add('resultAnimate'), 1800)
            timer = setTimeout(() => result.innerHTML = resultBall[rnd], 1800)
            timer = setTimeout(() => result.classList.remove('resultAnimate'), 3800);
            timer = setTimeout(() => search.disabled = false, 3300);
        } 

        
        else {
            search.disabled = true
            timer = setTimeout(() => result.classList.add('resultAnimate'), 1800)
            result.innerHTML = ""
            timer = setTimeout(() => result.innerHTML = resultBall[rnd], 1800)
            timer = setTimeout(() => result.classList.remove('resultAnimate'), 3800);
            timer = setTimeout(() => search.disabled = false, 3300);
        }
        warning.innerHTML = ""
        imgball.classList.add('imgBallAnimation');
        timer = setTimeout(() => imgball.classList.remove('imgBallAnimation'), 1800);
    }
    else {
        let warning = document.getElementById("warning")
        warning.innerHTML = "заполните поле"

    }


}
clear.addEventListener("click", clearValue)
function clearValue() {
    textBall.value = ""
}

