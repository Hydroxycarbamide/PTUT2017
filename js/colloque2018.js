jQuery(document).ready(function() {
  var duration = 500;
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 100) {
      // Si un défillement de 100 pixels ou plus.
      // Ajoute le bouton
      jQuery('#topButton').fadeIn(duration);
    } else {
      // Sinon enlève le bouton
      jQuery('#topButton').fadeOut(duration);
    }

    if (jQuery(this).scrollTop() > 120) {
      jQuery('.sousMenu-ul').addClass('positionFixed');
    } else {
      jQuery('.sousMenu-ul').removeClass('positionFixed');
    }

  });
  
  jQuery('#topButton').click(function(event) {
    // Un clic provoque le retour en haut animé.
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, 1000);
    return false;
  })
  jQuery('#a_bottom').click(function(event) {
    // Un clic provoque le retour en haut animé.
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 900}, 1000);
    return false;
  });

  jQuery('.partieCachee').hide();

  scrollInfoPratiques();


});

function modifierInfo(boutonModif, idFormAModifier){
  var paragraphe = document.querySelector('#p' + idFormAModifier);
  var form = document.querySelector('#form' + idFormAModifier);

  jQuery(boutonModif).hide();
  jQuery(paragraphe).hide();
  jQuery(form).show();
}

function modifierInfoPratiques(boutonModif, idFormAModifier, typeIP){
  var paragraphe = document.querySelector('#infos' + typeIP + idFormAModifier);
  var form = document.querySelector('#formModif' + typeIP + idFormAModifier);

  jQuery(boutonModif).hide();
  jQuery(paragraphe).hide();
  jQuery(form).show();
}

function modifierInfoAdd(boutonAjout, idFormAAjouter){
  var form = document.querySelector('#' + idFormAAjouter);

  jQuery(boutonAjout).hide();
  jQuery(form).show();
}

function modifierInfoSuppr(boutonSuppression, idFormASupprimer){
  var btnModif = document.querySelector('#lien' + idFormASupprimer);
  var paragraphe = document.querySelector('#p' + idFormASupprimer);
  var form = document.querySelector('#formSuppr' + idFormASupprimer);

  jQuery(btnModif).hide();
  jQuery(paragraphe).hide();
  jQuery(boutonSuppression).hide();
  jQuery(form).show();
}

function modifierInfoSupprInfoPratiques(boutonSuppression, idFormASupprimer, typeIP){
  var btnModif = document.querySelector('#btnModif' + idFormASupprimer);
  var paragraphe = document.querySelector('#infos' + typeIP + idFormASupprimer);
  var form = document.querySelector('#formSuppr' + typeIP + idFormASupprimer);

  jQuery(btnModif).hide();
  jQuery(paragraphe).hide();
  jQuery(boutonSuppression).hide();
  jQuery(form).show();
}

function scrollInfoPratiques(){

  var sections = [];
  var id = false;
  var $navbar = $('.sousMenu-ul');
  var $navbar_a = $('a', $navbar);

  // Scroll vers ancre
  $navbar_a.click(function(e){
    e.preventDefault();
    jQuery('html, body').animate({
      scrollTop: id = $($(this).attr('href')).offset().top - 80
    }, 1000);
    hash($(this).attr('href'));
  });

  $navbar_a.each(function(){
    sections.push($($(this).attr('href')));
  });

  $(window).scroll(function(e){
    var scrollTop = $(this).scrollTop() + ($(window).height() / 2)
    for(var i in sections){
      var section = sections[i];
      if(scrollTop > section.offset().top){
        var scrolled_id = section.attr('id');
      }
    }
    if(scrolled_id !== id){
      id = scrolled_id
      $navbar_a.removeClass('infoPActif');
      $('a[href="#' + id + '"]', $navbar).addClass('infoPActif');
      var themenu = document.querySelector('#themenu');
      if (id == 'accesiut') {
        console.log("Accès IUT");
        $(themenu).addClass('navbarRed');
        $('.smenu').css("color", "#767676");
        $('.infoPActif').css("border-left-color", "#7D0A0A");
        $('.infoPActif').css("color", "#7D0A0A");
        console.log("Couleur changée");
      } else {
        $(themenu).removeClass('navbarRed');
        $('.smenu').css("color", "#767676");
        $('.infoPActif').css("border-left-color", "#1C5080");
        $('.infoPActif').css("color", "#1C5080");
      }
      //console.log("Menu changé pour : " + id)   
    }
  });

  //console.log(sections);

}

hash = function(h){
  if(history.pushState){
    history.pushState(null, null, h)
  }
  else {
    location.hash = h;
  }
}