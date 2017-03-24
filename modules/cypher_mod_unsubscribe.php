<script type="text/javascript">
        function validateUnsubscribeForm(cypherUnsubscribeForm) 
        {
            if (document.cypherUnsubscribeForm.txtUnsubscribe.value == "") {
                  alert("Please enter your Email Address!");
                  document.cypherUnsubscribeForm.txtUnsubscribe.focus();
                  return false;
            }

            return true;
        }  
        
</script>
<form id="cypherUnsubscribeForm" name="cypherUnsubscribeForm" method="POST" action="common/f_unsubscribe.php" onsubmit="return validateUnsubscribeForm(this);">
  <div class="unsubscribe-form-field">
    <label>
      <em>Your E-mail Address:</em>
    </label>
    <input type="text" id="txtUnsubscribe" name="txtUnsubscribe" class="cypher-FormField"/>
  </div>
  <div style="text-align: center;">
    <input type="submit" value="" class="unsubscribeButton" alt="Unsubscribe to Newsletter" title="Unsubscribe to Newsletter"/>
  </div>
</form>