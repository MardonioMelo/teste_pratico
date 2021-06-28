// Script da Home

var portfolioModal = $('.j_portfolio')

portfolioModal.on("click", function (event) {

    $("#j_portfolio_desc").html(event.currentTarget.dataset.desc)
    $("#j_portfolio_title").html(event.currentTarget.dataset.title)
    $("#j_portfolio_img").attr("src", event.currentTarget.dataset.img)
    $("#j_portfolio_img").attr("alt", event.currentTarget.dataset.alt)
    $("#j_btn_soluction").attr("href", "solucao/" + event.currentTarget.dataset.num)
})