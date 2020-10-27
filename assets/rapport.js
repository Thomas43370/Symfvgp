require("bootstrap-datepicker");
//require("bootstrap");
console.log('datepicker');
$('.js-datepicker').datepicker({
    weekStart: 1,
    format : 'dd/mm/yyyy',
    todayBtn: 1,
    autoclose: true,
    todayHighlight: 1,
    html5: false,
    language: 'fr'
});
$('#questionnaire').ready(function(){
    $('.ajcomclick').each(function(){
        $(this).click(function(){
            console.log("c parti");
            let id=$(this).attr('id');
            console.log('id = '+id);
            if($('#com'+id).css('display')=='none'){
                $('#com'+id).fadeIn();
            }else{
                $('#com'+id).fadeOut();
                
            }
        })
    })
})