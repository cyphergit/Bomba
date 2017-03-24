var bombaEnquiry = new CypherDesign();
$(function () {
    if ($('#enquiry_form').length === 1) {

        var enquiryFields = {
            email: $('#txtEmail'),
            firstname: $('#txtFirstname'),
            lastname: $('#txtLastname'),
            subject: $('#txtSubject'),
            others: $('#txtOthers'),
            guest: $('#txtGuest'),
            date: $('#txtDate'),
            time: $('#txtTime'),
            contact: $('#txtContact'),
            message: $('#txtMessages'),
            newsletter: $('#txtNewsletter'),
            captcha: $('#txtCaptcha')
        };

        bombaEnquiry.formId = $('#enquiry_form');
        bombaEnquiry.formIsLabeled = false;

        bombaEnquiry.resetForm();
        bombaEnquiry.captchaEncode();

        var formValidated = function () {
            var notif = bombaEnquiry.notificationMsg();

            if (!bombaEnquiry.validateEmail(enquiryFields.email)) {
                return false;
            }

            if (!bombaEnquiry.validateFirstName(enquiryFields.firstname)) {
                return false;
            }

            if (!bombaEnquiry.validateLastName(enquiryFields.lastname)) {
                return false;
            }

            switch (enquiryFields.subject.val()) {
                case "0":
                    alert(notif.required_subject);
                    enquiryFields.subject.focus();
                    return false;

                    break;

                case "Others":
                    if (!bombaEnquiry.validateOthers(enquiryFields.others)) {
                        return false;
                    }

                    break;

                case "Reservation":
                    if (!bombaEnquiry.validateGuest(enquiryFields.guest)) {
                        return false;
                    }
                    ;

                    if (!bombaEnquiry.validateDate(enquiryFields.date)) {
                        return false;
                    }

                    if (!bombaEnquiry.validateTime(enquiryFields.time)) {
                        return false;
                    }

                    break;
            }

            if (!bombaEnquiry.validatePhone(enquiryFields.contact, 6, 15)) {
                return false;
            }

            if (!bombaEnquiry.validateMessage(enquiryFields.message)) {
                return false;
            }

            if (!bombaEnquiry.validateSubscription(enquiryFields.newsletter)) {
                return false;
            }

            if (!bombaEnquiry.validateCaptcha(enquiryFields.captcha)) {
                return false;
            }

            return true;
        };

        $("#cypher_form_submit").on("click", function () {            
            if (formValidated()) {
                var collection = bombaEnquiry.dataCollector(enquiryFields);
                var url = "common/send_enquiry.php";

                bombaEnquiry.processData({set: collection}, url, bombaEnquiry.formId);
                bombaEnquiry.resetForm();
                bombaEnquiry.refreshCaptcha();
            }
        });

        enquiryFields.subject.on("change", function () {
            switch ($(this).val()) {
                case "Reservation":
                    $('.reservation').show();
                    enquiryFields.guest.focus();
                    $('.subject-others').hide();
                    break;

                case "Others":
                    $('.subject-others').show();
                    enquiryFields.others.focus();
                    $('.reservation').hide();
                    break;

                default:
                    enquiryFields.subject.focus();
                    $('.reservation').hide();
                    $('.subject-others').hide();
            }
        });

        $(".captcha-refresh").on("click", function () {
            bombaEnquiry.refreshCaptcha();
        });
    }
});