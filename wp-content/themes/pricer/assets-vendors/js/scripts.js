$(document).ready(function(){

	/* Slider */
	$('.slider-reviews').slick({
		dots: true,
		responsive: [
			{
			  breakpoint: 850,
			  settings: {
				arrows: false,
			  }
			},
		]
	})

	$('.open-text').on('click', function(){
		const hiddenText = $(this).closest('.example').find('.hidden-text').text()
		const name = $(this).closest('.example').find('.text-2').text()
		$('#modal-text .text').html(hiddenText)
		$('#modal-text .name').html(name)
	})

	$('a[href="#"]').click(function(e){ e.preventDefault(); });

});

function isWebp() {
    function testWebP(callback) {

        var webP = new Image();
        webP.onload = webP.onerror = function () {
        callback(webP.height == 2);
        };
        webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
    }
        
    testWebP(function (support) {
        
        if (support == true) {
        document.querySelector('html').classList.add('webp');
        }else{
        document.querySelector('html').classList.add('no-webp');
        }
    });
}

isWebp()