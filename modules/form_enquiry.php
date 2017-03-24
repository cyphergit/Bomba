<div id="enquiry_form" class="cypher_form">   
    <div class="form_sections">
        <div><span>E-mail Address</span></div>
        <div><input type="text" id="txtEmail" name="txtEmail"/></div>
    </div>
    <div class="form_sections">
        <div><span>First Name</span></div>
        <div><input type="text" id="txtFirstname" name="txtFirstname"/></div>
    </div>
    <div class="form_sections">
        <div><span>Last Name</span></div>
        <div><input type="text" id="txtLastname" name="txtLastname"/></div>
    </div>
    <div class="form_sections">
        <div><span>Subject</span></div>
        <div>
            <select id="txtSubject" name="txtSubject">
                <option value="0">Select Subject</option>
                <option value="General Enquiry">General Enquiry</option>
                <option value="Reservation">Reservation</option>
                <option value="Others">Others</option>
            </select>
        </div>
    </div>
    <div class="subject-others">
        <div class="form_sections">
            <div><span>Other Concern (Please specify)</span></div>
            <div><input type="text" id="txtOthers" name="txtOthers"/></div>
        </div>
    </div>
    <div class="reservation">
        <div class="form_sections">
            <div><span>Number of Guest</span></div>
            <div><input type="text" id="txtGuest" name="txtGuest"/></div>
        </div>
        <div class="form_sections">
            <div><span>Date (dd/mm/yyyy)</span></div>
            <div><input type="text" id="txtDate" name="txtDate"/></div>
        </div>
        <div class="form_sections">
            <div><span>Time (0:00am/pm)</span></div>
            <div><input type="text" id="txtTime" name="txtTime"/></div>
        </div>
    </div>
    <div class="form_sections">
        <div><span>Contact No. (Land line/Mobile)</span></div>
        <div><input type="text" id="txtContact" name="txtContact"/></div>
    </div>    
    <div class="form_sections">
        <div><span>Message</span></div>
        <div><textarea id="txtMessages" name="txtMessages"></textarea></div>
    </div>
    <div class="form_sections">
        <div><span>Subscribe for a Newsletter?</span></div>
        <div>
            <select id="txtNewsletter" name="txtNewsletter">
                <option value="0">Select a value</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>                
            </select>
        </div>
    </div>    
    <div class="form_sections">
            <div><span>Captcha Code</span></div>
            <div><input type="text" id="txtCaptcha" name="txtCaptcha"/></div>
            <div class="captcha-section">
                <img src="modules/captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'/>
                <a class="captcha-refresh">Refresh Captcha Code</a>
                <span id="gcode"></span>
            </div>
        </div>
    <div class="form_sections">
        <div id="result-container"></div>
        <a class="form_button" id="cypher_form_submit">Send</a>        
    </div>
</div>