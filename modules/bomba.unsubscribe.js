var bombaUnsubscribe = new CypherDesign();
$(function () {
    if ($('#unsubscribe_form').length === 1) {

        var unsubscribeFields = { email: $('#txtEmail') };

        bombaUnsubscribe.formId = $('#unsubscribe_form');
        bombaUnsubscribe.formIsLabeled = false;

        bombaUnsubscribe.resetForm();

        var formValidated = function () {
            if (!bombaUnsubscribe.validateEmail(unsubscribeFields.email)) {
                return false;
            }

            return true;
        };

        $("#cypher_form_submit").on("click", function () {            
            if (formValidated()) {
                var collection = bombaUnsubscribe.dataCollector(unsubscribeFields);
                var url = "common/send_unsubscribe.php";

                bombaUnsubscribe.processData({set: collection}, url, bombaUnsubscribe.formId);
                bombaUnsubscribe.resetForm();
                bombaUnsubscribe.refreshCaptcha();
            }
        });
    }
});
