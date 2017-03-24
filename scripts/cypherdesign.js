var CypherDesign = function () {

    this.notificationMsg = function() {
        var msgCommon = "Please provide ";
        var msg = {
            required_email: msgCommon + "your E-mail address!",
            invalid_email: "Invalid e-mail address! Try again!",
            required_fname: msgCommon + "your First name!",
            required_lname: msgCommon + "your Last name!",
            required_contact: msgCommon + "your Contact number!",
            invalid_contact: "Invalid contact number! Try again!",            
            required_subject: "Select a subject!",
            required_others: "Please specify value for Others!",
            required_guest: msgCommon + "a number of guest!",
            invalid_guest: "Invalid guest value! Try again!",
            required_date: msgCommon + "a date!",
            invalid_date: "Invalid date value! Try again!",
            required_time: msgCommon + "a time!",
            invalid_time: "Invalid time value! Try again!",            
            required_msg: msgCommon + "a message!",
            required_captcha: msgCommon + "a captcha code!",
            invalid_captcha: "Captcha Code not match! Try again!",
            required_newsletter: "Please select a value to subscription!",
            error_1: "There is an error encountered sending your request. Please try again.",
            error_2: "There is an error encountered: Captcha code did not match. Please try again."
        };
        return msg;
    };
    var notif = this.notificationMsg();

    this.isNull = function (fieldId) {
        var f = fieldId.val();

        if (f == '' || f == null || f == '0') {
            return false;
        } else {
            return true;
        }
    };

    this.isEmail = function (email) {
        var x = email.val();
        var at_pos = x.indexOf("@");
        var dot_pos = x.lastIndexOf(".");

        if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
            return false;
        } else {
            return true;
        }
    };

    this.isPhoneNo = function (phone) {
        var validNumbers = "0123456789-()";

        for (var i = 0; i < phone.val().length; i++) {
            if (validNumbers.indexOf(phone.val().charAt(i)) == -1) {                
                return false;
            } else {
                return true;
            }
        }
    };

    this.isDate = function(date) {
        var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
        date = date.val();

        if (!date.match(re)) {
            return false;
        } else {
            return true;
        }
    };

    this.isTime = function(time) {
         var re = /^\d{1,2}:\d{2}([ap]m)?$/;
         time = time.val();

         if (!time.match(re)) {
             return false;
         } else {
             return true;
         }
    };

    this.isNumeric = function(number) {
        number = number.val();

        if (!isNaN(parseFloat(number)) && isFinite(number)) {
            return false;
        } else {
            return true;
        }
    };

    this.captchaCode = function() {
        return $.ajax({type: "POST", url: "common/captcha.php"});
    };

    this.captchaEncode = function() {
        var codeCss = {'display':'none'};
        var code = this.captchaCode();
        code.success(function(data){
            $("#gcode").html(btoa(data)).css(codeCss);
        });
    };

    this.captchaDecode = function() {
        var capRef = $("#gcode").html();
        var decoded = atob(capRef);

        return decoded;
    };

    this.isCaptchaMatch = function(captcha) {
        if (captcha.val() == this.captchaDecode()) {
            return true;

        } else {
            return false;
        }
    };

    this.refreshCaptcha = function () {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
        this.captchaEncode();
    };

    this.validateEmail = function (email) {
        if (!this.isNull(email)) {
            alert(notif.required_email);
            email.focus();
            return false;

        } else if (!this.isEmail(email)) {
            alert(notif.invalid_email);
            email.focus();
            return false;
        }
        return true;
    };

    this.validateFirstName = function( fname) {
        if (!this.isNull(fname)) {
            alert(notif.required_fname);
            fname.focus();
            return false;
        }
        return true;
    };

    this.validateLastName = function (lname) {
        if (!this.isNull(lname)) {
            alert(notif.required_lname);
            lname.focus();
            return false;
        }
        return true;
    };

    this.validateGuest = function (guest) {
        if (!this.isNull(guest)) {
            alert(notif.required_guest);
            guest.focus();
            return false;

        } else if (this.isNumeric(guest)) {
            alert(notif.invalid_guest);
            guest.focus();
            return false;
        }
        return true;
    };

    this.validateOthers = function (others) {
        if (!this.isNull(others)) {
            alert(notif.required_others);
            others.focus();
            return false;
        }
        return true;
    };

    this.validateDate = function (date) {
        if (!this.isNull(date)) {
            alert(notif.required_date);
            date.focus();
            return false;

        } else if (!this.isDate(date)) {
            alert(notif.invalid_date);
            date.focus();
            return false;
        }
        return true;
    };

    this.validateTime = function (time) {
        if (!this.isNull(time)) {
            alert(notif.required_time);
            time.focus();
            return false;

        } else if (!this.isTime(time)) {
            alert(notif.invalid_time);
            time.focus();
            return false;
        }
        
        var timeStr = time.val();
        var alteredTimeStr = timeStr.replace(/:/, "_");
        time.val(alteredTimeStr);
        
        return true;
    };
    
    this.validatePhone = function (phone, min, max) {
        if (!this.isNull(phone)) {
            alert(notif.required_contact);
            phone.focus();
            return false;
            
        } else if (!this.isPhoneNo(phone)) {            
            alert(notif.invalid_contact);
            phone.focus();
            return false;
            
        } else if (phone.val().length <= min) {
            alert("Contact must be minimum of "+min+" chars. only!");
            phone.focus();
            return false;
            
        } else if (phone.val().length > max) {
            alert("Contact must be maximum of "+max+" chars. only!");
            phone.focus();
            return false;
        }
        return true;
    };

    this.validateMessage = function (message) {
        if (!this.isNull(message)) {
            alert(notif.required_msg);
            message.focus();
            return false;
        }
        return true;
    };
    
    this.validateSubscription = function (subscription) {
        if (!this.isNull(subscription)) {
            alert(notif.required_newsletter);
            subscription.focus();
            return false;
        }
        return true;
    };

    this.validateCaptcha = function (captcha) {
        if (!this.isNull(captcha)) {
            alert(notif.required_captcha);
            captcha.focus();
            return false;

        } else if (!this.isCaptchaMatch(captcha)) {
            alert(notif.invalid_captcha);
            this.refreshCaptcha();
            captcha.focus();
            return false;
        }
        return true;
    };
    
    this.formId;
    this.formIsLabeled;
    
    this.resetForm = function () {
        formId = this.formId;
        var fieldTypes = {
            'inputTag': 'input',
            'selectTag': 'select',
            'textareaTag': 'textarea'
        };

        $.each(fieldTypes, function (key, value) {
            var fieldTag = value;
            if (fieldTag == 'input') {
                formId.find(fieldTag).each(function () {
                    if (!this.formIsLabeled) {
                        $(this).val('');
                    } else {
                        $(this).val($(this).attr('title'));
                    }
                });
            } else if (fieldTag == 'select') {
                formId.find(fieldTag).each(function () {
                    $(this).val('0');
                });
            } else if (fieldTag == 'textarea') {
                formId.find(fieldTag).each(function () {
                    $(this).val('');
                });
            }
        });
    };

    this.dataCollector = function (fields) {
        var set = [];
        $.each(fields, function (key, value) {
            var fieldSet = key + ':' + value.val();
            set.push(fieldSet);
        });

        return set;
    };
    
    var overlay = {
        overlayShow: function () {            
            $(".toggle-overlay").addClass("toggle-overlay-loader").show();
        },
        overlayHide: function () {
            $(".toggle-overlay").removeClass("toggle-overlay-loader").hide();
        },
        overlayNoLoader: function() {
            $(".toggle-overlay").removeClass("toggle-overlay-loader");
        }
    };    
    
    var formDialog = {        
        resultContainer: function (dialogTitle, content) {
            $("#result-container").html(content).dialog({
                draggable: false,
                title: dialogTitle,
                open: function (event, ui) {
                    $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
                },
                buttons: {
                    OK: function () {
                        $(this).dialog("close");
                        overlay.overlayHide();
                        location.reload();
                    }
                }
            });
        },
        loadDialog: function (data) {            
            overlay.overlayNoLoader();

            var r = jQuery.parseJSON(data);
            var dialogTitle;
            var content;

            $.each(r, function (key, value) {
                switch (key) {
                    case "success":
                        dialogTitle = "Complete";
                        content = "<span class='dialog-text-success'>" + value + "</span>";
                        break;
                    case "error":
                        dialogTitle = "Error";
                        content = "<span class='dialog-text-error'>" + value + "</span>";
                        break;

                    default:
                }
            });
            
            this.resultContainer(dialogTitle, content);
        }
    };
    
    this.processData = function (dataCollection, urlString) {         
        $.ajax({
            type: "POST",
            url: urlString,
            data: dataCollection,
            beforeSend: function() { overlay.overlayShow(); }
        }).done(function (result) {
            formDialog.loadDialog(result);
            //alert(result);
        });
    };

    this.galleriaTheme;
    this.loadGalleria = function(elementId) {
        Galleria.loadTheme(this.galleriaTheme);
        Galleria.ready(function() {
            var gallery = this;
            $(".galleria-images").click(function() { gallery.openLightbox(); });
        });

        if ($(elementId).length !== 0) { Galleria.run(elementId); }
    };

    this.accordionList;
    this.loadAccordion = function() {
        var accordionIds = this.accordionList;

        $.each(accordionIds, function (index, value) {
            value.accordion({ heightStyle: "content" });
        });
    };

    this.datePickerList;
    this.loadDatePicker = function() {
        var datePickerIds = this.datePickerList;

        $.each(datePickerIds, function (index, value) {
            value.datepicker();
        });
    };

    this.loadDatePickerMin = function() {
        var datePickerIds = this.datePickerList;

        $.each(datePickerIds, function (index, value) {
            value.datepicker({
                minDate: new Date(),
                dateFormat: 'dd/mm/yy'
            });
        });
    };

    this.scrollToTop = function(elementId, scrollSpeed) {
        elementId.on('click', function() {
            $('html, body').animate({scrollTop: 0}, scrollSpeed);
            return false;
        });
    };

    this.floaterElement;
    this.floaterWindowWidth;
    this.loadFloater = function () {
        if ($(window).scrollTop() > 60) {
            this.floaterElement.fadeIn();
        } else {
            if (window.innerWidth >= this.floaterWindowWidth) {
                this.floaterElement.fadeOut();
            }
        }
    };
};