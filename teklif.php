<?php
include "header.php"; ?>
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1><?=__c("Teklif")?></h1>
            <ul class="bread-crumb clearfix">
            <li><a href="index"><?= __c("Anasayfa")?></a></li>
                <li><?=__c("Teklif")?></li>
            </ul>
        </div>
    </div>
</section>
<style>
    #regForm {
        background-color: #ffffff;
        margin: 100px auto;
        padding: 40px;
        width: 70%;
        min-width: 300px;
    }


    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    button {
        background-color: #009fe3;
        color: #ffffff;
        border: none;

        font-size: 17px;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #009fe3;
    }
</style>
<section style="margin-top: -55px;">
<form id="regForm" method="POST" action="mail.php">
    <input type="hidden" name="mail_type" value="teklif">
   <center><h1><?=__c("Teklif Formu")?></h1></center> <br>
    <?php if (@$_GET['message']) { ?>
        <?= showAlert(@$_GET['type'], $_GET['message']) ?>
    <?php } ?>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <label><b><?=__c("Adı Soyadı ")?>*</b></label>
        <p><input placeholder="<?=__c("Adınızı ve soyadınızı giriniz")?>" oninput="this.className = ''" name="name" autocomplete="off" ></p><br>
        <label><b><?=__c("Ülke")?> *</b></label>
        <p><select class="form-control" style="border: 1px solid #aaaaaa !important;" name="country"><br>
        <?php  
        $ulkesor = $db->prepare("SELECT * FROM ulkeler order by ulke_id ASC");
        $ulkesor->execute(); 
        foreach($ulkesor as $ulkecek){
        ?>
                <option value="<?php echo $ulkecek['ulke_id'] ?>"><?php echo __c($ulkecek['name']) ?></option>
                <?php }?>
            </select></p><br>
        <label> <b><?=__c("Şehir")?> *</b></label>
        <p><input placeholder="<?=__c("Şehir giriniz")?>" oninput="this.className = ''" name="city" autocomplete="off"></p><br>
        <label><b> <?=__c("Email")?> *</b></label>
        <p><input placeholder="<?=__c("E-mail giriniz")?>" oninput="this.className = ''" name="email" autocomplete="off"></p><br>
        <label><b> <?=__c("Telefon")?> *</b></label>
        <p><input placeholder="<?=__c("Telefon giriniz")?>" oninput="this.className = ''" name="phone" autocomplete="off"></p><br>
    </div>

    <div class="tab">
        <label><b> <?=__c("Ürün (Ne üretmek istersiniz?)")?> *</b></label>
        <p><input oninput="this.className = ''" name="urun_name" autocomplete="off"></p><br>
        <label><b> <?=__c("Gram (Ürün Başı)")?>  *</b> </label>
        <p><input oninput="this.className = ''" name="urun_gram" autocomplete="off"></p><br>
        <label><b> <?=__c("Kaç adet ürün üretilecek (8 saatte) ")?>*</b></label>
        <p><input oninput="this.className = ''" name="urun_saat" autocomplete="off"></p>
    </div>

    <div style="overflow:auto;">
        <div style="float:right;">
            <br>
            <button type="button" id="prevBtn" style="padding: 10px 20px;" onclick="nextPrev(-1)"><b><?=__c("Geri")?></b> </button>
            <button type="button" id="nextBtn" style="padding: 10px 20px;" onclick="nextPrev(1)"><b><?=__c("İleri")?></b></button>
        </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>

    </div>
</form>
</section>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "<b> >>";
        } else {
            document.getElementById("nextBtn").innerHTML = "<b> >>";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        if((currentTab + n) == x.length){
            // ... the form gets submitted:
            $("#nextBtn").hide();
            document.getElementById("regForm").submit();
            return false;
        }else{
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>

<?php include "footer.php"; ?>