var bombaPlugIns = new CypherDesign();

$(function () {
    //Social media scroll floater
    bombaPlugIns.floaterElement = $('.socialFloater');
    bombaPlugIns.floaterWindowWidth = 768;
    bombaPlugIns.loadFloater();

    //Galleria Plug-in
    bombaPlugIns.galleriaTheme = 'scripts/galleria/themes/classic/galleria.classic.min.js';
    bombaPlugIns.loadGalleria('#galleria');

    //Jquery Plug-In: Accordion
    bombaPlugIns.accordionList = [$(".faq-list")];
    bombaPlugIns.loadAccordion();

    //Jquery Plug-In: Date Picker
    bombaPlugIns.datePickerList = [$("#txtDate")];
    bombaPlugIns.loadDatePickerMin();    
    
    //Scroll to Top
    bombaPlugIns.scrollToTop($('.scrollToTop'), 800);

    $(window).scroll(function () {
        if ($(this).scrollTop() > 10 ? bombaPlugIns.loadFloater() : bombaPlugIns.loadFloater());
    });

});