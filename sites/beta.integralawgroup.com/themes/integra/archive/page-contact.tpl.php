<?php
// $Id: page.tpl.php,v 1.28 2008/01/24 09:42:52 goba Exp $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */  ?> </script>
  

<!--[if IE]>
<style type="text/css" media="all">.borderitem {border-style:solid;}</style>
<![endif]-->
</head>

<body>

<div id="main">
	<div class="rowWrap" >
		<div id="contentlogo">
        <a href="http://integralawgroup.com">
        <img src="<?php global $base_path; print $base_path.path_to_theme(); ?>/images/contentlogo.jpg" width="312" height="124" alt="Welcome to Integra Law Group" />
        </a>
		</div>
		<div id="content-tophead">


             <div class="top-menu">    
<ul class="links top-links">
<li class="menu-209 first active">
<a href="http://integralawgroup.com/user" title="" class="active">Client Login</a></li>
<li class="menu-211"><a href="http://integralawgroup.com/contact" title="">Contact Us</a></li>
</ul>   
			</div>
        
        
		</div>
	</div>
	<div id="contentmenu">
    
    
    
        <!-- menu start -->

                                    <?php // if (isset($primary_links)) : ?>
    
    							<div class="pr-menu">		
                                	
                                       
<ul class="links primary-links">
<li class="menu-115 first"><a href="http://integralawgroup.com/innovative-legal-services">Innovative Legal<br /> Services</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/buying-business">Starting or Buying <br />a Business</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/managing-business">Legal V.P.<br />Service</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/selling-business">Selling a <br />Business</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/preparing-will-or-trust-0">Preparing a <br />Will or Trust</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/getting-divorce">Getting a <br />Divorce</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/obtaining-relief-debt" style="background-image: none">Obtaining <br />Debt Relief</a></li>
</ul> 
                                       
                                            <?php //print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
                                          
                                     


                                </div>      
            
                                    <?php //endif; ?>
          <!-- menu end -->
    
    
	</div>

	<div class="rowWrap" >
    

       	<div id="container">

        <div id="two-columns">
		 
        <div id="column-2">
        


      		        <!-- main content start -->
        
                        <div class="box-cont">
                        
                    
                        
                        

  <?php if ($breadcrumb): ?>
          <div id="breadcrumb">
            <?php print $breadcrumb; ?>
          </div><!-- /breadcrumb -->
  <?php endif; ?>
          
          
          

          
          
              


              <?php if ($tabs): ?>
              <div id="content-tabs">
                <?php print $tabs; ?>
              </div>
              <?php endif; ?>
              
              
              
              
              <br class="clearMod">
             
              
              
                 <span id="heading"><?php // print $title ?></span>
                     
        <?php if ($show_messages) { print $messages; } ?>
        <?php print $help ?>

       <form action="/contact"  accept-charset="UTF-8" method="post" id="contact-mail-page">
<div><font color="Black">You can leave a message using the contact form below.</font><div class="form-item" id="edit-name-wrapper">
 <label for="edit-name">Your name: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="name" id="edit-name" size="60" value="" class="form-text required" />
</div>







<div class="form-item" id="edit-address-wrapper">
 <label for="edit-address">Your address: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="address" id="edit-mail" size="60" value="" class="form-text required" />
</div>


<div class="form-item" id="edit-phone-wrapper">
 <label for="edit-phone">Your phone number: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="phone" id="edit-mail" size="60" value="" class="form-text required" />
</div>










<div class="form-item" id="edit-mail-wrapper">

 <label for="edit-mail">Your e-mail address: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="mail" id="edit-mail" size="60" value="" class="form-text required" />
</div>
<div class="form-item" id="edit-subject-wrapper">
 <label for="edit-subject">Subject: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="subject" id="edit-subject" size="60" value="" class="form-text required" />
</div>
<div class="form-item" id="edit-message-wrapper">
 <label for="edit-message">Message: <span class="form-required" title="This field is required.">*</span></label>

 <textarea cols="60" rows="5" name="message" id="edit-message"  class="form-textarea resizable required"></textarea>
</div>
<div class="form-item" id="edit-copy-wrapper">
 <label class="option"><input type="checkbox" name="copy" id="edit-copy" value="1"   class="form-checkbox" /> Send yourself a copy.</label>
</div>
<input type="submit" name="op" id="edit-submit" value="Send e-mail"  class="form-submit" />
<input type="hidden" name="form_build_id" id="form-95a7f88dfa285c2257948d5b69619b05" value="form-95a7f88dfa285c2257948d5b69619b05"  />
<input type="hidden" name="form_token" id="edit-form-token" value="230240f3ac15835aa90c212e41997971"  />
<input type="hidden" name="form_id" id="edit-contact-mail-page" value="contact_mail_page"  />

</div></form>



        <?php print $feed_icons; ?>
                        

                
         		      </div>              
 	       
		        <!-- main content end -->      
        


                        
                        


		</div>
        
        
        
        
        
        
        
        
        
        
     		<div id="column-1">
  
        
        
<!-- nav start -->        
        
<!--        
        <div class="block block-user" id="block-user-1">
	<div class="block-top"></div>
    <div class="bg-block">
        <div class="bg-block-top">
            <div class="title">
                <h3>Navigation</h3>
            </div>
            <div class="content"><ul class="menu"><li class="leaf first"><a href="/drupal_22436/?q=node" title="" class="active">Home</a></li>
<li class="leaf"><a href="/drupal_22436/?q=forum" title="">Our Forum</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">News</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node" title="" class="active">Blog</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">Solutions</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">Book</a></li>
<li class="leaf"><a href="/drupal_22436/?q=search" title="">Advanced search</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">FAQ&#039;s</a></li>
<li class="leaf"><a href="/drupal_22436/?q=contact" title="">Contact Us</a></li>
<li class="leaf last"><a href="/drupal_22436/?q=tracker">Recent posts</a></li>
</ul></div>
        </div>
    </div>
    <div class="block-bot"></div>
</div>
 -->
 
         <!-- side menu content start -->

<!--
<center>
<br /><br />
<a href="http://integralawgroup.com/content/integra-capital-partners"><img src="<?php // global $base_path; print $base_path.path_to_theme(); ?>/images/integra_cp.jpg" width="210" height="62" alt="Integra Capital Partners" /></a>
</center>
-->

<div class="left-box-cont">
<p>
<b>Integra Law Group</b>
<br />950 W Bannock, 11th Floor
<br />Boise, Idaho 83702
<br>
<br />(208) 386-9000

 <br />

</p>
</div>
 <?php print $left ?>

        <!-- side menu content end -->        
        
        
<!-- nav end -->                
        
        
        
        
        
        
		</div>   
        
        
        
        
        
        
        
        
        
  <div class="clr"></div>       
				</div>
                </div>        
        
        
        
	</div>
	<div id="contentfooter">
    
                         <div class="box-cont-footer">
&copy; 2009 Integra Law Group. All Rights Reserved.<br />
<?php if (isset($secondary_links)) { ?><?php print theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist')) ?><?php } ?>

         
         
         
         
         


              			 </div>
    
    
    
	</div>
</div>


</body>
</html>

