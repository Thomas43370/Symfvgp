import $ from 'jquery';

/**----Formulaire--------Formulaire--------Formulaire--------Formulaire--------Formulaire--------Formulaire--------Formulaire---- */
$(document).ready(function(){
    /**Coche/Decoche toutes les cases de commun */
    $('#valideCheckForm').click(function(){
        console.log('C parti pour l\'admin');
        if($('#valideCheckForm').prop("checked")==false){
            $('#FormAjaxForm input[type=checkbox]').each(function(){
                $(this).prop("checked", false)
            })
        }else{
            $('#FormAjaxForm input[type=checkbox]').each(function(){
                $(this).prop("checked", true)
            })
        }
    })
    /**Coche/Decoche toutes les cases de levage */
    $('#valideCheckLev').click(function(){
        console.log('C parti pour l\'admin');
        if($('#valideCheckLev').prop("checked")==false){
            $('#FormAjaxLev input[type=checkbox]').each(function(){
                $(this).prop("checked", false)
            })
        }else{
            $('#FormAjaxLev input[type=checkbox]').each(function(){
                $(this).prop("checked", true)
            })
        }
    })
    /**Coche/Decoche toutes les cases des equipements */
    $('#valideCheckEqui').click(function(){
        if($('#valideCheckEqui').prop("checked")==false){
            $('#FormAjaxEqui input[type=checkbox]').each(function(){
                $(this).prop("checked", false)
            })
        }else{
            $('#FormAjaxEqui input[type=checkbox]').each(function(){
                $(this).prop("checked", true)
            })
        }
    })

})

/**--------Questionnaire------------------Questionnaire------------------Questionnaire------------------Questionnaire------------------Questionnaire------------------Questionnaire---------- */
    

/**Recuperation en ajax de ts les titres et pose dans le select de class="titrage" */
    function RecupereTsTitres(){
        $('.titrage').each( function(){
            /**Le rappel des titres  */
            var lettre=$(this).attr('title');
            //console.log('recuperation Titres'); 
            //console.log('lettre='+lettre);
            $.ajax({
                url: "/admin/ajax/QuestionnaireAjax",
                type: "GET",
                datatype: "json",
                async: true,
                success: (data, status) => {
                    var option='<option value="">Faites votre choix de titre</option>';
                    data.forEach(function(element){
                        option+='<option value="'+element.id+'">'+element.name+'</option>';
                    });
                    $('#titre'+lettre).html(option);
                },
                error: function(xhr, textStatus, errorThrown){
                    console.log(textStatus);
                }
            })
            /**La gestion de l'affichage */


            /**Lancement de la recuperation des questions */
            $(this).change(function(){
                var idtitre=$(this).val();
                navy_seals_question(idtitre, lettre);

            })
        })
    }


  /**La fonction de recuperation des questions  */
  function navy_seals_question(idtitre, lettre){
    console.log(lettre+' les questions sont parties');
    $.ajax({
        url: "/admin/ajax/Questions",
        type: "GET",
        datatype: "json",
        data: 'idtitre=' +idtitre+'&regle='+$('#regle').val(),
        async: true,
        success: (data, status) => {
            //console.log(data);
            var long=data.length;
            var max=0;
            var option='<option value="">Faites votre choix de question</option>';
            data.forEach(function(element){
                option+='<option value="'+element.id+'">'+element.question+' - '+element.verif+'</option>';
                max++;
            });
            $('#tableau'+lettre).html('');
            if(max==0){
                $('#tableau'+lettre).append('<p>PAS DE QUESTION RATTACHEE A CE TITRE DANS CETTE REGLEMENTATION</p>');
            }
            for(var i=1; i<=max; i++){
                $('#tableau'+lettre).append('<p id="lign-'+lettre+'-'+i+'">Question '+lettre+'-'+i+'<select name="'+lettre+'-'+i+'">'+option+'</select></p>');
            }
        },
        error: function(xhr, textStatus, errorThrown){
            console.log(textStatus);
        }
    })
}

$('#Questionnaire').ready(()=>{
    RecupereTsTitres();
    $('#affTitre').click(() => {
        var alphabet=new Array('G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y');
        if($('#G').css('display')=='none'){
            for(var i=0; i<=8; i++){
                $('#'+alphabet[i]).css('display', 'block');
            }
        }else{
            for(var i=9; i<=18; i++){
                $('#'+alphabet[i]).css('display', 'block');
            }
        }
    })
})