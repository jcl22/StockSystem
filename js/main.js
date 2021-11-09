// Initiate the wowjs
new WOW().init();

/* superponertablas */
$('#lista-product').click(function(e){
    e.preventDefault();
  $("#lista-product-table").fadeOut(100);
  $("#solicitud-product-table").delay(100).fadeIn(100);
});

$('#solicitud-product').click(function(e){
    e.preventDefault();
  $("#solicitud-product-table").fadeOut(100);
  $("#lista-product-table").delay(100).fadeIn(100);
});